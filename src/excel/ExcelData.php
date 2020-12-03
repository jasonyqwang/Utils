<?php
/**
 * User: Jason Wang
 * Excel Data
 */

namespace Jsyqw\Utils\excel;


use Jsyqw\Utils\Exceptions\UtileExcelException;
use Jsyqw\Utils\FileHelper;

class ExcelData
{
    /**
     * @var ExcelHeader
     */
    public $excelHeader;

    /**
     * @var  \PHPExcel
     */
    private $PHPReader = null;
    /**
     * @var \PHPExcel_Worksheet
     */
    private $sheet = null;

    /**
     * @var int
     */
    protected $highestRow;
    /**
     * @var A、B ...
     */
    protected $highestColumm;

    /**
     * @var int
     */
    protected $maxRow = 0;
    /**
     * @var int
     */
    protected $maxCol = 0;

    /**
     * @var file path
     */
    protected $filePath;

    /**
     * set excel file path
     * @param $filePath
     * @throws UtileExcelException
     */
    private function setFilePath($filePath){
        if(!file_exists($filePath)){
            throw new UtileExcelException("{$filePath} not exist!");
        }
        $ext = strtolower(FileHelper::getExt($filePath));
        if(!in_array($ext, ['xls', 'xlsx'])){
            throw new UtileExcelException("the file ext '{$ext}' error!");
        }
        $this->filePath = $filePath;
    }

    /**
     * set excel header
     * @param $excelHeader ExcelHeader
     */
    public function setExcelHeader($excelHeader){
        $headerData = $this->getRowData($excelHeader->headerIndex);
        if(!$headerData){
            throw new UtileExcelException("The Excel header data is empty, index is {$excelHeader->headerIndex}");
        }
        $excelHeader->initExcelCellMapIndex($headerData);
        $this->excelHeader = $excelHeader;
    }

    /**
     * 加载文件
     * @param $filePath
     * @throws UtileExcelException
     */
    public function loadFile($filePath){
        $this->setFilePath($filePath);

        $this->PHPReader = \PHPExcel_IOFactory::load($filePath);
        $sheet = $this->PHPReader->getActiveSheet();
        //init hight row and column
        $this->highestRow = $sheet->getHighestRow();
        $this->highestColumm = $sheet->getHighestColumn();

        //init max row and max column
        $pRange = 'A1:'.$this->highestColumm.$this->highestRow;
        list($rangeStart, $rangeEnd) = \PHPExcel_Cell::rangeBoundaries($pRange);
        $maxCol = $rangeEnd[0];
        $maxRow = $rangeEnd[1];
        $this->maxCol = $maxCol;
        $this->maxRow = $maxRow;
        //init sheet
        $this->sheet = $sheet;
    }

    /**
     * 获取行数据
     * @param $row  start 0
     * @return array
     * @throws \PHPExcel_Exception
     */
    public function getRowData($row, $isTrim = true){
        $data = [];
        for ($column = 0; $column <= $this->maxCol; $column++) {//列数是以A列开始
            $value = $this->sheet->getCellByColumnAndRow($column, $row)->getValue();
            $columnLetter = \PHPExcel_Cell::stringFromColumnIndex($column);
            $data[$columnLetter] = $value;
        }
        //is return excel header
        if($this->excelHeader){
            $this->excelHeader->rowToMapIndex($data);
        }
        return $data;
    }
}