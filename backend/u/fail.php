<?php
	//CHECK DE LOGIN O REDIRIGIR AL LOGIN
    if(isset($_COOKIE['user_name'])){
		echo ''; 
	}
	else {
		echo "<META http-equiv=".'"REFRESH"'." CONTENT=".'"0;URL=../admin/index.php"'.">";
		include 'ip.php';		
		exit;
	}
echo "STATUS FAIL <br/>";
sleep(1);
echo "NO SE PUDO COPIAR, COMPRUEBA ERROR LOG, O QUE EL DIRECTORIO SE PUEDE ESCRIBIR";

	echo "<META http-equiv=".'"REFRESH"'." CONTENT=".'"3;URL=clonado.php"'.">";		
						
						
								$ua = $_SERVER['HTTP_USER_AGENT'];
								$id = sha1(rand(111111,999999));
								echo "<script> location.hash='user_token_id=$id&acc=administrator&&$ua';</script>";
								
								//CODE BY
					//https://github.com/realdaveblanch
						//https://github.com/X-aaron-X
		?>