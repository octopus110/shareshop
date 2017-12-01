<?php

namespace App\Http\Controllers;

use App\Classify;
use App\Commodity;
use App\Image;
use Illuminate\Http\Request;

class indexController extends Controller
{
    public function index()
    {
        $imageModel = new Image();
        $banner = $imageModel->where('classify', 1)->select('id', 'src')->get();

        $classifyModel = new Classify();
        $classify = $classifyModel->select('id', 'src', 'name')->orderBy('sort', 'desc')->get();

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

    public function _list($id = -2)
    {
        $classifyModel = new Classify();
        $classify = $classifyModel->select('id', 'name')->get();

        $commoditysModel = new Commodity();
        $ready = $commoditysModel;

        if ($id == -1) {//新品
            $ready = $ready->orderBy('commoditys.id', 'desc');
        }

        if ($id == 0) {//畅销品
            $ready = $ready->orderBy('commoditys.sales', 'desc');
        }

        if ($id > 0) {
            $ready = $ready->where('classify_id', $id);
        }

        $commoditys = $ready->select(
            'commoditys.id', 'commoditys.name', 'commoditys.price', 'users.storename', 'images.src'
        )
            ->leftjoin('images', 'images.cid', 'commoditys.id')
            ->leftjoin('users', 'users.id', 'commoditys.sid')
            ->groupby('commoditys.id')
            ->limit(3)
            ->get();
        return view('list', [
            'commoditys' => $commoditys,
            'classify' => $classify,
            'active' => $id
        ]);
    }

    public function ajax_list(Request $request)
    {

    }
}
