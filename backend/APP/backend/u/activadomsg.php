<?php
	if ($_SERVER["REQUEST_METHOD"] == "POST"){
		$numIDs = $_POST['numIDs'];
		echo "<h4>ACTIVADO</h4>";
	}					
						
	$ua = $_SERVER['HTTP_USER_AGENT'];
	$id = sha1(rand(111111,999999));
	echo "<script> location.hash='user_token_id=$id&acc=administrator&&$ua';</script>";

	//CODE BY
	//https://github.com/realdaveblanch
	//https://github.com/X-aaron-X
?>