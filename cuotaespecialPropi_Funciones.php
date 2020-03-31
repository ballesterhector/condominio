-<?php
	require '../conectarBD/conectarCondominio.php';
	$obj= new conectarDB();

				$data= $obj->subconsulta("CALL propietarioCJSelect('".$_GET['id_resid']."')");
				echo "<option>Seleccione el propietario</option>";
					foreach($data as $filas){
						echo "<option value='".$filas['propietanum']."'>".$filas['propietario'].",".$filas['apartamento']."</option>";
					}


 ?>
