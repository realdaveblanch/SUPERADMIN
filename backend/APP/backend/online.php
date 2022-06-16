<?php 
	$dbfile = "u/cfg/conectados.db"; // ruta a la base de datos de conectados
	$expire = 1300; //tiempo para considerar a alguien online en segundos 21 MIN ;)
	 
	if(!file_exists($dbfile)) {
		die("Error: BASE DE DATOS " . $dbfile . " NO ENCONTRADA");
	}
	 
	if(!is_writable($dbfile)) {
		die("Error: BASE DE DATOS" . $dbfile . " NO ES DE ESCRITURA, CHMOD 666.");
	}
	 
	function contaractivos() {
		global $dbfile, $expire;
		$cur_ip = getIP();
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
	 
		$fp = fopen($dbfile, "w");
			fputs($fp, serialize($dbary_new));
		fclose($fp);
	 
		$out = sprintf("%03d", count($dbary_new)); // formatear resultado a 3 números
			return $out;
	}
	 
	function getIP() {
		if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])) $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		elseif(isset($_SERVER['REMOTE_ADDR'])) $ip = $_SERVER['REMOTE_ADDR'];
		else $ip = "0";
		return $ip;
	}
	 
	$visitors_online = contaractivos();
	
	//CODE BY
	//https://github.com/realdaveblanch
	//https://github.com/X-aaron-X
?>