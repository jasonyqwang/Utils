<?php
/**
 * User: Jason Wang
 * Excel header map
 */

namespace Jsyqw\Utils\ExcelExport;


use Jsyqw\Utils\Exceptions\UtileExcelException;

class ExcelExportHeader
{
    /**
     * The default header index
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
     * 指定的 Key value 的映射关系
     * @var array  eg: ["name" => ExcelExportCell]
     */
    protected $columnMapExcelCells = [];

    public function __construct($headerColumnToExcelMap = [])
    {
        $this->setHeaderColumnToExcelMap($headerColumnToExcelMap);
    }

    /**
     * @param $headerColumnToExcelMap eg:["name" => "名称"]
     */
    private function setHeaderColumnToExcelMap($headerColumnToExcelMap){
        foreach ($headerColumnToExcelMap as $name => $value){
            $excelExportCell = new ExcelExportCell();
            $excelExportCell->name = $name;
            $excelExportCell->value = $value;
            $this->columnMapExcelCells[$name] = $excelExportCell;
        }
        $this->headerColumnToExcelMap = $headerColumnToExcelMap;
    }

    /**
     * @param $name
     * @return mixed
     * @throws UtileExcelException
     */
    public function getColumnMapExcelCells(){
        return $this->columnMapExcelCells;
    }

    /**
     * Get header column cell
     * @param $name
     * @return ExcelExportCell
     * @throws UtileExcelException
     */
    public function getHeaderColumnCell($name){
        if(isset($this->columnMapExcelCells[$name])){
            return $this->columnMapExcelCells[$name];
        }
        throw new UtileExcelException("Not init header fo {$name} cell");
    }

    /**
     * @param $name
     * @return ExcelExportCell
     * @throws UtileExcelException
     */
    public function setHeaderColumnCellWidth($name, $width){
        $cell = $this->getHeaderColumnCell($name);
        $cell->width = $width;
    }
}