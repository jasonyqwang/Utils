<?php
/**
 * User: Jason Wang
 * Excel Data
 */

namespace Jsyqw\Utils\ExcelExport;


use Jsyqw\Utils\Exceptions\UtileExcelException;
use Jsyqw\Utils\FileHelper;

class ExcelExportData
{
    /**
     * @var $excelExportHeader ExcelExportHeader
     */
    protected $excelExportHeader;

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
     */
    public function create($list, $excelName = null){
        if(!$this->excelExportHeader){
            throw new UtileExcelException("Please config Excel export header first!");
        }
        $objPHPExcel = $this->objPHPExcel;
        //获取表头
        $columnMapExcelCells = $this->excelExportHeader->getColumnMapExcelCells();

        //ExcelExportCell
        // 数据起始行
        $rowNum = 2;
        // 向每行单元格插入数据
        foreach ($list as $item) {
            // 设置所有垂直居中
            $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNum . ':' . $this->maxColumn . $rowNum)->getAlignment()
                ->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);
            // 居中
            $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNum . ':' . $this->maxColumn . $rowNum)->getAlignment()
                ->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

            // 设置单元格值
            $col = 'A';
            $index = 1;
            foreach ($columnMapExcelCells as $k => $v) {
                $cellValue = isset($item[$k]) ? $item[$k] : '';
                // 单元格赋值
                $objPHPExcel->getActiveSheet()->setCellValue($col . $rowNum, $cellValue);
//                $col = chr(ord($col) + 1);

                $col = $this->cellColumn($index);
                $index ++;
            }
            $rowNum++;
        }
    }
}