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
					<h3 class="titulos" id="respuesta">Cuota especial por apartamento</h3>
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
						<a href="#" onclick="window.open('http:../aplicacionesCondominio/ayudas/residencias.pdf')" /><i class="fas fa-book fa-2x" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Manual"></i></a>
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
								<tr class="bg-success" style="font-size:10px">
									<th class="text-center">Códigoa</th>
									<th class="text-center">Código CE</th>
									<th class="text-center">Concepto</th>
									<th class="text-center">Residencia</th>
									<th class="text-center">Edificio</th>
									<th class="text-center">Apartamento</th>
									<th class="text-center">propietario</th>
									<th class="text-center">Periodos</th>
									<th class="text-center">Periodos</th>
									<th class="text-center">Monto</th>
									<th class="text-center">Facturado</th>

								</tr>
							</thead>
							<tbody style="font-size:10px">
								<?php
									$obj= new conectarDB();
									$data= $obj->subconsulta("CALL gastosCEPropietariosAno('".$_GET['numpropi']."','".$_GET['anos']."')");
									$dat= json_encode($data);
									$totalU=0;
									if ($dat=='null') {
										echo '';
									}else{
										foreach ($data as $filas) { ?>
											<?php if ($filas['facturado']=='Si') { ?>
												<tr style="background: #D3F2FA">
													<td class="text-center"><?php echo $filas['codigoCEPer'] ?></td>
													<td class="text-center"><?php echo str_pad($filas['codigoCEPer'], 7, "0", STR_PAD_LEFT) ?></td>
													<td><?php echo $filas['motivoCEPer'] ?></td>
													<td><?php echo $filas['nombrecj'] ?></td>
													<td class="text-center"><?php echo $filas['edificioCEPer'] ?></td>
													<td class="text-center"><?php echo $filas['apartamento'] ?></td>
													<td class=""><?php echo $filas['propietario'] ?></td>
													<td class="text-center"><?php echo $filas['periodoPer'] ?></td>
													<td class="text-center"><?php echo $filas['periodoPer'] ?></td>
													<td class="dt-right"><?php echo number_format($filas['montoPer'],2) ?></td>
													<td class="text-center"><?php echo $filas['facturado'] ?></td>
												</tr>
											<?php } else { ?>
												<tr style="background: #FAA35C">
													<td class="text-center"><?php echo $filas['codigoCEPer'] ?></td>
													<td class="text-center"><?php echo str_pad($filas['codigoCEPer'], 7, "0", STR_PAD_LEFT) ?></td>
													<td><?php echo $filas['motivoCEPer'] ?></td>
													<td><?php echo $filas['nombrecj'] ?></td>
													<td class="text-center"><?php echo $filas['edificioCEPer'] ?></td>
													<td class="text-center"><?php echo $filas['apartamento'] ?></td>
													<td class=""><?php echo $filas['propietario'] ?></td>
													<td class="text-center"><?php echo $filas['periodoPer'] ?></td>
													<td class="text-center"><?php echo $filas['periodoPer'] ?></td>
													<td class="dt-right"><?php echo number_format($filas['montoPer'],2) ?></td>
													<td class="text-center"><?php echo $filas['facturado'] ?></td>
												</tr>
										<?php } ?>
									<?php } ?>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</article>
			</div><!--fin del main-->
			<footer class="dat">
				<script>
					var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
					var diasSemana = new Array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
					var f=new Date();
					document.write(diasSemana[f.getDay()] + ", " + f.getDate() + " de " + meses[f.getMonth()] + " de " + f.getFullYear());
				</script>
			</footer>
		</div><!--fin del contenedor-->
	<div>
		<script src="../aplicacionesCondominio/js/jquery-3.2.1.min.js"></script>
		<script src="../aplicacionesCondominio/js/bootstrap.min.js"></script>
		<script src="../aplicacionesCondominio/js/bootstrap-submenu.min.js"></script>
		<script src="../aplicacionesCondominio/js/jquery.dataTables.min.js"></script>
		<script src="../aplicacionesCondominio/js/dataTables.bootstrap.min.js"></script>
		<script src="../aplicacionesCondominio/js/sweetalert.min.js"></script>
		<script src="../aplicacionesCondominio/js/jsConstantes.js"></script>
		<script src="../aplicacionesCondominio/js/cuotaespecialpropi.js"></script>
	</div>
	</body>
</html>