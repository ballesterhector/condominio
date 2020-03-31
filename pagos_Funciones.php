<?php
	require '../conectarBD/conectarCondominio.php';
	$obj= new conectarDB();

		switch ($_GET['proceso']) {
			case 'Registro':
				$data= $obj->actualizar('CALL pagosPorAptInsert("'.$_GET['recibonum'].'","'.$_GET['Subconcepto'].'","'.$_GET['conjunto'].'",
                                                            "'.$_GET['edf'].'","'.$_GET['propie'].'","'.$_GET['apta'].'",
															"'.$_GET['fechafact'].'","'.$_GET['perio'].'","'.$_GET['cobro'].'",
															"'.$_GET['modificador'].'"
															)');
															
				$data= $obj->actualizar("CALL deudaPorReciboCobros('".$_GET['modificador']."','".$_GET['recibonum']."')");											
			break;
			
			case 'Edicion':
				$data= $obj->subconsulta("CALL facturacionEvolucionPorFactura('".$_GET['recib']."')");
				echo json_encode($data);
			break;

			case 'Modifica':
				$data= $obj->actualizar('CALL proveedorUpdate("'.$_GET['numer'].'","'.$_GET['telef1'].'","'.$_GET['telef2'].'",
															"'.$_GET['corre'].'","'.$_GET['motiv'].'"
															)');
			break;

		default:		
			# code...
			break;
	}

 ?>
