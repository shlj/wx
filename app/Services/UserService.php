<?php
/**
 * Created by PhpStorm.
 * User: songhang
 * Date: 16-12-19
 * Time: 下午3:12
 */

namespace App\Services;

use App\Exceptions\Exception;
use App\Services\Common\HelperService;

class UserService
{
    public static function getOpenId($code, $AppId, $AppSecret)
    {
        if (empty($code)) {
            throw new Exception('invalid.request', '非法请求!');
        }
        //获取access_token
        $url = "https://api.weixin.qq.com/sns/oauth2/access_token";
        $params = [
            'appid' => $AppId,
            'secret' => $AppSecret,
            'code' => $code,
            'grant_type' => 'authorization_code',
        ];

        $data = HelperService::httpRequest($url, $params);

        $res = json_decode($data, true);
        if (isset($res['errcode'])) {
            throw new Exception($res['errcode'], '授权失败,请刷新此页面');
        }

        session($res);

        return $res;
    }
}