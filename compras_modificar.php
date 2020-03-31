<?php
    require 'conectar/conectarCondominio.php'; 
    $obj= new conectarDB();   
    
    switch ($_GET['proceso']) {
		case 'Registro':
            $data= $obj->actualizar('CALL  gastoInsert("'.$_GET['proveedor'].'","'.$_GET['factura'].'","'.$_GET['fecha'].'",
                                                            "'.$_GET['total'].'","'.$_GET['periodo'].'","'.$_GET['usuario'].'"
                                                           
														)');
														
			break;
	
		case 'compraDetalle':
				$datos = $obj->actualizar('CALL gastodetallInsert("'.$_GET['numgas'].'","'.$_GET['cost'].'",
																"'.$_GET['cantid'].'","'.$_GET['usua'].'","'.$_GET['gastotot'].'",
																"'.$_GET['observ'].'","'.$_GET['descrip'].'"
										)');
			break;
			
		case 'totalgasto':
				$data= $obj->subconsulta("CALL gastoTotalSelect('".$_GET['numgas']."')");
				echo json_encode($data);
			break;	
		
		case 'cerrar':
			$datos = $obj->actualizar('CALL gastoCerrar("'.$_GET['numgas'].'","'.$_GET['usua'].'")');
		break;	
					
		default:
			# code...
			break;
	}

?>
