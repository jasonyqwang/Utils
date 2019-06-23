<?php
/**
 * Created by PhpStorm.
 * @author  jason <jasonwang1211@gmail.com>
 */

namespace Jsyqw\Utils;


class SystemHelper
{
    /**
     * 获取内存使用情况
     * @return int|string
     */
    public static function getMemoryUsage(){
        if(function_exists('memory_get_usage')){
            $mem = memory_get_usage();
            return FileHelper::format($mem);
        }
        return 0;
    }

    /**
     * 记录日志，一般调试时候使用
     * @param $msg
     * @param string $file
     */
    public static function logMsg($msg, $file = './log.txt') {
        if(is_array($msg)){
            $msg = json_encode($msg);
        }
        $desc = '[' .  self::getMemoryUsage() . ']['.date('Y-m-d H:i:s', time()).'] - '. $msg . PHP_EOL;
        $fp = fopen($file, 'a');

        fwrite($fp, $desc);
        fclose($fp);
    }
}