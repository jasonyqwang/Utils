# 实用工具包

# 安装

    composer require jsyqw/utils
    
## 数组助手类 ArrayHelper
```php

//把对象或者数组对象，转成数组
ArrayHelper::toArray($object, $properties = [], $recursive = true);

//获取对象或者数组的指定的值
ArrayHelper::getValue($array, $key, $default = null);

//根据指定的key，建立key对应索引的数组，或者分组后的索引数组
ArrayHelper::index($array, $key, $groups = []);

//把数组转成 key-value 的形式
ArrayHelper::map($array, $from, $to, $group = null);

//检查数组是否是列索引
ArrayHelper::isAssoc($array);
    
```

## FileHelper
```php

//把文件大小格式化成友好格式
FileHelper::format($bytes, $decimals = 2);

//删除文件 和 目录
FileHelper::delDir($path, $isDelCurrent = false);

//获取文件扩展
FileHelper::getExt($str);

```

## IPHelper
```php

//获取客户端真实ip
IPHelper::remoteIp($useProxy = false)

//随机生成 chinese`ip （爬虫伪造ip）
IPHelper::randIp()

```

## StrHelper
```php

//生成唯一数字 eg: YYYYMMDDHHIISSNNNNNNNNCC 24 
StrHelper::uniqueNum();

//生成唯一的 guid
StrHelper::guid();

//随机字长度的随机字符串
StrHelper::random($length = 6, $type = 'string')

```

## ValidateHelper
```php

//验证手机号
ValidateHelper::checkPhone($phone);

//验证邮箱
ValidateHelper::checkEmail($email);

//验证是不是http开头的地址
ValidateHelper::isHttp($str);

//验证是否是 json 字符串
ValidateHelper::isJson($str)

```
## HttpHelper
```php

//curl post 请求封装
HttpHelper::curlPost($url, $data, $options = [])

//curl get 请求封装
HttpHelper::curlGet($url, $data, $options = [])

//curl 请求封装
HttpHelper::curl($method, $url, $data='', $options = [])

//curl post 异步请求不需要返回结果
HttpHelper::asyncCurlPost($url, $data, $options = [])

//curl get 异步请求不需要返回结果
HttpHelper::asyncGet($url, $data, $options = [])

```

## RuntimeHelper
```php
// 启动计时
RuntimeHelper::instance()->start();

//结束计时并返回消耗的时间（单位 毫秒）
RuntimeHelper::instance()->stop();

//重新开始计时
RuntimeHelper::instance()->reset();
```

## SystemHelper
```php
// 获取内存使用情况
SystemHelper::getMemoryUsage();

// 获取内存使用情况
SystemHelper::logMsg($msg, $file = './log.txt');

```

## TreeHelper
```php
// 树形递归 , $keyName 作为主键的名称
TreeHelper::getTree($arr, $pid, $keyName = 'pid');
// 返回示例
[{
	"id": "1",
	"pid": "0",
	"name": "test1",
	"children": [{
		"id": "4",
		"pid": "1",
		"name": "test1-1",
		"children": []
	}]
}]
```
    
        
    
    
    