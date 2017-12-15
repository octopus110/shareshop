<?php

namespace App\Http\Controllers;

use App\Classify;
use App\Commodity;
use App\Image;
use App\Member;
use App\Order;
use App\Property;
use App\Address;
use EasyWeChat\Foundation\Application;
use Illuminate\Support\Facades\Log;
use Validator;
use EasyWeChat;
use Illuminate\Http\Request;

class indexController extends Controller
{
    public function index(Request $request)
    {
        $imageModel = new Image();
        $banner = $imageModel->where('classify', 1)->select('id', 'src')->get();

        $classifyModel = new Classify();
        $classify = $classifyModel->select('id', 'src', 'name')->get();

        $commoditysModel = new Commodity();
        $newcommoditys = $commoditysModel->select(
            'commoditys.id', 'commoditys.name', 'commoditys.price', 'users.storename', 'images.src'
        )->leftjoin('images', 'images.cid', 'commoditys.id')
            ->leftjoin('users', 'users.id', 'commoditys.sid')
            ->groupby('commoditys.id')
            ->orderBy('commoditys.id', 'desc')->limit(4)->get();

        $salescommoditys = $commoditysModel->select(
            'commoditys.id', 'commoditys.name', 'commoditys.price', 'users.storename', 'images.src'
        )->leftjoin('images', 'images.cid', 'commoditys.id')
            ->leftjoin('users', 'users.id', 'commoditys.sid')
            ->groupby('commoditys.id')
            ->orderBy('commoditys.sales', 'desc')->limit(4)->get();

        return view('index', [
            'banner' => $banner,
            'newcommoditys' => $newcommoditys,
            'classify' => $classify,
            'salescommoditys' => $salescommoditys,
            /*'mid' => session()->get('mid')*/
        ]);
    }

    public function _list($id = -2, $k = 0)
    {
        $classifyModel = new Classify();
        $classify = $classifyModel->select('id', 'name')->get();

        return view('list', [
            'classify' => $classify,
            'id' => $id,
            'k' => $k
        ]);
    }

    public function ajax_list(Request $request, $id)
    {
        $commoditysModel = new Commodity();

        $page = $request->input('page');
        $offset = ($page - 1) * 8;

        if ($id == -1) {
            $commoditysModel = $commoditysModel->orderBy('commoditys.id', 'desc');
        } else if ($id == 0) {
            $commoditysModel = $commoditysModel->orderBy('commoditys.sales', 'desc');
        } else if ($id > 0) {
            $commoditysModel = $commoditysModel->where('commoditys.classify_id', $id);
        }

        $commoditys = $commoditysModel->select(
            'commoditys.id', 'commoditys.name', 'commoditys.price', 'users.storename', 'images.src'
        )
            ->leftjoin('images', 'images.cid', 'commoditys.id')
            ->leftjoin('users', 'users.id', 'commoditys.sid')
            ->groupby('commoditys.id')
            ->offset($offset)
            ->limit(8)
            ->get();

        return response()->json($commoditys);
    }

    public function detail($id = 15)
    {
        $commoditysModel = new Commodity();
        $data = $commoditysModel->select(
            'commoditys.id', 'commoditys.name', 'commoditys.price', 'commoditys.quantity', 'commoditys.introduce', 'users.storename', 'users.logo', 'users.storeintroduce'
        )
            ->leftjoin('users', 'users.id', 'commoditys.sid')
            ->find($id);

        $imagModel = new Image();
        $images = $imagModel->where('cid', $id)->select('src')->get();

        $propertysModel = new Property();
        $propertysDb = $propertysModel->where('cid', $id)->select('id', 'title', 'content')->get();
        $propertys = [];
        $propertysNum = count($propertysDb);
        if ($propertysNum) {
            foreach ($propertysDb as $k => $item) {
                $propertys[$k]['title'] = $item->title;
                $propertys[$k]['content'] = array_filter(explode(',', $item->content));
            }
        }

        return view('detail', [
            'data' => $data,
            'images' => $images,
            'propertys' => $propertys
        ]);
    }

    protected function options()
    {
        return [
            'app_id' => env('WECHAT_APPID', 'wx45758c4b029a3bcc'),         // AppID
            'secret' => env('WECHAT_SECRET', '3d47b3bee2474f09b16e5ff6500e31f5'),     // AppSecret
            'token' => env('WECHAT_TOKEN', 'mall'),

            // payment
            'payment' => [
                'merchant_id' => '1494016742',
                'key' => 'qwertyuiopqwertyuiopqwertyuiop12',
                'cert_path' => '/data/web/shareshop/public/cert/apiclient_cert.pem',
                'key_path' => '/data/web/shareshop/public/cert/apiclient_key.pem'
            ],
        ];
    }

    //单个产品支付
    public function pay(Request $request)
    {
        $id = $request->session()->get('order_id');

        $user = session('wechat.oauth_user');
        $openid = $user['id'];

        $orderMode = new Order();
        $order = $orderMode->select(
            'id', 'cid', 'uid', 'money', 'sum', 'attr', 'rid'
        )->find($id);

        $address = (new Address())->where('type', 1)->select(
            'name', 'phone', 'info'
        )->find($order->uid);

        $commdity = (new Commodity())->select(
            'commoditys.name', 'images.src', 'commoditys.price'
        )
            ->leftJoin('images', 'images.cid', 'commoditys.id')
            ->groupby('commoditys.id')
            ->find($order->cid);

        /*
         * 生成微信支付订单信息
         * */
        $options = $this->options();
        $app = new Application($options);
        $payment = $app->payment;

        $attributes = [
            'trade_type' => 'JSAPI', // JSAPI，NATIVE，APP...
            'openid' => $openid,
            'body' => $commdity->name,
            'detail' => $commdity->name, //我这里是通过订单找到商品详情，你也可以自定义
            'out_trade_no' => $order->rid,
            'total_fee' => $order->money * 100,
            'notify_url' => url('/pay/callback'),
            'attach' => ''
        ];

        $orderwechat = new \EasyWeChat\Payment\Order($attributes);
        $result = $payment->prepare($orderwechat);
        if ($result->return_code == 'SUCCESS' && $result->result_code == 'SUCCESS') {
            $prepayId = $result->prepay_id;
            $config = $payment->configForJSSDKPayment($prepayId);
        } else {
            dd($result);
        }

        return view('order', [
            'order' => $order,
            'address' => $address,
            'commdity' => $commdity,
            'config' => $config,
            'js' => $app->js
        ]);
    }

    //根据订单id支付（待支付）
    public function multiple_pay($multiple_id = '')
    {
        $multiple_id = explode(',', rtrim($multiple_id, ','));

        $user = session('wechat.oauth_user');
        $openid = $user['id'];

        $orderMode = new Order();
        $commdityModel = new Commodity();

        $body = $out_trade_no = '';
        $money = 0;
        $order_sum = 0;
        foreach ($multiple_id as $k => $id) {
            $order = $orderMode->select(
                'id', 'cid', 'uid', 'money', 'sum', 'attr', 'rid'
            )->find($id);

            $commdity = $commdityModel->select(
                'commoditys.name', 'images.src', 'commoditys.price'
            )
                ->leftJoin('images', 'images.cid', 'commoditys.id')
                ->groupby('commoditys.id')
                ->find($order->cid);

            $data[$k]['order'] = $order;
            $data[$k]['commdity'] = $commdity;

            $body .= $commdity->name . ' ';
            $out_trade_no .= $order->rid . ' ';
            $money += $order->money;
            $order_sum++;
        }

        $address = (new Address())->where('type', 1)->select(
            'name', 'phone', 'info'
        )->find($order->uid);

        /*
         * 生成微信支付订单信息
         * */
        $options = $this->options();
        $app = new Application($options);
        $payment = $app->payment;

        $attributes = [
            'trade_type' => 'JSAPI', // JSAPI，NATIVE，APP...
            'openid' => $openid,
            'body' => $body,
            'detail' => $body, //我这里是通过订单找到商品详情，你也可以自定义
            'out_trade_no' => $out_trade_no,
            'total_fee' => $money * 100,
            'notify_url' => url('/multiple_pay/callback'),
            'attach' => ''
        ];

        $orderwechat = new \EasyWeChat\Payment\Order($attributes);
        $result = $payment->prepare($orderwechat);
        if ($result->return_code == 'SUCCESS' && $result->result_code == 'SUCCESS') {
            $prepayId = $result->prepay_id;
            $config = $payment->configForJSSDKPayment($prepayId);
        } else {
            dd($result);
        }

        return view('multiple_order', [
            'data' => $data,
            'address' => $address,
            'money' => $money,
            'order_sum' => $order_sum,
            'config' => $config,
            'js' => $app->js
        ]);
    }

    public function multiple_callback(Request $request)
    {
        $options = $this->options();
        $app = new Application($options);
        $payment = $app->payment;

        $response = $payment->handleNotify(function ($notify, $successful) {
            // 使用通知里的 "微信支付订单号" 或者 "商户订单号" 去自己的数据库找到订单
            $order_id = explode(' ', $notify->out_trade_no);

            foreach ($order_id as $id) {
                $order = Order::where('rid', $id)->first();
                // 检查订单是否已经更新过支付状态
                if ($order->status == 0) { //已经是支付状态
                    return true;
                }
                // 用户是否支付成功
                if ($successful) {
                    $order->status = 0;
                }
                $order->save();//更新订单已付款
            }
            return true;
        });
        return $response;
    }

    public function callback(Request $request)
    {
        $options = $this->options();
        $app = new Application($options);
        $payment = $app->payment;

        $response = $payment->handleNotify(function ($notify, $successful) {
            // 使用通知里的 "微信支付订单号" 或者 "商户订单号" 去自己的数据库找到订单
            $order = Order::where('rid', $notify->out_trade_no)->first();

            // 检查订单是否已经更新过支付状态
            if ($order->status == 0) { //已经是支付状态
                return true;
            }
            // 用户是否支付成功
            if ($successful) {
                $order->status = 0;
            }

            $ret = $order->save();//更新订单已付款

            if ($ret) {
                return true;
            }

            return false;
        });
        return $response;
    }

    public function order(Request $request)
    {
        $user = session('wechat.oauth_user');
        $openid = $user['id'];

        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['statusCode' => 100]);
        }

        $uid = (new Member())->where('openid', $openid)->select('id')->first();
        $uid = $uid->id;

        $order = new Order();
        $id = $request->input('id');

        $sid = (new Commodity())->select('sid', 'price', 'name')->find($id);
        $money = $sid->price * $request->input('sum');

        $id = $order->insertGetId([
            'sid' => $sid->sid,
            'cid' => $id,
            'type' => 0,
            'uid' => $uid,
            'money' => $money,
            'rid' => 'eos' . time(),
            'sum' => $request->input('sum', 1),
            'attr' => $request->input('attr', ''),
            'status' => 1,
            'proinfo' => $sid->name,
            'delivery' => 0,
        ]);

        $request->session()->put('order_id', $id);

        if ($id) {
            return response()->json(['statusCode' => 200]);
        }
    }
}
