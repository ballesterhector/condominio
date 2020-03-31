<?php
	require '../conectarBD/conectarCondominio.php';
	$obj= new conectarDB();

		switch ($_GET['proceso']) {
			case 'Registro':
				$data= $obj->actualizar('CALL facturacionPorAptInsert("'.$_GET['conjunto'].'","'.$_GET['perio'].'"
															)');
															
											
				$data= $obj->actualizar('CALL facturaciongastosSI("'.$_GET['conjunto'].'","'.$_GET['perio'].'"
															)');

				$data= $obj->actualizar('CALL facturacionReciboUpdate("'.$_GET['conjunto'].'","'.$_GET['perio'].'"
															)');
														
			break;
		
			case 'pagos':
				$data= $obj->actualizar("CALL deudaPorReciboCobros('".$_GET['usuar']."','".$_GET['nrecibo']."')");
			break;

			case 'Modifica':
				$data= $obj->actualizar('CALL propietarioUpdate("'.$_GET['numer'].'","'.$_GET['propi'].'","'.$_GET['cedul'].'",
															"'.$_GET['modificador'].'","'.$_GET['motiv'].'",
															"'.$_GET['telef1'].'","'.$_GET['telef2'].'","'.$_GET['inqil'].'",
                                                            "'.$_GET['cedulin'].'","'.$_GET['telef1inq'].'","'.$_GET['telef2inq'].'"
															
															
															
															)');
			break;

		default:		
			# code...
			break;
	}

 ?>
