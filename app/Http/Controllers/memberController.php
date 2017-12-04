<?php

namespace App\Http\Controllers;

use App\Member;
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

    public function member()
    {
        return view('member');
    }

    public function carts()
    {
        return view('cart');
    }

    public function transaction()
    {
        return view('transaction');
    }

    public function address()
    {
        return view('address');
    }
}
