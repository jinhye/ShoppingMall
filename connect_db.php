 <?php

	//db information
	$lines = file("./secret/topsecret.txt");
	$host_name = trim($lines[0]);
	$db_user = trim($lines[1]);
	$db_pw = trim($lines[2]);
	$db_name = trim($lines[3]);
?>