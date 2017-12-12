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
        $userWe = $this->wechat->user;

        $server->setMessageHandler(function ($message) use ($userWe) {
            $userOpenid = $message->FromUserName;
            switch ($message->MsgType) {
                case 'event':
                    $userInfo['openid'] = $userOpenid;
                    $user = $userWe->get($userInfo['openid']);
                    $userInfo['nickname'] = $user['nickname'];
                    $userInfo['headimgurl'] = $user['headimgurl'];
                    if (userAttention($userInfo)) {
                        return $this->reply('follow_keyword');
                    } else {
                        return '您的信息由于某种原因没有保存，请重新关注';
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
