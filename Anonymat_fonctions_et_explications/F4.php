


	<?php	
		
	

	
	        $tab=array('1','2','3','4','5','6','7','8','9','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z',
		'a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z');

				
	
			//declaration de la 4ème fonction de cryptage 
		function fonction($Ne,$Nm,$tab)// cryptage Numerique (avec num Matière)
			{
				include('connexion.php');
			$listeMatieres = "SELECT * FROM matieres WHERE NumMatiere = '$Nm'";
			if($dataListeMatieres = mysqli_query($db,$listeMatieres)) 
			{
				$Matiere = mysqli_fetch_array($dataListeMatieres,MYSQLI_ASSOC);
			
				$NumMatiereCorresp=$Matiere['NumMatCorrespondant'];
			}
		
			$ch='';
			     do
				{
					$a=$Ne%100;			
					$Ne=($Ne-$a)/100;
					$ch=$ch.$tab[$a];
				}
				while($Ne!=0);
				$ch=$ch.$tab[$NumMatiereCorresp];
			return($ch);
			}
    	?>
			


