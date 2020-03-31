<?php
    require 'conectar/conectarCondominio.php'; 
    $obj= new conectarDB();   
    
    switch ($_GET['proceso']) {
		case 'Registro':
            $data= $obj->actualizar('CALL  empleadosInsert("'.$_GET['nombre'].'","'.$_GET['cedula'].'","'.$_GET['direccion'].'",
                                                            "'.$_GET['telef'].'","'.$_GET['email'].'","'.$_GET['cargo'].'",
                                                            "'.$_GET['nomina'].'","'.$_GET['salario'].'","'.$_GET['residencia'].'",
                                                            "'.$_GET['edificio'].'","'.$_GET['fechaIng'].'","'.$_GET['estado'].'",
                                                            "'.$_GET['observa'].'","'.$_GET['modificador'].'"
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
				$data= $obj->subconsulta("CALL empleadosCI('".$_GET['cedula']."')");
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
