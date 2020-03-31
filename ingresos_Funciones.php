<?php
	require '../conectarBD/conectarCondominio.php';
	$obj= new conectarDB();

		switch ($_GET['proceso']) {
			case 'Registro':
				$data= $obj->actualizar('CALL ingresosInsert("'.$_GET['min'].'","'.$_GET['cuotas'].'","'.$_GET['inicio'].'",
                                                             "'.$_GET['resid'].'","'.$_GET['edif'].'","'.$_GET['motivo'].'",
                                                             "'.$_GET['monto'].'","'.$_GET['ultcorrel'].'"
															)');
			break;
			
			case 'facturar':
				$data = $obj->actualizar('CALL facturacionPorAptInsertIng("'.$_GET['cjto'].'")');
				
				$data= $obj->actualizar('CALL  facturacionasignarnumFactura()');
                
                $data = $obj->actualizar('CALL facturacionINGfacturado("'.$_GET['cjto'].'")');
                
			break;

			case 'Modifica':
				$data= $obj->actualizar('CALL proveedorUpdate("'.$_GET['numer'].'","'.$_GET['telef1'].'","'.$_GET['telef2'].'",
															"'.$_GET['corre'].'","'.$_GET['motiv'].'"
															)');
			break;

			default:		
				$data= $obj->subconsulta("CALL propietarioCJEdifSelect('".$_GET['id_resid']."')");
				echo "<option>Seleccione el edificio</option>";
					foreach($data as $filas){
						echo "<option value='".$filas['edificio']."'>Edificio-".$filas['edificio']."</option>";
					}
			break;
	}

 ?>
