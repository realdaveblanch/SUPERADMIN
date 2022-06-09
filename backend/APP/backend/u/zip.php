<?php
//CHECK DE LOGIN O REDIRIGIR AL LOGIN
    if(isset($_COOKIE['user_name'])) {
		echo ''; 
	}
	else {
		echo "<META http-equiv=".'"REFRESH"'." CONTENT=".'"0;URL=../index.php"'.">";	
		exit;
	}
// Ruta del objetivo
$rootPath = file_get_contents("cfg/urlpura.ini");
echo "Objetivo" . $rootPath;
echo "</br>";
flush();
sleep(1);

// Iniciar objeto zip
$hostname = file_get_contents("cfg/hostname.ini");
echo "Nombre Objetivo:" . $rootPath;
echo "</br>";
flush();
sleep(1);
$zip = new ZipArchive();
@mkdir ('../../../backupWEBAPP/');
echo "Carpeta backup creada";
echo "</br>";
flush();
sleep(0);
date_default_timezone_set("Europe/Madrid");
$fecha = date("m-d-y");
$zip->open('../../../backupWEBAPP/' . $hostname . $fecha . '.zip' , ZipArchive::CREATE | ZipArchive::OVERWRITE);
echo "Nombre final copia:" .$hostname.$fecha.'.zip';
flush();
sleep(0);

// Iterador recursivo

$files = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($rootPath),
    RecursiveIteratorIterator::LEAVES_ONLY
);

foreach ($files as $name => $file)
{
    // Saltar directorios (se añadirán auto)
    if (!$file->isDir())
    {
        // Ruta relativa y real
        $filePath = $file->getRealPath();
        $relativePath = substr($filePath, strlen($rootPath) + 1);

        // Añadir al zip
        $zip->addFile($filePath, $relativePath);
    }
}

// Se ejecuta la acción
$zip->close();
flush();
echo "<br/>";
echo "Copia de Seguridad ejecutada";
flush();
sleep(0);
echo "<META http-equiv=".'"REFRESH"'." CONTENT=".'"2;URL=ok.php"'.">";
?>