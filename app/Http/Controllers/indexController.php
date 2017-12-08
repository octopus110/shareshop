<?php

namespace App\Http\Controllers;

use App\Classify;
use App\Commodity;
use App\Image;
use App\Order;
use App\Property;
use App\Address;
use Validator;
use Illuminate\Http\Request;

class indexController extends Controller
{
    public function index(Request $request)
    {
        $imageModel = new Image();
        $banner = $imageModel->where('classify', 1)->select('id', 'src')->get();

        $classifyModel = new Classify();
        $classify = $classifyModel->select('id', 'src', 'name')->get();

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
            'mid' => session()->get('mid')
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

    public function detail($id = 15)
    {
        $commoditysModel = new Commodity();
        $data = $commoditysModel->select(
            'commoditys.id', 'commoditys.name', 'commoditys.price', 'commoditys.quantity', 'commoditys.introduce', 'users.storename', 'users.logo', 'users.storeintroduce'
        )
            ->leftjoin('users', 'users.id', 'commoditys.sid')
            ->find($id);

        $imagModel = new Image();
        $images = $imagModel->where('cid', $id)->select('src')->get();

        $propertysModel = new Property();
        $propertysDb = $propertysModel->where('cid', $id)->select('id', 'title', 'content')->get();
        $propertys = [];
        $propertysNum = count($propertysDb);
        if ($propertysNum) {
            foreach ($propertysDb as $k => $item) {
                $propertys[$k]['title'] = $item->title;
                $propertys[$k]['content'] = array_filter(explode(',', $item->content));
            }
        }

        return view('detail', [
            'data' => $data,
            'images' => $images,
            'propertys' => $propertys
        ]);
    }

    public function c_order(Request $request, $id = 0)
    {
        if ($request->isMethod('get')) {
            $orderMode = new Order();
            $order = $orderMode->select(
                'id', 'cid', 'uid', 'money', 'sum', 'attr'
            )->find($id);

            $address = (new Address())->where('type', 1)->select(
                'name', 'phone', 'info'
            )->find($order->uid);

            $commdity = (new Commodity())->select(
                'commoditys.name', 'images.src', 'commoditys.price'
            )
                ->leftJoin('images', 'images.cid', 'commoditys.id')
                ->groupby('commoditys.id')
                ->find($order->cid);

            /*
             * 生成微信支付订单信息
             * */

            return view('order', [
                'order' => $order,
                'address' => $address,
                'commdity' => $commdity,
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'id' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json(['statusCode' => 100]);
            }

            $uid = $request->session()->get('mid');

            if (!$uid) {
                return response()->json(['statusCode' => 500]);
            }

            $order = new Order();
            $id = $request->input('id');

            $sid = (new Commodity())->select('sid', 'price', 'name')->find($id);
            $money = $sid->price * $request->input('sum');

            $id = $order->insertGetId([
                'sid' => $sid->sid,
                'cid' => $id,
                'type' => 0,
                'uid' => $uid,
                'money' => $money,
                'rid' => 'eos' . time(),
                'sum' => $request->input('sum', 1),
                'attr' => $request->input('attr', ''),
                'status' => 1,
                'proinfo' => $sid->name,
                'delivery' => 0,
            ]);

            if ($id) {
                return response()->json(['statusCode' => 200, 'id' => $id]);
            }
        }
    }
}
