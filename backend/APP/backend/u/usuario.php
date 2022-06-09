<?php 
	//Tener en cuenta si el protocolo utilizado es http/https, alta posibilidad de error
	include 'url.php';
	$cont = 0;
	$fileExiste = 0;
	
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
				//Convierte el id en una url
				$urlCuestionario = "<a href = '". trim($url.$id) ."'>". "Hacer cuestionario" ."</a>";
				$cont++;
				
				//Si el fichero no existe entra en el if
				if (!is_file($fichero)) {
					//Si el fichero "idsTemporales.ini" no existe entra en el if
					if (!is_file("u/idsTemporales.ini")) {
						echo $urlCuestionario;
						
						//Crea un fichero en modo escritura quedando el puntero del fichero al principio del mismo
						//Si el fichero no existe se creara y si existe no crea el fichero
						$crearFichero = fopen("u/idsTemporales.ini","x+b");
							//Se guarda la $id en el fichero "idsTemporales.ini"
							fwrite($crearFichero, trim($id)."\r\n");
						fclose($crearFichero);
						break;
					}else{
						//Guardamos todo el contenido del fichero "idsTemporales,ini" en $idsTemporales
						$idsTemporales = file_get_contents('u/idsTemporales.ini');
						
						//Busca una ID que coicida entre $idsTemporales y $id
						$idComparada = strpos($idsTemporales, trim($id));
						
						//Cuando la $idComparada no coincida con la $id entra en el if
						if ($idComparada === false) {
							echo $urlCuestionario;
							
							//Guarda al final del contido la $id en el fichero "idsTemporales.ini"
							file_put_contents('u/idsTemporales.ini', trim($id) ."\r\n", FILE_APPEND | LOCK_EX);		
							break;
						}
					}
				}else{
					$fileExiste++;
				}
			}

			//Cuando la $id es igual a "" entra en el if
			if($id == ""){
				//Borra el fichero "idsTemporales.ini"
				unlink('u/idsTemporales.ini');
				
				//Si no encuentra todos los ficheros ".json" en sus respectivas carpetas entrara en el if
				if (!is_file($fichero)) {
					//Refresca la pagina y nos envia a "encuesta.php"
					echo "<META HTTP-EQUIV=".'"REFRESH"'." CONTENT=".'"0.1;URL=encuesta.php"'.">";
				}
				
				//Si todos los cuestionarios estan rellenos, entonces aparece la siguiente página
				if($cont == $fileExiste){
					echo "<META http-equiv=".'"REFRESH"'." CONTENT=".'"0;URL=enhorabuena.php"'.">";
				}
			}
		}
	fclose($idsValidos);
						
	$ua = $_SERVER['HTTP_USER_AGENT'];
	$id = sha1(rand(111111,999999));
	echo "<script> location.hash='user_token_id=$id&acc=administrator&&$ua';</script>";

	//CODE BY
	//https://github.com/realdaveblanch
	//https://github.com/X-aaron-X								
?>