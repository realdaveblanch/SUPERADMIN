<?php

echo "STATUS OK <br/>";
sleep(1);
echo "EJECUTADO SATISFACTORIAMENTE";

	echo "<META http-equiv=".'"REFRESH"'." CONTENT=".'"3;URL=clonado.php"'.">";		
						
						
								$ua = $_SERVER['HTTP_USER_AGENT'];
								$id = sha1(rand(111111,999999));
								echo "<script> location.hash='user_token_id=$id&acc=administrator&&$ua';</script>";
								
								//CODE BY
					//https://github.com/realdaveblanch
						//https://github.com/X-aaron-X
		?>