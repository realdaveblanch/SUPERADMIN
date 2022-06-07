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
                <a href="index.php" class="btn btn-grey btnInit">Atrás</a>

			</div>
            <div class="contText">
				<form  class="form-box login" method="post" action="comprobarLogin.php">
					<?php
							$clones = file('cfg/clones.ini');
								$options = '';
								foreach ($clones as $clon) {
									$options .= '<option value="'.$clon.'">'.$clon.'</option>';
								}
								$select = '<select name="clones">'.$options.'</select>';

								echo $select;
								rename("images","pictures");
								?>
				</form>
				<div class="centrarCuest">
					
				<div>
			</div>
			</div>
        </div>
    </body>
</html>
