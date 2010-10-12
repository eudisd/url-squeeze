<?php
	include "../db.php";
	$t = $_GET['id'];
	$sql = "SELECT l_url FROM url WHERE id = '{$t}'";

	$db = new Database();

	$r = mysql_query($sql, $db->r);
	if(!$r){
		die("Query FAILED!");
	}
	$row = mysql_fetch_array($r);

	
	header("Location: " . 'http://'.$row[0]);
?>
