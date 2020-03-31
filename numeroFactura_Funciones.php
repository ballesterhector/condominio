<?php
	require '../conectarBD/conectarCondominio.php';
	$obj= new conectarDB();

		switch ($_GET['proceso']) {
            case 'genera':
				$data= $obj->actualizar('CALL numefacturaInsert(1,"'.$_GET['fecha'].'")');
				
				$data= $obj->actualizar('CALL numefacturaUpdate()');
			break;

			default:		
				
			break;    
                
                
                
                
                
        }
 ?>
