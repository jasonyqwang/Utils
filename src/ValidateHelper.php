<?php
/**
 * Created by PhpStorm.
 * 校验
 */
namespace Jsyqw\Utils;

class ValidateHelper
{
    /**
     * 检查是否是手机号码
     * @param $phone
     * @return bool
     */
    public static function checkPhone($phone){
        if(preg_match("/^1[345789]{1}\d{9}$/",$phone)){
            return true;
        }else{
            return false;
        }
    }

    /**
     * 邮箱格式检查
     * @param $email
     * @return bool
     */
    public static function checkEmail($email){
        $pattern = "/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/";
        if(preg_match($pattern, $email)){
            return true;
        }else{
            return false;
        }
    }

    /**
     * 判断是不是 http 地址
     * @param $str
     * @return bool
     */
    public static function isHttp($str){
        if(!$str){
            return false;
        }
        $pattern = '/(http|https):\/\/([\w.]+\/?)\S*/';
        if(preg_match($pattern, $str)){
            return true;
        }
        return false;
    }
}