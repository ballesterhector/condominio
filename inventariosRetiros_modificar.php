<?php
    require 'conectar/conectarCondominio.php'; 
    $obj= new conectarDB();   
    
    switch ($_GET['proceso']) {
		case 'Retirar':
            $data= $obj->actualizar('CALL  inventariosInsert("'.$_GET['rubcod'].'","'.$_GET['aRetirar'].'","'.$_GET['modificador'].'",
                                                            "'.$_GET['observ'].'","'.$_GET['presenta'].'","'.$_GET['ultimo'].'"
                                                           
														)');
			break;
	
		
		case 'existencia':
				$data= $obj->subconsulta("CALL inventarioResumen('".$_GET['codprod']."')");
				echo json_encode($data);
			break;	
		
					
		default:
			# code...
			break;
	}

?>
