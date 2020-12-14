<?php
/**
 * User: Jason Wang
 * Excel Data
 */

namespace Jsyqw\Utils\Excels;


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
     * Is return excel index num
     * @var bool
     */
    public $isReturnExcelIndex = true;
    /**
     * @var string
     */
    public $excelRowIndexCulumn = 'row_index';

    /**
     * Should formulas be calculated
     * 是否应计算公式
     * @var $calculateFormulas boolean  default true
     */
    public $calculateFormulas = true;

    /**
     * Should formatting be applied to cell values
     * 是否应将格式应用于单元格值
     * @var $formatData boolean  default true
     */
    public $formatData = true;

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
//        $this->highestRow = $sheet->getHighestRow();
//        $this->highestColumm = $sheet->getHighestColumn();
        $this->highestRow = $sheet->getHighestDataRow();
        $this->highestColumm = $sheet->getHighestDataColumn();

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
     * Get data
     * @param int $startRow
     * @return array
     */
    public function getData($startRow = 2, $maxRow = null){
        if(!$maxRow){
            $maxRow = $this->maxRow;
        }
        $data = [];
        for ($rowIndex = $startRow; $rowIndex <= $maxRow; $rowIndex++){
            $data[] = $this->getRowData($rowIndex);
        }
        return $data;
    }


    /**
     * 获取行数据
     * @param $row  start 0
     * @return array
     * @throws \PHPExcel_Exception
     */
    public function getRowData($row, $isTrim = true){
        $data = [];
        for ($column = 0; $column <= $this->maxCol; $column++) {
            $cell = $this->sheet->getCellByColumnAndRow($column, $row);
            $columnLetter = \PHPExcel_Cell::stringFromColumnIndex($column);
            $value = null;
            if ($cell->getValue() !== null) {
                if ($cell->getValue() instanceof \PHPExcel_RichText) {
                    $value = $cell->getValue()->getPlainText();
                } else {
                    if ($this->calculateFormulas) {
                        $value = $cell->getCalculatedValue();
                    } else {
                        $value = $cell->getValue();
                    }
                }
                if ($this->formatData) {
                    //this is important for show date
                    $style = $this->PHPReader->getCellXfByIndex($cell->getXfIndex());
                    $value = \PHPExcel_Style_NumberFormat::toFormattedString(
                        $value,
                        ($style && $style->getNumberFormat()) ? $style->getNumberFormat()->getFormatCode() : \PHPExcel_Style_NumberFormat::FORMAT_GENERAL
                    );
                }
            }
            $data[$columnLetter] = $value;
        }
        if($this->isReturnExcelIndex){
            $data[$this->excelRowIndexCulumn] = $row;
        }
        //is return excel header
        if($this->excelHeader){
            $this->excelHeader->rowToMapIndex($data);
        }
        return $data;
    }
}