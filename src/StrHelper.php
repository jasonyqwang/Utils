<?php
/**
 * Created by PhpStorm.
 */

namespace Jsyqw\Utils;


class StrHelper
{
    /**
     * 生成唯一的数字串
     * @return string eg: YYYYMMDDHHIISSNNNNNNNNCC 24位
     */
    public static function uniqueNum(){
        //格式主体（YYYYMMDDHHIISSNNNNNNNN）
        $main = date('YmdHis') . rand(10000000,99999999);
        $len = strlen($main);
        $sum = 0;
        for($i=0; $i<$len; $i++){
            $sum += (int)(substr($main,$i,1));
        }
        $str = $main . str_pad((100 - $sum % 100) % 100,2,'0',STR_PAD_LEFT);
        return $str;
    }

    /**
     * 获取guid
     * @return string  eg: 08178533-5ca4-6194-5745-607197a47faa
     */
    public static function guid(){
        if (function_exists('com_create_guid')) {
            return com_create_guid();
        } else {
            mt_srand((double)microtime() * 1000000);
            $charid = md5(uniqid(rand(), true));
            $hyphen = chr(45);// "-"
            $uuid = substr($charid, 0, 8) . $hyphen
            . substr($charid, 8, 4) . $hyphen
            . substr($charid, 12, 4) . $hyphen
            . substr($charid, 16, 4) . $hyphen
            . substr($charid, 20, 12);
            return $uuid;
        }
    }

    /**
     * 方法一：获取随机字符串
     * @param number $length 长度
     * @param string $type 类型
     * @return string 随机字符串
     */
    function random($length = 6, $type = 'string')
    {
        $config = array(
            'number' => '1234567890',
            'letter' => 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
            'string' => 'abcdefghjkmnpqrstuvwxyzABCDEFGHJKMNPQRSTUVWXYZ23456789',
            'all' => 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890'
        );
        if (!isset($config[$type]))
            $type = 'string';
        $string = $config[$type];
        $code = '';
        $strlen = strlen($string) - 1;
        for ($i = 0; $i < $length; $i++) {
            $code .= $string{mt_rand(0, $strlen)};
        }
        return $code;
    }
}