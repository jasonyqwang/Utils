<?php
/**
 * Created by PhpStorm.
 * @author  jason <jasonwang1211@gmail.com>
 */

namespace Jsyqw\PHPUnit;

use Jsyqw\Utils\SystemHelper;
use PHPUnit\Framework\TestCase;

class SystemHelperTest extends TestCase
{
    /**
     * 获取内存使用情况
     * @return int|string
     */
    public function testGetMemoryUsage(){
        $res = SystemHelper::getMemoryUsage();

        $this->assertGreaterThan(-1, $res);
    }

}