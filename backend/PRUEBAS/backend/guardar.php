<?php
	$data = json_decode($_POST['data']);
	$idUser = strtoupper($data[89]);
	$directoriosArray = str_split($idUser);

	$respuestas_SRC = '..'.DIRECTORY_SEPARATOR.'res';
	//$respuestas_SRC = '/expert/htwebs/fpsico.ibersysweb.es/res';
	
	$directorio = $respuestas_SRC.DIRECTORY_SEPARATOR
					//
					//.$directoriosArray[0].$directoriosArray[1].DIRECTORY_SEPARATOR
					//
				   .$directoriosArray[0].$directoriosArray[1].$directoriosArray[2].$directoriosArray[3]
				   .$directoriosArray[4].$directoriosArray[5].$directoriosArray[6].$directoriosArray[7]
				   .$directoriosArray[8].$directoriosArray[9].$directoriosArray[10].$directoriosArray[11].$directoriosArray[12];
	$filefull = $directorio.DIRECTORY_SEPARATOR
				   .$directoriosArray[0].$directoriosArray[1].$directoriosArray[2].$directoriosArray[3]
				   .$directoriosArray[4].$directoriosArray[5].$directoriosArray[6].$directoriosArray[7]
				   .$directoriosArray[8].$directoriosArray[9].$directoriosArray[10].$directoriosArray[11].$directoriosArray[12].".json";

	date_default_timezone_set("Europe/Madrid");
	$fecha = date("G_i-m-d-y");
	file_put_contents($filefull, $_POST['data']);

	if(file_exists($respuestas_SRC.$directorioArchivo.$fileName)) {
		http_response_code(200);
	} else {
		http_response_code(405);
	}

//if(file_exists($respuestas_SRC.$directorioArchivo)) {
//
//    file_put_contents($respuestas_SRC.$directorioArchivo.$fileName, $_POST['data']);
//    if(file_exists($respuestas_SRC.''.$directorioArchivo.$fileName)) {
//        http_response_code(200);
//    } else {
//        http_response_code(405);
//    }
//} else {
//    $directorioF = $respuestas_SRC;
//    mkdir($directorioF.$directorioArchivo, 0777, true);
//    if(file_exists($respuestas_SRC.$directorioArchivo)) {
//        file_put_contents($respuestas_SRC.$directorioArchivo.$fileName, $_POST['data']);
//        if(file_exists($respuestas_SRC.''.$directorioArchivo.$fileName)) {
//            http_response_code(200);
//        } else {
//            http_response_code(405);
//        }
//    } else {
//        http_response_code(405);
//    }
//}
/**
 * Obtener y guardar la IP de un visitante en PHP
 *

 */
# Para obtener la fecha correcta hay que poner la zona horaria
date_default_timezone_set("Europe/Madrid");
$fechaYHora = date("Y-m-d H:i:s");
# Si no hay REMOTE_ADDR entonces ponemos "Desconocida"
# Formatear mensaje
$mensaje = sprintf('<span style="font-weight: bold;"> Último cuestionario rellenado: </span> <br/> <p style="color:red; font-weight: bold;"> %s%s </p>', $fechaYHora, PHP_EOL);
$mensaje2 = sprintf('<span style="font-weight: bold;"> Último cuestionario rellenado: </span> <br/> <p style="color:red; font-weight: bold; margin-bottom: 10px; margin-top: 10px;"> %s%s </p>', $fechaYHora, PHP_EOL);
# Y adjuntarlo o escribirlo en ips.txt
file_put_contents("u/cfg/lastcuest.ini",'' );
file_put_contents("u/cfg/lastcuest.ini", $mensaje, FILE_APPEND);

file_put_contents("u/cfg/lastcuest2.ini",'' );
file_put_contents("u/cfg/lastcuest2.ini", $mensaje2, FILE_APPEND);
# Ya registramos la ip, ahora seguimos con el flujo normal ;)
# Ahora lo imprimimos en pantalla


