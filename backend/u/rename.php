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
if ($_SERVER["REQUEST_METHOD"] == "POST"){
		//Guardo el valor  "numIDs" introducido en el formulario "ad.php" y lo guardo en $numIDs
		
		$clon = $_POST['clones'];

		$interno = file_get_contents($clon);




rename($interno, $interno . "_old" );


function move_file($file, $to){
    $path_parts = pathinfo($file);
    $newplace   = "$to/{$path_parts['basename']}";
    if(rename($file, $newplace))
        return $newplace;
    return null;
}
$destino = 'cfg/clones/desactivados';
move_file($clon, $destino);
	
//Hay que buscar line en select y eliminar
echo "<META http-equiv=".'"REFRESH"'." CONTENT=".'"0;URL=ok.php"'.">";
}
?>