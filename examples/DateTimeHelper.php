<?php
/**
 * Created by PhpStorm.
 * @author  jason <jasonwang1211@gmail.com>
 */

require  dirname(__DIR__) .'/vendor/autoload.php';


$ret = \Jsyqw\Utils\DateTimeHelper::startMonthTime(-1);
//$ret = \Jsyqw\Utils\DateTimeHelper::startWeekTime(-1);
//2019-11-25 00:00:00
print_r($ret);
