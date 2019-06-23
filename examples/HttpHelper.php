<?php
/**
 * Created by PhpStorm.
 * @author  jason <jasonwang1211@gmail.com>
 */

require  dirname(__DIR__) .'/vendor/autoload.php';


$url = 'https://';
\Jsyqw\Utils\HttpHelper::asyncCurlGet($url);
