<?php
if ($_SERVER["REQUEST_METHOD"] == "POST"){
		//Guardo el valor  "numIDs" introducido en el formulario "ad.php" y lo guardo en $numIDs
		
		$clon = $_POST['clones'];	


rename($clon, $clon . "_old" );



//Se escribe en urlunactive, que este clon ha sido desactivado
$fp4 = fopen('cfg/urlunactive.ini', 'a');
fwrite($fp4, $clon . "_old" ."\r\n");

//Se borra el dichoso /r/n
$path = 'cfg/urlinactive.ini';
$contents = file_get_contents($path);
rtrim($contents);
$contents = substr($contents, 0, -4);
$fh = fopen($path, 'w') or die("can't open file");
fwrite($fh, $contents);
fclose($fh);  
	
//Hay que buscar line en select y eliminar






echo "<META http-equiv=".'"REFRESH"'." CONTENT=".'"2;URL=ok.php"'.">";
}
?>