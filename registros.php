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
					<h3 class="titulos" id="">Data propietarios registrados</h3>
					<div class="subsaludo">
						<a href="#" onclick="window.open('http:../aplicacionesCondominio/ayudas/propietarios.pdf')" /><i class="fas fa-book fa-2x" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Manual"></i></a>
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
									<th class="text-center">Residencia</th>
									<th class="text-center">Registro</th>
									<th class="text-center">Edificio</th>
									<th class="text-center">Propietario</th>
									<th class="text-center">Apartamento</th>
									<th class="text-center">Teléfono</th>
									<th class="text-center">Acción</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$obj= new conectarDB();
									$data= $obj->subconsulta("CALL propietarioSelect('0')");
									$dat= json_encode($data);
									if ($dat=='null') {
										echo '';
									}else{
										foreach ($data as $filas) { ?>
											<tr>
												<td><?php echo $filas['nombrecj'] ?></td>
												<td align="center"><?php echo date("d-m-Y",strtotime($filas['registrado'])) ?></td>
												<td><?php echo $filas['edificio'] ?></td>
												<td><?php echo $filas['propietario'] ?></td>
												<td><?php echo $filas['apartamento'] ?></td>
												<td><?php echo $filas['telefonoP1'] ?></td>
												<td class="text-center icono">
													<a href='javascript:modal(<?php echo $filas['propietanum'] ?>)' class='glyphicon glyphicon-folder-open fa-lg' aria-hidden="true" data-toggle="tooltip" data-placement="top" title='Modificar'</a>
													<a href='javascript: onclick(fichatecnica(<?php echo $filas['propietanum'] ?>))' class='fas fa-print fa-2x' aria-hidden="true" data-toggle="tooltip" data-placement="top" title='Ficha técnica'</a>
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
								<div class="respuesta" id="respuesta"></div>
							</div>
							<form id="formulario" class="form-horizontal" onsubmit="return agregarRegistro();">
								<div class="modal-body">
									<input type="hidden" id="proceso" name="proceso">
									<input type="hidden" name="modificador" value="<?php echo $usuario ?>">
									<section class="modalempleados">
										<article class="">
											<div class="ladoA">
												<label for="" class="" style="width:25%;">
													<input type="text" class="form-control " name="numer" id="numer" placeholder="Código" readonly style="text-align:center">
												</label>
												<label for="" style="width:25%">
													<input type="text" class="form-control" name="edif" id="edif" placeholder="Edificio" style="text-align:center" required="require" autocomplete="off">
												</label>
												<label for="" style="width:27%">
													<input type="text" class="form-control" name="apt" id="apt" placeholder="Apartamento" style="text-align:center" required="require" autocomplete="off">
												</label>
												<label for="" style="width:20%">
													<input type="text" class="form-control " name="alicuota" id="alicuota" placeholder="Alicuota" style="text-align:center" required="require" autocomplete="off">
												</label>
											</div>
											<div class="ladoA">
												<label for="" style="margin-left:5px;">
													<select class="form-control" name="conjunto" id="conjunto" required="require" autocomplete="off">
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
												<label for="" style="margin-left:5px;width:50%">
													<input type="text" class="form-control " name="propi" id="propi" placeholder="Propietario" required="require" autocomplete="off">
												</label>
											</div>
											<div class="ladoA">
												<label for="">
													<input type="number" class="form-control" style="width:100px" name="cedul" id="cedul" placeholder="Cedula/RIF" required="require" autocomplete="off">
												</label>
												<label for="" style="">
													<input type="text" class="form-control" style="width:122px" name="telef1" id="telef1" pattern="[0-9]{4}-[0-9]{3}-[0-9]{4}" placeholder="Teléfono" data-toggle="tooltip" data-placement="top" title="Use formato 0XXX-XXX-XXXX" autocomplete="off">
												</label>
												<label for="" style="">
													<input type="tel" class="form-control" style="width:122px" name="telef2" id="telef2" pattern="[0-9]{4}-[0-9]{3}-[0-9]{4}" placeholder="Teléfono" data-toggle="tooltip" data-placement="top" title="Use formato 0XXX-XXX-XXXX" autocomplete="off">
												</label>
												<label for="" style="">
													<input type="email" class="form-control" style="width:162px" name="emapropi" id="emapropi" placeholder="Email" >
												</label>
											</div>
											<div class="ladoA">
												<label for="" style="width:100%">
													<input type="text" class="form-control " name="inqil" id="inqil" placeholder="Inquilino" >
												</label>
											</div>
											<div class="ladoA">
												<label for="">
													<input type="number" class="form-control" style="width:100px" name="cedulin" id="cedulin" value="0" data-toggle="tooltip" data-placement="top" title="Ingrese Cedula/RIF" autocomplete="off">
												</label>
												<label for="" style="margin-left:5px">
													<input type="text" class="form-control" style="width:122px" name="telef1inq" id="telef1inq" placeholder="Teléfono" pattern="[0-9]{4}-[0-9]{3}-[0-9]{4}" placeholder="Teléfono" data-toggle="tooltip" data-placement="top"  title="Use formato 0XXX-XXX-XXXX" autocomplete="off">
												</label>
												<label for="" style="margin-left:5px">
													<input type="tel" class="form-control" style="width:122px" name="telef2inq" id="telef2inq" placeholder="Teléfono" pattern="[0-9]{4}-[0-9]{3}-[0-9]{4}" placeholder="Teléfono" data-toggle="tooltip" data-placement="top"  title="Use formato 0XXX-XXX-XXXX" autocomplete="off">
												</label>
												<label for="" style="">
													<input type="email" class="form-control" style="width:162px" name="emainqil" id="emainqil" placeholder="Email" >
												</label>
											</div>
											<div class="subladoA">
												<label for="" style="width:100%" id="motivo">
													<input type="text" class="form-control " name="motiv" id="motiv" placeholder="Motivo" autocomplete="off">
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
		<script src="../aplicacionesCondominio/js/registros.js"></script>
	</div>
	</body>
</html>