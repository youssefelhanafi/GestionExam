<?php

function historique($NumMat,$date,$tache)
{

$req1 = "SELECT * FROM matieres WHERE NumMatiere = '$NumMat'";
$resultat1 = mysqli_query($db,$req1);
$row1 = mysqli_fetch_array($resultat1,MYSQLI_ASSOC);
$matiere = $row1['DesignationMatiere'];
$numModule = $row1['NumModule'];



$req2 = "SELECT * FROM modules WHERE NumModule = '$numModule'";
$resultat2 = mysqli_query($db,$req2);
$row2 = mysqli_fetch_array($resultat2,MYSQLI_ASSOC);

$module = $row2['DesignationModule'];
$numFiliere = $row2['numFilliere'];
$semestre = $row2['Semestre'];

$req3 = "SELECT * FROM fillieres WHERE NumFilliere = '$numFiliere'";
$resultat3 = mysqli_query($db,$req3);
$row3 = mysqli_fetch_array($resultat3,MYSQLI_ASSOC);
$filiere = $row3['DesignationFilliere'];


$req = "INSERT INTO historiques(`tache`, `date_de_la_tache`, `designation_matiere`, `designation_module`, `designation_filiere`, `semestre`) VALUES ('$tache','$date','$matiere','$module','$filiere','$semestre')" ;

$result = mysqli_query($db,$req);

}

?>