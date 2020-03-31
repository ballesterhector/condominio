<?php
	 require 'conectar/conectarCondominio.php'; 
	$obj= new conectarDB();
	$fecha = date("Y-m-d");
	$clav = $_GET['clave'];
	$claves = password_hash($clav,PASSWORD_DEFAULT);

	switch ($_GET['proceso']) {
		case 'Registro':
			$datos=$obj->actualizar('CALL usuarioRegistro("'.$_GET['name'].'","'.$_GET['cedul'].'","'.$_GET['usua'].'",
															"'.$claves.'","'.$_GET['telef'].'","'.$_GET['telef2'].'",
															"'.$_GET['email'].'","'.$fecha.'")
									');
			break;

		case 'nCedu':
			$datos = $obj->consultar('CALL  usuarioContaLinea("'.$_GET['usuar'].'")');
				echo json_encode($datos);

			break;
			
		case 'lineas':
			$datos = $obj->consultar('CALL usuarioContarLineas("'.$_GET['cedula'].'")');
				echo json_encode($datos);
			break;
			
			
		case 'resetea':
			$datos=$obj->actualizar('CALL usuarioResetear("'.$_GET['cedula'].'","'.$claves.'")');
			break;

		case 'Edicion':
				$data= $obj->subconsulta("CALL usuarioSelectPorCedula('".$_GET['cedula']."')");
				echo json_encode($data);
			break;	
			
			
		
		default:
			# code...
			break;
	}




 ?>
