<?php

namespace widuu\Express;

class Express
{

    /**
     * 获取快递公司名称
     *
     * @param  string $number       快递单号
     * @param  string $companyName  快递公司名称
     * @param  string $output       返回类型，默认数组，true返回json格式
     * @return array|bool|string
     */

    public function search( $number , $companyName = '', $output = false )
    {
        $companyCode = '';

        if( !empty($companyName) ){
            $companyData = ExpressName::$name;
            if( !in_array($companyName, $companyData) ){
                $info = json_encode(['status'=>500,'info'=>'Company Not Exists']);
            }else{
                $companyCode = array_search($companyName, $companyData);
            }
        }else{
            $companyCode = $this->getCompanyName($number,false);
        }
       
        $info = $this->get("http://m.kuaidi100.com/query?type={$companyCode}&postid={$number}");

        return $output ? $info : json_decode($info,true);
    }

    /**
     * 获取快递公司名称
     *
     * @param  string $number 快递单号
     * @param  string $output 返回类型，默认返回名称，false返回公司编码
     * @return string
     */

    public function getCompanyName( $number , $output = true )
    {
        $companyCode = '';

        $content = $this->get('http://m.kuaidi100.com/autonumber/auto?num='.$number);
        if( !empty($content) ){
            $result = json_decode($content,true);
            $companyCode = isset( $result[0]['comCode'] ) ? $result[0]['comCode'] : 'unknow';
        }

        $companyName = ExpressName::$name;

        return $output ? (isset($companyName[$companyCode]) ? $companyName[$companyCode] : $companyCode):$companyCode;

    }

    /**
     * 更新快递公司静态类
     *
     * @return void
     */

    public function updateCompany()
    {
        
        $vendorDir = dirname(__FILE__);

        $content = $this->get("http://m.kuaidi100.com/all/");
        
        preg_match_all("/data\-code\=\"(?P<name>\w+)\"\>(?P<title>.*)\<\/a\>/iU",$content,$match);
     
        $name = array();
        foreach($match['name'] as $k=>$v){
            if( strpos($match['title'][$k], 'img') ){
                $match['title'][$k] = preg_replace("/<img\s+src=[\\\'| \\\"](.*?(?:[\.gif|\.jpg]))[\\\'|\\\"].*?[\/]?>/",'',$match['title'][$k]);   
            }
            $name[$v] =$match['title'][$k];
        }
        
        $config = var_export($name,true);

        $classString = "<?php\n\nnamespace widuu\Express;\n\n";  
        $classString .= "class ExpressName\n";  
        $classString .= "{\n\n\t\t";  
        $classString .= "static \$name={$config};\n}";  

        $result = file_put_contents( $vendorDir.'/ExpressName.php', $classString );
        
        return $result;
    }

    /**
     * CURL采集网页内容
     *
     * @param string $url 请求连接
     * @return bool|mixed
     */

    private function get($url)
    {
        if( !function_exists('curl_init') ){
            $content = file_get_contents($url);
        }else{
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_TIMEOUT, 10);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            $content = curl_exec($curl);
            $status  = curl_getinfo($curl);
            curl_close( $curl );
            if ( intval($status["http_code"]) != 200 ) {
                return false;
            }
        }

        return $content;
    }
}