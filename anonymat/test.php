<?php

include('user.php');
require('tracer.php');
echo '<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	</head>';

	$tableSemestre = array("S1","S2","S3","S4","S5");

$requeteFiliere = "SELECT * FROM fillieres";
Tracer($requeteFiliere) ;
$resultFiliere = mysqli_query($db,$requeteFiliere);
$rowFiliere = mysqli_fetch_array($resultFiliere,MYSQLI_ASSOC);


if(count($rowFiliere)==0)
   echo "Aucune Filiére n'existe dans la base de données";

else
{?>
	 <body>
  <h1 align='center'>Tableau de bord</h1>
  <table cellspacing='15px' border='0px' align ='center' >
  <form action='choix.php' method='POST'>
  <tr>
  <td> Filière : </td>
  <td><select name='Filiere'>
  <option></option>

<?php }

while(count($rowFiliere)!=0)
{

  echo "<OPTION>".$rowFiliere['DesignationFilliere']."</OPTION>";

  $rowFiliere = mysqli_fetch_array($resultFiliere,MYSQLI_ASSOC);

}
?>
</td>
</tr>
<tr>
<td> Semestre : </td>
<td><select name='Semestre'>
<option></option>

<?php

for ($i=0;$i<count($tableSemestre);$i++)
{
  echo "<OPTION>".$tableSemestre[$i]."</OPTION>";
}
?>

</td>
</tr>
<tr>
<td></td>
<td><input type='submit' name='Validerbtn' value='Valider' /></td>
</tr>

<?php

if (isset($_POST['Validerbtn']))
{

  $Filiere = mysqli_real_escape_string($db,$_POST['Filiere']);
  $Semestre = mysqli_real_escape_string($db,$_POST['Semestre']);

  if(empty($Filiere)||empty($Semestre))
  {

    echo "vous devez choisir une filiere et un semestre ! " ;

  }

else 
  {

    $requetenumfiliere = "SELECT * FROM fillieres WHERE DesignationFilliere = '$Filiere' ";
    $resultNumFiliere = mysqli_query($db,$requetenumfiliere);
    $rowNumFiliere = mysqli_fetch_array($resultNumFiliere,MYSQLI_ASSOC);

    $numfiliere = $rowNumFiliere['NumFilliere'];

    $requeteMatiere = "SELECT * FROM modules INNER JOIN matieres ON modules.NumModule = matieres.NumModule WHERE numFilliere='$numfiliere' and Semestre = '$Semestre'";
    $resultMatiere = mysqli_query($db,$requeteMatiere);
    $rowMatiere = mysqli_fetch_array($resultMatiere,MYSQLI_ASSOC);

    if(count($rowMatiere)==0)
      echo "aucun matiere n'est dans la base de données !";

  else
    {
    	?>
      <table cellspacing='15px' border='1px' align ='center' width = '100%'>
      <thead>
      <tr>
      <th> Semestre : <?php $Semestre ?> </th>
      <th> Filière : <?php $Filiere ?> </th>
      </tr>
      </thead>


      <table cellspacing='0px' border='1px' align ='center' width = '100%'>
      <thead>
      <tr>
      <th> Module </th>
      <th> Matière </th>
      <th> Etat </th>
      <th> La liste des étudiants </th>
      <th> La liste des étudiants avec le Code Anonyme </th>
      <th> La liste indiquée au prof  </th>
      <th> Le fichier des notes </th>
      <th> Le fichier final </th>
      </tr>
      </thead>
      <tbody>
      <tr>

      <?php
      while (count($rowMatiere)!=0)
      { ?>

        <tr>
        <td> <?php $rowMatiere['DesignationModule'] ?> </td>
        <td> <?php$rowMatiere['DesignationMatiere'] ?> </td>
        <td> <?php$rowMatiere['etat'] ?> </td>
     <?php

     if ($rowMatiere['etat']==0)
        { ?>

          <td>
            <div class="center">

            <form method="post" enctype="multipart/form-data" action="uploadf1.php">
    
            <input type="file" name="fichier" size="30">
            <input type="submit" name="upload" value="Uploader">
        
    </form>

    </br>
        <button type="button" onclick="window.open('demo.php')">Fichier Administration</button>
        
       <!-- <input type="hidden" name="nummat" value="<?PHP echo $rowMatiere['NumMatiere'];?>"> -->
        
        <button type="button" onclick="window.open('demo2.php')">Fichier Profs</button>

    
    <form method="post" enctype="multipart/form-data" action="uploadf2.php">
        <p>
            <input type="file" name="fichier" size="30">
            <input type="submit" name="upload" value="Uploader">
        </p>
    </form>

        <button type="button" onclick="window.open('untitled.php')">Fichier des Notes</button>
                    
                
            </div>
          </td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          

        
       <?php }


        if ($rowMatiere['etat']==1)
        {?>

               <td>
          <form method="post" enctype="multipart/form-data" action="uploadf1.php">
    
            <input type="file" name="fichier" size="30">
            <input type="submit" name="upload" value="Uploader">
        
           </form>
          </td>
          <td>
            <button type="button" onclick="window.open('demo.php')">Fichier Administration</button>
          </td>
          <td></td>
          <td></td>
          <td></td>

          

       <?php }


        if ($rowMatiere['etat']==2)
        {?>
               <td>
          <form method="post" enctype="multipart/form-data" action="uploadf1.php">
    
            <input type="file" name="fichier" size="30">
            <input type="submit" name="upload" value="Uploader">
        
           </form>
          </td>
          <td>
            <button type="button" onclick="window.open('demo.php')">Fichier Administration</button>
          </td>
          <td>
            <button type="button" onclick="window.open('demo2.php')">Fichier Profs</button>
          </td>
          <td></td>
          <td></td>


       <?php }

        if($rowMatiere['etat']==3)
        {?>
          <td>
          <form method="post" enctype="multipart/form-data" action="uploadf1.php">
    
            <input type="file" name="fichier" size="30">
            <input type="submit" name="upload" value="Uploader">
        
           </form>
          </td>
          <td>
            <button type="button" onclick="window.open('demo.php')">Fichier Administration</button>
          </td>
          <td>
            <button type="button" onclick="window.open('demo2.php')">Fichier Profs</button>
          </td>
          <td>
             <form method="post" enctype="multipart/form-data" action="uploadf2.php">
        <p>
            <input type="file" name="fichier" size="30">
            <input type="submit" name="upload" value="Uploader">
        </p>
    </form>
          </td>
          <td></td>
    
        <?php }

        if($rowMatiere['etat']>=4)
        {?>
           <td>
          <form method="post" enctype="multipart/form-data" action="uploadf1.php">
    
            <input type="file" name="fichier" size="30">
            <input type="submit" name="upload" value="Uploader">
        
           </form>
          </td>
          <td>
            <button type="button" onclick="window.open('demo.php')">Fichier Administration</button>
          </td>
          <td>
            <button type="button" onclick="window.open('demo2.php')">Fichier Profs</button>
          </td>
          <td>
             <form method="post" enctype="multipart/form-data" action="uploadf2.php">
        <p>
            <input type="file" name="fichier" size="30">
            <input type="submit" name="upload" value="Uploader">
        </p>
    </form>
          </td>
          <td><button type="button" onclick="window.open('untitled.php')">Fichier des Notes</button></td>
       
          
        <?php }

        $rowMatiere = mysqli_fetch_array($resultMatiere,MYSQLI_ASSOC);

      }

      echo "</tr>";
      echo "</tbody>";
      
    }


  }


}


echo "</body>";


?>