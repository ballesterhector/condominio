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
				<input type="hidden" value="<?php echo $estad ?>" id="estadoUsua">
				<div class="menu">
					<div class="logo">
						<a href="#"><img src="../aplicacionesCondominio/imagenes/asda.png" alt="" class="" style=""><sub>Condominio</sub></a>
					</div>
					<nav class="enlaces" id="enlaces">
						<?php include "../aplicacionesCondominio/nav/menuarriba.html" ?>
					</nav>
				</div>
				<div class="saludo">
					<h3 class="titulos" id="">Data residencias</h3>
					<div class="subsaludo">
						<a href="#" onclick="window.open('http:../aplicacionesCondominio/ayudas/residencias.pdf')" /><i class="fas fa-book fa-2x" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Manual"></i></a>
						<input type="button" name="nuevo" id="nuevo" class="btn btn-success " value="Nuevo">
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
								<th class="text-center">Código</th>
								<th class="text-center">Residencia</th>
								<th class="text-center">Dirección</th>
								<th class="text-center">RIF</th>
								<th class="text-center">Contacto</th>
								<th class="text-center">Cobrar por alicuota</th>
								<th class="text-center">Apartamentos</th>
								<th class="text-center">Acción</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$obj= new conectarDB();
								$data= $obj->subconsulta("CALL residenciasSelect('0')");
								$dat= json_encode($data);
								if ($dat=='null') {
									echo '';
								}else{
									foreach ($data as $filas) { ?>
										<tr>
											<td class="text-center"><?php echo str_pad($filas['numcj'], 7, "0", STR_PAD_LEFT) ?></td>
											<td><?php echo $filas['nombrecj'] ?></td>
											<td><?php echo $filas['direccioncj'] ?></td>
											<td><?php echo $filas['rifcj'] ?></td>
											<td><?php echo $filas['contactocj'] ?></td>
											<td style="width:100px;text-align:center"><?php echo $filas['cobraralicuota'] ?></td>
											<td style="width:10px;text-align:center"><?php echo $filas['totapartamentos'] ?></td>
											<td class="text-center ">
												<a href='javascript:modal(<?php echo $filas['numcj'] ?>)' class='glyphicon glyphicon-folder-open fa-lg' aria-hidden="true" data-toggle="tooltip" data-placement="top" title='Modificar'</a>
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
							<div class="modal-content">
								<div class="modal-header">
									<h3 class="modal-title fondoLs" id="myModalLabel"></h3>
								</div>
								<form id="formulario" class="form-horizontal" onsubmit="return agregarRegistro();">
									<div class="modal-body" style="margin-top: -10px">
										<input type="hidden" id="proceso" name="proceso">
										<input type="hidden" name="modificador" value="<?php echo $usuario ?>">
										<section class="modalempleados">
											<article class="">
												<div class="ladoA">
													<label for="" style="width:20%">
														<input type="text" class="form-control " name="codi" id="codi" placeholder="Código" readonly style="text-align:center">
													</label>
													<label for="" style="width:77%">
														<input type="text" class="form-control " name="resid" id="resid" placeholder="Residencia" style="" required="require" autocomplete="off">
													</label>
												</div>
												<div class="ladoA">
													<label for="" style="width:35%">
														<input type="text" class="form-control"  style="text-align:center"  name="rif" id="rif" placeholder="RIF" required="require" autocomplete="off">
													</label>
													<label for="" style="width:20%">
														<select class="form-control " name="alicu" id="alicu" required="require" data-toggle="tooltip" data-placement="top" title='Cobrar por alicuota' autocomplete="off">
															<option value="No">No</option>
															<option value="Si">Si</option>
														</select>
													</label>
													</label>
														<label for="" style="width:25%">
														<input type="number" class="form-control" style="text-align:center" name="numer" id="numer" placeholder="Apartamentos" required="require" autocomplete="off">
													</label>
												</div>
												<div class="ladoA">
													<label for="" style="width:100%">
														<input type="text" class="form-control " name="dire" id="dire" placeholder="Diección" required="require" autocomplete="off">
													</label>
												</div>
												<div class="ladoA">
													<label for="" style="width:100%">
														<input type="text" class="form-control " name="contac" id="contac" placeholder="Contacto" required="require" autocomplete="off">
													</label>
												</div>
												<div class="ladoA">
													<label for="" style="width:135px">
														<input type="text" class="form-control " name="telef1" id="telef1" pattern="[0-9]{4}-[0-9]{3}-[0-9]{4}" placeholder="Teléfono" data-toggle="tooltip" data-placement="top" title="Use formato 0XXX-XXX-XXXX" autocomplete="off">
													</label>
													<label for="" style="width:135px">
														<input type="text" class="form-control " name="telef2" id="telef2" pattern="[0-9]{4}-[0-9]{3}-[0-9]{4}" placeholder="Teléfono" data-toggle="tooltip" data-placement="top" title="Use formato 0XXX-XXX-XXXX" autocomplete="off">
													</label>
													<label for="" style="width:45%">
														<input type="email" class="form-control " name="email" id="email" placeholder="Email" autocomplete="off">
													</label>
												</div>
												<div class="subladoA">
													<label for="" style="width:100%" id="motivo">Motivo
														<input type="text" class="form-control " name="motiv" id="motiv"  autocomplete="off">
													</label>
												</div>
											</article>
										</section>
									</div>
									<div class="piemodal">
										<div class="boton">
											<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
										</div>
										<div class="submit">
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
		<script src="../aplicacionesCondominio/js/residencias.js"></script>
	</div>
	</body>
</html>