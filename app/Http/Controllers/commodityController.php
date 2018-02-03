<?php

namespace App\Http\Controllers;

use App\Classify;
use App\Commodity;
use App\Image;
use App\Property;
use App\User;
use App\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use QrCode;

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

            //添加图片
            $image = explode(',', $request->input('image_id'));
            if (count($image)) {
                $imageModel = new Image();
                $image = array_filter($image);

                $imageModel->whereIn('id', $image)->update([
                    'cid' => $id
                ]);
            }

            //添加属性
            $propertys = $request->input('property');
            $propertysNum = count($propertys);
            if (count($propertysNum)) {
                $arr = [];
                for ($i = 0; $i < $propertysNum; $i++) {
                    $arr[$i]['title'] = $propertys[$i]['title'];
                    $arr[$i]['content'] = $propertys[$i]['v1'] . ',' . $propertys[$i]['v2'] . ',' . $propertys[$i]['v3'] . ',' .
                        $propertys[$i]['v4'] . ',' . $propertys[$i]['v5'] . ',' . $propertys[$i]['v6'];
                    $arr[$i]['cid'] = $id;

                }
                $propertyModel = new Property();
                $propertyModel->insert($arr);
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

            $commodity = $commodityModel->select('id', 'name','sid', 'quantity', 'introduce', 'classify_id', 'price')->find($id);
            $images = $imagesModel->select('src')->where('cid', $id)->get();
            $classify = $classifyModel->getInfo();

            $merchant = Auth::user();
            $role = 1;
            if ($merchant->grade == 0) {
                $userModel = new User();

                $merchant = $userModel->where('grade', 1)->select('id', 'storename', 'grade')->get();
                $role = 0;
            }

            $propertysModel = new Property();
            $propertysDb = $propertysModel->where('cid', $id)->select('id', 'title', 'content')->get();

            $propertys = [];
            $propertysNum = count($propertysDb);
            if ($propertysNum) {
                foreach ($propertysDb as $k => $item) {
                    $propertys[$k]['title'] = $item->title;
                    $propertys[$k]['content'] = explode(',', $item->content);
                }
            }

            return view('server/commodity_modify', [
                'commodity' => $commodity,
                'images' => $images,
                'classify' => $classify,
                'merchant' => $merchant,
                'role' => $role,
                'propertys' => $propertys,
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
            //更新图片
            $image = explode(',', $request->input('image_id'));
            if (count($image) > 1) {
                $imageModel = new Image();
                $image = array_filter($image);

                $imageModel->where('cid', $id)->delete();

                $imageModel->whereIn('id', $image)->update([
                    'cid' => $id
                ]);
            }

            //更新属性
            $propertys = $request->input('property');

            $propertysNum = count($propertys);
            if ($propertysNum) {
                $arr = [];
                for ($i = 0; $i < $propertysNum; $i++) {
                    $arr[$i]['title'] = $propertys[$i]['title'];
                    $arr[$i]['content'] = $propertys[$i]['v1'] . ',' . $propertys[$i]['v2'] . ',' . $propertys[$i]['v3'] . ',' .
                        $propertys[$i]['v4'] . ',' . $propertys[$i]['v5'] . ',' . $propertys[$i]['v6'];
                    $arr[$i]['cid'] = $id;

                }

                $propertyModel = new Property();
                $propertyModel->where('cid', $id)->delete();
                $propertyModel->insert($arr);
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

    //下载指定产品二维码
    public function downCode($id){

        $userid = Auth::id();

        $oppenid = (new User())->select('weixin')->find($userid);
        $memberid = (new Member())->select('id')->where('oppenid',$oppenid)->first();
        QrCode::format('png')->size(300)->generate('http://mall.eos-tech.cn/details/'.$id.'/'.$memberid,public_path('qrcodes/qrcode_'.$id.'.png'));

        return response()->download(public_path('qrcodes/qrcode_'.$id.'.png'));
    }
}
