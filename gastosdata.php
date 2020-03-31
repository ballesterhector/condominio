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
					<h3 class="titulos" id="respuesta">Gastos de condominio</h3>
					<div class="subsaludo">
						<a href="#" onclick="window.open('http:../aplicacionesCondominio/ayudas/gastos.pdf')" /><i class="fas fa-book fa-2x" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Manual"></i></a>
					    <a href="gastosconsulta.php?coju=1&period=02/2014"><i class="fas fa-angle-double-right fa-2x" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Consulta de gastos"></i></a>
					</div>
				</div>
			</header>
			<div id="main">
				<nav>
					<?php include "../aplicacionesCondominio/nav/menuizquierda.html" ?>
				</nav>
				<article class="contenedorgasto">
					<div class="">
						<table class="table table-condensed table-bordered table-responsive display compact" id="dataTables">
							<thead>
								<tr class="bg-success">
									<th class="text-center">Residencia</th>
									<th class="text-center">Proveedor</th>
									<th class="text-center">Proveedor</th>
									<th class="text-center">Código</th>
									<th class="text-center">Fecha</th>
									<th class="text-center">Periodo</th>
									<th class="text-center">Gasto</th>
									<th class="text-center">Facturado</th>
									<th class="text-center">Fecha</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$obj= new conectarDB();
									$data= $obj->subconsulta("CALL gastosSelect('0')");
									$dat= json_encode($data);
									if ($dat=='null') {
										echo '';
									}else{
										foreach ($data as $filas) { ?>
											<?php if ($filas['facturado']=='Si'){ ?>
												<tr style="background: #D3F2FA">
												    <td align=""><?php echo $filas['nombrecj'] ?></td>
													<td align=""><?php echo $filas['proveedor'] ?></td>
													<td align=""><?php echo $filas['proveedor'] ?></td>
													<td align="center"><?php echo str_pad($filas['numgasto'], 7, "0", STR_PAD_LEFT) ?></td>
													<td align="center"><?php echo date("d-m-Y",strtotime($filas['fechagast']))?></td>
													<td align="center"><?php echo $filas['periodo'] ?></td>
													<td align="right"><?php echo number_format($filas['totalfactura'],2) ?></td>
													<td align="center"><?php echo $filas['facturado'] ?></td>
													<td align="center"><?php echo date("d-m-Y",strtotime($filas['fechafacturado']))?></td>
												</tr>
											<?php }else { ?>
												<tr style="background: #FAA35C">
												    <td align=""><?php echo $filas['nombrecj'] ?></td>
													<td align=""><?php echo $filas['proveedor'] ?></td>
													<td align=""><?php echo $filas['proveedor'] ?></td>
													<td align="center"><?php echo str_pad($filas['numgasto'], 7, "0", STR_PAD_LEFT) ?></td>
													<td align="center"><?php echo date("d-m-Y",strtotime($filas['fechagast']))?></td>
													<td align="center"><?php echo $filas['periodo'] ?></td>
													<td align="right"><?php echo number_format($filas['totalfactura'],2) ?></td>
													<td align="center"><?php echo $filas['facturado'] ?></td>
													<td align="center"><?php echo date("d-m-Y",strtotime($filas['fechafacturado']))?></td>
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
		<script src="../aplicacionesCondominio/js/gastosdata.js"></script>
	</div>
	</body>
</html>