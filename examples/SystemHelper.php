<?php
/**
 * Created by PhpStorm.
 * @author  jason <jasonwang1211@gmail.com>
 */

require  dirname(__DIR__) .'/vendor/autoload.php';

use Jsyqw\Utils\SystemHelper;

echo SystemHelper::getMemoryUsage() . PHP_EOL;

echo SystemHelper::logMsg('text'). PHP_EOL;