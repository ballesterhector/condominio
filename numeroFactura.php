<?php
	require '../aplicacionesCondominio/php/session_start.php';
	
    require '../conectarBD/conectarCondominio.php';
	
	$obj= new conectarDB();
		$data= $obj->subconsulta("SELECT  ultimoAnoNumeroFactura() AS ultimoCE");
	       foreach ($data as $filas) { 
			$ultiano= $filas['ultimoCE'];
           }
		   
	$obj= new conectarDB();
		$data= $obj->subconsulta("SELECT   anobloqueo() AS anobloqueos");
	       foreach ($data as $filas) { 
			$bloqueo= $filas['anobloqueos'];
           }	   
	
		$anos=date("Y");
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
				<input type="hidden" value="<?php echo $ultiano.'/'.'01'.'/'.'01' ?>" name="fech" id="fech">
				
				<input type="hidden" value="<?php echo $ultiano ?>" name="anos1" id="anos1">
				<input type="hidden" value="<?php echo $ultiano -1?>" name="anoulti" id="anoulti">
				<input type="hidden" value="<?php echo $bloqueo ?>" name="bloquear" id="bloquear">
				
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
						<h3 class="titulos" id="respuesta">Generar números de facturas</h3>
					</div>
					<div class="buscar">
						<label for="" style="margin-left:10px">
							<input type="number" class="form-control" style="text-align:center;width:45%" name="peribusca" id="peribusca" autocomplete="off" placeholder="Año">
						</label>
						<label>
							<p style="margin-right:100px"> Último año registrado <?php echo $ultiano -1?> </p>
						</label>
					</div>
					<div class="subsaludo">
						<a href="#" onclick="window.open('http:../aplicacionesCondominio/ayudas/administracion.pdf')" /><i class="fas fa-book fa-2x" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Manual"></i></a>
						<input type="button" name="nuevo" id="nuevo" class="btn btn-success" value="Generar facturas">
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
								    <th class="text-center">Factura</th>
									<th class="text-center">Residencia</th>
									<th class="text-center">Propietario</th>
									<th class="text-center">Edificio</th>
									<th class="text-center">Apartamento</th>
									<th class="text-center">Periodo</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$obj= new conectarDB();
									$data= $obj->subconsulta("CALL numefacturaSelect('".$_GET['ano']."')");
									$dat= json_encode($data);
									if ($dat=='null') {
										echo '';
									}else{
										foreach ($data as $filas) { ?>
											<tr>
												<td class="text-center"><?php echo str_pad($filas['numerofactura'], 7, "0", STR_PAD_LEFT) ?></td>
												<td><?php echo $filas['nombrecj'] ?></td>
												<td><?php echo $filas['propietario'] ?></td>
												<td><?php echo $filas['edificio'] ?></td>
												<td><?php echo $filas['apartamento'] ?></td>
												<td align="center"><?php echo $filas['periodofactura'] ?></td>
											</tr>
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
		<script src="../aplicacionesCondominio/js/numerofactura.js"></script>
	</div>
	</body>
</html>