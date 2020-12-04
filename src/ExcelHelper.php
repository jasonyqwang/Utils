<?php
/**
 * Created by PhpStorm.
 * @author  jason <jasonwang1211@gmail.com>
 */

namespace Jsyqw\Utils;


use Jsyqw\Utils\Excels\ExcelData;
use Jsyqw\Utils\Excels\ExcelHeader;

class ExcelHelper
{
    /**
     * @var array [$file => ExcelData]
     */
    private $fileExcelDataCache = [];
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
     * set excel header map
     * @param $excelHeader ["birthday" => "出生日期", "name" => "名称", "height" => "身高"]
     * @throws Exceptions\UtileExcelException
     */
    public function setExcelHeaderMap($file, $header){
        $excelData = $this->getExcelData($file);
        $excelHeader = new ExcelHeader($header);
        $excelData->setExcelHeader($excelHeader);
        $this->fileExcelDataCache[$file] = $excelData;
    }

    /**
     * @param $file
     * @param array $header
     * @return ExcelData|mixed
     * @throws Exceptions\UtileExcelException
     */
    public function getExcelData($file, $header = []){
        if(isset($this->fileExcelDataCache[$file])){
            $excelData = $this->fileExcelDataCache[$file];
        }else{
            $excelData = new ExcelData();
            $excelData->loadFile($file);
        }
        if($header){
            $excelHeader = new ExcelHeader($header);
            $excelData->setExcelHeader($excelHeader);
        }
        $this->fileExcelDataCache[$file] = $excelData;
        return $excelData;
    }

    /**
     * get excel data
     * eg： $data = ExcelHelper::instance($file)->getData(["birthday" => "出生日期", "name" => "名称", "height" => "身高"]);
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
    }]
     */
    public function getData($file, $header = []){
        $excelData = $this->getExcelData($file, $header);
        $data = $excelData->getData();
        return $data;
    }

    /**
     * Get Row Data
     * @param $row
     * @return array
     * @throws \PHPExcel_Exception
     */
    public function getRowData($file, $row){
        $excelData = $this->getExcelData($file);
        return $excelData->getRowData($row);
    }
}