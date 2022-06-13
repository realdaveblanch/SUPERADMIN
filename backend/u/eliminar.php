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
		
		$clon = $_POST['BORRAR'];

		$interno = file_get_contents($clon);
		
		
//Se elimina la ruta que contenga $clon ($interno)
	

	//La funcion borrara la carpeta res y todo su contenido
	function removeFiles($target) {
	    if(is_dir($target)){
	        $files = glob( $target . '*', GLOB_MARK );
	        foreach( $files as $file ){
	            removeFiles( $file );      
	        }
	        rmdir( $target );
	    } elseif(is_file($target)) {
	        unlink( $target );  
	    }
	}
removeFiles($interno . "_old");
unlink($interno);
unlink($clon);


	
//Hay que buscar line en select y eliminar
echo "<META http-equiv=".'"REFRESH"'." CONTENT=".'"0;URL=opciones.php"'.">";
}
?>