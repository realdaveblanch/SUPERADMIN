<?php
	//CHECK DE LOGIN O REDIRIGIR AL LOGIN
    if(isset($_COOKIE['client'])){
		echo ''; 
	}
	else {
		echo "<META http-equiv=".'"REFRESH"'." CONTENT=".'"0;URL=index.php"'.">";	
		exit;
	}

	$file = "u/cfg/comentarios.txt";

	  
	$txt = fopen($file, "r") or die("No puedo abrir el fichero o no hay comentarios!");
	fclose($txt);

	date_default_timezone_set("Europe/Madrid");
	$fecha = date("G_i-m-d-y");
	header('Content-Description: File Transfer');
	header("Content-Disposition: attachment; filename=comentarios-$fecha.txt");
	header('Expires: 0');
	header('Cache-Control: must-revalidate');
	header('Pragma: public');
	header('Content-Length: ' . filesize($file));
	header("Content-Type: text/plain");
	readfile($file);


	//Copia de respaldo comentarios
	//$source = $file; 
	//$destination = "respaldo/comentarios/comentarios-$fecha.txt"; 
	//if( !copy($source, $destination) ) { 
	    //echo "No se pudo realizar respaldado! \n"; 
	//} 
	//else { 
	    //echo "----------Mensaje del sistema: Comentarios respaldados---------- \n"; 
	//} 
?>
