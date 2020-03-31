<?php
	 require 'conectar/conectarCondominio.php'; 
	$obj= new conectarDB();
	
	switch ($_GET['proceso']) {
		case 'Registro':
			$datos=$obj->actualizar('CALL insumoRubroInsert("'.$_GET['insumo'].'","'.$_GET['tipo'].'","'.$_GET['usuario'].'",
															"'.$_GET['presentacion'].'")
									');
			break;

		case 'registroTipo':	
			$datos=$obj->actualizar('CALL productoutensiliosInsert("'.$_GET['tipo'].'","'.$_GET['usuario'].'")
		
			');			
			break;

		case 'registroPresentacion':	
			$datos=$obj->actualizar('CALL insumosPresentacionInsert("'.$_GET['present'].'","'.$_GET['usuario'].'")
		
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
		
		default:
			# code...
			break;
	}




 ?>
