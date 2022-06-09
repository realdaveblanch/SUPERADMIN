<?php
	//Funcion para convertir el ".json" en un formato que entienda "fpsico"
	function convertir($text){
		$newText = '';
		$arrayVariables = json_decode($text);
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

	file_put_contents(getcwd().DIRECTORY_SEPARATOR.'u/cfg/allfiles.txt','' );
	$directoryArray = explode(DIRECTORY_SEPARATOR,getcwd());
	$directory = '';
	foreach($directoryArray as $index => $dir) {
		if($index<count($directoryArray) - 1) {
			$directory .= $dir.DIRECTORY_SEPARATOR;
		}
	}

	$directory.= 'res';
	$cont = 0;
	date_default_timezone_set('Europe/Madrid');
	$fecha ='"'.date("d/m/Y H:i:s").'"'; 

	//Si la carpeta "res" existe entra en el if
	if (file_exists("../res")) {
		$subDirectories = scandir($directory);

		foreach($subDirectories as $subDirectory) {
			//Entrara en el if cuando no sea '.' o '..'
			if($subDirectory != '.' && $subDirectory != '..') {
				//Guarda la ruta entera de la carpeta que en su caso es la carpeta con el nombre de la "ID"
				$subDir  = $directory.DIRECTORY_SEPARATOR.$subDirectory;
				if(is_dir($subDir)) {
					$subsubDirectories = scandir($subDir);
					foreach($subsubDirectories as $subsubDirectory) {
						//Entrara en el if cuando no sea '.' o '..'
						if($subsubDirectory != '.' && $subsubDirectory != '..') {
							//$subsubDir = $subDir.DIRECTORY_SEPARATOR.$subsubDirectory;

							$files = scandir($subDir);
							foreach($files as $file) {
								$text = '';
								$fullfile = $subDir.DIRECTORY_SEPARATOR.$file;
								if(is_file($fullfile)) {
									$cont++;

									//Lee el fichero "fecha.ini" y lo convierto en un array
									$array = file('u/cfg/fecha.ini');
									//Guardo el nombre de la carpeta que es el nombre de la "ID"
									$buscarID = trim($subDirectory);

									//Funcion para buscar en "fecha.ini" y "$buscarID". La ID que sea igual
									$matches = array_filter(
										$array, function($var) use ($buscarID) {
											//Devuelve "$buscarID" sin ningun caracter por delante y atras
		             						return preg_match("/^.*$buscarID.*\$/m", $var); 
		         						}
		         					);

									//Si la funcion "$matches" es mayor que 1 eso quiere decir que la ID de "fecha.ini" y "$buscarID" son iguales
		         					if (count($matches) > 0) {
		         						//Guarda en "$linea" toda la linea de la ID encontrada
										foreach ($matches as $linea) {
											//Guardo en "$fechaID" la fecha contandolo por sus caracteres
											$fechaID = substr(htmlspecialchars(trim($linea)), 0, 19);
										  }
									}

									$text = convertir(file_get_contents($fullfile));
									file_put_contents(getcwd().DIRECTORY_SEPARATOR.'u/cfg/allfilesx.txt',$fullfile."-".$fecha.",".$text. "\r\n", FILE_APPEND );
									file_put_contents(getcwd().DIRECTORY_SEPARATOR.'u/cfg/allfiles.txt', '"'.$fechaID.'"'.",".$text. "\r\n", FILE_APPEND );
									file_put_contents(getcwd().DIRECTORY_SEPARATOR.'u/cfg/logfiles.log','Total Ficheros Gestionados: '.$cont.' - Ultimo Fichero leido: '.$fullfile );
								}
							}
						}
					}
				}
			}
		}	
	}
	
	date_default_timezone_set("Europe/Madrid");
	$fecha = date("G_i-m-d-y");

	header("Content-disposition: attachment; filename=resultados-$fecha.txt");
	header("Content-type: text/plain");
	readfile(getcwd().DIRECTORY_SEPARATOR.'u/cfg/allfiles.txt');


	//Copia de respaldo resultados
	//$file = "u/cfg/allfiles.txt";
	//$source = $file; 
	//$destination = "respaldo/resultados/resultados-$fecha.txt"; 

	//if( !copy($source, $destination) ) { 
    	//echo ""; 
	//} 
	//else { 
    	//echo ""; 
	//} 

	//CODE BY
	//https://github.com/realdaveblanch
	//https://github.com/X-aaron-X
?>