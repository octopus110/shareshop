<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Commodity extends Model
{
    protected $table = 'commoditys';

    public function getInfo()
    {
        $id = Auth::id();//属于哪个商户的商品
        $res = $this->where('sid', $id)->select(
            'commoditys.id', 'commoditys.name', 'commoditys.quantity', 'commoditys.status',
            'commoditys.introduce', 'commoditys.price', 'commoditys.created_at', 'classifys.name as classify')
            ->leftJoin('classifys', 'commoditys.classify_id', 'classifys.id')
            ->get();

        return $res;
    }

    public function status($status)
    {
        $arr = [
            '正常',
            '下架'
        ];

        return $arr[$status];
    }

    public function add($data)
    {
        $id = $this->insertGetId([
            'name' => $data['name'],
            'quantity' => $data['quantity'],
            'introduce' => $data['description'],
            'classify_id' => $data['classify'],
            'price' => $data['price'],
        ]);

        return $id;
    }
}
