<?php

namespace App\Http\Controllers;

use App\Member;
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

    public function serve(Request $request)
    {
        $server = $this->wechat->server;
        $user = $this->wechat->user;

        $server->setMessageHandler(function ($message) use ($user, $request) {
            switch ($message->MsgType) {
                case 'event':
                    $userOpenid = $message->FromUserName;

                    switch ($message->Event) {
                        case 'subscribe':
                            $member = new Member();

                            $id = $member->where('openid', $userOpenid)->select('id')->first();

                            if (!$id) {
                                $id = $member->insertGetId([
                                    'openid' => $userOpenid,
                                    'nickname' => $user->get($userOpenid)->nickname,
                                    'head' => $user->get($userOpenid)->headimgurl,
                                ]);

                                if ($id) {
                                    $request->session()->put('mid', $id);
                                    return '欢迎您的到来:' . $user->get($userOpenid)->nickname;
                                } else {
                                    return '您的信息由于某种原因没有保存，您处于未登录状态';
                                }
                            } else {
                                request()->session()->put('mid', $id);
                                return '欢迎您的再次光临';
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
