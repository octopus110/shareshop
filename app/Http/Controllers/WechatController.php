<?php

namespace App\Http\Controllers;

use EasyWeChat\Foundation\Application;
use EasyWeChat\Message\Transfer;
use Illuminate\Http\Request;
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
                    switch ($message->Event) {
                        case 'subscribe':
                            return '你好' . $user->get($message->FromUserName)->nickname . '! 欢迎关注';
                            break;
                        default:
                            return '谢谢关注';
                            break;
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
