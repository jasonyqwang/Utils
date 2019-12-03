<?php
/**
 * User: Jason Wang
 * 时间助手类
 */

namespace Jsyqw\Utils;


class DateTimeHelper
{
    /**
     * 获取第 n 个月的起始日期
     * @param $n int
     * @return string
     */
    public static function startMonthDate($n){
        $time = strtotime($n . ' month');
        return date('Y-m-01 00:00:00', $time);
    }


    /**
     * 获取第 n 个月的起始时间戳
     * @param $n
     * @return int
     */
    public static function startMonthTime($n){
        $date = self::startMonthDate($n);
        return strtotime($date);
    }

    /**
     * 获取第 n 个星期的起始日期
     * @param $n int
     * @return string
     */
    public static function startWeekDate($n){
        $time = strtotime('sunday  '.$n . ' week') - 6 * 24 * 3600;
        return date('Y-m-d 00:00:00', $time);
    }


    /**
     * 获取第 n 个星期的起始时间戳
     * @param $n
     * @return int
     */
    public static function startWeekTime($n){
        $date = self::startWeekDate($n);
        return strtotime($date);
    }
}