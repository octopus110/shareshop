<?php

namespace App\Http\Controllers;

use App\Member;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class homeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Auth::user('name');

        $user['id'] = $data['id'];
        $user['email'] = $data['email'];
        $user['weixin'] = $data['weixin'];
        $user['grade'] = $data['grade'];

        //查询是否有放款信息
        $userModel = new User();

        $appay = $userModel->where('users.appy', 0)->select(
            'users.id', 'users.storename', 'users.weixin', 'users.phone', 'users.appay_money', 'users.send_money', 'users.updated_at',
            DB::raw('SUM(orders.money) as money')
        )
            ->leftJoin('orders', 'orders.sid', 'users.id')
            ->groupBy('orders.sid')
            ->get();


        return view('server.index', ['data' => $user, 'appay' => $appay]);
    }

    public function quit()
    {
        Auth::logout();

        return view('auth/login');
    }
}
