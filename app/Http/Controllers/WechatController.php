<?php

namespace App\Http\Controllers;

use App\Member;
use EasyWeChat\Foundation\Application;
use EasyWeChat\Message\Transfer;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;

class WechatController extends Controller
{
    protected $wechat;

    public function __construct(Application $wechat)
    {
        $this->wechat = $wechat;
    }

    public function serve()
    {
        $server = $this->wechat->server;
        $userWe = $this->wechat->user;

        $server->setMessageHandler(function ($message) use ($userWe) {
            $userOpenid = $message->FromUserName;
            switch ($message->MsgType) {
                case 'event':
                    $user = $userWe->get($userOpenid);

                    $memberModel = new Member();

                    $is_exit = $memberModel->where('openid', $userOpenid)->select('id')->first();

                    if ($is_exit) {
                        $memberid = $is_exit->id;
                    } else {
                        $member = [
                            'openid' => $userOpenid,
                            'nickname' => $user['nickname'],
                            'head' => $user['headimgurl'],
                            'earnings' => 0,
                            'getearnings' => 0,
                            'type' => 0
                        ];
                        $memberid = $memberModel->insertGetId($member);
                    }

                    if ($memberid) {
                        session()->pull('mid', $memberid);
                        return session()->get('mid');
                        return '欢迎您的到来: ' . $user['nickname'];
                    } else {
                        return '由于某种原因你的信息未进行保存,你处于离线状态，购买商品时会跳转到个人中心完成注册，你也可以点击<a href="/member">注册</a>进行手动注册';
                    }

                    break;
                case 'text':
                    return new Transfer();
                    break;
            }
        });

        return $server->serve();
    }

    public function back()
    {

    }
}
