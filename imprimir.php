<?php

	session_start();
	include("db.php");
	
	if(isset($_SESSION['dentro_gestor']))
	{

	$sql = "SELECT * FROM ".$prefijo."document WHERE id = " . $_GET['reg'];
	$result = $mysqli->query($sql) or js_alert($mysqli->error);
	$linia=$result->fetch_array();
	
	foreach($linia as $n => $v) $$n = $mysqli->real_escape_string($v);
	
	$texto = "SERVERI MUNICIPAL DE L'HABITATGE
i Actuacions Urbanes, S.A.

";
	$texto .="Num: $num/$any $en_sa
";
	$texto .="Data: $data Hora: $hora";
	
	file_put_contents("generados/".$num."-".$any.".txt", $texto, LOCK_EX);
	}

	//header("Location: generados/$num-$any.txt");
	header("Content-disposition: attachment; filename=$num-$any.txt");
header("Content-type: application/octet-stream");
readfile("generados/$num-$any.txt");
	?>
