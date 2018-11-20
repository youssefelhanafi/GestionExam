<?php
	
	//connexion au DTABASE
	$mysql_id = mysql_connect('localhost', 'root', 'pirate');
	if($mysql_id)
	{
	mysql_select_db('studentdatabase', $mysql_id);
	echo " <br />"	;	
	echo "<h4>connected to database<h4>";
	}
	else
	echo "connection failure";

?>
