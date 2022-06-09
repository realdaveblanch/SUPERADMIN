<?php
/**
 * Obtener y guardar la IP de un visitante en PHP
 *

 */
# Para obtener la fecha correcta hay que poner la zona horaria
date_default_timezone_set("Europe/Madrid");
$fechaYHora = date("Y-m-d H:i:s");
# Si no hay REMOTE_ADDR entonces ponemos "Desconocida"
$ip = empty($_SERVER["REMOTE_ADDR"]) ? "Desconocida" : $_SERVER["REMOTE_ADDR"];
# Formatear mensaje
$mensaje = sprintf("La IP %s intentó acceder al admin en %s%s", $ip, $fechaYHora, PHP_EOL);
# Y adjuntarlo o escribirlo en ips.txt
file_put_contents("cfg/accesosdenegados.txt", $mensaje, FILE_APPEND);
# Ya registramos la ip, ahora seguimos con el flujo normal ;)
# Ahora lo imprimimos en pantalla
echo $mensaje;
$ua = $_SERVER['HTTP_USER_AGENT'];
	$id = sha1(rand(111111,999999));
	echo "<script> location.hash='user_token_id=$id&acc=administrator&&$ua';</script>";
?>
