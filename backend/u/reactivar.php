<?php
if ($_SERVER["REQUEST_METHOD"] == "POST"){
		//Guardo el valor  "numIDs" introducido en el formulario "ad.php" y lo guardo en $numIDs

}
$clon = $_POST['reactivar'];	

$word = "_old";
$mystring = $clon;
if(strpos($mystring, $word) !== false){
	$a = substr($clon, 0, -4);
	
if (rename($clon, $a)) {
echo "ok";
} else {
echo "fail";
}
//hay que eliminar de url unactive
  
  $fp4 = fopen('cfg/urlselect.ini', 'a');
	fwrite($fp4, $a . PHP_EOL);
	
//Se borra el dichoso /r/n
$path = 'cfg/urlselect.ini';
$contents = file_get_contents($path);
rtrim($contents);
$contents = substr($contents, 0, -4);
$fh = fopen($path, 'w') or die("can't open file");
fwrite($fh, $contents);
fclose($fh);  
	
  
  	rename($clon, $a );
	echo "<META http-equiv=".'"REFRESH"'." CONTENT=".'"2;URL=ok.php"'.">";




} else{
    echo "No está inactivo!";
}


?>