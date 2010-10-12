<?php session_start();
	include 'db.php';
	$db = new Database();

	$base = 'www.eudisduran.com/s/r/';
	
	$long_url = $_GET['long_url'];

	if (substr($long_url, 0, 7) == 'http://'){
		$long_url = str_replace('http://', '', $long_url);
	}
	if($long_url == ''){
		echo "Empty!";
	}

	else {
		/* The url table should have three members: id PRIMARY KEY, s_url (short url), and
		   l_url (long url). */

		$query = "SELECT MAX(id) AS id FROM url";
		$r = mysql_query($query, $db->r);	
		if(!$r){
			die("The query FAILED!");
		}
		if(mysql_num_rows($r) == 0){
			die("No rows to extract in DB!");
		}

		// Get last id in db
		$row = mysql_fetch_assoc($r);
		
		$last_id = $row['id'];

		$next_id = $last_id + 1;

		$short_url = $base . '?id=' . $next_id;
	
		$sql = "INSERT INTO url (s_url, l_url) VALUES('" . $short_url . "', '" . $long_url . "')";

		mysql_query($sql, $db->r); // Write the URL into the database!

		$_SESSION['display'] = 'url_display';
		$_SESSION['short_url'] = $short_url;

		$db->close_db();

		header("Location: index.php");
	
		

		
	}
?>
