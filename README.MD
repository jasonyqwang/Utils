# 实用工具包

# 安装

    composer require jsyqw/utils
    
## ArrayHelper
```php

//Converts an object or an array of objects into an array.
ArrayHelper::toArray($object, $properties = [], $recursive = true);

//Retrieves the value of an array element or object property with the given key or property name.
ArrayHelper::getValue($array, $key, $default = null);

//Indexes and/or groups the array according to a specified key.
ArrayHelper::index($array, $key, $groups = []);

//Builds a map (key-value pairs) from a multidimensional array or an array of objects.
ArrayHelper::map($array, $from, $to, $group = null);
    
```

## FileHelper
```php

//Convert camel case to human readable format
FileHelper::format($bytes, $decimals = 2);

//Delete dir and files
FileHelper::delDir($path, $isDelCurrent = false);

//Get files extension
FileHelper::getExt($str);

```

## IPHelper
```php

//Get client`s real ip
IPHelper::remoteIp($useProxy = false)

//Generate  random chinese`ip
IPHelper::randIp()

```

## StrHelper
```php

//Generate unique num eg: YYYYMMDDHHIISSNNNNNNNNCC 24 
StrHelper::uniqueNum();

//Generate guid
StrHelper::guid();

//Random string
StrHelper::random($length = 6, $type = 'string')

```

## ValidateHelper
```php

//Check phone rule
ValidateHelper::checkPhone($phone);

//Check email rule
ValidateHelper::checkEmail($email);

//Check it's an HTTP address or not
ValidateHelper::isHttp($str);

```


    
        
    
    
    