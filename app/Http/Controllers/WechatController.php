<?php

namespace App\Http\Controllers;

use EasyWeChat\Foundation\Application;
use EasyWeChat\Message\Transfer;
use App\Http\Controllers\Controller;

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
        $user = $this->wechat->user;

        $server->setMessageHandler(function ($message) use ($user) {
            switch ($message->MsgType) {
                case 'event':
                    return '欢迎您的到来:' . $user->get($message->FromUserName)->nickname;
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
