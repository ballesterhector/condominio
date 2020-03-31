<?php 
	require '../conectarBD/conectarCondominio.php';
	$obj= new conectarDB();
	$fecha = date("Y-m-d");
	echo $fecha;
	$cedula=5010351;
	$datos = $obj->consultar('CALL usuarioSelectPorCedula(5010351)');
				echo json_encode($datos);
	$clav=5010;
	$claves = password_hash($clav,PASSWORD_DEFAULT);
	echo $claves;
?>