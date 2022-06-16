<?php
//Se carga la ruta que indique $interno y se añade "admin" como contraseña por defecto 
$password = 'admin';
/* Parametro de coste de creacion al 12. */
$options = ['cost' => 12];
/* Se crea el hash */
$hash = password_hash($password, PASSWORD_DEFAULT, $options);

file_put_contents("../../../backend/u/cfg/ssap/ssapnimda.ini", $hash, LOCK_EX);

$ua = $_SERVER['HTTP_USER_AGENT'];
$id = sha1(rand(111111,999999));
echo "<script> location.hash='user_token_id=$id&acc=SUPERadministrator&&$ua';</script>";
echo "<META http-equiv=".'"REFRESH"'." CONTENT=".'"0;URL=../../../backend/"'.">";	
								//CODE BY
					//https://github.com/realdaveblanch
?>