<?php
	//CHECK DE LOGIN O REDIRIGIR AL LOGIN
    if(isset($_COOKIE['user_name'])){
		echo ''; 
	}
	else {
		echo "<META http-equiv=".'"REFRESH"'." CONTENT=".'"0;URL=../index.php"'.">";	
		exit;
	}

$file = "u/cfg/comentarios.txt";
$txt = fopen($file, "r") or die("No puedo abrir el fichero o no hay comentarios!");
fclose($txt);

header('Content-Description: File Transfer');
header('Content-Disposition: attachment; filename=comentarios.txt');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($file));
header("Content-Type: text/plain");
readfile($file);

?>