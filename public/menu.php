<?php
header("Content-type: text/html; charset=utf-8");
define("ACCESS_TOKEN", "BFqOl2-QTve_4GgXXujAO6s1h-2-Z5VDN1ersOiC-EhZIKJydOd1iOJLBK0Q9KjIT5Zd4mO5LgDqbsRqYSPPedrr54EvYBbflCmJS8O_IjPCz_0vIrSW93n-c521fgV2GPCgAIABKX");

function createMenu($data)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=" . ACCESS_TOKEN);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $tmpInfo = curl_exec($ch);
    if (curl_errno($ch)) {
        return curl_error($ch);
    }

    curl_close($ch);
    return $tmpInfo;

}

//获取菜单
function getMenu()
{
    return file_get_contents("https://api.weixin.qq.com/cgi-bin/menu/get?access_token=" . ACCESS_TOKEN);
}

//删除菜单
function deleteMenu()
{
    return file_get_contents("https://api.weixin.qq.com/cgi-bin/menu/delete?access_token=" . ACCESS_TOKEN);
}


$data = '{
     "button":[
     {
          "type":"view",
          "name":"商城首页",
          "url":"http://mall.eos-tech.cn/"
      },
      {
          "type":"view",
          "name":"全部商品",
          "url":"http://mall.eos-tech.cn/list"
      },
      {
           "name":"我的",
           "sub_button":[
            {
               "type":"view",
                "name":"我的账户",
                "url":"http://mall.eos-tech.cn/member"
            },
            {
               "type":"view",
                "name":"购物车",
                "url":"http://mall.eos-tech.cn/cart"
            },
            {
               "type":"view",
                "name":"查看物流",
                "url":"http://mall.eos-tech.cn/member"
            }]
       }]
}';


echo createMenu($data);
//echo getMenu();
//echo deleteMenu();