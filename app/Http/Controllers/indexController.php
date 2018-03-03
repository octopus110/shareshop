<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Classify;
use App\Commodity;
use App\Earning;
use App\Image;
use App\Member;
use App\Order;
use App\Property;
use App\Address;
use App\User;
use EasyWeChat\Foundation\Application;
use Illuminate\Support\Facades\Log;
use Validator;
use EasyWeChat;
use Illuminate\Http\Request;

class indexController extends Controller
{
    protected function options()
    {
        return [
            'app_id' => env('WECHAT_APPID', ''),
            'secret' => env('WECHAT_SECRET', ''),
            'token' => env('WECHAT_TOKEN', ''),

            'payment' => [
                'merchant_id' => env('MERCHANT_ID', ''),
                'key' => env('WEICHAT_PAY', ''),
                'cert_path' => '/data/web/shareshop/public/cert/apiclient_cert.pem',
                'key_path' => '/data/web/shareshop/public/cert/apiclient_key.pem'
            ],
        ];
    }

    //测试微信支付
    public function test()
    {
        $tools = new \Libs\weixin\JsApiPay();

        $openId = $tools->GetOpenid();

        $input = new \WxPayUnifiedOrder();

        $input->SetBody("test");
        $input->SetAttach("test");
        $input->SetOut_trade_no(WxPayConfig::MCHID.date("YmdHis"));
        $input->SetTotal_fee("1");
        $input->SetTime_start(date("YmdHis"));
        $input->SetTime_expire(date("YmdHis", time() + 600));
        $input->SetGoods_tag("test");
        $input->SetNotify_url("http://paysdk.weixin.qq.com/example/notify.php");
        $input->SetTrade_type("JSAPI");
        $input->SetOpenid($openId);
        $order = \WxPayApi::unifiedOrder($input);

        return $tools->GetJsApiParameters($order);
    }

    public function index(Request $request)
    {
        $imageModel = new Image();
        $banner = $imageModel->where('classify', 1)->select('id', 'src', 'href')->get();

        $classifyModel = new Classify();
        $classify = $classifyModel->select('id', 'src', 'name')->orderBy('sort', 'desc')->get();

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

    public function detail($id = 0, $userid = null)
    {
        $commoditysModel = new Commodity();
        $imagModel = new Image();
        $propertysModel = new Property();

        $data = $commoditysModel->select(
            'commoditys.id', 'commoditys.name', 'commoditys.price', 'commoditys.quantity', 'commoditys.introduce', 'users.storename', 'users.logo', 'users.storeintroduce'
        )
            ->leftjoin('users', 'users.id', 'commoditys.sid')
            ->find($id);
        $images = $imagModel->where('cid', $id)->select('src')->get();
        $propertysDb = $propertysModel->where('cid', $id)->select('id', 'title', 'content')->get();
        $propertys = [];
        $propertysNum = count($propertysDb);
        if ($propertysNum) {
            foreach ($propertysDb as $k => $item) {
                $propertys[$k]['title'] = $item->title;
                $propertys[$k]['content'] = array_filter(explode(',', $item->content));
            }
        }

        $app = new Application($this->options());

        return view('detail', [
            'openid' => session('wechat.oauth_user')['id'],
            'userid' => $userid,
            'data' => $data,
            'images' => $images,
            'propertys' => $propertys,
            'js' => $app->js
        ]);
    }

    //创建订单接口
    public function create_order(Request $request)
    {
        //产品id
        $validator = Validator::make($request->all(), [
            'type' => 'required', //0传递的是商品id 1传递的是订单id
        ]);
        if ($validator->fails()) {
            return response()->json(['statusCode' => 100]);
        }

        $user = session('wechat.oauth_user');
        $openid = $user['id'];

        $membreModel = new Member();
        $orderModel = new Order();
        $commdityModel = new Commodity();

        $memberid = $this->addWechatMember();

        if ($request->input('type') == 0) { //传递的是产品id
            $dataArr = $request->input('commodityid');
            $dataArr = array_filter($dataArr);

            $cartsModel = new Cart();

            $orderIds = [];//存放订单id的数组
            foreach ($dataArr as $k => $v) {//一个订单一个产品
                $one = $commdityModel->select('sid', 'price', 'name')->find($k);
                $money = $one['price'] * $v['sum'];

                $id = $orderModel->insertGetId([
                    'sid' => $one->sid,
                    'cid' => $k,
                    'type' => 0,
                    'uid' => $memberid,
                    'money' => $money,
                    'rid' => 'eos' . time(),
                    'sum' => $v['sum'],
                    'attr' => $v['attr'],
                    'status' => 1,
                    'proinfo' => $one->name,
                    'delivery' => 0,
                    'shareshopid' => $request->input('userid')
                ]);

                array_push($orderIds, $id);

                //如果是从cart来的 更新cart状态
                $cart = $cartsModel->where([
                    'uid' => $memberid,
                    'cid' => $k
                ])->select('id')->first();

                if (isset($cart->id)) {
                    $cart->where('id', $cart->id)->delete();
                }
            }
        } else if ($request->input('type') == 1) { //传递的是订单id
            $orderIds = $request->input('orderid');
        }

        session()->put('orderid', $orderIds);
        return response()->json(['statusCode' => 200]);
    }

    //支付接口
    public function pay(Request $request)
    {
        $orderid = $request->session()->get('orderid'); //订单id是一个数组

        $user = session('wechat.oauth_user');
        $openid = $user['id'];

        $mid = $this->addWechatMember();

        $addressModel = new Address();
        $orderModel = new Order();
        $commodityModel = new Commodity();

        $address = $addressModel->where('type', 1)->where('uid', $mid)->select(
            'id', 'name', 'phone', 'info'
        )->first();

        $money = $sum = 0;//总价格初始化 0元
        $commditys = $orders = [];

        $orders = $orderModel->whereIn('id', $orderid)->select('id', 'cid', 'money', 'sum', 'attr')->get();
        foreach ($orders as $item) {
            $money += $item->money;
            $sum += $item->sum;
            $com = $commodityModel->select(
                'commoditys.id', 'commoditys.name', 'commoditys.price', 'images.src'
            )->leftjoin('images', 'images.cid', 'commoditys.id')
                ->groupby('commoditys.id')
                ->find($item->cid);
            array_push($commditys, $com);
        }

        $orderidstr = implode(' ', $orderid);//用于构造out_trade_no

        /*
         * 生成微信支付订单信息
         * */
        $app = new Application($this->options());
        $payment = $app->payment;

        $attributes = [
            'trade_type' => 'JSAPI',
            'openid' => $openid,
            'body' => 'EOS商品购买',
            'detail' => 'EOS商品购买 订单id是(多个订单的话 id用空格分割)：' . $orderidstr,
            'out_trade_no' => 'eos' . time(),
            'total_fee' => $money * 100,
            'notify_url' => url('/pay/callback'),
            'attach' => $orderidstr //用于回调是的更新订单状态
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
            'order' => $orders,
            'address' => $address,
            'commdity' => $commditys,
            'money' => $money,
            'sum' => $sum,
            'config' => $config,
            'js' => $app->js
        ]);
    }

    //支付回调接口
    public function callback()
    {
        $app = new Application($this->options());
        $payment = $app->payment;

        $response = $payment->handleNotify(function ($notify, $successful) {
            if ($successful) {
                $orderid = explode(' ', $notify->attach); //获取订单id
                $orderModel = new Order();
                $memberModel = new Member();
                $userModel = new User();
                foreach ($orderid as $item) {
                    $order = $orderModel->find($item);
                    // 检查订单是否已经更新过支付状态
                    if ($order->status != 0) { //已经是支付状态
                        $order->status = 0;
                    }
                    $order->save();
                    if ($order->shareshopid && $order->money > 0) { //如果存在分享者的id并且交易金额大于50要给你分享者分发利益
                        $member = $memberModel->where('id', $order->shareshopid)->first();
                        $user = $userModel->where('id', $order->sid)->first();
                        $member->earnings = $member->earnings * 1 + $user->profit * 1;
                        $member->type = 1;
                        $member->save();
                        //更新注册商表，让他的个体注册商里包含此用户
                        $user->mid = $user->mid . ',' . $member->id;
                        $user->save();
                    }
                }
                return true;
            } else {
                return false;
            }
        });
        return $response;
    }

    //发红包接口
    public function packet()
    {
        $user = session('wechat.oauth_user');
        $openid = $user['id'];
        $memberModel = new Member();
        $member = $memberModel->where('openid', $openid)->select('id', 'getearnings', 'realname', 'IDnumber')->first();

        if (!($member->realname && $member->IDnumber)) {
            return view('redpack_fails', ['title' => '个人信息不完整']);
        }
        if (isset($member->getearnings) && $member->getearnings >= 50) {
            $app = new Application($this->options());
            $redpack = $app->lucky_money;

            $redpackData = [
                'mch_billno' => 'xy123456',
                'send_name' => 'EOS商城发放红包',
                're_openid' => $openid,
                'total_amount' => $member->getearnings * 100,  //单位为分
                'wishing' => 'EOS商城发放红包',
                'act_name' => 'EOS商城发放红包',
                'remark' => 'EOS商城发放红包',
            ];
            $ret = $redpack->sendNormal($redpackData);

            if ($ret->return_code == 'SUCCESS' && $ret->result_code == 'SUCCESS') {
                $earning = new Earning();

                $earning->money = $member->getearnings;
                $earning->uid = $member->id;
                $earning->cid = 0;
                $earning->save();

                $member->getearnings = 0;
                $member->save();
                return view('pay_success', ['title' => '发放成功']);
            } else {
                return view('redpack_fails', ['title' => '红包发放未开放']);
            }
        } else {
            return view('redpack_fails', ['title' => '50元以上才能提现']);
        }
    }
}
