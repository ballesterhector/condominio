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
					<h3 class="titulos" id="respuesta">Registro de gastos de condominio</h3>
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
					<div class="sub1">
						<form id="formulario" class="form-horizontal" onsubmit="return agregarRegistro();">
							<div class="subladotop">
								<input type="hidden" id="proceso" name="proceso" value="Registro">
								<input type="hidden" name="modificador" value="<?php echo $usuario ?>">
								<label for="" class="">Fecha
									<input type="date" class="form-control " name="fech" id="fech" required="require">
								</label>
								<label for="" style=""> Residencia
									<select class="form-control" name="conjunto" id="conjunto" required="require" autocomplete="off">
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
								<label for="" style=""> Proveedor
									<select class="form-control" name="provee" id="provee" style="width:230px" required="require" autocomplete="off">
										<option></option>
										<?php
											$obj = new conectarDB();
											$data = $obj->consultar("CALL proveedorSelect('0')");
											foreach($data as $key){
												echo "<option value='".$key['numprovee']."'>".$key['proveedor']."</option>";
											}
										?>
									</select>
								</label>							
								<label for="" class="">Factura
									<input type="text" class="form-control " name="factu" id="factu" style="width:100px" required="require" autocomplete="off">
								</label>
								<label for="" class="">Periodo
									<input type="text" class="form-control " name="period" id="period" style="width:90px;text-align:center" required="require"pattern="(0[1-9]|1[012])[/](\d{4})" placeholder=" mm/aaaa" data-toggle="tooltip" data-placement="top" title='Formato MM/AAAA' autocomplete="off">
								</label>
								<label for="" class="">Total Gasto
									<input type="text" class="form-control " name="totg" id="totg" style="width:100px;text-align:center" required="require" autocomplete="off">
								</label>
								<label>
									<div class="submit">
										<input type="submit" value="Reg" class="btn btn-success" style="width:40px;height:34px;margin:15px 0 0 5px;padding:0px" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Registrar data" id="reg" />
									</div>
								</label>
							</div>
						</form>
					</div>
					<div class="sub2">
						<table class="table table-condensed table-bordered table-responsive display compact" id="dataTables">
							<thead>
								<tr class="bg-success">
									<th class="text-center">Código</th>
									<th class="text-center">Fecha</th>
									<th class="text-center">Periodo</th>
									<th class="text-center">Compra</th>
									<th class="text-center">Ejecutado</th>
									<th class="text-center">Por ejecutar</th>
									<th class="text-center">Acción</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$obj= new conectarDB();
									$data= $obj->subconsulta("CALL gastosSelectEjecutado()");
									$dat= json_encode($data);
									if ($dat=='null') {
										echo '';
									}else{
										foreach ($data as $filas) { ?>
											<tr>
												<td align="center"><?php echo str_pad($filas['numgasto'], 7, "0", STR_PAD_LEFT) ?></td>
												<td align="center"><?php echo date("d-m-Y",strtotime($filas['fechagast']))?></td>
												<td align="center"><?php echo $filas['periodo'] ?></td>
												<td align="right"><?php echo number_format($filas['totalfactura'],2) ?></td>
												<td align="right"><?php echo number_format($filas['ejecutado'],2) ?></td>
												<td align="right"><?php echo number_format($filas['dife'],2) ?></td>
												<td align="center">
												<?php if($filas['dife'] >0){?>
													<a href='javascript: onclick(location.href="gastos2.php?numRegistro=" + <?php echo $filas['numgasto'] ?>)' class='glyphicon glyphicon-folder-open fa-lg' aria-hidden="true" data-toggle="tooltip" data-placement="top" title='Ejecutar gasto'</a>
												<?php }?>
												</td>
											</tr>
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
		<script src="../aplicacionesCondominio/js/gastos.js"></script>
	</div>
	</body>
</html>