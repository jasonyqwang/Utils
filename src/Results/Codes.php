<?php
/**
 * Created by PhpStorm.
 * @author  jason <jasonwang1211@gmail.com>
 */

namespace Jsyqw\Utils\Results;


class Codes
{
    const CODE_SUCCESS = 0;                   //成功

    //1000 - 1999 客户端引起的错误
    const CODE_ERROR_INVALID = 1000;          //非法请求
    const CODE_ERROR_PARAMS = 1001;           //参数错误
    const CODE_ERROR_SIGN = 1002;             //签名无效
    const CODE_ERROR_TIME = 1003;             //时间校验失败

    //2000 - 2999 服务器的业务交互的错误提示（包括约定好的特殊状态码）
    const CODE_ERROR_SERVER = 2000;           //服务器返回友好提示
    const CODE_ERROR_AUTH = 2001;             //认证错误 【特殊】
    const CODE_ERROR_ACCESS = 2002;           //没有权限
    const CODE_ERROR_UNKNOWN = 2003;          //未知错误

    //3000 - 3999 客户端不能直接显示警告
    const CODE_ERROR_SERVICE = 3000;           //服务器错误
}