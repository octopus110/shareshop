<?php

namespace App\Http\Controllers;

use App\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $userModel = new Member();

        $appay = $userModel->where('appy', 0)->select(
            'member.id', 'member.storename', 'member.weixin', 'member.phone', 'member.appay_money', 'member.send_money', 'member.updated_at',
            DB::raw('SUM(order.money) as money')
        )
            ->leftJoin('order', 'order.sid', 'members.id')
            ->groupBy('order.sid')
            ->get();


        return view('server.index', ['data' => $user, 'appay' => $appay]);
    }

    public function quit()
    {
        Auth::logout();

        return view('auth/login');
    }
}
