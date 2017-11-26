<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Validator;

class userController extends Controller
{
    public function _list()
    {
        $user = new User();
        $data = $user->get();

        return view('server/user', ['data' => $data]);
    }

    public function add(Request $request)
    {
        if ($request->isMethod('get')) {

            return view('server/user_add');
        } else {
            $validator = Validator::make($request->all(), [
                'weixin' => 'required|unique:users',
                'name' => 'required',
                'phone' => 'required',
                'IDnumber' => 'required',
                'provider' => 'required',
                'email' => 'required|unique:users',
                'password' => 'required',
                'profit' => 'required',
                'grade' => 'required'
            ]);

            if ($validator->fails()) {
                return response()->json(['statusCode' => 200, 'confirmMsg' => '信息不完整或用户已经存在', 'callbackType' => 'confirm']);
            }

            $userModel = new User();

            $userModel->weixin = $request->input('weixin');
            $userModel->name = $request->input('name');
            $userModel->phone = $request->input('phone');
            $userModel->IDnumber = $request->input('IDnumber');
            $userModel->provider = $request->input('provider');
            $userModel->email = $request->input('email');
            $userModel->password = bcrypt($request->input('password'));
            $userModel->deadline = $request->input('deadline');
            $userModel->grade = $request->input('grade');

            $res = $userModel->save();

            if ($res) {
                return response()->json(['statusCode' => 200, 'confirmMsg' => '添加成功', 'callbackType' => 'confirm']);
            } else {
                return response()->json(['statusCode' => 200, 'confirmMsg' => '网络异常，请重试', 'callbackType' => 'confirm']);
            }
        }
    }

    public function del(Request $request)
    {
        $id = $request->input('id');
        $userModel = new User();
        $res = $userModel->where('id', $id)->delete();

        if ($res) {
            return response()->json(['statusCode' => 200, 'confirmMsg' => '删除成功', 'callbackType' => 'forwardConfirm', 'forwardUrl' => 'user']);
        } else {
            return response()->json(['statusCode' => 200, 'confirmMsg' => '网络异常，请重试', 'callbackType' => 'forwardConfirm', 'forwardUrl' => 'user']);
        }
    }

    public function modify(Request $request)
    {
        $id = $request->input('id');

        $userModel = new User();

        if ($request->isMethod('get')) {
            $data = $userModel->find($id);

            return view('server/user_modify', ['data' => $data]);
        } else {
            $validator = Validator::make($request->all(), [
                'weixin' => 'required',
                'name' => 'required',
                'phone' => 'required',
                'IDnumber' => 'required',
                'provider' => 'required',
                'email' => 'required',
                'profit' => 'required'
            ]);

            if ($validator->fails()) {
                return response()->json(['statusCode' => 200, 'confirmMsg' => '信息不完整或用户已经存在', 'callbackType' => 'confirm']);
            }

            $arr = [
                'weixin' => $request->input('weixin'),
                'name' => $request->input('name'),
                'phone' => $request->input('phone'),
                'IDnumber' => $request->input('IDnumber'),
                'provider' => $request->input('provider'),
                'email' => $request->input('email'),
                'profit' => $request->input('profit'),
            ];

            if ($request->input('password')) {
                $arr['password'] = $request->input('password');
            }

            $res = $userModel->where('id', $id)->update($arr);

            if ($res) {
                return response()->json(['statusCode' => 200, 'confirmMsg' => '修改成功', 'callbackType' => 'confirm']);
            } else {
                return response()->json(['statusCode' => 200, 'confirmMsg' => '网络异常，请重试', 'callbackType' => 'confirm']);
            }
        }
    }
}
