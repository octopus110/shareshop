<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function type($type)
    {
        $arr = [
            '购物订单',
            '提现订单',
        ];

        return $arr[$type];
    }

    public function status($status)
    {
        $arr = [
            '已付款',
            '未付款',
            '已关闭',
        ];

        return $arr[$status];
    }

    public function delivery($delivery)
    {
        $arr = [
            '未发货',
            '已发货',
            '已签收',
        ];

        return $arr[$delivery];
    }
}
