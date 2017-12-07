<?php
dd(123);
$wechatObj = new Wechat();

$creatMenu = $wechatObj->getAccessToken();
//creatMenu
var_dump($creatMenu);

class Wechat
{
    public $appid = 'wx45758c4b029a3bcc';
    protected $appsecret = '3d47b3bee2474f09b16e5ff6500e31f5';

    //获得token
    public function getAccessToken()
    {

        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=" . $this->appid . "&secret=" . $this->appsecret;
        $data = getCurl($url);
        $resultArr = json_decode($data, true);
        return $resultArr["access_token"];
    }

    //创建菜单
    public function creatMenu()
    {
        $accessToken = $this->getAccessToken();
        $menuPostString = ' {
                             "button":[
                             {
                                  "type":"click",
                                  "name":"今日歌曲",
                                  "key":"V1001_TODAY_MUSIC"
                              },
                              {
                                   "name":"菜单",
                                   "sub_button":[
                                   {
                                       "type":"view",
                                       "name":"搜索",
                                       "url":"http://www.soso.com/"
                                    },
                                    {
                                         "type":"miniprogram",
                                         "name":"wxa",
                                         "url":"http://mp.weixin.qq.com",
                                         "appid":"wx286b93c14bbf93aa",
                                         "pagepath":"pages/lunar/index"
                                     },
                                    {
                                       "type":"click",
                                       "name":"赞一下我们",
                                       "key":"V1001_GOOD"
                                    }]
                               }]
                         }';

        $menuPostUrl = " https://api.weixin.qq.com/cgi-bin/menu/create?access_token=" . $accessToken;
        $menu = dataPost($menuPostString, $menuPostUrl);

        return $menu;
    }
}

function getCurl($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}

function dataPost($post_string, $url)
{
    $context = array('http' =>
        array('method' => "POST",
            'header' => "User-Agent:Mozilla/5.0 (Windows; U; Windows NT 6.0; en-US) \r\n Accept: */*",
            'content' => $post_string)
    );
    $stream_context = stream_context_create($context);
    $data = file_get_contents($url, FALSE, $stream_context);
    return $data;
}