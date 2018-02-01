<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Validator;
use Storage;

class userController extends Controller
{
    public function _list()
    {
        $user = new User();
        $data = $user->where('grade', 1)->get();

        dd($data)

        return view('server/user', ['data' => $data]);
    }

    public function add(Request $request)
    {
        if ($request->isMethod('get')) {

            return view('server/user_add');
        } else {
            $validator = Validator::make($request->all(), [
                'weixin' => 'required|unique:users',
                'storename' => 'required',
                'name' => 'required',
                'phone' => 'required',
                'IDnumber' => 'required',
                'provider' => 'required',
                'email' => 'required|unique:users',
                'password' => 'required',
                'profit' => 'required',
                'chang' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json(['statusCode' => 200, 'confirmMsg' => '信息不完整或用户已经存在', 'callbackType' => 'confirm']);
            }

            $logo = '';
            if ($request->file('image')) {
                $file = $request->file('image');
                if ($file->isValid()) {
                    if (in_array(strtolower($file->getClientOriginalExtension()), ['jpeg', 'jpg', 'gif', 'png'])) {
                        $newName = 'classify_' . time() . rand(1, 999999) . '.' . $file->getClientOriginalExtension();

                        $realPath = $file->getRealPath();

                        $bool = Storage::disk('uploads')->put($newName, file_get_contents($realPath));

                        if ($bool) {
                            $logo = $newName;
                        }
                    }
                }
            }

            $userModel = new User();
            $userModel->weixin = $request->input('weixin');
            $userModel->storename = $request->input('storename');
            $userModel->storeintroduce = $request->input('storeintroduce');
            $userModel->logo = $logo;
            $userModel->name = $request->input('name');
            $userModel->phone = $request->input('phone');
            $userModel->IDnumber = $request->input('IDnumber');
            $userModel->provider = $request->input('provider');
            $userModel->email = $request->input('email');
            $userModel->password = bcrypt($request->input('password'));
            $userModel->deadline = $request->input('deadline');
            $userModel->chang = $request->input('chang');
            $userModel->grade = 1;

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
                'profit' => 'required',
                'chang' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json(['statusCode' => 200, 'confirmMsg' => '信息不完整或用户已经存在', 'callbackType' => 'confirm']);
            }

            $arr = [];
            if ($request->file('image')) {
                $file = $request->file('image');
                if ($file->isValid()) {
                    if (in_array(strtolower($file->getClientOriginalExtension()), ['jpeg', 'jpg', 'gif', 'png'])) {
                        $newName = 'classify_' . time() . rand(1, 999999) . '.' . $file->getClientOriginalExtension();

                        $realPath = $file->getRealPath();

                        $bool = Storage::disk('uploads')->put($newName, file_get_contents($realPath));

                        if ($bool) {
                            $arr['logo'] = $newName;
                        }
                    }
                }
            }

            $arr['weixin'] = $request->input('weixin');
            $arr['name'] = $request->input('name');
            $arr['storename'] = $request->input('storename');
            $arr['storeintroduce'] = $request->input('storeintroduce');
            $arr['phone'] = $request->input('phone');
            $arr['IDnumber'] = $request->input('IDnumber');
            $arr['provider'] = $request->input('provider');
            $arr['email'] = $request->input('email');
            $arr['profit'] = $request->input('profit');
            $arr['chang'] = $request->input('chang');

            if ($request->input('password')) {
                $arr['password'] = bcrypt($request->input('password'));
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
