<html>
<head>
<script>
var xmlhttp;

var getAjaxRequest = function(){
	if(xmlhttp != '' || xmlhttp != null){
		if (window.XMLHttpRequest)	{// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
		}
		else{// code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		};
	};
};

function deleteUrl(idx){
	if(confirm('Delete index ' + idx +' ?')){
		getAjaxRequest();
		var params = "?idx="+ idx+"&table="+"<?= $_GET['table'] ?>";

		xmlhttp.open("GET","delete_ajax.php"+params,true);

		xmlhttp.send();

		alert("아마도..삭제되었습니다 ");

		setTimeout(window.location.reload(),1000);
	};
};

function insertMedia()
{
	getAjaxRequest();
	
  /*
	  $type = $_POST['type'];
	$url = $_POST['url'];
	$desc = $_POST['desc'];
   */
	var type = document.getElementById('select_media_type').value;
	var url = document.getElementById('url').value;
	var desc = document.getElementById('desc').value;

	if(url == "" || desc == ""){
		alert("URL과 설명을 입력하세요");
	}

	//http://localhost/HbbTV-Testsuite/addurl/insert_ajax.php?type=
	var params = "?type="+ type +"&url="+url+"&desc="+desc+"&table="+"<?= $_GET['table'] ?>";

	xmlhttp.open("GET","insert_ajax.php"+params,true);

	xmlhttp.send();

	alert("입력되었습니다");
	setTimeout(window.location.reload(),1000);
}
</script>
</head>
<body>
<table>
<tr><td>
	==========================
	</td>
	<td>
	========================================================
	</td>
	<td>
	====================
	</td>
	</tr>
	<tr>
	<td>
	Type : 
	<select id="select_media_type" name="media_type">
		<option value="0">video/mp4</option>
		<option value="1">video/mpeg</option>
		<option value="2">application/dash+xml</option>
		<option value="3">application/vnd.apple.mpegurl</option>
	</select>
	</td>
	<td>
	URL : <input id="url" name="media_url" type="text" style="width:400px;"/>
	</td>
	<td>
	desc : <input id="desc"  type="text" style="width:400px;"/>
	</td>
	<td>
	<input type="button" value="추가!" onclick="insertMedia()" />
	</td>
	</tr>
	<tr><td>
	==========================
	</td>
	<td>
	========================================================
	</td>
	<td>
	====================
	</td>
	</tr>

</table>
<table>
<tr>
<td>index</td><td></td><td>media_type</td><td>URL</td><td>DESC</td>
</tr>
<? 

include("db_settings.php");

$table = "media_dash_ts";

if(count($_GET)>0){
	$table = $_GET['table'];
}	

if (!$select) {
	die('Not connected : ' . mysql_error());
}

$query = "select * from ".$table; 
$result = mysql_query($query); 
if (!$result) { 
	echo "error query"; 
	exit; 
} 

$rows  = mysql_num_rows($result); 

$i = 0; 
$media_type = "video/mp4";

while ($i<$rows) { 
	$row = mysql_fetch_row($result);
	if($row[1] == 0){
		$media_type = "video/mp4";
	}else if($row[1] == 1){
		$media_type = "video/mpeg";
	}else if($row[1] == 2){
		$media_type = "application/dash+xml";
	}else if($row[1] == 3){
		$media_type = "application/vnd.apple.mpegurl";
	}else{
		$media_type = "??";
	}
	echo "<tr><td>".$row[0]."</td><td><a href='javascript:deleteUrl(".$row[0].");'>[X]</a></td><td>".$media_type."</td><td>".$row[2]."</td><td>".$row[3]."</td></tr>";
	$i++;
} 
mysql_close($link); 

?> 
</table>

</body>
</html>
