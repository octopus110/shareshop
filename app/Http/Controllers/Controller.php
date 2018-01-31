<?php

namespace App\Http\Controllers;

use App\Member;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    //添加新的微信用户
    public function addWechatMember()
    {
        $memberModel = new Member();
        $memberid = $memberModel->where('openid', session('wechat.oauth_user')['id'])->select('id')->first();

        if ($memberid) {
            $memberid = $memberid->id;
            session()->pull('mid',$memberid);
        } else {
            $member = [
                'openid' => session('wechat.oauth_user')['id'],
                'nickname' => session('wechat.oauth_user')['nickname'],
                'head' => session('wechat.oauth_user')['avatar'],
                'earnings' => 0,
                'getearnings' => 0,
                'type' => 0,
                'created_at' => date('Y-m-d H:i:s', time())
            ];
            $memberid = $memberModel->insertGetId($member);
            session()->pull('mid',$memberid);
        }
        return $memberid;
    }
}
