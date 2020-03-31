		<?php
	require '../aplicacionesCondominio/php/session_start.php';
	
    require '../conectarBD/conectarCondominio.php';

    $obj= new conectarDB();
		$data= $obj->subconsulta("SELECT   ultimoIngreso() AS ultimoCE");
	       foreach ($data as $filas) { 
             $ultcorrelativo= $filas['ultimoCE'];
           } 

    $obj= new conectarDB();
		$data= $obj->subconsulta("SELECT   ultimoIngreso2() AS ultimoCE");
	       foreach ($data as $filas) { 
             $ultcorrelativo2= $filas['ultimoCE'];
           } 

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
					<div>
						<h3 class="titulos" id="respuesta">Data ingresos</h3>
					</div>
					<div class="buscar">
						<label for="">
							<select class="form-control" style="width:100%" name="cjbusca" id="cjbusca" autocomplete="off">
								<option value="0">Residencia</option>
								<?php
									$obj = new conectarDB();
									$data = $obj->consultar("CALL residenciasSelect('0')");
									foreach($data as $key){
										echo "<option value='".$key['numcj']."'>".$key['nombrecj']."</option>";
									}
								?>
							</select>
						</label>
						<label>
							<input type="button" name="chec" id="chec" class="btn btn-info " value="Facturar">
						</label>
					</div>
					<div class="subsaludo">
						<a href="#" onclick="window.open('http:../aplicacionesCondominio/ayudas/residencias.pdf')" /><i class="fas fa-book fa-2x" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Manual"></i></a>
						<input type="button" name="detaapt" id="detaapt" class="btn btn-success " value="Detalle por apartamento">
					</div>
				</div>
			</header>
			<div id="main">
				<nav>
					<?php include "../aplicacionesCondominio/nav/menuizquierda.html" ?>
				</nav>
				<article class="contenedor2">
					<div class="CE1">
						<!--Registro del detalle factura-->
						<form id="formulario" class="form-horizontal" onsubmit="return agregarRegistro();">
							
								<input type="hidden" id="proceso" name="proceso" value="Registro">
								<input type="hidden" id="min" name="min" value="1">
								<input type="hidden" id="min" name="ultcorrel" value="<?php echo $ultcorrelativo ?>">
								<input type="hidden" name="modificador" value="<?php echo $usuario ?>">
								<label for="" style=""> 
									<select class="form-control" name="resid" id="resid" required="require" autocomplete="off">
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
								<label for="" style="">
									<select class="form-control" title="" style="width:250px" name="edif" id="edif"></select>
								</label>
								
								<label for="" class="">Cuotas
									<input type="numbre" class="form-control " name="cuotas" id="cuotas" style="width:60px;text-align:center" value="1" required="require">
								</label>
								<label for="" class="">Monto
									<input type="text" class="form-control dif" name="monto" id="monto" style="width:100px;text-align:center" required="require" autocomplete="off">
								</label>
								<label for="" class="">Inicio
									<input type="date" class="form-control " name="inicio" id="inicio" style="" required="require">
								</label>
								<label for="" class="" >Concepto
									<input type="text" class="form-control dif" name="motivo" id="motivo" style="width:240px" required="require" autocomplete="off">
								</label>
								<label>
									<input type="submit" value="Reg" class="btn btn-success" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Registrar data" id="reg" />
								</label>
							
						</form>	
					<!--Fin Registro del detalle factura-->
					</div>
					<div class="CE2">
						<table class="table table-condensed table-bordered table-responsive display compact" id="dataTables">
							<thead>
								<tr class="bg-success" style="font-size:10px">
									<th class="text-center">Códigoa</th>
									<th class="text-center">Código</th>
									<th class="text-center">Concepto</th>
									<th class="text-center">Residencia</th>
									<th class="text-center">Edificio</th>
									<th class="text-center">Inicio</th>
									<th class="text-center">Cuotas</th>
									<th class="text-center">Monto</th>
									<th class="text-center">Correlativo</th>
									<th class="text-center">Periodos</th>
								</tr>
							</thead>
							<tbody style="font-size:10px">
								<?php
									$obj= new conectarDB();
									$data= $obj->subconsulta("CALL ingresosSelect()");
									$dat= json_encode($data);
									$totalU=0;
									if ($dat=='null') {
										echo '';
									}else{
										foreach ($data as $filas) { ?>
											<tr>
												<td class="text-center"><?php echo $filas['codigoIngresos'] ?></td>
												<td class="text-center"><?php echo str_pad($filas['codigoIngresos'], 7, "0", STR_PAD_LEFT) ?></td>
												<td><?php echo $filas['motivoIng'] ?></td>
												<td><?php echo $filas['nombrecj'] ?></td>
												<td class="text-center"><?php echo $filas['edificioIng'] ?></td>
												<td class="text-center"><?php echo date("d-m-Y",strtotime($filas['fechainicioIng'])) ?></td>
												<td class="text-center"><?php echo $filas['cuotasIng'] ?></td>
												<td class="dt-right"><?php echo number_format($filas['montoIng']*-1,2) ?></td>
												<td class="text-center"><?php echo $filas['correlativoIng'] ?></td>
												<td class="text-center"><?php echo $filas['periodoIng'] ?></td>
												
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
		<script src="../aplicacionesCondominio/js/ingresos.js"></script>
	</div>
	</body>
</html>