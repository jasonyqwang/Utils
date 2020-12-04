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

//生成短的唯一码，可以根据编码的值推算出来年、月、日
//短唯一码的起始年份，默认是2020年
//【A:对应年】+【6：月16进制】+【04:日期】+【57112：时间戳后五位】+【46633：毫秒5位】+【随机两位】
//注意：
//1.如果年份年份大于24年，则对第一个字符倍增操作，比如我们程序运行到2047年的时候 则以 AA 开头，
//2.如果传入的起始年份大于当前年份，则返回的字符串前面增加“-”符号
StrHelper::shortUniqueStr();

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
    
## DateTimeHelper 时间操作类
```php
//获取上个月的第一天起始时间（一般用于统计比较多）
DateTimeHelper::startMonthDate(-1);
//返回
2019-11-01 00:00:00

//获取下个月的第一天起始时间（一般用于统计比较多）
DateTimeHelper::startMonthDate(1);
//返回
1572566400

//获取上周的第一天（周一）起始时间
DateTimeHelper::startWeekDate(-1);
//返回
2019-11-25 00:00:00

//获取下周的第一天（周一）起始时间
DateTimeHelper::startWeekTime(1);
//返回 
1574640000

```        
    
## Excel处理工具类，根据excel首行配置，自动映射成数据库字段的数组结构
```php
/**
    $file: excel 文件路径
    数据库字段 birthday 和excel表头中的数据 "出生日期" 对应，
    数据库字段 name 和excel表头中的数据 "名称" 对应，
    数据库字段 height 和excel表头中的数据 "身高" 对应，
*/

$data = ExcelHelper::instance($file)->getData(["birthday" => "出生日期", "name" => "名称", "height" => "身高"]);
```
$data 的数据如下：
```json
[{
    "B": "男",
    "C": "打篮球",
    "E": 70,
    "G": null,
    "name": "张三",
    "height": 180,
    "birthday": "2000年11月13日"
}, {
    "B": "女",
    "C": null,
    "E": 50,
    "G": null,
    "name": "李四",
    "height": 160,
    "birthday": "2001年12月3日"
}, {
    "B": "女",
    "C": "画画",
    "E": 40,
    "G": null,
    "name": "王五",
    "height": 170,
    "birthday": "1992年1月13日"
}]
```
    
    