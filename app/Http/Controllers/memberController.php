<?php

namespace App\Http\Controllers;

use App\Address;
use App\Cart;
use App\Commodity;
use App\Member;
use App\Order;
use EasyWeChat\Factory;
use EasyWeChat\Support\Log;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class memberController extends Controller
{
    /*public function login(Request $request)
    {
        if ($request->isMethod('get')) {

            $mid = $request->session()->get('mid');

            if ($mid) {
                return redirect('/');
            } else {
                return view('login', [
                    'redirect_url' => session()->get('redirect_url'),
                ]);
            }
        } else {
            $validator = Validator::make($request->all(), [
                'type' => 'required'
            ]);

            if ($validator->fails()) {
                return response()->json(['statusCode' => 100]);
            }

            $ret = false;
            $member = new Member();

            switch ($request->input('type')) {
                case 0:
                    $validator = Validator::make($request->all(), [
                        'email' => 'required',
                        'password' => 'required'
                    ]);

                    if ($validator->fails()) {
                        return response()->json(['statusCode' => 100]);
                    }

                    $memberInfo = $member->where([
                        ['email', '=', $request->input('email')],
                        ['password', '=', md5($request->input('password'))]
                    ])->select('id')->first();

                    if ($memberInfo) {
                        $request->session()->put('mid', $memberInfo->id);
                        return response()->json(['statusCode' => 200]);
                    } else {
                        return response()->json(['statusCode' => 100]);
                    }
                    break;
                case 1:
                    $validator = Validator::make($request->all(), [
                        'email' => 'required|unique:members',
                        'nick' => 'required',
                        'password' => 'required'
                    ]);

                    if ($validator->fails()) {
                        return response()->json(['statusCode' => 100]);
                    }

                    $ret = $member->save();
                    $id = $member->insertGetId([
                        'email' => $request->input('email'),
                        'password' => $request->input('password'),
                        'nickname' => $request->input('nick'),
                        'type' => 0,
                    ]);

                    $request->session()->put('mid', $id);

                    if ($ret) {
                        return response()->json(['statusCode' => 200]);
                    }
                    break;
            }
        }
    }*/

    public function member()
    {
        $ordersModel = new Order();
        $memberModel = new Member();
        $cartsModel = new Cart();

        if (session()->has('mid')) {
            $memberid = session()->get('mid');
        } else {
            $user = session('wechat.oauth_user');

            $memberid = $memberModel->where('openid', $user['id'])->select('id')->first();
            $memberid = $memberid->id;
        }

        $carts = $pay = $send = $submit = 0;
\Illuminate\Support\Facades\Log::info('member_id:'.$memberid);
        if ($memberid) {
            $member = $memberModel->select('nickname', 'head', 'earnings', 'getearnings', 'type')->find($memberid);

            $carts = $cartsModel->where('uid', $memberid)->count();
            $orderStatus = $ordersModel->where('uid', $memberid)->select('status', 'delivery')->get();

            foreach ($orderStatus as $item) {
                if ($item->status == 1) {
                    $pay++;
                }
                if ($item->status == 0 && $item->delivery == 0) {
                    $send++;
                }
                if ($item->status == 1 && $item->delivery == 1) {
                    $submit++;
                }
            }
        } else {
            $user = session('wechat.oauth_user');
            $member = [
                'openid' => $user['id'],
                'nickname' => $user['nickname'],
                'head' => $user['avatar'],
                'earnings' => 0,
                'getearnings' => 0,
                'type' => 0
            ];
            $memberid = $memberModel->insertGetId($member);
        }

        session()->put('mid', $memberid);
        return view('member', [
            'member' => $member,
            'carts' => $carts,
            'sends' => $send,
            'carts' => $carts,
            'pay' => $pay,
            'send' => $send,
            'submit' => $submit,
            'submit' => $submit
        ]);
    }

    public function carts(Request $request)
    {
        $cartModel = new Cart();

        if ($request->session()->has('mid')) {
            $mid = $request->session()->get('mid');
        } else {
            $memberModel = new Member();
            $user = session('wechat.oauth_user');
            $openid = $user['id'];

            $memberid = $memberModel->where('openid', $openid)->select('id')->first();

            if (isset($memberid->id)) {
                $mid = $memberid;
            } else {
                $member = [
                    'openid' => $openid,
                    'nickname' => $user['nickname'],
                    'head' => $user['avatar'],
                    'earnings' => 0,
                    'getearnings' => 0,
                    'type' => 0,
                    'shareshopid' => $request->input('userid')
                ];
                $mid = $memberModel->insertGetId($member);
            }
        }

        if ($request->isMethod('get')) {
            $carts = $cartModel->where('carts.uid', $mid)
                ->select('carts.id', 'commoditys.id as commodty_id', 'carts.total', 'carts.attr', 'commoditys.name', 'commoditys.price', 'images.src', 'carts.sum')
                ->leftJoin('commoditys', 'carts.cid', 'commoditys.id')
                ->leftJoin('images', 'images.cid', 'commoditys.id')
                ->groupby('commoditys.id')
                ->get();

            return view('cart', ['carts' => $carts]);
        } else {
            $validator = Validator::make($request->all(), [
                'cid' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json(['statusCode' => 300]);
            }

            $cid = $request->input('cid');

            if (!$mid) {
                $request->session()->put('redirect_url', '/details/' . $cid);

                return response()->json(['statusCode' => 100,]);
            }

            $total = (new Commodity())->select('price')->find($cid);

            if ($cartModel->where('cid', $cid)->count()) {
                return response()->json(['statusCode' => 400]);
            } else {
                $cartModel->uid = $mid;
                $cartModel->cid = $cid;
                $cartModel->sum = $request->input('sum', 1);
                $cartModel->attr = rtrim($request->input('attr', ''), ',');
                $cartModel->total = $request->input('sum', 1) * $total['price'];
                $ret = $cartModel->save();

                if ($ret) {
                    return response()->json(['statusCode' => 200]);
                }
            }
        }
    }

    public function cartDel(Request $request, $id)
    {
        $cart = new Cart();

        if ($request->isMethod('get')) {
            $ret = $cart->where('id', $id)->delete();

            if ($ret) {
                return redirect('/cart');
            }
        } else {
            $validator = Validator::make($request->all(), [
                'sum' => 'required',
                'total' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json(['statusCode' => 100]);
            }

            $ret = $cart->where('id', $id)->update([
                'sum' => $request->input('sum'),
                'total' => $request->input('total'),
            ]);

            if ($ret) {
                return response()->json(['statusCode' => 200]);
            } else {
                return response()->json(['statusCode' => 300]);
            }
        }
    }

    public function obligation(Request $request, $type)
    {
        $mid = $request->session()->get('mid');

        if (!$mid) {
            return false;
        }

        $orderModel = new Order();
        $order = $orderModel->where('uid', $mid);
        $is_pay = 0; //是否需要支付
        switch ($type) {
            case 0: //待付款
                $order = $order->where('orders.status', 1);
                $is_pay = 1;
                $title = '待付款';
                break;
            case 1: //待发货
                $order = $order->where('orders.status', 0)->where('orders.delivery', 0);
                $title = '待发货';
                break;
            case 2: //待签收
                $order = $order->where('orders.status', 0)->where('orders.delivery', 1);
                $title = '待签收';
                break;
            case 3: //已购买
                $order = $order->where('orders.status', 0)->where('orders.delivery', 1);
                $title = '已购买';
                break;
        }
        $order = $order->select('orders.id', 'commoditys.id as commodty_id', 'orders.money', 'commoditys.name', 'commoditys.price', 'images.src', 'orders.sum')
            ->leftJoin('commoditys', 'orders.cid', 'commoditys.id')
            ->leftJoin('images', 'images.cid', 'commoditys.id')
            ->groupby('orders.id')
            ->get();

        return view('obligation', ['data' => $order, 'is_pay' => $is_pay, 'title' => $title]);
    }

    public function transaction()
    {
        $orderModel = new Order();
        $transactions = $orderModel->where('orders.status', 0)
            ->select('commoditys.name', 'orders.money', 'orders.type')
            ->leftjoin('commoditys', 'commoditys.id', 'orders.cid')
            ->get();

        return view('transaction', [
            'transactions' => $transactions
        ]);
    }

    public function order_del($id)//删除订单
    {
        $ret = Order::where('id', $id)->delete();

        if ($ret) {
            return redirect()->back();
        }
    }

    public function address(Request $request)
    {
        $addressModel = new Address();

        if ($request->isMethod('get')) {
            $address = $addressModel->where('uid', $request->session()->get('mid'))->select(
                'id', 'type', 'info', 'name', 'phone'
            )
                ->orderBy('type', 'desc')
                ->get();

            return view('address', [
                'address' => $address
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'province' => 'required',
                'city' => 'required',
                'district' => 'required',
                'address' => 'required',
                'name' => 'required|String',
                'phone' => ['regex:/^(13[0-9]|14[5|7]|15[0|1|2|3|5|6|7|8|9]|18[0|1|2|3|5|6|7|8|9])\d{8}$/'],
            ]);

            if ($validator->fails()) {
                return response()->json(['statusCode' => 100]);
            }

            if ($addressModel->where('type', 1)->count()) {
                $addressModel->type = 0;
            } else {
                $addressModel->type = 1;
            }

            $addressModel->info = $request->input('province') . ' ' . $request->input('city') . ' ' . $request->input('district')
                . ' ' . $request->input('address');
            $addressModel->name = $request->input('name');
            $addressModel->phone = $request->input('phone');
            $addressModel->uid = $request->session()->get('mid');

            $ret = $addressModel->save();

            if ($ret) {
                return response()->json(['statusCode' => 200]);
            } else {
                return response()->json(['statusCode' => 300]);
            }
        }
    }

    public function address_deal($id = 0, $t = 0)
    {
        $addressModel = new Address();

        switch ($t) {
            case 0:
                $ret = $addressModel->where('id', $id)->delete();

                if ($ret) {
                    return redirect('/address');
                }
                break;
            case 1:
                $addressModel->where('type', 1)->update([
                    'type' => 0,
                ]);
                $ret = $addressModel->where('id', $id)->update([
                    'type' => 1,
                ]);

                if ($ret) {
                    return redirect('/address');
                }
                break;
        }

    }

    public function edit(Request $request, $id = 0)
    {
        if ($request->isMethod('get')) {
            $address = (new Address())->select('id', 'info', 'name', 'phone')->find($id)->toArray();
            $address['info'] = explode(' ', $address['info']);

            return view('address_eidt', [
                'address' => $address,
                'id' => $id
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'id' => 'required',
                'province' => 'required',
                'city' => 'required',
                'district' => 'required',
                'address' => 'required',
                'name' => 'required|String',
                'phone' => ['regex:/^(13[0-9]|14[5|7]|15[0|1|2|3|5|6|7|8|9]|18[0|1|2|3|5|6|7|8|9])\d{8}$/'],
            ]);

            if ($validator->fails()) {
                return response()->json(['statusCode' => 100]);
            }

            $addressModel = new Address();

            $info = $request->input('province') . ' ' . $request->input('city') . ' ' . $request->input('district')
                . ' ' . $request->input('address');


            $ret = $addressModel->where('id', $request->input('id'))->update([
                'info' => $info,
                'name' => $request->input('name'),
                'phone' => $request->input('phone'),
            ]);

            if ($ret) {
                return redirect('/address');
            } else {
                return redirect('/address/edit/' . $request->input('id'));
            }
        }
    }
}
