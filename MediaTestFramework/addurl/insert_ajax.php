<?php

if(count($_GET)>0){
	include("db_settings.php");
	
	$table = $_GET['table'];

	$type = $_GET['type'];
	$url = $_GET['url'];
	$desc = $_GET['desc'];
	
	if (!$select) {
		die('Not connected : ' . mysql_error());
	}
	
	$sql = "INSERT INTO ".$table."(media_type,media_url,description) VALUES(".$type.",'".$url."','".$desc."')";
	$result = mysql_query($sql);

	mysql_close($link); 
}else{

}

?>