<?php	
		$param=3;        // parametre de choix du mode de cryptage (1,2,3 ou 4 car on a 4 fonctions de cryptage )..(le choix se fait par l'administrateur) 
		$NumMatiere='GHDue7';	//le numero de matiere avec lequel on va crypter ( le choix se fait par l'administrateur) 
		include("connexion.php");
	
		if($param==1)
				include ("F1.php");
		if($param==2)
				include ("F2.php");
		if($param==3)
				include ("F3.php");
		if($param==4)
				include ("F4.php");
				
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


			               /*********Remplissage de la table " correspondances "************/

	
   // cette tache doit s'exécuter une seule fois (sauf le cas ou on ajoute une Matiere ) et elle ne fait pas partie du cryptage 
  //la table "correspondance" contient deux colonnes : [ NumMatiere varchar(20) ] c'est le numéro du matiere et [ NumMatiereC int(2) ] c'est le numero du matiere correspondant 

	$l=9; // on affecte le numero 9 pour la premiere matiere ( $l s'incrémente à chaque fois et ne doit pas depasser 99 ) 
 
	$listeMatieres = "SELECT * FROM Matieres";
	if($dataListeMatieres = mysql_query($listeMatieres)) 
		{
			while($Matiere = mysql_fetch_row($dataListeMatieres)) 
			{
				$Nm=$Matiere[0]; //  le numéro du matière
				if($l==100) $l=0;  // $l ne doit pas depasser 99
				$sql_ins ='INSERT INTO correspondances VALUES ("'.$Nm.'",'.$l.')';
				mysql_query ($sql_ins) or die ('<br />Erreur SQL !'.$sql.'<br />'.mysql_error());
				$l++;
			}
		}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
				      
				     /*********Récuperation du numéro du matiere correspondant ***********/
	
	
	
	
	
	$NumMatCorresp=0; // initialisation d'une variable qui va prendre le numero du Matiere CORRESPONDANT au numero de matiere ci dessus 
 
	// on cherche le numero qui lui correspond dans la table "correspondances" et on lui stocke dans la variable $NumMatCorresp  
 	
	/*$requet2 = '(SELECT  NumMatiereC into'.$NumMatCorresp.' FROM correspondances where NumMatiere="'.$NumMatiere.'")';  // probleme ici $$NumMatCorresp ne prend pas de valeur ! 
	mysql_query ($requet2) or die ('<br />Erreur SQL !'.$sql.'<br />'.mysql_error());*/
	


	$listeMatieres = "SELECT * FROM correspondances";
	if($dataListeMatieres = mysql_query($listeMatieres)) 
		{
			while($Matiere = mysql_fetch_row($dataListeMatieres)) 
			{
				$NumMatiere=$Matiere[0];
				if($NumMatiere==$NumMatiere) $NumMatCorresp=$Matiere[1];
			}
		}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	

						  /*******************Procedure de cryptage****************************/

	

/*  on declare par la suite deux tableaux tab1 et tab2 tel que tab1[i] contient le numero apogé de l'etudiant 'x' (par exemple) lui correspond son code anpnyme dans tab2[i]
			 
								tab1[i] : numero apogé de l'etudiant 'x' 
								tab2[i] : code anonyme de l'etudiant 'x'	
*/


	$v=$NumMatCorresp;
	$tab1=array(''); 
	$k=0;
	$requet = "SELECT * FROM etudiant";
	if($result = mysql_query($requet)) 
		{
			
			
			while($ligne = mysql_fetch_row($result)) 
			{
				
				$ch='';
				$Ne = $ligne[0];
				$tab1[$k]=$Ne;
				if ($param == 1 || $param == 2) 
				{
					
					$ch=fonction($Ne,$tab);					
					$tab2[$k]=$ch;
				}
					
				
				if ($param == 3 || $param == 4) 
				{ 
			   
					if($v==100)// $v ne doit pas depasser 99 car la talle du tableau $tab est égale à 99.. 
					{
					$v==0; 
					}
					
					
					$ch=fonction($Ne,$v,$tab);
					$tab2[$k]=$ch;
					$v++;
					
				}
				
				
				$k++;

				}
		}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////		
		
			                     /*******************stockage dans la base de données****************************/
		

		$j=0;
		while($j <= count($tab1)) 
		{
		echo "ici";
		$sql_ins1 ='INSERT into crypt VALUES ('.$tab1[$j].',"'.$tab2[$j].'")';
		mysql_query ($sql_ins1) or die ('<br />Erreur SQL !'.$sql.'<br />'.mysql_error());
		$j++;
           	}

   ?>
