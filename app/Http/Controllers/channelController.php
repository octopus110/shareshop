<?php

namespace App\Http\Controllers;

use App\Earning;
use App\Member;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class channelController extends Controller
{
    public function _list()
    {
        $memberModel = new Member();
        $user = Auth::user();
        $usermid = explode(',', $user->mid); //一个商户可能拥有多个渠道商

        $member = $memberModel;
        
        if (Auth::user()->grade) {
            $member = $member->where('orders.sid', Auth::id());
        }

        $member = $memberModel->where('type', 1)
            ->whereIn('id', $usermid)
            ->select('id', 'nickname', 'IDnumber', 'earnings', 'getearnings', 'updated_at')->get();

        return view('server/channel', ['data' => $member]);
    }

    //发放红包
    public function send(Request $request)
    {
        $id = $request->input('id');
        $memberModel = new Member();
        $member = $memberModel->select('getearnings', 'earnings')->find($id);

        $res = $memberModel->where('id', $id)->update([
            'getearnings' => $member->earnings,
            'earnings' => 0
        ]);

        if ($res) {
            return response()->json(['statusCode' => 200, 'confirmMsg' => '发放成功', 'callbackType' => 'forwardConfirm', 'forwardUrl' => 'channel']);
        } else {
            return response()->json(['statusCode' => 200, 'confirmMsg' => '发放失败', 'callbackType' => 'forwardConfirm', 'forwardUrl' => 'channel']);
        }
    }

    //查看收益
    public function earnings($id)
    {
        $EarningModel = new Earning();
        $data = $EarningModel->where('earnings.id', $id)
            ->select('earnings.id', 'earnings.money', 'earnings.cid', 'commoditys.name', 'earnings.created_at')
            ->leftJoin('commoditys', 'commoditys.id', 'earnings.cid')
            ->get();

        return view('server/earnings', ['data' => $data]);
    }
}
