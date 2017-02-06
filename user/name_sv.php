<?php
	if(!isset($_SESSION)){session_start();}
	
	$query = mysqli_query($sqlHp, "SELECT * FROM ".SQL_HP_DB.".settings WHERE id=1");
	$output = mysqli_fetch_assoc($query);
	echo $output['value']; 
 ?>