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
	$ua = $_SERVER['HTTP_USER_AGENT'];
	$id = sha1(rand(111111,999999));
	echo "<script> location.hash='user_token_id=$id&acc=administrator&&$ua';</script>";

if ($_SERVER["REQUEST_METHOD"] == "POST"){
		//Guardo el valor  "numIDs" introducido en el formulario "ad.php" y lo guardo en $numIDs
		
		$clon = $_POST['clones'];

		$interno = file_get_contents($clon);
		
		
//Este código solo lee y gestiona la db, no añade nada nuevo
$dbfile = $interno . "/backend/u/cfg/conectados.db"; // ruta a la base de datos de conectados
$expire = 1300; //tiempo para considerar a alguien online en segundos 21 MIN ;)
//Si la base de datos no existe mostraba un, mensaje  
if(!file_exists($dbfile)) {
die("Error: BASE DE DATOS " . $dbfile . " NO ENCONTRADA");
}
//Si la base de datos no es de escritura mostraba un, mensaje 
if(!is_writable($dbfile)) {
die("Error: BASE DE DATOS" . $dbfile . " NO ES DE ESCRITURA, CHMOD 666.");
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
//Se cuenta el número de personas realizando cuestionarios
$number = $visitors_online;
//Si el número es mayor a 0 se considera que hay personas realizando cuestionarios y no se ejecutará la desactivación
    if($number > 0)
    {		
        echo "Hay $number personas realizando cuestionarios!!";
		echo "<br/>";
		echo "No es recomendable desactivar";
		echo "<br/>";
		echo "Inténtalo de nuevo más tarde";
		flush();
		sleep(3);
		echo "<META http-equiv=".'"REFRESH"'." CONTENT=".'"0;URL=opciones.php"'.">";
		
    }
    else{
		
echo "OK, DESACTIVANDO";
flush();
sleep(2);
echo "<br/>";

//Si el número es 0 se considera que no hay gente interactuando con los cuestionarios y por tanto se ejecuta la desactivación
//Se cambia el nombre de la ruta que contenga $clon ($interno) a _old
rename($interno, $interno . "_old" );
//Se declara funcion mover ini	
	function mover_ini($archivoini, $destino){
    $partesderuta = pathinfo($archivoini);
    $nuevodestino   = "$destino/{$partesderuta['basename']}";
    if(rename($archivoini, $nuevodestino))
        return $nuevodestino;
    return null;
}
$destinofinal = 'cfg/clones/desactivados';
mover_ini($clon, $destinofinal);

echo "<META http-equiv=".'"REFRESH"'." CONTENT=".'"0;URL=opciones.php"'.">";
    }
}			
		
								//CODE BY
					//https://github.com/realdaveblanch
?>