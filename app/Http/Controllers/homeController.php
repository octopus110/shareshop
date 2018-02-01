<?php

namespace App\Http\Controllers;

use App\Member;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Validator;

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

        //查询出申请发放的商家
        $appay = $userModel->where('users.appay', 1)->select(
            'users.id', 'users.storename', 'users.weixin', 'users.phone', 'users.appay_money', 'users.send_money', 'users.updated_at',
            DB::raw('sum(orders.money) as money')
        )
            ->leftJoin('orders', 'orders.sid', 'users.id')
            ->groupBy('orders.sid')
            ->get();

        //列出当前商家的信息$data['id']
        $userIndex = $userModel->select(
            'users.id', 'users.storename', 'users.weixin', 'users.phone', 'users.send_money','users.appay_money',
            DB::raw('sum(orders.money) as money')
        )
            ->leftJoin('orders', 'orders.sid', 'users.id')
            ->groupBy('orders.sid')
            ->find(3);

        return view('server.index', ['data' => $user, 'appay' => $appay,'userindex'=>$userIndex]);
    }

    public function quit()
    {
        Auth::logout();

        return view('auth/login');
    }

    //申请放款
    public function applyMoney(Request $request){
        $userModel = new User();

        $user = $userModel->select('id','appay_money','appay')->find(Auth::id());

        $user->appay_money = $request->input('money');
        $user->appay = 1;

        $ret = $user->save();

        if ($ret) {
            return response()->json(['statusCode' => 200, 'confirmMsg' => '申请成功', 'callbackType' => 'forwardConfirm']);
        }
    }

    //放款
    public function sendMoney(Request $request){
  
        $validator = Validator::make($request->all(), [
            'id' => 'required', 
            'money'=>'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['statusCode' => 100]);
        }

        $userModel = new User();

        $user = $userModel->select('id','send_money','appay')->find($request->input('id'));

        $user->send_money = $user->send_money+$request->input('money')*1;
        $user->appay = 0;

        $ret = $user->save();

        if($ret){
            return response()->json(['statusCode' => 200]);
        }else{
            return response()->json(['statusCode' => 100]);
        }
    }
}
