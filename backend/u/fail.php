<?php

echo "STATUS FAIL <br/>";
sleep(1);
echo "NO SE PUDO REALIZAR, COMPRUEBA ERROR LOG, O QUE EL DIRECTORIO SE PUEDE ESCRIBIR";

	echo "<META http-equiv=".'"REFRESH"'." CONTENT=".'"2;URL=clonado.php"'.">";		
						
						
								$ua = $_SERVER['HTTP_USER_AGENT'];
								$id = sha1(rand(111111,999999));
								echo "<script> location.hash='user_token_id=$id&acc=administrator&&$ua';</script>";
								
								//CODE BY
					//https://github.com/realdaveblanch
		?>