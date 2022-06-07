<?php
	//CHECK DE LOGIN O REDIRIGIR AL LOGIN
    if(isset($_COOKIE['user_name'])){
		echo ''; 
	}
	else {
		echo "<META http-equiv=".'"REFRESH"'." CONTENT=".'"0;URL=../index.php"'.">";	
		exit;
	}

//Elimina los logos cuando es invocado
	if (is_file("../../assets/img/logo.png")) {
		unlink('../../assets/img/logo.png');
		clearstatcache();
		
	}
						
							
								$ua = $_SERVER['HTTP_USER_AGENT'];
								$id = sha1(rand(111111,999999));
								echo "<script> location.hash='user_token_id=$id&acc=administrator&&$ua';</script>";
					//CODE BY
		//https://github.com/realdaveblanch
			//https://github.com/X-aaron-X
?>
<! -- redireccion al logo.php -->
<meta http-equiv="refresh" content="0;URL='logo.php'" />

