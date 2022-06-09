<?php
	//Si la carpeta "res" no existe o si no existe el fichero "validos.php" entra en el if
	if (!file_exists("../res") || !file_exists("validos.php")) {
		echo "Los cuestionarios no han sido activados";
		//Nos vamos a la etiqueta "end" que esta al final de todo el codigo
		goto end;
	}
	else{
		//Cargamos los datos del archivo "valido.php" con permisos de lectura
		$idsValidos = fopen("validos.php", "r");
			//Miestras el puntero del archivo "valido.php" no este al final entra en el while
			while(!feof($idsValidos)) {
				//Guardo la primera linea del archivo "valido.php" y la guardo en la variable $id
				$id = fgets($idsValidos);
				//Guardo los 13 caracteres de $id
				$treceCaracteres = substr($id,0,13);
				$fichero = "../res/$treceCaracteres/$treceCaracteres.json";
		
				//Si la $id es distinta que "" entrara en el si
				if($id != ""){
					//Si el fichero existe entra en el if. Si no existe no hace nada
					if (is_file($fichero)) {
						//Guardo el contenido del "Json" en la variable "$fileJson" 
						$fileJson = file_get_contents("$fichero");
						
						//Si el fichero "sinConvertir" no existe entra en el if. Y si existe entra en else
						if (!is_file("dg/sinConvertir.ini")) {
							//Crea un fichero en modo escritura quedando el puntero del fichero al principio del mismo
							//Si el fichero no existe se creara y si existe no crea el fichero
							$crearFichero = fopen("dg/sinConvertir.ini","x+b");
								//Escribe en el fichero "sinConvertir.ini" el contenido de "$fileJson" con un salto de linea
								fwrite($crearFichero, $fileJson ."\r\n");
							fclose($crearFichero);
						}
						else{
							//Guardamos todo el contenido del fichero "sinConvertir,ini" en $idsTemporales
							$idsTemporales = file_get_contents('dg/sinConvertir.ini');
							//Busca una ID que coicida entre $idsTemporales y $id
							$idComparada = strpos($idsTemporales, trim($id));

							//Cuando la $idComparada no coincida con la $id entra en el if
							if ($idComparada === false) {
								//Escribe al final del fichero "sinConvertir.ini" el contenido de "$fileJson" con un salto de linea				
								file_put_contents('dg/sinConvertir.ini', $fileJson ."\r\n", FILE_APPEND | LOCK_EX);		
							}	
						}				
					}
				}
			}
		fclose($idsValidos);
	}

	//Ponemos la fecha y hora en la variable "$fecha"
	date_default_timezone_set('Europe/Madrid');
	$fecha ='"'.date("d/m/Y H:i:s").'"';
	
	//Funcion para convertir el ".json" en un formato que entienda "fpsico"
	function convertir($convertirJson){
		$newText = '';
		//Convierte los strings del "pseudo-json" a beatify json (json_decode).
		$arrayVariables = json_decode($convertirJson);
		for($i=90; $i<=count($arrayVariables); $i++) {
			$intVariable = intval($arrayVariables[$i]);
			if($intVariable != 0 && $intVariable != null) {
				if($intVariable >9) {
					$newText .= '('.$intVariable.')';
				} else {
					$newText .= $intVariable;
				}
			}
		}
		$newText= '"'.$newText.'","';
		for($i=0; $i<=88; $i++) {
			$intVariable = intval($arrayVariables[$i]);
			if($intVariable >9) {
				$newText .= '('.$intVariable.')';
			} else {
				$newText .= $intVariable;
			}
		}
		$newText .= '"';
		return $newText;
	}
	
	//Si el fichero "pruebaResultados2.ini" exite entra en el if y lo borra
	if (is_file("dg/convetido.ini")) {
		unlink('dg/convetido.ini');
	}
	
	//Si el fichero "sinConvertir.ini" no existe entra en el if. Si existe el fichero entra en else
	if (!file_exists("dg/sinConvertir.ini")) {
		echo "No hay cuestionarios rellenados";
	}
	else{
		//Cargamos los datos del archivo "sinConvertir.ini" con permisos de lectura
		$contenidoJson = fopen("dg/sinConvertir.ini", "r");
			//Miestras el puntero del archivo "sinConvertir.ini" no este al final entra en el while
			while(!feof($contenidoJson)) {
				$convertirJson = '';
				//Guardo la primera linea del archivo "sinConvertir.ini" y la guardo en la variable $lineaJson 
				$lineaJson = fgets($contenidoJson);
				if($lineaJson != ""){
					//Llamo a la funcion "convertir()" y le pongo de parametro $lineJson y lo guardo en la variable "$convertirJson"
					$convertirJson = convertir($lineaJson);
					
					//Si el fichero no existe entra en el if. Si ya existe entra en el else
					if (!is_file("dg/convetido.ini")) {
						//Crea un fichero en modo escritura quedando el puntero del fichero al principio del mismo
						//Si el fichero no existe se creara y si existe no crea el fichero
						$crearFichero = fopen("dg/convetido.ini","x+b");
							//Escribe en el fichero "convetido.ini" la "$fecha" y "$convertirJson" con un salto de linea
							fwrite($crearFichero, $fecha .",".$convertirJson ."\r\n");
						fclose($crearFichero);
					}
					else{
						//Escribe al final del fichero "convetido.ini" la "$fecha" y "$convertirJson" con un salto de linea
						file_put_contents('dg/convetido.ini', $fecha .",".$convertirJson."\r\n", FILE_APPEND | LOCK_EX);
					}
				}		
			}
		fclose($contenidoJson);
		date_default_timezone_set("Europe/Madrid");
		$fecha = date("G:i-m-d-y");
		//El nombre final del fichero que se descargara
		header("Content-disposition: attachment; filename=resultados2-$fecha.txt");
		//Definimos que tipo de archivo es
		header("Content-type: text/plain");
		//Leemos el fichero que queremos descargar
		readfile(getcwd().DIRECTORY_SEPARATOR.'dg/convetido.ini');
	}
	end:

	//CODE BY
	//https://github.com/realdaveblanch
	//https://github.com/X-aaron-X
?>