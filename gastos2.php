<?php
	require '../aplicacionesCondominio/php/session_start.php';
	
    require '../conectarBD/conectarCondominio.php';
	$obj = new conectarDB();
	$data = $obj->consultar("CALL gastosSelect('".$_GET['numRegistro']."')");
		foreach ($data as $filas) { 
			$numero= $filas['numgasto'];
			$fecha= $filas['fechagast'];
			$factura= $filas['facturagast'];
			$numprovee= $filas['numproveedor'];
			$totfac= $filas['totalfactura'];
			$periodo= $filas['periodo'];
			$resid= $filas['conjuntoresid'];
		} 
    
	$obj = new conectarDB();
	$data = $obj->consultar("CALL gastodetalTotSelect('".$_GET['numRegistro']."')");
		foreach ($data as $filas) { 
			$totunida= $filas['cantidad'];
			$gasto= $filas['costo'];
		}
		
		$diferencia=$totfac-$gasto;
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
					<h3 class="titulos" id="respuesta">Data gastos registrados</h3>
					<div class="subsaludo">
					    <a href="gastos.php"><i class="fas fa-angle-double-left fa-2x"  aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Devolver a gastos"></i></a>
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
				<article class="contenedorgasto">
					<div class="sub1">
						<!--Registro del detalle factura-->
						<form id="formulariodetalle" class="form-horizontal" onsubmit="return agregarDetalle();">
							<div class="subladotop">
								<input type="hidden" id="proceso" name="proceso" value="detalle">
								<input type="hidden" name="modificador" value="<?php echo $usuario ?>">
								<input type="hidden" name="numdatalle" id="numdatalle" value="<?php echo $numero ?>">
								<input type="hidden" name="dife" id="dife" value="<?php echo $diferencia ?>">
								<label for="" class="">Concepto
									<input type="text" class="form-control " name="concep" id="concep"  style="width:360px" required="require" value="">
								</label>
								<label for="" class="">Gasto
									<input type="text" class="form-control dif" name="gast" id="gast" style="width:100px;text-align:center" required="require" autocomplete="off">
								</label>
								<label for="" class="">Cantidad
									<input type="text" class="form-control " name="cant" id="cant" style="width:90px" required="require">
								</label>
								
								
								<label>
									<div class="submit">
										<input type="submit" value="Reg" class="btn btn-success" style="width:40px;height:34px;margin:15px 0 0 5px;padding:0px" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Registrar data" id="reg" />
									</div>
								</label>
							</div>
						</form>	
					<!--Fin Registro del detalle factura-->
					</div>
					<div class="sub2">
						<table class="table table-condensed table-bordered table-responsive display compact" id="dataTables">
							<thead>
								<tr class="bg-success" style="font-size:10px">
									<th class="text-center">Código</th>
									<th class="text-center">Concepto</th>
									<th class="text-center">Cantidad</th>
									<th class="text-center">Costo</th>
									<th class="text-center">Registrado por</th>
								</tr>
							</thead>
							<tfoot>
								<tr style="font-size:10px">
									<th colspan="2" style="text-align:right">Ejecutado:</th>
									<th class="dt-right"><?php echo $totunida ?></th>
									<th class="dt-right"><?php echo number_format($gasto,2) ?></th>
								</tr>
								<tr style="font-size:10px">
									<th colspan="3" style="text-align:right">Por ejecutar:</th>
									<th class="dt-right dif"><?php echo number_format($diferencia,2) ?></th>
								</tr>
							</tfoot>
							<tbody style="font-size:10px">
								<?php
									$obj= new conectarDB();
									$data= $obj->subconsulta("CALL gastodetalSelect('".$_GET['numRegistro']."')");
									$dat= json_encode($data);
									$totalU=0;
									if ($dat=='null') {
										echo '';
									}else{
										foreach ($data as $filas) { ?>
												<tr>
												<td><?php echo str_pad($filas['numegasto'], 7, "0", STR_PAD_LEFT) ?></td>
												<td><?php echo $filas['descripcion'] ?></td>
												<td class="dt-right"><?php echo $filas['cantidad'] ?></td>
												<td class="dt-right"><?php echo number_format($filas['costo'],2) ?></td>
												<td><?php echo $filas['usuario'] ?></td>
											</tr>
									<?php } ?>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</article>
				<aside>
					<!--Registro del total factura-->
					<label for="" class="">Código
						<input type="text" class="form-control " name="numer" id="numer" value="<?php echo str_pad($numero, 7, "0", STR_PAD_LEFT) ?>" readonly style="width:80px;text-align:center;font-size:12px">
					</label>
					<label for="" class="">Fecha
						<input type="text" class="form-control " name="fech" id="fech" value="<?php echo date("d-m-Y",strtotime($fecha) )?>" disabled="true" style="font-size:10px;width:80px">
					</label>
					<label for="" style="margin-left:5px;"> Residencia
						<select class="form-control" name="conjunto" id="conjunto" value="<?php echo $resid ?>" disabled="true" style="font-size:10px;">
							<?php
								$obj = new conectarDB();
								$data = $obj->consultar("CALL residenciasSelect('0')");
								foreach($data as $key){
									echo "<option value='".$key['numcj']."'>".$key['nombrecj']."</option>";
								}
							?>
						</select>
					</label>
					<label for="" style="margin-left:5px;"> Proveedor
						<select class="form-control" name="provee" id="provee" value="<?php echo $numprovee ?>" disabled="true" style="font-size:10px;">
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
						<input type="text" class="form-control lete" name="factu" id="factu" value="<?php echo $factura ?>" style="width:90px;font-size:10px" disabled="true">
					</label>
					<label for="" class="">Periodo
						<input type="text" class="form-control lete" name="period" id="period" value="<?php echo $periodo ?>" style="width:90px;text-align:center;font-size:10px" disabled="true">
					</label>
					<label for="" class="">Total Gasto
						<input type="text" class="form-control lete" name="totg" id="totg" value="<?php echo number_format($totfac,2) ?>" style="width:100px;text-align:center;font-size:10px" disabled="true">
					</label>
					<!--Fin Registro del total factura-->
				</aside>
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