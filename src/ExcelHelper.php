<?php
/**
 * Created by PhpStorm.
 * @author  jason <jasonwang1211@gmail.com>
 */

namespace Jsyqw\Utils;


use Jsyqw\Utils\Excel\ExcelData;
use Jsyqw\Utils\Excel\ExcelHeader;

class ExcelHelper
{
    private static $_instance = null;

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    /**
     * @return ExcelHelper|null
     */
    public static function instance(){
        if(!self::$_instance){
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * get excel data
     * eg： $data = ExcelHelper::instance()->getData($file, ["birthday" => "出生日期", "name" => "名称", "height" => "身高"]);
     * @param $file
     * @param array $header  eg： ["birthday" => "出生日期", "name" => "名称", "height" => "身高"]
     * @return array eg:[{
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
     */
    public function getData($file, $header = []){
        $excelData = new ExcelData();
        $excelData->loadFile($file);
        if($header){
            $excelHeader = new ExcelHeader($header);
            $excelData->setExcelHeader($excelHeader);
        }
        $data = $excelData->getData();
        return $data;
    }
}