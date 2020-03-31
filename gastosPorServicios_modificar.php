<?php
    require 'conectar/conectarCondominio.php'; 
    $obj= new conectarDB();   
    
    switch ($_GET['proceso']) {
		case 'Registro':
            $data= $obj->actualizar('CALL  gastosPorServiciosIncert("'.$_GET['usuario'].'","'.$_GET['fecha'].'","'.$_GET['factura'].'",
                                                            "'.$_GET['proveedor'].'","'.$_GET['gasto'].'","'.$_GET['period'].'",
                                                            "'.$_GET['moimiento'].'","'.$_GET['motivo'].'","'.$_GET['observa'].'"
                                                           
														)');
			break;
	
		case 'compraDetalle':
				$datos = $obj->actualizar('CALL gastodetallInsert("'.$_GET['numgas'].'","'.$_GET['descrip'].'","'.$_GET['cost'].'",
																"'.$_GET['cantid'].'","'.$_GET['usua'].'","'.$_GET['gastotot'].'",
																"'.$_GET['unidad'].'","'.$_GET['observ'].'",
										)');
			break;
			
		case 'totalgasto':
				$data= $obj->subconsulta("CALL gastodetalTotGasto('".$_GET['numgas']."')");
				echo json_encode($data);
			break;	
		
		case 'cerrar':
			$datos = $obj->actualizar('CALL gastoCerrar("'.$_GET['numgas'].'","'.$_GET['usua'].'")');
		break;

		case 'tipo':
			$datos = $obj->actualizar('CALL gastosTipoInsert("'.$_GET['tipo'].'")');
		break;	
					
		default:
			# code...
			break;
	}

?>
