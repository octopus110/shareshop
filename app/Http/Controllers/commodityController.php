<?php

namespace App\Http\Controllers;

use App\Classify;
use App\Commodity;
use App\Image;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class commodityController extends Controller
{
    public function _list()
    {
        $commodity = new Commodity();

        $data = $commodity->getInfo();

        return view('server/commodity', ['data' => $data]);
    }

    public function detail($id)
    {
        $commodity = new Commodity();
        $data = $commodity->select('name', 'introduce')->find($id);
        return view('server/commodity_detail', ['data' => $data]);
    }

    public function add(Request $request)
    {
        if ($request->isMethod('get')) {

            $classify = new Classify();
            $data = $classify->getInfo();

            $merchant = Auth::user();
            $role = 1;

            if ($merchant->grade == 0) {
                $userModel = new User();

                $merchant = $userModel->where('grade', 1)->select('id', 'storename', 'grade')->get();
                $role = 0;
            }

            return view('server/commodity_add', ['data' => $data, 'merchant' => $merchant, 'role' => $role]);
        } else {
            $validator = Validator::make($request->all(), [
                'name' => 'required|String',
                'classify' => 'required|Numeric',
                'quantity' => 'required|Numeric',
                'price' => 'required',
                'sid' => 'required',
                'description' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json(['statusCode' => 200, 'confirmMsg' => '信息不完整', 'callbackType' => 'confirm']);
            }

            $commodity = new Commodity();

            $id = $commodity->add($request->only('name', 'classify', 'quantity', 'price', 'description', 'sid'));

            $image = explode(',', $request->input('image_id'));

            if (count($image)) {
                $imageModel = new Image();
                $image = array_filter($image);

                $imageModel->whereIn('id', $image)->update([
                    'cid' => $id
                ]);
            }

            if ($id) {
                return response()->json(['statusCode' => 200, 'confirmMsg' => '添加成功', 'callbackType' => 'confirm']);
            }

            return response()->json(['statusCode' => 200, 'confirmMsg' => '网络异常，请重试', 'callbackType' => 'confirm']);
        }
    }

    public function del(Request $request)
    {
        $id = $request->input('id');
        $commodityModel = new Commodity();
        $res = $commodityModel->where('id', $id)->delete();
        $images = new Image();
        $images->where('cid', $id)->delete();

        if ($res) {
            return response()->json(['statusCode' => 200, 'confirmMsg' => '删除成功', 'callbackType' => 'forwardConfirm', 'forwardUrl' => 'commodity']);
        } else {
            return response()->json(['statusCode' => 200, 'confirmMsg' => '网络异常，请重试', 'callbackType' => 'forwardConfirm', 'forwardUrl' => 'commodity']);
        }
    }

    public function modify(Request $request)
    {
        if ($request->isMethod('get')) {
            $id = $request->input('id');

            $commodityModel = new Commodity();
            $imagesModel = new Image();
            $classifyModel = new Classify();

            $commodity = $commodityModel->select('id', 'name', 'quantity', 'introduce', 'classify_id', 'price')->find($id);
            $images = $imagesModel->select('src')->where('cid', $id)->get();
            $classify = $classifyModel->getInfo();

            $merchant = Auth::user();
            $role = 1;

            if ($merchant->grade == 0) {
                $userModel = new User();

                $merchant = $userModel->where('grade', 1)->select('id', 'storename', 'grade')->get();
                $role = 0;
            }

            return view('server/commodity_modify', [
                'commodity' => $commodity,
                'images' => $images,
                'classify' => $classify,
                'merchant' => $merchant,
                'role' => $role
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'name' => 'required|String',
                'classify' => 'required|Numeric',
                'quantity' => 'required|Numeric',
                'price' => 'required',
                'description' => 'required',
                'sid' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json(['statusCode' => 200, 'confirmMsg' => '信息不完整', 'callbackType' => 'confirm']);
            }

            $id = $request->input('id');

            $commodity = new Commodity();

            $res = $commodity->where('id', $id)->update([
                'name' => $request->input('name'),
                'classify_id' => $request->input('classify'),
                'quantity' => $request->input('quantity'),
                'price' => $request->input('price'),
                'introduce' => $request->input('description'),
                'sid' => $request->input('sid'),
            ]);

            $image = explode(',', $request->input('image_id'));

            if (count($image) > 1) {
                $imageModel = new Image();
                $image = array_filter($image);

                $imageModel->where('cid', $id)->delete();

                $imageModel->whereIn('id', $image)->update([
                    'cid' => $id
                ]);
            }

            if ($res) {
                return response()->json(['statusCode' => 200, 'confirmMsg' => '修改成功', 'callbackType' => 'confirm']);
            }

            return response()->json(['statusCode' => 200, 'confirmMsg' => '网络异常，请重试', 'callbackType' => 'confirm']);
        }
    }

    public function soldout(Request $request)
    {
        $id = $request->input('id');
        $status = $request->input('s');
        $commodityModel = new Commodity();
        $res = $commodityModel->where('id', $id)->update([
            'status' => $status
        ]);

        if ($res) {
            return response()->json(['statusCode' => 200, 'confirmMsg' => '操作成功', 'callbackType' => 'forwardConfirm', 'forwardUrl' => 'commodity']);
        } else {
            return response()->json(['statusCode' => 200, 'confirmMsg' => '网络异常，请重试', 'callbackType' => 'forwardConfirm', 'forwardUrl' => 'commodity']);
        }
    }
}
