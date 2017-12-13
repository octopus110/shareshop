<?php

namespace App\Http\Controllers;

use EasyWeChat\Foundation\Application;
use EasyWeChat\Message\Transfer;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;

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
                    $userInfo['openid'] = $userOpenid;
                    $user = $userWe->get($userInfo['openid']);
                    $userInfo['nickname'] = $user['nickname'];
                    $userInfo['headimgurl'] = $user['headimgurl'];

                    return '欢迎您的到来: ' . $user['nickname'];
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
