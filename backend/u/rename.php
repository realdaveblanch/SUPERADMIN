<?php
if ($_SERVER["REQUEST_METHOD"] == "POST"){
		//Guardo el valor  "numIDs" introducido en el formulario "ad.php" y lo guardo en $numIDs
		
		$clon = $_POST['clones'];	

if (rename($clon, $clon . ".0")) {
	echo "<META http-equiv=".'"REFRESH"'." CONTENT=".'"0;URL=ok.php"'.">";		
	
} else {

			echo "<META http-equiv=".'"REFRESH"'." CONTENT=".'"0;URL=fail.php"'.">";
	
}




//Se escribe en urlunactive, que este clon ha sido desactivado
$fp4 = fopen('cfg/urlunactive.ini', 'a');
fwrite($fp4, $clon . "_old" ."\r\n");
	
//Se busca la línea en el select y se elimina

$key = $clon;
$contents = '';
$fc=file("cfg/urlselect.ini");

$f=fopen("in_temp.txt","a");

$temp = array();
foreach($fc as $line)

    if (substr($line,$key) === false) 
        fwrite($f, line);
	
fclose($f);
unlink("cfg/urlselect.ini");
rename("in_temp.txt", "cfg/urlselect.ini");

  

}
else {
	echo "<META http-equiv=".'"REFRESH"'." CONTENT=".'"0;URL=fail.php"'.">";

rename($clon, $clon . "_old");
$fp4 = fopen('cfg/urlunactive.ini', 'a');
		file_put_contents('cfg/urlunactive.ini','', LOCK_EX);
	fwrite($fp4, $clon . "_old");

}

?>