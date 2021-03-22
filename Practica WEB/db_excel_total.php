<?php
require "PHPExcel/Classes/PHPExcel.php";
require "PHPExcel/Classes/PHPExcel/Writer/Excel5.php"; 





$serverName = ""; 


$username ="";
$password ="";
$database ="";



$conn = mssql_connect($serverName, $username, $password);


$stmt = mssql_init('[dbo].[pkg_Registro.Excel_total]');

$result=mssql_execute($stmt);


$name_silo= $_REQUEST['silo_act'];



$objPHPExcel = new PHPExcel();
// Set document properties
$objPHPExcel->getProperties()->setCreator("Neptuno");
$objPHPExcel->getProperties()->setLastModifiedBy("Neptuno");
 $objPHPExcel->getProperties()->setTitle("Datos Tabla");
$objPHPExcel->getProperties() ->setSubject("Datos Tabla");
$objPHPExcel->getProperties()->setDescription("Datos exportados de la tabla");
   $objPHPExcel->getProperties() ->setKeywords("office 2007 openxml php");


// Add some data
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(41);
$objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(40);
$objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(33);
$objPHPExcel->getActiveSheet()->getStyle("A2")->getFont()->setSize(26);

$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('A3', 'Numero de registro');
$objPHPExcel->getActiveSheet()->setCellValue('B3', 'Valor');
 $objPHPExcel->getActiveSheet()->setCellValue('C3', 'Fecha y hora');
 $objPHPExcel->getActiveSheet()->setCellValue('A2', 'Datos del Silo ' . $name_silo);
$objPHPExcel->getActiveSheet()->mergeCells('A2:C2');
 $style = array(
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        )
    );
   $objPHPExcel->getActiveSheet()-> getStyle("A2:C2")->applyFromArray($style);

$rowCount = 4	;
// Miscellaneous glyphs, UTF-8
while($row = mssql_fetch_array($result)){
      $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $row['id_registro']);
      $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, $row['valor']);
      $objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, $row['fecha']);
      $rowCount++;
}

// Rename worksheet

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);




$gdImage = imagecreatefrompng('images/logo-neptuno-2.png');
// Add a drawing to the worksheetecho date('H:i:s') . " Add a drawing to the worksheet\n";
$objDrawing = new PHPExcel_Worksheet_MemoryDrawing();
$objDrawing->setName('Sample image');$objDrawing->setDescription('Sample image');
$objDrawing->setImageResource($gdImage);
$objDrawing->setRenderingFunction(PHPExcel_Worksheet_MemoryDrawing::RENDERING_PNG);
$objDrawing->setMimeType(PHPExcel_Worksheet_MemoryDrawing::MIMETYPE_DEFAULT);
$objDrawing->setWidthAndHeight(400,200);
$objDrawing->setResizeProportional(true);
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
$objDrawing->setCoordinates('A1');




// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel; charset=UTF-8');
header('Content-Disposition: attachment;filename="Datos_total.xls"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');












?>