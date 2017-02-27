<?php
namespace Core\excel;
class Excel{
	public function __construct(){
		require('PHPExcel.php');
	}
	//导出
	public function exportExcel($data,$filename,$type='.xls'){
		error_reporting(E_ALL);
        date_default_timezone_set('Europe/London');
        $objPHPExcel = new \PHPExcel();
        foreach ($data as $key => $value) {
        	$num=$key+1;
        	$xl="A";
        	foreach($value as $k=>$v){
        		if($key==0){
        			$objPHPExcel->setActiveSheetIndex(0)
                     			 ->setCellValue($xl.$num, $v);    		
        		}else{
        			$objPHPExcel->setActiveSheetIndex(0)
                     			 ->setCellValue($xl.$num, $v);  
        		}
        		$xl++;		
        	}
        }
        $objPHPExcel->getActiveSheet()->setTitle($filename);
        $objPHPExcel->setActiveSheetIndex(0);
         header('Content-Type: application/vnd.ms-excel');
         header("Content-Disposition:attachment;filename=" . $filename . "$type");
         header('Cache-Control: max-age=0');
         $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
         $objWriter->save('php://output');
         exit;
	}
	//导入
	public function importExcel($filePath='',$sheet=0){
		//require('PHPExcel.php');
		if(empty($filePath) or !file_exists($filePath)){die('file not exists');}
        $PHPReader = new \PHPExcel_Reader_Excel2007();        //建立reader对象
        if(!$PHPReader->canRead($filePath)){
                $PHPReader = new \PHPExcel_Reader_Excel5();
                if(!$PHPReader->canRead($filePath)){
                        echo 'no Excel';
                        return ;
                }
        }
        $PHPExcel = $PHPReader->load($filePath);        
        $currentSheet = $PHPExcel->getSheet($sheet);        
        $allColumn = $currentSheet->getHighestColumn();      
        $allRow = $currentSheet->getHighestRow();        
        $data = array();
        for($rowIndex=1;$rowIndex<=$allRow;$rowIndex++){      
                for($colIndex='A';$colIndex<=$allColumn;$colIndex++){
                        $addr = $colIndex.$rowIndex;
                        $cell = $currentSheet->getCell($addr)->getValue();
                        if($cell instanceof PHPExcel_RichText){ 
                                $cell = $cell->__toString();
                        }
                        $data[$rowIndex][$colIndex] = $cell;
                }
        }
        return $data;
	}
}