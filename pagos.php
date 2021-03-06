<?php
	require '../aplicacionesCondominio/php/session_start.php';

    require '../conectarBD/conectarCondominio.php';


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
					<h3 class="titulos" id="">Registrar pagos</h3>
					<div class="buscar">
						<label for="">
							<select class="form-control" style="" name="cjbusca" id="cjbusca" autocomplete="off">
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
						<label for="" style="margin-left:10px">
							<input type="text" class="form-control" style="text-align:center;width:48%" name="peribusca" id="peribusca" autocomplete="off" pattern="(0[1-9]|1[012])[/](\d{4})" placeholder="Periodo" aria-hidden="true" data-toggle="tooltip" data-placement="top" title='Formato MM/AAAA' >
						</label>
					</div>
					<div class="subsaludo">
						<a href="#" onclick="window.open('http:../aplicacionesCondominio/ayudas/ingresos.pdf')" /><i class="fas fa-book fa-2x" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Manual"></i></a>
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
									<th class="text-center">Facturación</th>
									<th class="text-center">Periodo</th>
									<th class="text-center">Facturado</th>
									<th class="text-center">Cobrado</th>
									<th class="text-center">Monto</th>
									<th class="text-center">Acción</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$obj= new conectarDB();
									$data= $obj->subconsulta("CALL deudasPorPagar('".$_GET['coju']."','".$_GET['period']."')");
									$dat= json_encode($data);
									if ($dat=='null') {
										echo '';
									}else{
										foreach ($data as $filas) { ?>
											<tr>
												<td><?php echo $filas['nombrecj'] ?></td>
												<td><?php echo $filas['concepto'] ?></td>
												<td class="text-center"><?php echo str_pad($filas['numrecibo'], 7, "0", STR_PAD_LEFT) ?></td>
												<td><?php echo $filas['aptfactura'] ?></td>
												<td><?php echo $filas['propietario'] ?></td>
												<td align="center"><?php echo date("d-m-Y",strtotime($filas['fechafactu'])) ?></td>
												<td align="center"><?php echo $filas['periodofact'] ?></td>
												<td align="right"><?php echo number_format($filas['acobrar'],2) ?></td>
													<?php if($filas['cobradomonto']==0){ ?>
														<td style="color:red; text-align:center">Adeudado</td>
													<?php } else{ ?>
														<td align="center"><?php echo date("d-m-Y",strtotime($filas['cobradofecha'])) ?></td>
													<?php }?>
												<td align="right"><?php echo number_format($filas['cobradomonto'],2) ?></td>
												<td class="icono">
													<?php if($filas['cobradomonto']==0){ ?>
														<a href='javascript:nuevo(<?php echo $filas['numrecibo'] ?>)' class='fab fa-amazon-pay fa-2x' aria-hidden="true" data-toggle="tooltip" data-placement="top" title='Registrar pago'></a>
														<a href='javascript: onclick(facturacionFactura(<?php echo $filas['numrecibo'] ?>))' class='fas fa-print fa-2x' aria-hidden="true" data-toggle="tooltip" data-placement="top" title='Recibo de pago'></a>
													<?php } else{ ?>
													<a></a>
														<a href='javascript: onclick(facturacionFactura(<?php echo $filas['numrecibo'] ?>))' class='fas fa-print fa-2x' aria-hidden="true" data-toggle="tooltip" data-placement="top" title='Recibo de pago'></a>
													<?php }?>
												</td>
											</tr>
									<?php } ?>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</article>
			</div>
	<!--Inicio modal nuevo-->
			<div class="form-group">
				<div class="modal fade" id="abreModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog ">
						<div class="modal-content modal-lg">
							<div class="modal-header bg-info " style="height:90px">
								<h3 class="modal-title fondoLs" id="myModalLabel"></h3>
								<div class="respuesta" id="respuesta"></div>
							</div>
							<form id="formulario" class="form-horizontal" onsubmit="return agregarRegistro();">
								<div class="modal-body" align="center">
									<input type="hidden" id="proceso" name="proceso">
									<input type="hidden" name="modificador" value="<?php echo $usuario ?>">
									<input type="hidden" name="recibonum" id="recibonum">
									<section class="modalProductos">
										<article class="ladoA">
											<div id="subladotop">
												<label for=""> Residencia
													<select class="form-control" style="width:100%" name="conjuntoselect" id="conjuntoselect" disabled="true">
														<option></option>
														<?php
															$obj = new conectarDB();
															$data = $obj->consultar("CALL residenciasSelect('0')");
															foreach($data as $key){
																echo "<option value='".$key['numcj']."'>".$key['nombrecj']."</option>";
															}
														?>
													</select>
													<input type="hidden" id="conjunto" name="conjunto">
												</label>
												<label for="" style="margin-left:10px">Propietario
													<select class="form-control" style="width:100%" name="propieselect" id="propieselect" disabled="true">
														<option></option>
														<?php
															$obj = new conectarDB();
															$data = $obj->consultar("CALL propietarioSelect('0')");
															foreach($data as $key){
																echo "<option value='".$key['propietanum']."'>".$key['propietario']."</option>";
															}
														?>
													</select>
													<input type="hidden" id="propie" name="propie">
												</label>
												<label for="" style="margin-left:10px">Edificio
													<input type="text" class="form-control" style="text-align:center;width:100px" name="edf" id="edf" autocomplete="off" readonly>
												</label>
												<label for="" style="margin-left:10px">Apartamento
													<input type="text" class="form-control" style="text-align:center;width:100px" name="apta" id="apta" autocomplete="off" readonly>
												</label>

												<label for="" style="margin-left:10px">Periodo
													<input type="text" class="form-control" style="text-align:center;width:100px" name="perio" id="perio" autocomplete="off" readonly>
												</label>
												<label for="" style="margin-left:10px">Fecha factura
													<input type="text" class="form-control" style="text-align:center;width:100px" name="fechafact" id="fechafact" readonly>

												</label>
												<label for="" style="margin-left:10px">Adeudado
													<input type="text" class="form-control" style="text-align:center;width:115px" name="" id="cobro2" readonly>
													<input type="hidden" class="form-control" style="text-align:center;width:115px" name="cobro" id="cobro">
												</label>
												<label for="" style="">Concepto
													<input type="text" class="form-control" style="width:410px" name="Subconcepto" id="Subconcepto" value="Cancelación cuota de condominio" readonly>
												</label>

											</div>
										</article>
									</section>
								</div>
								<div class="piemodal bg-success" style="">
									<div class="boton">
										<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									</div>
									<div class="">
										<input type="submit" value="" class="btn btn-success" id="reg" />
									</div>
								</div>
							</form>
						</div>
						<!--fin modal-content-->
					</div>
					<!--fin modal-dialog-->
				</div>
				<!--fin modal-fade-->
			</div>
				<!--Fin modal nuevo-->

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
		<script src="../aplicacionesCondominio/js/pagos.js"></script>
	</div>
	</body>
</html>