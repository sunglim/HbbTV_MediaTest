<?php

if(count($_GET)>0){
	include("db_settings.php");
	
	$table = $_GET['table'];
	$index = $_GET['idx'];

	if (!$select) {
		die('Not connected : ' . mysql_error());
	}

	$sql = "DELETE FROM ".$table." WHERE id=".$index.";";
	
	$result = mysql_query($sql);
	
	mysql_close($link); 
}

?>