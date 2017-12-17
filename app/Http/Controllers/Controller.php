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
}
