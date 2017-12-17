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

    //根据用户openid获取用户id
    protected function getId()
    {
        $user = session('wechat.oauth_user');
        $memberid = Member::where('openid', $user['id'])->select('id')->first()->id;
        return $memberid;
    }

    //获得微信用户信息
    protected function getWeChatInfo()
    {
        return session('wechat.oauth_user');
    }

    //添加新的微信用户
    public function addWechatMember()
    {
        $memberModel = new Member();
        $memberid = $memberModel->where('openid', $this->getWeChatInfo()['id'])->select('id')->first();

        if ($memberid) {
            $memberid = $memberid->id;
        } else {
            $member = [
                'openid' => $this->getWeChatInfo()['id'],
                'nickname' => $this->getWeChatInfo()['nickname'],
                'head' => $this->getWeChatInfo()['avatar'],
                'earnings' => 0,
                'getearnings' => 0,
                'type' => 0
            ];
            $memberid = (new Member())->insertGetId($member);
        }
        return $memberid;
    }
}
