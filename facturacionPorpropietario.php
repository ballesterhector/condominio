<?php
	require '../aplicacionesCondominio/php/session_start.php';

    require '../conectarBD/conectarCondominio.php';

	$obj= new conectarDB();
	$data= $obj->subconsulta("CALL deudaPorReciboTotal('".$_GET['numpropi']."','".$_GET['anos']."')");
	$totgasto=$data[0]['acobrar'];


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
					<h3 class="titulos" id="">Facturaciones efectuadas</h3>
					<div class="cuotaespe">
						<label for=""> Residencia
							<select class="form-control" style="width:100%" name="resid" id="resid" autocomplete="off">
								<option></option>
								<?php
									$obj = new conectarDB();
									$data = $obj->consultar("CALL residenciasSelect('0')");
									foreach($data as $key){
										echo "<option value='".$key['numcj']."'>".$key['nombrecj']."</option>";
									}
								?>
							</select>
						</label>
						<label for="" style="">
							<select class="form-control" title="" style="width:250px" name="propi" id="propi"></select>
						</label>
						<label for="" style="">
							<input type="text" id="anosbusca" class="btn btn-success" style="width:90px;text-align:center" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Indique año" value="<?php echo date('Y') ?>">
						</label>
						<label for="" style="margin-left:20px">
							<i class="fas fa-angle-double-right fa-2x" id="saltar"></i>
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
						<table class="table table-condensed table-bordered table-responsive display compact" id="dataTables">
							<thead>
								<tr class="bg-success">
									<th class="text-center">Residencia</th>
									<th class="text-center">Concepto</th>
									<th class="text-center">Recibo</th>
									<th class="text-center">Apartamento</th>
									<th class="text-center">Propietario</th>
									<th class="text-center">Periodo</th>
									<th class="text-center">Facturado</th>
									<th class="text-center">Total</th>
									<th class="text-center">Cobrado</th>
									<th class="text-center">Monto</th>
									<th class="text-center">Acción</th>
								</tr>
							</thead>
							<tfoot>
                                <tr>
									<th colspan="7" style="text-align:right">Total adeudado:</th>
									<th class="dt-right"><?php echo number_format($totgasto,2) ?></th>
									<th class="dt-right"></th>
									<th class="dt-right"></th>
									<th class="dt-right"></th>
								</tr>
                            </tfoot>
							<tbody>
								<?php
									$obj= new conectarDB();
									$data= $obj->subconsulta("CALL facturacionEvolucionPropietario('".$_GET['numpropi']."','".$_GET['anos']."')");
									$dat= json_encode($data);
									if ($dat=='null') {
										echo '';
									}else{
										foreach ($data as $filas) { ?>
											<?php if($filas['tot'] == 0) { ?>
												<tr>
													<td><?php echo $filas['nombrecj'] ?></td>
													<td><?php echo $filas['subconcepto'] ?></td>
													<td class="text-center"><?php echo str_pad($filas['numrecibo'], 7, "0", STR_PAD_LEFT) ?></td>
													<td><?php echo $filas['aptfactura'] ?></td>
													<td><?php echo $filas['propietario'] ?></td>
													<td align="center"><?php echo $filas['periodofact'] ?></td>
													<td align="right"><?php echo number_format($filas['acobrar'],2) ?></td>
													<td align="right"><?php echo number_format($filas['tot'],2) ?></td>
													<td align="right"><?php echo $filas['estado'] ?></td>
													<td align="right"><?php echo number_format($filas['cobradomonto'],2) ?></td>
													<td class="" align="center">
														<a href='javascript: onclick(facturacionEdoCuenta(<?php echo $filas['propietarionume'] ?>,<?php echo $filas['ano'] ?>))' class='fas fa-print fa-lg' aria-hidden="true" data-toggle="tooltip" data-placement="top" title='Estado de cuenta'></a>
													</td>
												</tr>
											<?php } else {?>
												<tr style="background:#D4F8FA">
													<td><?php echo $filas['nombrecj'] ?></td>
													<td><?php echo $filas['subconcepto'] ?></td>
													<td class="text-center"><?php echo str_pad($filas['numrecibo'], 7, "0", STR_PAD_LEFT) ?></td>
													<td><?php echo $filas['aptfactura'] ?></td>
													<td style="color:#D76B00;font-size:14px;text-align:right">Total a pagar</td>
													<td align="center"><?php echo $filas['periodofact'] ?></td>
													<td align="right"><?php echo number_format($filas['acobrar'],2) ?></td>
													<td style="color:#D76B00;font-size:14px" align="right"><?php echo number_format($filas['tot'],2) ?></td>
													<td align="right"><?php echo $filas['estado'] ?></td>
													<td align="right"><?php echo number_format($filas['cobradomonto'],2) ?></td>
													<td class="" align="center">
														<a href='javascript: onclick(facturacionEdoCuenta(<?php echo $filas['propietarionume'] ?>,<?php echo $filas['ano'] ?>))' class='fas fa-print fa-lg' aria-hidden="true" data-toggle="tooltip" data-placement="top" title='Estado de cuenta'></a>
													</td>
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
		<script src="../aplicacionesCondominio/js/facturacion.js"></script>
	</div>
	</body>
</html>