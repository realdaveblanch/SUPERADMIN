<?php
//CHECK DE LOGIN O REDIRIGIR AL LOGIN
    if(isset($_COOKIE['suprpowers'])){
		echo ''; 
	}
	else {
		echo "<META http-equiv=".'"REFRESH"'." CONTENT=".'"0;URL=../"'.">";
		include 'ip.php';		
		exit;
	}	
if ($_SERVER["REQUEST_METHOD"] == "POST"){
$clon = $_POST['resetear'];	
//Se declara el valor interno del .ini seleccionado en opciones como $interno
$interno = file_get_contents($clon);

//Se carga la ruta que indique $interno y se añade "admin" como contraseña por defecto 
$password = 'admin';
/* Parametro de coste de creacion al 12. */
$options = ['cost' => 12];
/* Se crea el hash */
$hash = password_hash($password, PASSWORD_DEFAULT, $options);

file_put_contents($interno."/backend/u/cfg/ssap/ssapnimda.ini", $hash, LOCK_EX);
}
$ua = $_SERVER['HTTP_USER_AGENT'];
$id = sha1(rand(111111,999999));
echo "<script> location.hash='user_token_id=$id&acc=SUPERadministrator&&$ua';</script>";
	echo "<META http-equiv=".'"REFRESH"'." CONTENT=".'"0;URL=opciones.php"'.">";
	
											//CODE BY
								//https://github.com/realdaveblanch				

?>