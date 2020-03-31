<?php
	require '../conectarBD/conectarCondominio.php';
	$obj= new conectarDB();

		switch ($_GET['proceso']) {
			case 'Registro':
				$data= $obj->actualizar('CALL gastoInsert("'.$_GET['fech'].'","'.$_GET['factu'].'","'.$_GET['provee'].'",
                                                            "'.$_GET['totg'].'","'.$_GET['period'].'","'.$_GET['conjunto'].'"
															)');
			break;
						
			case 'ultimo':
				$datos = $obj->consultar('CALL gastosUltimoSelect()');
				echo json_encode($datos);

			break;
			
			case 'detalle':
				$data= $obj->actualizar('CALL gastodetallInsert("'.$_GET['numdatalle'].'","'.$_GET['concep'].'","'.$_GET['gast'].'",
                                                            "'.$_GET['cant'].'","'.$_GET['modificador'].'"
															)');
			break;

		default:		
			# code...
			break;
	}

 ?>
