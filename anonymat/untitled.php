<?php

//processing form submitted
 
//if (!isset($_POST['btnSubmit'])) exit;
 
//include PHPExcel library
require("connexion.php");
require_once "PHPExcel/Classes/PHPExcel/IOFactory.php";
require_once('PHPExcel/Classes/PHPExcel.php');
 
//load Excel template file
/*
$objTpl = PHPExcel_IOFactory::load("Untitled 1.xls");
$objTpl->setActiveSheetIndex(0);  //set first sheet as active
$sheet = $objPHPExcel->getSheet(0);
$highestRow = $objTpl->getHighestRow();
$highestColumn = $objTpl->getHighestColumn();
*/

//
$objReader = PHPExcel_IOFactory::createReader('Excel5');
    $objPHPExcel = $objReader->load("upload/Fichier_Administration.xls");
$sheet = $objPHPExcel->getSheet(0);
$highestRow = $sheet->getHighestRow();
$highestColumn = $sheet->getHighestColumn();
//
//
$query = "select Nom,note_cc,note_cf from etudiants,notes where etudiants.NumApogee=notes.NumApogee order by Nom";
$result = mysqli_query($connection,$query);

//while($row = mysqli_fetch_array($result)) {
   for ($rowx=18;$rowx<=$highestRow;++$rowx) {
   	$row = mysqli_fetch_array($result);
   	$objPHPExcel->getActiveSheet()->setCellValue('E'.$rowx,$row['note_cc'] );
   	//$objPHPExcel->getActiveSheet()->getStyle('E'.$rowx)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //C1 is right-justified
   	$objPHPExcel->getActiveSheet()->setCellValue('G'.$rowx,$row['note_cf'] );
   //	$objPHPExcel->getActiveSheet()->getStyle('G'.$rowx)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //C1 is right-justified


   }


/*

while($row = mysqli_fetch_array($result)) {
   //echo  $row['note_cc'];
   //echo  $row['note_cf'];
   for ($rowx=18;$rowx<=$highestRow;++$rowx) {
   	$objPHPExcel->getActiveSheet()->setCellValue('E'.$i, 'Salut');
   	$objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //C1 is right-justified
   	$i++;


   }
}

*/
/*
$i=18;
$objPHPExcel->getActiveSheet()->setCellValue('C2', date('Y-m-d'));  //set C1 to current date
$objPHPExcel->getActiveSheet()->getStyle('C2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //C1 is right-justified
$objPHPExcel->getActiveSheet()->setCellValue('C'.$i, 'Salut');
$objPHPExcel->getActiveSheet()->setCellValue('C4', 'cava');
 
$objPHPExcel->getActiveSheet()->getStyle('C4')->getAlignment()->setWrapText(true);  //set wrapped for some long text message

*/




//
 


 /*
$objTpl->getActiveSheet()->setCellValue('C2', date('Y-m-d'));  //set C1 to current date
$objTpl->getActiveSheet()->getStyle('C2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //C1 is right-justified
$objTpl->getActiveSheet()->setCellValue('C3', 'Salut');
$objTpl->getActiveSheet()->setCellValue('C4', 'cava');
 
$objTpl->getActiveSheet()->getStyle('C4')->getAlignment()->setWrapText(true);  //set wrapped for some long text message
 */
//$objTpl->getActiveSheet()->getColumnDimension('C')->setWidth(40);  //set column C width
//$objTpl->getActiveSheet()->getRowDimension('4')->setRowHeight(120);  //set row 4 height
//$objTpl->getActiveSheet()->getStyle('A4:C4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP); //A4 until C4 is vertically top-aligned
 // import matnum
$sheet = $objPHPExcel->getSheet(0);
$highestRow = $sheet->getHighestRow();
$highestColumn = $sheet->getHighestColumn();
//
$nummat = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(1, 3) ;
$nm= chop($nummat,".txt");

//prepare download
$filename='Notes_'.$nm.'.xls'; //just some random filename
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="'.$filename.'"');
header('Cache-Control: max-age=0');
 
$objPHPExcel = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');  //downloadable file is in Excel 2003 format (.xls)
$objPHPExcel->save('php://output');  //send it to user, of course you can save it to disk also!
 
exit; //done.. exiting!

?>