<?php

namespace App\Http\Controllers;

use App\Member;
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
                    $userOpenid = $message->FromUserName;

                    switch ($message->Event) {
                        case 'subscribe':
                            $member = new Member();
                            $member->nickname = $user->get($userOpenid)->nickname;
                            $member->head = $user->get($userOpenid)->headimgurl;
                            $ret = $member->save();

                            if ($ret) {
                                request()->session()->put('openid', $userOpenid);
                                return $this->reply('follow_keyword');
                            } else {
                                return '您的信息由于某种原因没有保存，你处于未登录状态';
                            }
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
