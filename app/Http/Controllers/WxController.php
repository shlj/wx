<?php
/**
 * Created by PhpStorm.
 * User: songhang
 * Date: 16-12-19
 * Time: 下午3:02
 */

namespace App\Http\Controllers;


use App\Exceptions\Exception;
use App\Services\UserService;
use Illuminate\Http\Request;

class WxController extends Controller
{
    private $APPID;
    
    private $SECRET;
    
    public function __construct()
    {
        $this->APPID = env('APP_ID');
        $this->SECRET = env('APP_SECRET');
    }

    public function getOpenId(Request $request)
    {
        $code = $request->get('code');

        try {
            UserService::getOpenId($code, $this->APPID, $this->SECRET);
        } catch (Exception $e) {
            return view('errors.503');
        }

        return view('index.index');
    }
}