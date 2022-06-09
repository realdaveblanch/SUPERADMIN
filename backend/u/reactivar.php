<?php
if ($_SERVER["REQUEST_METHOD"] == "POST"){
		//Guardo el valor  "numIDs" introducido en el formulario "ad.php" y lo guardo en $numIDs

}
$clon = $_POST['reactivar'];	


	
	$key = $a;
$contents = '';
$fc=file("cfg/urlunactive.ini");
$f=fopen("in_temp2.txt","w");

$temp = array();
foreach($fc as $line)

    if (substr($line,$key) === false) {
        fwrite($f, line);
}
fclose($f);
unlink("cfg/urlunactive.ini");
rename("in_temp2.txt", "cfg/urlunactive.ini");

$word = "_old";
$mystring = $clon;
if(strpos($mystring, $word) !== false){
	$a = substr($clon, 0, -4);
	
if (rename($clon, $a)) {
	$message = sprintf(
		'The file %s was renamed to %s successfully!'		
	);
} else {
	$message = sprintf(
		'There was an error renaming file %s'
	);
}

  
  $fp4 = fopen('cfg/urlselect.ini', 'a');
	fwrite($fp4, $a . PHP_EOL);
  
  
	echo "<META http-equiv=".'"REFRESH"'." CONTENT=".'"2;URL=ok.php"'.">";

$word = "_old";
$mystring = $clon;
 
// Test if string contains the word 
if(strpos($mystring, $word) !== false){
	$a = substr($clon, 0, -4);
	echo $a;
	rename($clon, $a );

} else{
    echo "No está inactivo!";
}


?>