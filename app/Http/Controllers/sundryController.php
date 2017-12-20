<?php

namespace App\Http\Controllers;

use App\Image;
use App\User;
use Illuminate\Http\Request;
use Validator;

class sundryController extends Controller
{
    //管理员管理
    public function admin()
    {
        $user = new User();

        $data = $user->where('grade', 0)->select(
            'id', 'weixin', 'name', 'phone', 'email', 'created_at'
        )->get();

        return view('server/admin', ['data' => $data]);
    }

    public function add(Request $request)
    {
        if ($request->isMethod('get')) {

            return view('server/admin_add');
        } else {
            $validator = Validator::make($request->all(), [
                'weixin' => 'required',
                'name' => 'required',
                'phone' => 'required',
                'email' => 'required',
                'password' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json(['statusCode' => 200, 'confirmMsg' => '信息不完整', 'callbackType' => 'confirm']);
            }

            $userModel = new User();

            $userModel->weixin = $request->input('weixin');
            $userModel->name = $request->input('name');
            $userModel->phone = $request->input('phone');
            $userModel->email = $request->input('email');
            $userModel->password = $request->input('password');
            $userModel->grade = 0;
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
            return response()->json(['statusCode' => 200, 'confirmMsg' => '删除成功', 'callbackType' => 'forwardConfirm', 'forwardUrl' => 'admin']);
        } else {
            return response()->json(['statusCode' => 200, 'confirmMsg' => '网络异常，请重试', 'callbackType' => 'forwardConfirm', 'forwardUrl' => 'admin']);
        }
    }

    public function modify(Request $request)
    {
        $id = $request->input('id');

        $userModel = new User();

        if ($request->isMethod('get')) {
            $data = $userModel->select('id', 'name', 'weixin', 'phone', 'email')->find($id);

            return view('server/admin_modify', ['data' => $data]);
        } else {
            $validator = Validator::make($request->all(), [
                'weixin' => 'required',
                'name' => 'required',
                'phone' => 'required',
                'email' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json(['statusCode' => 200, 'confirmMsg' => '信息不完整', 'callbackType' => 'confirm']);
            }

            $arr = [
                'weixin' => $request->input('weixin'),
                'name' => $request->input('name'),
                'phone' => $request->input('phone'),
                'email' => $request->input('email'),
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

    public function banner()
    {
        $imagesModel = new Image();

        $images = $imagesModel->select('id', 'src', 'href')->where('classify', 1)->orderBy('id', 'desc')->limit(4)->get()->toArray();

        return view('server/banner', ['images' => $images]);
    }

    public function banner_del(Request $request)
    {
        $id = $request->input('id');
        $imageModel = new Image();
        $imageModel->where('id', $id)->delete();
        return response()->json(['statusCode' => 200, 'confirmMsg' => '删除成功', 'callbackType' => 'forwardConfirm', 'forwardUrl' => 'banner']);

    }
}
