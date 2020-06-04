<?php
/**
 * Created by PhpStorm.
 * @author  jason <jasonwang1211@gmail.com>
 */

namespace Jsyqw\Utils;


class StrHelper
{
    /**
     * 生成短的唯一码
     * eg：A604571124663362【16位】
     * 【A:对应年】+【6：月16进制】+【04:日期】+【57112：时间戳后五位】+【46633：毫秒5位】+【随机两位】
     * @return string
     */
    public static function shortUniqueStr(){
        $yArr = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O','P', 'Q', 'R', 'S', 'T','U', 'V'];
        $i = date('Y') - 2020;
        $yCode = isset($yArr[$i]) ? $yArr[$i] : 'Z';
        $str = $yCode . strtoupper(dechex(date('m'))) . date('d') . substr(time(), -5) . substr(microtime(), 2, 5) . sprintf('%02d', rand(0, 99));
        return $str;
    }

    /**
     * 生成唯一数字
     * @return string eg: YYYYMMDDHHIISSNNNNNNNNCC 24位
     * 格式：YYYY-MMDD-HHII-SS-NNNN,NNNN-CC，其中：YYYY=年份，MM=月份，DD=日期，HH=24格式小时，II=分，SS=秒，NNNNNNNN=随机数，CC=检查码
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
     * 生成唯一的 guid
     * @return string  eg: 08178533-5ca4-6194-5745-607197a47faa
     */
    public static function guid(){
        if (function_exists('com_create_guid')) {
            return trim(com_create_guid(), '{}');
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
     * 随机字长度的随机字符串
     * @param int $length 长度
     * @param string $type 类型
     * @return string 随机字符串
     */
    public static function random($length = 6, $type = 'string')
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