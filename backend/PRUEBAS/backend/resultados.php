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
								$text = convertir(file_get_contents($fullfile));
								file_put_contents(getcwd().DIRECTORY_SEPARATOR.'u/cfg/allfilesx.txt',$fullfile."-".$fecha.",".$text. "\r\n", FILE_APPEND );
								file_put_contents(getcwd().DIRECTORY_SEPARATOR.'u/cfg/allfiles.txt',$fecha.",".$text. "\r\n", FILE_APPEND );
								file_put_contents(getcwd().DIRECTORY_SEPARATOR.'u/cfg/logfiles.log','Total Ficheros Gestionados: '.$cont.' - Ultimo Fichero leido: '.$fullfile );
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
	$file = "u/cfg/allfiles.txt";
	$source = $file; 
	$destination = "respaldo/resultados/resultados-$fecha.txt"; 
	if( !copy($source, $destination) ) { 
    echo ""; 
	} 
	else { 
    echo ""; 
	} 
						//CODE BY
		//https://github.com/realdaveblanch
			//https://github.com/X-aaron-X
?>
