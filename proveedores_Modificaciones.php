<?php
    require 'conectar/conectarCondominio.php'; 
    $obj= new conectarDB();   
    
    switch ($_GET['proceso']) {
		case 'Registro':
            $data= $obj->actualizar('CALL proveedorInsert("'.$_GET['proveedor'].'","'.$_GET['activi'].'","'.$_GET['direccion'].'",
                                                            "'.$_GET['rif'].'","'.$_GET['teleContacto'].'","'.$_GET['teleContacto2'].'",
															"'.$_GET['email'].'","'.$_GET['modificador'].'","'.$_GET['contacto'].'"
														)');
			break;
	
		case 'Modifica':
				$datos = $obj->actualizar('CALL clientesModifica("'.$_GET['rif'].'","'.$_GET['telef'].'","'.$_GET['estado'].'","'.$_GET['direcc'].'",
																"'.$_GET['contacto'].'","'.$_GET['teleContacto'].'","'.$_GET['email'].'",
																"'.$_GET['observ'].'","'.$_GET['tolera'].'",
																"'.$_GET['paleta'].'","'.$_GET['contratada'].'","'.$_GET['modificador'].'",
																"'.$_GET['bloqueo'].'","'.$_GET['id-prod'].'"
				
										)');
			break;
			
		case 'Edicion':
				$data= $obj->subconsulta("CALL clientesSelectTodos('".$_GET['nomCli']."')");
				echo json_encode($data);
			break;	
			
		case 'arranque':
			
			$datos = $obj->actualizar('CALL clientesModificaArranque("'.$_GET['numCli'].'","'.$_GET['usuar'].'","'.$codigo.'"
				
										)');
			echo json_encode($datos);
			break;		
	
			
		default:
			# code...
			break;
	}

?>
