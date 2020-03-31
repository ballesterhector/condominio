<?php
	require '../aplicacionesCondominio/php/session_start.php';

    require '../conectarBD/conectarCondominio.php';

    $obj = new conectarDB();
	$data = $obj->consultar("CALL gastosConsultaAcobrar('".$_GET['coju']."','".$_GET['period']."')");
		$totgasto=$data[0]['tot'];

	$obj = new conectarDB();
	$data = $obj->consultar("CALL gastosConsultaAcobrarPropietario('".$_GET['coju']."','".$_GET['period']."')");
		$facturado=$data[0]['facturad'];
?>

<!DOCTYPE html>
<html lang="es">

	<head>
		<meta charset="UTF-8">
		<meta name="description" content="Aplicación para control de condominios">
		<meta name="keywords" content="asda">
		<meta name="author" content="Ballester Héctor @ballesterhector">
		<meta name="viewport" content="width=device-width, user-scalable=0,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0">
		<title>ASDA On Line</title>
		<link rel="stylesheet" type="text/css" href="../aplicacionesCondominio/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../aplicacionesCondominio/css/bootstrap-submenu.min.css">
		<link rel="stylesheet" type="text/css" href="../aplicacionesCondominio/font-awesome/css/fontawesome-all.css">
		<link rel="stylesheet" type="text/css" href="../aplicacionesCondominio/css/jquery.dataTables.min.css">
		<link rel="stylesheet" type="text/css" href="../aplicacionesCondominio/css/dataTables.bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../aplicacionesCondominio/css/sweetalert.css">
		<link rel="stylesheet" type="text/css" href="../aplicacionesCondominio/css/estilosCondominio.css">
	</head>
	<body>
		<div class="contenedor">
			<header>
				<input type="hidden" value="<?php echo $usuario ?>" name="usuar" id="usuar">
				<div class="menu">
					<div class="logo">
						<a href="#"><img src="../aplicacionesCondominio/imagenes/asda.png" alt="" class="" style=""><sub>Condominio</sub></a>
					</div>
					<nav class="enlaces" id="enlaces">
						<?php include "../aplicacionesCondominio/nav/menuarriba.html" ?>
					</nav>
				</div>
				<div class="saludo">
				    <div>
				        <h3 class="titulos" id="">Gastos por propietarios</h3>
				    </div>

					<div class="buscar">
						<label for="">
							<select class="form-control" style="" name="cjbusca" id="cjbusca" autocomplete="off">
								<option>Residencia</option>
								<?php
									$obj = new conectarDB();
									$data = $obj->consultar("CALL residenciasSelect('0')");
									foreach($data as $key){
										echo "<option value='".$key['numcj']."'>".$key['nombrecj']."</option>";
									}
								?>
							</select>
						</label>
						<label for="" style="margin-left:10px">
							<input type="text" class="form-control" style="text-align:center;width:45%" name="peribuscaapt" id="peribuscaapt" autocomplete="off" pattern="(0[1-9]|1[012])[/](\d{4})" placeholder="Periodo" aria-hidden="true" data-toggle="tooltip" data-placement="top" title='Formato MM/AAAA' >
						</label>
					</div>
					<div class="subsaludo">
						<a href="#" onclick="window.open('http:../aplicacionesCondominio/ayudas/facturacion.pdf')" /><i class="fas fa-book fa-2x" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Manual"></i></a>
					</div>
				</div>
			</header>
			<div id="main">
				<nav>
					<?php include "../aplicacionesCondominio/nav/menuizquierda.html" ?>
				</nav>
				<article class="contenedor2">
					<div class="tabla">
						<table class="table table-condensed table-bordered table-responsive display compact" style="font-size:11px" id="dataTables">
							<thead>
								<tr class="bg-success">
									<th class="text-center">Correlativo</th>
									<th class="text-center">Residencia</th>
									<th class="text-center">Viviendas</th>
									<th class="text-center">Propietario</th>
									<th class="text-center">Vivienda</th>
									<th class="text-center">Factura</th>
									<th class="text-center">Proveedor</th>
									<th class="text-center">Periodo</th>
									<th class="text-center">Gasto</th>
									<th class="text-center">A cancelar</th>
								</tr>
							</thead>
							<tfoot>
                                <tr>
                                    <th colspan="7" style="text-align:right">Total gasto:</th>
                                    <th></th>
                                	<th class="dt-right"><?php echo number_format($totgasto,2) ?></th>
                                	<th></th>
                                </tr>
                               <tr>
                                    <th colspan="8" style="text-align:right">Total por propietario:</th>
                                    <th></th>
                                	<th class="dt-right"><?php echo number_format($facturado,2) ?></th>
                                	<th></th>
                                </tr>
                            </tfoot>
							<tbody>
								<?php
									$obj= new conectarDB();
									$data= $obj->subconsulta("CALL gastosConsultaPropietarios('".$_GET['coju']."','".$_GET['period']."')");
									$dat= json_encode($data);
									if ($dat=='null') {
										echo '';
									}else{
										foreach ($data as $filas) { ?>
											<?php if($filas['totalfactura']>0) { ?>
											    <tr style="background:#D4F8FA">
                                                    <td><?php echo $filas['numgasto'] ?></td>
                                                    <td><?php echo $filas['nombrecj'] ?></td>
                                                    <td style="padding-left:30px"><?php echo $filas['totapartamentos'] ?></td>
                                                    <td><?php echo $filas['propietario'] ?></td>
													<td><?php echo $filas['apt'] ?></td>
                                                    <td class="text-center"><?php echo $filas['facturagast'] ?></td>
                                                    <td><?php echo $filas['proveedor'] ?></td>
                                                    <td align="center"><?php echo $filas['periodo'] ?></td>
                                                    <td class="dt-right"><?php echo number_format($filas['totalfactura'],2) ?></td>
                                                    <td align="right"><?php echo $filas['condominio'] ?></td>
                                                </tr>
											<?php } else { ?>
											    <tr>
                                                    <td><?php echo $filas['numgasto'] ?></td>
                                                    <td><?php echo $filas['nombrecj'] ?></td>
                                                    <td><?php echo $filas['totapartamentos'] ?></td>
                                                    <td><?php echo $filas['propietario'] ?></td>
													<td><?php echo $filas['apt'] ?></td>
                                                    <td class="text-center"><?php echo $filas['facturagast'] ?></td>
                                                    <td><?php echo $filas['proveedor'] ?></td>
                                                    <td align="center"><?php echo $filas['periodo'] ?></td>
                                                    <td align="center"><?php echo $filas['totalfactura'] ?></td>
                                                    <td align="right"><?php echo number_format($filas['condominio'],2) ?></td>
                                                </tr>
											<?php } ?>
									<?php } ?>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</article>
			</div>
	    	<footer class="dat">
				<script>
					var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
					var diasSemana = new Array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
					var f=new Date();
					document.write(diasSemana[f.getDay()] + ", " + f.getDate() + " de " + meses[f.getMonth()] + " de " + f.getFullYear());
				</script>
			</footer>
		</div>
	<div>
		<script src="../aplicacionesCondominio/js/jquery-3.2.1.min.js"></script>
		<script src="../aplicacionesCondominio/js/bootstrap.min.js"></script>
		<script src="../aplicacionesCondominio/js/bootstrap-submenu.min.js"></script>
		<script src="../aplicacionesCondominio/js/jquery.dataTables.min.js"></script>
		<script src="../aplicacionesCondominio/js/dataTables.bootstrap.min.js"></script>
		<script src="../aplicacionesCondominio/js/sweetalert.min.js"></script>
		<script src="../aplicacionesCondominio/js/jsConstantes.js"></script>
		<script src="../aplicacionesCondominio/js/gastos.js"></script>
	</div>
	</body>
</html>