<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class orderController extends Controller
{
    public function _list(Request $request)
    {
        $orderModel = new Order();

        $id = Auth::id();//属于哪个商户的id
        $data = $orderModel;
        if ($id) {
            $data = $orderModel->where('orders.sid', $id);
        }

        $data->where(function ($query) use ($request) {
            if ($request->input('status', -1) != -1) {
                $query->where('orders.status', $request->input('status'));
            }
            if ($request->input('delivery', -1) != -1) {
                $query->where('orders.delivery', $request->input('delivery'));
            }
        })
            ->select(
                'orders.id', 'commoditys.name as name', 'orders.type', 'members.openid', 'members.nickname', 'orders.money',
                'orders.rid', 'orders.status', 'orders.delivery', 'orders.express_name', 'orders.express_id', 'orders.created_at',
                'users.storename', 'users.id as storeid'
            )->leftJoin('commoditys', 'orders.cid', 'commoditys.id')
            ->leftJoin('members', 'members.id', 'orders.uid')
            ->leftJoin('users', 'users.id', 'orders.sid')
            ->get();

        return view('server/order', [
            'data' => $data,
            'status' => $request->input('status', -1),
            'delivery' => $request->input('delivery', -1),
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
}
