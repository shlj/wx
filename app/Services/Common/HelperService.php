<?php
/**
 * Created by PhpStorm.
 * User: songhang
 * Date: 16-4-15
 * Time: 下午5:49
 */

namespace App\Services\Common;

use Log;

class HelperService
{
    public static function httpRequest($url, $params = array(), $method ='get', $timeout = 30, $headers = [])
    {
        $ch = curl_init();
        if(is_array($headers) && !empty($headers)){
            curl_setopt ($ch, CURLOPT_HTTPHEADER , $headers);
        }
        if($method == 'post'){
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //true 说明进行SSL证书认证
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); //true 说明进行严格认证
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        }

        if($method == 'get'){
            if(!empty($params)){
                $url_get = $url."?".http_build_query($params);
            } else {
                $url_get = $url;
            }
            curl_setopt($ch, CURLOPT_URL, $url_get);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        }

        $res = curl_exec($ch);
        curl_close($ch);

        if(env('API_LOG', false)) {
            Log::info("====api====",[
                'url' => $url,
                'params' => $params,
                'method' => $method,
                'response' => $res,
            ]);
        }

        return $res;
    }
}