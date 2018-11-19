<?php
/**
 * Created by Youssef Elhanafi.
 * Date: 25/05/2016
 * Time: 10:45
 */
include ("connexion.php");
require_once('PHPExcel/Classes/PHPExcel.php');
include("upload2'.php");
include("historique'.php");

if (isset($_GET['m']) && !empty($_GET['m'])) {
    $m = $_GET['m'];
}
else {
   // header('Location:choix.php');
    exit();
}

$extension=pathinfo("uploads/".$name_file,PATHINFO_EXTENSION);
if ($extension="xls"){
    $objReader = PHPExcel_IOFactory::createReader('Excel5');
    $objPHPExcel = $objReader->load("uploads/".$name_file);
}
elseif($extension="xlsx"){
    $objReader = PHPExcel_IOFactory::createReader('Excel2007');
    $objPHPExcel = $objReader->load("uploads/".$name_file);

}
//  Get worksheet dimensions
$sheet = $objPHPExcel->getSheet(0);
$highestRow = $sheet->getHighestRow();
$highestColumn = $sheet->getHighestColumn();
//
//$nummat = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(1, 3) ;
//$nm= chop($nummat,".txt");
//echo $nm ,'</br>';
//
//$sql="select NumFilliere from modules,matieres where NumMatiere like '%$nm%' and matieres.NumModule=modules.NumModule";
//$req=mysqli_query($connection,$sql)or die (mysqli_error($connection));
//$row1 = mysqli_fetch_assoc($req);
//$numfil=implode(' ',$row1);
//echo $numfil,'</br>';

//
for ($row=1;$row<=$highestRow;++$row) {
    for ($x = 1; $x < 4; $x++) {
        $rows[$x] = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow($x,$row);
    }
    //$date=date('Y-m-d',strtotime($rows[3]));
   /* $sql="INSERT INTO etudiants(NumApogee,NumFilliere,Nom,Prenom,DateNaissance) VALUES ('".$rows[0]."',
                                                                                        '".$numfil."',
                                                                                        '".$rows[1]."',
                                                                                        '".$rows[2]."',
                                                                                        '".$date."'
                                                                                       )";

    $req=mysqli_query($connection,$sql)
    or die (mysqli_error($connection));
    $sql2="INSERT INTO notes(NumApogee,NumMatiere) VALUES ('".$rows[0]."','".$nm."')";
    $req2=mysqli_query($connection,$sql2)
    or die (mysqli_error($connection));*/


    $sql="update notes set note_cc='".$rows[2]."', note_cf='".$rows[3]."'where CodeAnonyme='".$rows[1]."'";
    $req=mysqli_query($db,$sql)
    or die (mysqli_error($db));


}
// remplissage du code anonyme
//include('crypt.php');

header('choix.php')


$reqetat = "SELECT etat FROM matieres Where NumMatiere = '$m'";
$resultatetat = mysqli_query($db,$reqetat);
$rowetat = mysqli_fetch_array($resultatetat,MYSQLI_ASSOC);
$etat = $rowetat['etat'];
if($etat==3)
{
    $reqetatupdate = "UPDATE matieres SET etat = 4 where NumMatiere = '$m'";
    $resultatetatupdate = mysqli_query($db,$reqetatupdate);
}

$tache = "Attachement de La liste des notes";
$date = date("Y-m-d H:i:s");
historique($m,$date,$tache);
?>



