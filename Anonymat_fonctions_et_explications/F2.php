


	<?php

	$tab=array('1','2','3','4','5','6','7','8','9','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z',
		'a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z');
	
		
                        
			function fonction($Ne,$tab)
			{
				         $ch='';
		        			
					 do 
				          {
		 			   $reste=$Ne%61;           // on écrit chaque numéro d'étudiant dans la base 61 car on a un tableau ($tab) de 61 case 
                                           $ch=$ch.$tab[$reste];    // les indices commencent de 0 à 60 donc on doit avoir un reste inferieur ou égal à 60
                                           $div=(int)($Ne/61);
					   $Ne=$div;
					  }
					while ($div!=0);
					return $ch;
                    
				

				
			 
			   }
          

    	?>
			
