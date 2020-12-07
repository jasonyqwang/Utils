<?php
/**
 * User: Jason Wang
 * Excel Data
 */

namespace Jsyqw\Utils\ExcelsExport;


use Jsyqw\Utils\Exceptions\UtileExcelException;
use Jsyqw\Utils\FileHelper;
use Jsyqw\Utils\StrHelper;

class ExcelExportData
{
    /**
     * @var $excelExportHeader ExcelExportHeader
     */
    protected $excelExportHeader;

    /**
     * @var The excel path
     */
    protected $filePath;

    /**
     * @var \PHPExcel
     */
    protected $objPHPExcel;

    public function __construct()
    {
        // 实例化excel类
        $objPHPExcel = new \PHPExcel();
        // 操作第一个工作表
        $objPHPExcel->setActiveSheetIndex();
        // 设置sheet名
        $objPHPExcel->getActiveSheet()->setTitle('Sheet1');

        $this->objPHPExcel = $objPHPExcel;
    }

    /**
     * 导出表头数据
     */
    private function exportHeader(){
        $excelExportHeader = $this->excelExportHeader;
        //获取表头
        $columnMapExcelCells = $this->excelExportHeader->getColumnMapExcelCells();
        $objPHPExcel = $this->objPHPExcel;
        //The data start col
        $colIndex = $this->excelExportHeader->headerColumnStartIndex;
        // The data start index
        $rowIndex = $this->excelExportHeader->headerRowStartIndex;
        $sheet = $objPHPExcel->getActiveSheet();
        /**
         * @var $excelExportCell ExcelExportCell
         */
        foreach ($columnMapExcelCells as $key => $excelExportCell) {
            $sheet->getColumnDimensionByColumn($colIndex)->setWidth($excelExportCell->width);
            $sheet->setCellValueByColumnAndRow($colIndex , $rowIndex, $excelExportCell->value);
            $colIndex++;
        }
        // 列名表头文字加粗
        $sheet->getStyleByColumnAndRow($this->excelExportHeader->headerColumnStartIndex, $this->excelExportHeader->headerRowStartIndex, $colIndex, $rowIndex)
            ->getFont()->setBold(true);
        // 列表头文字居中
        $sheet->getStyleByColumnAndRow($this->excelExportHeader->headerColumnStartIndex, $this->excelExportHeader->headerRowStartIndex, $colIndex, $rowIndex)
            ->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    }

    /**
     * Set file path
     * @param $path
     */
    public function setFilePath($path){
        if(!is_dir($path)){
            mkdir($path, 0777);
        }
        $this->filePath = $path;
    }

    /**
     * Get file path
     */
    public function getFilePath(){
        if(!$this->filePath){
            $this->filePath = sys_get_temp_dir();
        }
        return trim($this->filePath, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;
    }

    public function getObjPHPExcel(){
        return $this->objPHPExcel;
    }
    
    /**
     * set Excel export header
     * @param $excelExportHeader ExcelExportHeader
     */
    public function setExcelExportHeader($excelExportHeader){
        $this->excelExportHeader = $excelExportHeader;
    }

    /**
     * @param $list
     * @param null $excelName
     * @return mixed
     * @throws \PHPExcel_Exception
     * @throws \PHPExcel_Reader_Exception
     * @throws \PHPExcel_Writer_Exception
     * @return string
     */
    public function create($list, $excelName = null){
        if(!$this->excelExportHeader){
            throw new UtileExcelException("Please config Excel export header first!");
        }
        $objPHPExcel = $this->objPHPExcel;
        $sheet = $objPHPExcel->getActiveSheet();

        $this->exportHeader();

        //Get header cell
        $columnMapExcelCells = $this->excelExportHeader->getColumnMapExcelCells();
        //The data start col
        $colIndex = $this->excelExportHeader->headerColumnStartIndex;
        // The data start index
        $rowIndex = $this->excelExportHeader->headerRowStartIndex + 1;

        $colIndex1 = $colIndex + count($columnMapExcelCells);
        $rowIndex1 = $rowIndex + count($list);
        // 设置所有垂直居中
        $sheet->getStyleByColumnAndRow($colIndex, $rowIndex, $colIndex1, $rowIndex1)
            ->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);
        // 设置所有水平居中
        $sheet->getStyleByColumnAndRow($colIndex, $rowIndex, $colIndex1, $rowIndex1)
            ->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        /**
         * @var $excelExportCell ExcelExportCell
         */
        // 向每行单元格插入数据
        foreach ($list as $item) {
            foreach ($columnMapExcelCells as $key => $excelExportCell) {
                $cellValue = isset($item[$excelExportCell->name]) ? $item[$excelExportCell->name] : '';
                $sheet->setCellValueByColumnAndRow($colIndex , $rowIndex, $cellValue);
                $colIndex++;
            }
            $colIndex = $this->excelExportHeader->headerColumnStartIndex;
            $rowIndex++;
        }
        return $this->output($excelName);
    }

    /**
     * @param null $excelName
     * @return string
     * @throws \PHPExcel_Reader_Exception
     * @throws \PHPExcel_Writer_Exception
     */
    private function output($excelName = null){
        $file = $this->getFile($excelName);
        $objWriter = \PHPExcel_IOFactory::createWriter($this->objPHPExcel,'Excel2007');
        $objWriter->save($file);
        return $file;
    }

    /**
     * @param $excelName
     * @return string
     */
    public function getFile($excelName){
        if(!$excelName){
            $excelName = StrHelper::shortUniqueStr().'.xlsx';
        }
        $file = $this->getFilePath().$excelName;
        return $file;
    }
}