<?php
/**
 * 用于计算程序运行的时间(可以以单例方式使用)
 *
 * @author  jason <jasonwang1211@gmail.com>
 */

namespace Jsyqw\Utils;


class RuntimeHelper
{
    private static $_instance = null;
    public $startTime = 0;
    public $stopTime = 0;

    /**
     * 实例化
     * @return RuntimeHelper|null
     */
    public static function instance(){
        if(!self::$_instance){
            self::$_instance = new static();
        }
        return self::$_instance;
    }

    /**
     * 获取毫秒的时间
     * @return float
     */
    public function getMicroTime() {
        list($time, $sec) = explode(' ', microtime());
        return ((float) $time + (float) $sec);
    }

    /**
     * 记录开始的时间
     * @return bool
     */
    public function start() {
        $this->startTime = $this->getMicroTime();
        return true;
    }

    /**
     * 结束计时并返回消耗的时间（单位 毫秒）
     */
    public function stop() {
        $this->stopTime = $this->getMicroTime();
        return $this->consumeTime();
    }

    /**
     * 计算消耗多长时间 单位毫秒）
     * @return float
     */
    public function consumeTime(){
        $this->stopTime = $this->getMicroTime();
        return round(($this->stopTime - $this->startTime) * 1000, 1);
    }

    /**
     * 重新开始计时
     * @return bool
     */
    public function reset(){
        $this->startTime = 0;
        $this->stopTime = 0;
        return true;
    }
}