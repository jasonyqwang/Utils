<?php
/**
 * Created by PhpStorm.
 * @author jason
 */
namespace Jsyqw\PHPUnit;

use Jsyqw\Utils\FileHelper;


class FileHelperTest extends \PHPUnit\Framework\TestCase
{
    public function setUp()/* The :void return type declaration that should be here would cause a BC issue */
    {
        parent::setUp();
        $path = __DIR__.'/tmp/test';
        if(!is_dir($path)){
            mkdir($path);
        }
    }

    public function testFormat(){
        $size = FileHelper::format(200, 2);
        $this->assertSame('200B',$size);


        $size = FileHelper::format(2000, 2);
        $this->assertSame('1.95KB',$size);
    }

    public function testDelDir(){
        $path = __DIR__.'/tmp/test';

        $rs = FileHelper::delDir($path);
        $this->assertTrue($rs);

        $rs = FileHelper::delDir($path, true);
        $this->assertTrue($rs);
    }

    public function testGetExt(){
        $str ='/tmp/test.JPG';

        $rs = FileHelper::getExt($str);
        $this->assertSame('jpg',$rs);
    }
}