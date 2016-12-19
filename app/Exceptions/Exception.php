<?php
/**
 * Created by PhpStorm.
 * User: hwang
 * Date: 2016/1/15
 * Time: 11:08
 */

namespace App\Exceptions;


class Exception extends \Exception{

    protected $errCode ;
    protected $errMsg;

    public function __construct($code = 'internalError', $msg='服务器内部错误'){
        $this->errCode = $code;
        $this->errMsg = $msg;
        $this->message = "[$code:$msg]";
    }

    public function getErrCode(){
        return $this->errCode;
    }

    public function getErrMsg(){
        return $this->errMsg;
    }

}