<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class orderController extends Controller
{
    public function _list()
    {
        $orderModel = new Order();

        $id = Auth::id();//属于哪个商户的id

        $data = $orderModel->where('orders.sid', $id)
            ->select(
                'orders.id', 'commoditys.name as name', 'orders.type', 'orders.uid', 'orders.money',
                'orders.rid', 'orders.status', 'orders.delivery', 'orders.created_at'
            )->leftJoin('commoditys', 'orders.cid', 'commoditys.id')
            ->get();

        return view('server/order', ['data' => $data]);
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
        $id = $request->input('id');

        $order = new Order();

        $res = $order->where('id', $id)->update([
            'delivery' => 1
        ]);

        if ($res) {
            return response()->json(['statusCode' => 200, 'confirmMsg' => '发货成功', 'callbackType' => 'forwardConfirm', 'forwardUrl' => 'order']);
        }
    }
}
