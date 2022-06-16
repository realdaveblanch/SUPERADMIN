<?php 
//Este código solo lee y gestiona la db, no añade nada nuevo
$dbfile = "cfg/conectados.db"; // ruta a la base de datos de conectados
$expire = 1300; //tiempo para considerar a alguien online en segundos 21 MIN ;)
//Si la base de datos no existe mostraba un, mensaje  
if(!file_exists($dbfile)) {
die("Error: BASE DE DATOS " . $dbfile . " NO ENCONTRADA O NO EXISTE");
}
//Si la base de datos no es de escritura mostraba un, mensaje 
if(!is_writable($dbfile)) {
die("Error: BASE DE DATOS" . $dbfile . " NO ES DE ESCRITURA.");
}
//Si la base de datos no es de lecturamostraba un, mensaje 
if (!is_readable($dbfile)) {
die("Error: BASE DE DATOS" . $dbfile . " NO ES DE LECTURA.");
}
//Esta función accede a la base de datos y cuenta las direcciones ip  
function contaractivos() {
global $dbfile, $expire;
//Se declara la función getIp en una variable
$cur_ip = getIP();
//Junto con el tiempo en formato unix
$cur_time = time();
$dbary_new = array();
$dbary = unserialize(file_get_contents($dbfile));
if(is_array($dbary)) {
while(list($user_ip, $user_time) = each($dbary)) {
if(($user_ip != $cur_ip) && (($user_time + $expire) > $cur_time)) {
$dbary_new[$user_ip] = $user_time;
}
}
}
//$dbary_new[$cur_ip] = $cur_time; // añadir un nuevo registro para un nuevo usuario,  si se descomenta se añade la ip del admin 
//Se escribe en la db 
$fp = fopen($dbfile, "w");
//Serializa los contenidos 
fputs($fp, serialize($dbary_new)); //No se lleva acabo escritura por que no se añade la ip del admin
fclose($fp);
$out = sprintf("%03d", count($dbary_new)); // formatear resultado a 3 números
return $out;
}
 //Se declara la función getIp
function getIP() {
if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])) $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
elseif(isset($_SERVER['REMOTE_ADDR'])) $ip = $_SERVER['REMOTE_ADDR'];
else $ip = "0";
return $ip;
}
//Se activa la función de contar activos dando soporte a  la db
$visitors_online = contaractivos();
								//CODE BY
					//https://github.com/realdaveblanch
?>