<?php
/**
 * Created by PhpStorm.
 * @author jason
 */
namespace Jsyqw\PHPUnit;

use Jsyqw\Utils\FileHelper;


class FileHelperTest extends \PHPUnit\Framework\TestCase
{
    public function testFormat(){
        $size = FileHelper::format(200, 2);
        $this->assertSame('200B',$size);


        $size = FileHelper::format(2000, 2);
        $this->assertSame('1.95KB',$size);
    }
}