<?php
/**
 * Created by PhpStorm.
 * @author  jason <jasonwang1211@gmail.com>
 */

namespace Jsyqw\Utils\Results\Models;


use phpDocumentor\Reflection\Types\Object_;

class DataModel
{
    //状态码
    public $code = 0;
    //提示msg
    public $msg = "";
    //返回的数据，必须是个数组对象， 即： key => value 的方式；
    public $data = [];
    //对应时间戳
    public $time = 0;
    //额外的参数，和 code同一级别的
    public $params = [];

    public function toData(){
        $retData =  [
            'code' => $this->code,
            'msg' => $this->msg,
            'data' => $this->data ? $this->data : (object)[],
            'time' => $this->time ?? time()
        ];
        return array_merge($this->params, $retData);
    }
}