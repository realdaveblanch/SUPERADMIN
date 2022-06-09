<?php
if ($_SERVER["REQUEST_METHOD"] == "POST"){
		//Guardo el valor  "numIDs" introducido en el formulario "ad.php" y lo guardo en $numIDs

}
$clon = $_POST['reactivar'];	

$interno = file_get_contents($clon);


echo $interno;

  
rename($interno . "_old", $interno . "" );
	
	function move_file($file, $to){
    $path_parts = pathinfo($file);
    $newplace   = "$to/{$path_parts['basename']}";
    if(rename($file, $newplace))
        return $newplace;
    return null;
}
$destino = 'cfg/clones/activos';
move_file($clon, $destino);

	echo "<META http-equiv=".'"REFRESH"'." CONTENT=".'"2;URL=ok.php"'.">";




?>