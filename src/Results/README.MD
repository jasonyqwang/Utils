# 在controller的基类中引用 Results 即可

```php
class BaseApiController extends ActiveController
{
    use Results;

}
```