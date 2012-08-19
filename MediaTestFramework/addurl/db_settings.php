<?php
	$link = mysql_connect("server", "id", "passwd")  
          or die("Could not connect");
 
	$select = mysql_select_db("dbname"); 
?>