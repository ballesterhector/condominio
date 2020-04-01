<?php
	require "html/head.php";
	
?>
		<div class="titulo">
			<div class="columna1">
				<h2 class="letra">Gastos de condominio</h2>
			</div>
			<div class="columna2">
				<a href="#" onclick="window.open('http:ayudas/compras.pdf')" ><span class="icon-local_library" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Manual"></span></a>
				<a href="#" onclick="window.open('http:inventariosPDF.php')" ><span class="icon-local_print_shopprint" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Reporte"></span></a>
				<input type="text" class="form-control" id="period" style="width:100px;text-align:center" value="<?php echo $_GET['periodo'] ?>">
			</div>
			<div class="columna3">
				<h3 class="letra"><?php echo $residencias ?></h3>
			</div>
		</div>
		<div class="contenedor">
			<header>
				<div class="saludo">
				</div>
			</header>
			<article class="cajaGastos">
				<div class="columna1">
					<table class="table table-condensed table-bordered table-responsive display compact" id="dataTables">
						<thead>
							<tr class="bg-success">
								<th class="text-center">Movimiento</th>
								<th class="text-center">Período</th>
								<th class="text-center">Gasto</th>
								<th class="text-center">Fecha</th>
								<th class="text-center">Proveedor</th>
								<th class="text-center">Factura</th>
								<th class="text-center">Gasto</th>
								<th class="text-center">Facturado</th>
							</tr>
							</thead>
							
							<tbody>
								<?php
									$obj= new conectarDB();
									$data= $obj->subconsulta("CALL gastosPeriodo('".$_GET['periodo']."')");
									$total=0;
									$dat= json_encode($data);
									
									if ($dat=='null') {
										echo '';
									}else{
										foreach ($data as $filas) { 
												   $total=$total+$filas['totalfactura'];
									?>
												<tr style="background: #D3F2FA;font-size">
													<td align=""><?php echo $filas['movimiento_gast'] ?></td>
													<td align="center"><?php echo $filas['periodo'] ?></td>
													<td align="center"><?php echo str_pad($filas['numgasto'], 7, "0", STR_PAD_LEFT) ?></td>
													<td align="center"><?php echo date("d-m-Y",strtotime($filas['fechagast']))?></td>
													<td align=""><?php echo $filas['proveedor'] ?></td>
													<td align=""><?php echo $filas['facturagast'] ?></td>
													<td align="right"><?php echo number_format($filas['totalfactura'],2) ?></td>
													<td align="center"><?php echo $filas['facturado'] ?></td>
												</tr>
												<tr>
									<?php } ?>
												<td colspan=6 align=right><b>Total</b></td>
													<td align="right" ><?php echo number_format($total,2) ?></td>
												</tr>
								<?php } ?>
							</tbody>
						</table>
				</div>
			</article>
			
		</div><!--fin del contenedor-->
		</div>
			<div id="respuesta"></div>
			<?php require "html/footer.php"?>
			<script src="jsBody/gastosdata.js"></script>
		</div>
		<script type="text/javascript">

			$('#period').on('change',function (e) {
				
				var peri = document.getElementById('period').value;
				document.location.href = "gastosdata.php?periodo=" + peri;
			});									
		</script>
	</body>
</html>