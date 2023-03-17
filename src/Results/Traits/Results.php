<?php
/**
 * Created by PhpStorm.
 * @author  jason <jasonwang1211@gmail.com>
 */

namespace Jsyqw\Utils\Results\Traits;

use Jsyqw\Utils\Results\Codes;
use Closure;
use Jsyqw\Utils\Results\Models\Data;
use Jsyqw\Utils\Results\Models\DataModel;

trait Results
{
    //默认返回的消息（比如 try catch 到的异常信息，客户端不能直接显示警告）
    protected static $defaultMsgList = [
        //成功
        Codes::CODE_SUCCESS => '操作成功',
        //1000 - 1999 客户端引起的错误
        Codes::CODE_ERROR_INVALID => '非法请求',//（post & get 请求不正确）
        Codes::CODE_ERROR_PARAMS => '参数错误',//各种参数错误，具体是什么参数错误，可以在返回的时候输入msg参数
        Codes::CODE_ERROR_SIGN => '签名无效',//--基类
        Codes::CODE_ERROR_TIME => '请求无效',//（时间校验失败）--基类

        //2000 - 2999 服务器的业务交互的错误提示(包括约定好的特殊状态码）
        Codes::CODE_ERROR_SERVER => '服务器繁忙',    //服务器返回友好提示
        Codes::CODE_ERROR_AUTH => '认证错误',//token 无效--基类【特殊】
        Codes::CODE_ERROR_ACCESS => '没有权限',//没有接口的权限
        Codes::CODE_ERROR_UNKNOWN => '未知错误',

        //3000 - 4000 服务器错误（比如 try catch 到的异常信息，客户端不能直接显示警告）
        Codes::CODE_ERROR_SERVICE => '服务器处理异常',
    ];

    /**
     * @param DataModel $dataModel
     * @param Closure|null $callback 执行匿名函数，比如设置 header 头等信息等，用于扩展
     * @return mixed
     */
    public function returnJson(DataModel $dataModel, Closure $callback = null)
    {
        if (!$dataModel->msg && isset(self::$defaultMsgList[$dataModel->code])) {
            $dataModel->msg = self::$defaultMsgList[$dataModel->code];
        }
        if ($callback && $callback instanceof Closure) {
            $callback();
        }
        return $dataModel->toData();
    }

    /**
     * 处理成功返回
     * @param array $data
     * @param string $msg
     * @param array $params 和code同级的数据
     * @param Closure|null $callback
     * @return array
     */
    public function success($data = [], $msg = '', $params = [], Closure $callback = null)
    {
        $dataModel = new DataModel();
        $dataModel->code = Codes::CODE_SUCCESS;
        $dataModel->msg = $msg;
        $dataModel->data = $data;
        $dataModel->params = $params;

        return $this->returnJson($dataModel, $callback);
    }

    /**
     * 处理错误返回,参数错误
     * @param string $msg
     * @param array $data
     * @param array $params 和code同级的数据
     * @param Closure|null $callback
     * @return array
     */
    public function paramsError($msg = '', $data = [], $params = [], Closure $callback = null)
    {
        $dataModel = new DataModel();
        $dataModel->code = Codes::CODE_ERROR_PARAMS;
        $dataModel->msg = $msg;
        $dataModel->data = $data;
        $dataModel->params = $params;
        return $this->returnJson($dataModel, $callback);
    }

    /**
     * 处理错误返回
     * @param string $msg
     * @param int $code
     * @param array $data
     * @param array $params 和code同级的数据
     * @param Closure|null $callback
     * @return array
     */
    public function error($msg = '', $code = Codes::CODE_ERROR_SERVER, $data = [], $params = [], Closure $callback = null)
    {
        $dataModel = new DataModel();
        $dataModel->code = $code;
        $dataModel->msg = $msg;
        $dataModel->data = $data;
        $dataModel->params = $params;
        return $this->returnJson($dataModel, $callback);
    }

    /**
     * 认证错误
     * @param string $msg
     * @param array $data
     * @param array $params 和code同级的数据
     * @param Closure|null $callback
     * @return array
     */
    public function authError($msg = '', $data = [], $params = [], Closure $callback = null)
    {
        $dataModel = new DataModel();
        $dataModel->code = Codes::CODE_ERROR_AUTH;
        $dataModel->msg = $msg;
        $dataModel->data = $data;
        $dataModel->params = $params;
        return $this->returnJson($dataModel, $callback);
    }
}