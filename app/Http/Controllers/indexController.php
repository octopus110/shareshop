<?php

namespace App\Http\Controllers;

use App\Classify;
use App\Commodity;
use App\Image;
use App\Property;
use Illuminate\Http\Request;

class indexController extends Controller
{
    public function index()
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
            'salescommoditys' => $salescommoditys
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
