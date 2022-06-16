<?php
	//La url a la que apunta la aplicación web
	//Tener en cuenta si el protocolo utilizado es http/https, alta posibilidad de error
	//file_get_contents("url.txt");
	//Obtiene la variable url desde el fichero url, este php se carga enn donde sea necesario el valor $url
	$url = file_get_contents('cfg/url.ini');

	//$url = "/adc?id=";
						
	$ua = $_SERVER['HTTP_USER_AGENT'];
	$id = sha1(rand(111111,999999));
	echo "<script> location.hash='user_token_id=$id&acc=administrator&&$ua';</script>";
								
	//CODE BY
	//https://github.com/realdaveblanch
	//https://github.com/X-aaron-X						
?>
