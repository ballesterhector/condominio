<?php
	require '../conectarBD/conectarCondominio.php';
	$obj= new conectarDB();

		switch ($_GET['proceso']) {
			case 'Registro':
				$data= $obj->actualizar('CALL facturacionPorAptInsert("'.$_GET['conjunto'].'","'.$_GET['perio'].'"
															)');
															
											
				$data= $obj->actualizar('CALL facturaciongastosSI("'.$_GET['conjunto'].'","'.$_GET['perio'].'"
															)');

				$data= $obj->actualizar('CALL  facturacionasignarnumFactura()');
														
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
			$data= $obj->subconsulta("CALL propietarioCJSelect('".$_GET['id_resid']."')");
				echo "<option>Seleccione el propietario</option>";
					foreach($data as $filas){
						echo "<option value='".$filas['propietanum']."'>".$filas['propietario']."  ".$filas['apartamento']."</option>";
					}
			break;
	}

 ?>
