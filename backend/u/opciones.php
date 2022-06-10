<?php
//CHECK DE LOGIN O REDIRIGIR AL LOGIN
error_reporting(0);
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
	?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <title>SUPERADMIN</title>
        <!-- CSS -->
        <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="../../assets/fonts/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="../../assets/css/style.css">
		<link rel="stylesheet" href="../../assets/css/style2.css">
        <link rel="icon"  href="../../assets/img/favi.png">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">	
    </head>
    <body>
        <!-- Top content -->
        <div class="divText">
        <div class="blanco top-content">
			<div class=" logos">
                <a href="clonado.php" class="btn btn-grey btnInit">Atrás</a>

			</div>
            <div class="contText">
				<form  class="form-box login" method="post" action="rename.php">
					<?php
					
					$dir = 'cfg/clones/activos/';
					$q   = (count(glob("$dir/*")) === 0) ? 'vacio' : 'hayalgo';
						
					if ($q=="vacio") {
						echo "NO HAY APP ACTIVADAS!!"; 
					}
					else{
					
					$files = glob('cfg/clones/activos/*.ini');
					while(list($i, $filename) = each($files)){
					   
					
							$clones = file_get_contents($files);
								$options = '';
								
					}
					foreach ($files as $file) {
									$options .= '<option value="'.$file.'">'.$file.'</option>';
								}
								$select = '<select name="clones">'.$options.'</select>';

								echo $select;
					}
								
								
								
								?>
								<button type="submit" name="seleccionar">Desactivar</button>
								</form>
				
					<form  class="form-box login" method="post" action="default.php">
					
					<?php
					
					$dir = 'cfg/clones/activos/';
					$q   = (count(glob("$dir/*")) === 0) ? 'vacio' : 'hayalgo';
						
					if ($q=="vacio") {
						echo "NO HAY APP ACTIVADAS PARA RESTAURAR CONTRASEÑA!!"; 
					}
					else{
					
					$files = glob('cfg/clones/activos/*.ini');
					while(list($i, $filename) = each($files)){
					   
					
							$clones = file_get_contents($files);
								$options = '';
								
					}
					foreach ($files as $file) {
									$options .= '<option value="'.$file.'">'.$file.'</option>';
								}
								$select = '<select name="resetear">'.$options.'</select>';

								echo $select;
					}
								
								
								?>
								<button type="submit" name="default">Reset Admin</button>
								
								
					</form>	
								
								
				</form>
				
					<form  class="form-box login" method="post" action="reactivar.php">
					<?php
					
					
					$dir = 'cfg/clones/desactivados/';
					$q   = (count(glob("$dir/*")) === 0) ? 'vacio' : 'hayalgo';
						
					if ($q=="vacio") {
						echo "NO HAY APP DESACTIVADAS"; 
					}
					else{
						$filesdes = glob('cfg/clones/desactivados/*.ini');
					while(list($i, $filename) = each($filesdes)){
					   
					
							$clones = file_get_contents($filesdes);
								$options = '';
								
					}
					foreach ($filesdes as $filede) {
									$options .= '<option value="'.$filede.'">'.$filede.'</option>';
								}
								$select = '<select name="reactivar">'.$options.'</select>';
								echo $select;
					}
							
								?>
								<button type="submit" name="seleccionar">Reactivar</button>
								
								
				</form>		
								
								
				
				<div class="centrarCuest">
					
				<div>
			</div>
			</div>
        </div>
		

    </body>
</html>
