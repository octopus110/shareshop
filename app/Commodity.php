<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use QrCode;

class Commodity extends Model
{
    protected $table = 'commoditys';

    public function getInfo()
    {
        $user = Auth::user();//属于哪个商户的商品

        $grade = $user->grade;

        if ($grade == 0) {
            $data = $this->select(
                'commoditys.id', 'commoditys.name', 'commoditys.sales', 'commoditys.quantity', 'commoditys.status',
                'commoditys.introduce', 'commoditys.price', 'commoditys.created_at', 'classifys.name as classify')
                ->leftJoin('classifys', 'commoditys.classify_id', 'classifys.id')
                ->get();
        } else {
            $data = $this->where('sid', $user->id)->select(
                'commoditys.id', 'commoditys.name', 'commoditys.quantity', 'commoditys.status',
                'commoditys.introduce', 'commoditys.price', 'commoditys.created_at', 'classifys.name as classify')
                ->leftJoin('classifys', 'commoditys.classify_id', 'classifys.id')
                ->get();
        }

        return $data;
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
            'sid' => $data['sid'],
        ]);

        return $id;
    }
}
