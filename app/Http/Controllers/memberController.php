<?php

namespace App\Http\Controllers;

use App\Address;
use App\Cart;
use App\Member;
use App\Order;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class memberController extends Controller
{
    public function login(Request $request)
    {
        if ($request->isMethod('get')) {
            return view('login');
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
    }

    public function member(Request $request)
    {
        $memberid = $request->session()->get('mid');
        if ($memberid) {
            $ordersModel = new Order();

            $member = (new Member())->select('nickname', 'head', 'earnings', 'getearnings')->find($memberid);
            $carts = (new Cart())->where('uid', $memberid)->count();
            $sends = $ordersModel->where([
                ['uid', '=', $memberid],
                ['status', '=', 0],
                ['delivery', '<>', 2],
            ])->count();

            $h = date('G');

            if ($h < 11) {
                $t = '早上好';
            } else if ($h < 13) {
                $t = '中午好';
            } else if ($h < 17) {
                $t = '下午好';
            } else {
                $t = '晚上好';
            }

            return view('member', [
                'member' => $member,
                'carts' => $carts,
                'sends' => $sends,
                't' => $t
            ]);
        }
        return redirect('/');
    }

    public function carts()
    {
        return view('cart');
    }

    public function transaction()
    {
        return view('transaction');
    }

    public function address(Request $request)
    {
        $addressModel = new Address();

        if ($request->isMethod('get')) {
            $address = $addressModel->where('uid', $request->session()->get('mid'))->select('id', 'type', 'info')
                ->orderBy('type')
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

            if (!$addressModel->where('type', 1)->count()) {
                $addressModel->type = 1;
            } else {
                $addressModel->type = 0;
            }

            $addressModel->info = $request->input('province') . ' ' . $request->input('city') . ' ' . $request->input('district')
                . ' ' . $request->input('address');
            $addressModel->uid = $request->session()->get('mid');

            $ret = $addressModel->save();

            if ($ret) {
                return response()->json(['statusCode' => 200]);
            } else {
                return response()->json(['statusCode' => 300]);
            }
        }
    }
}
