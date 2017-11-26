<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classify;
use Validator;

class classifyController extends Controller
{
    public function _list()
    {
        $classifyModel = new Classify();

        $data = $classifyModel->getInfo();

        return view('server/classify', [
            'data' => $data
        ]);
    }

    public function add(Request $request)
    {
        if ($request->isMethod('get')) {

            return view('server/classify_add');
        } else {
            $validator = Validator::make($request->all(), [
                'name' => 'required|unique:classifys|String',
                'sort' => 'required|Numeric',
            ]);

            if ($validator->fails()) {
                return response()->json(['statusCode' => 200, 'confirmMsg' => '分类已经存在', 'callbackType' => 'confirm']);
            }

            $classifyModel = new Classify();

            $res = $classifyModel->add($request->only(['name', 'sort']));

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
        $classifyModel = new Classify();
        $res = $classifyModel->where('id', $id)->delete();

        if ($res) {
            return response()->json(['statusCode' => 200, 'confirmMsg' => '删除成功', 'callbackType' => 'forwardConfirm', 'forwardUrl' => 'classify']);
        } else {
            return response()->json(['statusCode' => 200, 'confirmMsg' => '网络异常，请重试', 'callbackType' => 'forwardConfirm', 'forwardUrl' => 'classify']);
        }
    }

    public function modify(Request $request)
    {
        $id = $request->input('id');

        $classifyModel = new Classify();

        if ($request->isMethod('get')) {
            $data = $classifyModel->select('id','name', 'sort')->find($id);

            return view('server/classify_modify', ['data' => $data]);
        } else {
            $validator = Validator::make($request->all(), [
                'name' => 'required|unique:classifys|String',
                'sort' => 'required|Numeric',
            ]);

            if ($validator->fails()) {
                return response()->json(['statusCode' => 200, 'confirmMsg' => '分类已经存在', 'callbackType' => 'confirm']);
            }

            $res = $classifyModel->where('id', $id)->update([
                'name' => $request->input('name'),
                'sort' => $request->input('sort')
            ]);

            if ($res) {
                return response()->json(['statusCode' => 200, 'confirmMsg' => '修改成功', 'callbackType' => 'confirm']);
            } else {
                return response()->json(['statusCode' => 200, 'confirmMsg' => '网络异常，请重试', 'callbackType' => 'confirm']);
            }
        }
    }
}
