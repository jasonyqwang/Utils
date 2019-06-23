<?php
/**
 * Created by PhpStorm.
 * @author  jason <jasonwang1211@gmail.com>
 */
require  dirname(__DIR__) .'/vendor/autoload.php';


use Jsyqw\Utils\RuntimeHelper;


RuntimeHelper::instance()->start();
$consumeTime = RuntimeHelper::instance()->stop();
