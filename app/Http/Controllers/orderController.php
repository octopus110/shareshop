<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Excel;

class orderController extends Controller
{
    public function _list(Request $request)
    {
        $data = new Order();

        if (Auth::user()->grade) {
            $data = $data->where('orders.sid', Auth::id());
        }

        $data = $data->where(function ($query) use ($request) {
            if ($request->input('status', -1) != -1) {
                $query->where('orders.status', $request->input('status'));
            }
            if ($request->input('delivery', -1) != -1) {
                $query->where('orders.delivery', $request->input('delivery'));
            }
        })
        ->select(
            'orders.id', 'commoditys.name as name', 'orders.type', 'members.openid', 'members.nickname', 'orders.money','orders.rid', 'orders.status', 'orders.delivery', 'orders.express_name', 'orders.express_id', 'orders.created_at',
            'users.storename', 'users.id as storeid'
        )->leftJoin('commoditys', 'orders.cid', 'commoditys.id')
        ->leftJoin('members', 'members.id', 'orders.uid')
        ->leftJoin('users', 'users.id', 'orders.sid')
        ->get();        

        return view('server/order', [
            'data' => $data,
            'status' => $request->input('status', -1),
            'delivery' => $request->input('delivery', -1),
            'userType' => Auth::user()->grade,
        ]);
    }

    public function stop(Request $request)
    {
        $id = $request->input('id');

        $order = new Order();

        $res = $order->where('id', $id)->update([
            'status' => 2
        ]);

        if ($res) {
            return response()->json(['statusCode' => 200, 'confirmMsg' => '关闭成功', 'callbackType' => 'forwardConfirm', 'forwardUrl' => 'order']);
        }
    }

    public function send(Request $request)
    {
        if ($request->isMethod('get')) {
            return view('server/express', [
                'id' => $request->input('id')
            ]);
        } else {
            $id = $request->input('id');
            $order = new Order();
            $res = $order->where('id', $id)->update([
                'delivery' => 1,
                'express_name' => $request->input('express_name'),
                'express_id' => $request->input('express_id'),
            ]);

            if ($res) {
                return response()->json(['statusCode' => 200, 'confirmMsg' => '发货成功', 'callbackType' => 'forwardConfirm', 'forwardUrl' => 'order']);
            }
        }
    }

    //导出exl
    public function export(){

        $data = new Order();

        if (Auth::user()->grade) {
            $data = $data->where('orders.sid', Auth::id());
        }

        $data = $data->where('orders.status', 0)
        ->select(
            'orders.id', 'orders.rid','commoditys.name as name','users.id as storeid','users.storename','members.openid', 'members.nickname', 'orders.money','orders.created_at'
             
        )->leftJoin('commoditys', 'orders.cid', 'commoditys.id')
        ->leftJoin('members', 'members.id', 'orders.uid')
        ->leftJoin('users', 'users.id', 'orders.sid')
        ->get()->toArray();

        $head = [[
            '订单编号','订单ID','商品名称','商家ID','商家名称','用户唯一标识','用户微信昵称','总金额','购买时间',
        ]];

        $data = array_merge($head,$data);

        Excel::create('已付款订单',function($excel) use ($data){
            $excel->sheet('score', function($sheet) use ($data){
                $sheet->rows($data);
            });
        })->export('xls');
    }
}
