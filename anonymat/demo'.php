<?php
//documentation on the spreadsheet package is at:
//http://pear.php.net/manual/en/package.fileformats.spreadsheet-excel-writer.php
chdir('phpxls');
require_once 'Writer.php';
chdir('..');
require('connexion.php');

require('historique.php');

if (isset($_GET['m']) && !empty($_GET['m'])) {
    $m = $_GET['m'];
}
else {
    header('Location:choix.php');
    exit();
}





$query = "select NumMatiere, notes.NumApogee,CodeAnonyme,etudiants.nom,etudiants.prenom from notes,etudiants where etudiants.NumApogee=notes.NumApogee";
$result = mysqli_query($db,$query);

$sheet1 = array(
    array('NumMatiere','NumApogee','CodeAnonyme','nom','prenom')
);

while($row = mysqli_fetch_array($result)) {
    $sheet1[] = array($row['NumMatiere'], $row['NumApogee'], $row['CodeAnonyme'], $row['nom'],$row['prenom']);
}









$workbook = new Spreadsheet_Excel_Writer();

$format_und =& $workbook->addFormat();
$format_und->setBottom(2);//thick
$format_und->setBold();
$format_und->setColor('black');
$format_und->setFontFamily('Arial');
$format_und->setSize(8);

$format_reg =& $workbook->addFormat();
$format_reg->setColor('black');
$format_reg->setFontFamily('Arial');
$format_reg->setSize(8);

$arr = array(
      'Infos_etudiants'=>$sheet1,
      );

foreach($arr as $wbname=>$rows)
{
    $rowcount = count($rows);
    $colcount = count($rows[0]);

    $worksheet =& $workbook->addWorksheet($wbname);

    $worksheet->setColumn(0,0, 6.14);//setColumn(startcol,endcol,float)
    $worksheet->setColumn(1,3,15.00);
    $worksheet->setColumn(4,4, 8.00);
    
    for( $j=0; $j<$rowcount; $j++ )
    {
        for($i=0; $i<$colcount;$i++)
        {
            $fmt  =& $format_reg;
            if ($j==0)
                $fmt =& $format_und;

            if (isset($rows[$j][$i]))
            {
                $data=$rows[$j][$i];
                $worksheet->write($j, $i, $data, $fmt);
            }
        }
    }
}

$workbook->send('Infos_etudiants.xls');
$workbook->close();



$reqetat = "SELECT etat FROM matieres Where NumMatiere = '$m'";
$resultatetat = mysqli_query($db,$reqetat);
$rowetat = mysqli_fetch_array($resultatetat,MYSQLI_ASSOC);
$etat = $rowetat['etat'];
if($etat==1)
{
    $reqetatupdate = "UPDATE matieres SET etat = 2 where NumMatiere = '$m'";
    $resultatetatupdate = mysqli_query($db,$reqetatupdate);
}

$tache = "telechargement de La liste des etudiants avec le Code Anonyme";
$date = date("Y-m-d H:i:s");


historique($m,$date,$tache);

//-----------------------------------------------------------------------------
?>

