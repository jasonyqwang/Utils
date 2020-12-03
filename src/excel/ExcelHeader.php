<?php
/**
 * User: Jason Wang
 * excel header map
 */

namespace Jsyqw\Utils\excel;


use Jsyqw\Utils\Exceptions\UtileExcelException;

class ExcelHeader
{
    /**
     * the default header index
     * @var int
     */
    public $headerIndex = 1;
    /**
     * 头部字段的映射关系
     * Mapping relation of header field
     * @var array eg: ["name" => "名称"]
     */
    protected $headerColumnToExcelMap = [];

    /**
     * 指定的 Keyvalue 的映射关系
     * @var array  eg: ["A" => "name"]
     */
    protected $columnMapExcelCellIndex = [];

    public function __construct($headerColumnToExcelMap = [])
    {
        $this->setHeaderColumnToExcelMap($headerColumnToExcelMap);
    }

    /**
     * @param $headerColumnToExcelMap eg:["name" => "名称"]
     */
    public function setHeaderColumnToExcelMap($headerColumnToExcelMap){
        if(count($headerColumnToExcelMap) != count(array_flip($headerColumnToExcelMap))){
            throw new UtileExcelException("Header column config error!");
        }
        $this->headerColumnToExcelMap = $headerColumnToExcelMap;
    }

    /**
     * @param $headerData  ["A" => "名称"]
     * @return array ["A" => "name"]
     */
    public function initExcelCellMapIndex($headerData){
        $columnMapExcelCellIndex = [];
        /**
         * eg: ["名称" => "name"]
         */
        $headerColumnToExcelMapFlip = array_flip($this->headerColumnToExcelMap);
        /**
         * @var $headerData eg: ["A" => "名称"]
         * @var $index eg: A
         * @var $name eg: 名称
         */
        foreach ($headerData as $index => $value){
            if(isset($headerColumnToExcelMapFlip[$value])){
                $name = $headerColumnToExcelMapFlip[$value];
                $columnMapExcelCellIndex[$index] = $name;
            }
        }
        $this->columnMapExcelCellIndex = $columnMapExcelCellIndex;
    }

    /**
     * row to map
     * @param $rowData eg:["A" => "名称"]
     */
    public function rowToMapIndex(&$rowData){
        /**
         * @var $columnMapExcelCellIndex ["A" => "name"]
         */
        foreach ($this->columnMapExcelCellIndex as $index => $name){
            if(isset($rowData[$index])){
                $rowData[$name] = $rowData[$index];
                unset($rowData[$index]);
            }
        }
    }
}