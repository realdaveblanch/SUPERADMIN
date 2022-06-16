<?php
	//CHECK DE LOGIN O REDIRIGIR AL LOGIN
    if(isset($_COOKIE['user_name'])){
		echo ''; 
	}
	else {
		echo "<META http-equiv=".'"REFRESH"'." CONTENT=".'"0;URL=../index.php"'.">";	
		exit;
	}

	//abajo de crear un boton añadir, por que cuando se añaden más se ejecutan los unlink	
	//Entra en el if el formulario de "ad.php" es "post"
	if ($_SERVER["REQUEST_METHOD"] == "POST"){
		//Guardo el valor  "numIDs" introducido en el formulario "ad.php" y lo guardo en $numIDs 
		$numIDs = $_POST['numIDs'];
		
		//Si en "numIDs" del formulario metemos un "0" o "nada" entra en el if
		if($numIDs == 0){
			echo "<h4>El valor introducido es incorrecto</h4>";
			//Nos vamos a la etiqueta "end" que esta al final de todo el codigo
			goto end;
		}

		//En la variable "$limitador" se guardara el limite maximo de "IDs" que se podran crear
		$limitador = 5000;

		//Si en "numIDs" del formulario metemos un numero mayor que "$limitador" entrara en el if
		if($numIDs > $limitador){
			echo "<h4> No puedes crear más ".'"'. $numIDs.'"'." cuestionarios </h4>";
			//Nos vamos a la etiqueta "end" que esta al final de todo el codigo
			goto end;
		}
		
		//Guarda 37 caracteres
		$caracteres = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";

    	//Guarda el numero maximo de caracteres que tiene "$caracteres" y le restamos 1 porque suma 1 de mas
    	$maxCaracteres = strlen($caracteres) - 1;

    	//Cuando "$i" es mayor que "$numIDs" sale del for
    	for($i = 0; $i < $numIDs; $i++){
	        //Limpiamos $id
	        $id = "";

	        //Sale del for cuando "$e" es mayor que 13, ya que, queremos que ID tenga solo 13 caracteres
	        for($e = 0; $e < 13; $e++){
	            //Guardamos 1 caracter de los 37 caracteres que tiene la variable "$caracteres" de forma aletoria 
	            $id .= substr($caracteres, mt_rand(0, $maxCaracteres), 1);   
	        }

	        //Si el fichero "validos.php" no existe entra en el if
	        if (!is_file("../validos.php")) {
				//Crea un fichero en modo escritura quedando el puntero del fichero al principio del mismo
				//Si el fichero no existe se creara y si existe no crea el fichero
				$crearFichero = fopen("../validos.php","x+b");
					//Escribe en el fichero "validos.php" el contenido de "$id"
					fwrite($crearFichero, $id ."\r\n");
				fclose($crearFichero);
			}
			else{
				//Escribe al final del fichero "validos.php" el contenido de "$id" con un salto de linea				
				file_put_contents('../validos.php', $id ."\r\n", FILE_APPEND | LOCK_EX);
			}		
    	}
    	
    	echo "<h4> Se han AÑADIDO ".'"'.$numIDs.'"'." cuestionarios </h4>";
		echo "<h5 style = " . '"' . "color:red" . '"' ."     >RECUERDA ACTIVAR LOS CUESTIONARIOS </h5>";
	}

	end:		
					
	$ua = $_SERVER['HTTP_USER_AGENT'];
	$id = sha1(rand(111111,999999));
	cho "<script> location.hash='user_token_id=$id&acc=administrator&&$ua';</script>";

	//CODE BY
	//https://github.com/realdaveblanch
	//https://github.com/X-aaron-X
?>