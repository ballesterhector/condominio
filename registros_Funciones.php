<?php
	require '../conectarBD/conectarCondominio.php';
	$obj= new conectarDB();

		switch ($_GET['proceso']) {
			case 'Registro':
				$data= $obj->actualizar('CALL propietarioInsert("'.$_GET['apt'].'","'.$_GET['propi'].'","'.$_GET['cedul'].'",
                                                            "'.$_GET['cedulin'].'","'.$_GET['alicuota'].'","'.$_GET['conjunto'].'",
															"'.$_GET['telef1'].'","'.$_GET['telef2'].'","'.$_GET['inqil'].'",
															"'.$_GET['telef1inq'].'","'.$_GET['telef2inq'].'","'.$_GET['edif'].'",
															"'.$_GET['emapropi'].'","'.$_GET['emainqil'].'"
															)');
			break;

			case 'Edicion':
				$data= $obj->subconsulta("CALL propietarioSelect('".$_GET['nomPro']."')");
				echo json_encode($data);
			break;

			case 'Modifica':
				$data= $obj->actualizar('CALL propietarioUpdate("'.$_GET['numer'].'","'.$_GET['propi'].'","'.$_GET['cedul'].'",
															"'.$_GET['modificador'].'","'.$_GET['motiv'].'",
															"'.$_GET['telef1'].'","'.$_GET['telef2'].'","'.$_GET['inqil'].'",
                                                            "'.$_GET['cedulin'].'","'.$_GET['telef1inq'].'","'.$_GET['telef2inq'].'",
                                                            "'.$_GET['emapropi'].'","'.$_GET['emainqil'].'"
															)');
			break;

		default:
			# code...
			break;
	}

 ?>
