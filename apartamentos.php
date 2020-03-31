<?php
    require "html/head.php";
    
    
?>
	<div class="titulo">
        <div class="columna1">
            <h2 class="letra">Data apartamentos</h2>
        </div>
        <div class="columna2">
            <a href="#" onclick="window.open('http:ayudas/apartamentos.pdf')" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Manual"><span class="icon-local_library"></span></a>
        </div>
    </div>
	
    <div class="container"  id=''>
        <div class="tabla">
			<table class="table table-bordered table-responsive display compact" id="dataTables">
				<thead>
					<tr class="alert alert-info">
						<th class="text-center">Código</th>
						<th class="text-center">Residencia</th>
						<th class="text-center">Edificio</th>
						<th class="text-center">Apartamento</th>
						<th class="text-center">Propietario</th>
						<th class="text-center">Inquilino</th>
						<th class="text-center">Alicuota</th>
						<th class="text-center">Acción</th>
					</tr>
				</thead>
				<tbody style="cursor:pointer">
					<?php
						$obj= new conectarDB();
						$data= $obj->subconsulta("CALL apartamentosSelect('0')");
						$dat= json_encode($data);
							if ($dat=='null') {
								echo '';
							}else{
		    					foreach ($data as $filas) { ?>
									<tr>
										<td align="center"><?php echo str_pad($filas['numApt'], 7, "0", STR_PAD_LEFT) ?></td>
										<td><?php echo $filas['nombrecj'] ?></td>
										<td><?php echo $filas['edificio'] ?></td>
										<td><?php echo $filas['apartamento'] ?></td>
										<td><?php echo $filas['nombreUsuario'] ?></td>
										<td><?php echo $filas['inquilino'] ?></td>
										<td><?php echo $filas['alicuotaApt'] ?></td>
										<td class="text-center">
											<a href='apartamentoPropietario.php?numApt=<?php echo $filas['numApt'] ?>&propie=<?php echo $filas['numApt']?>' aria-hidden="true" data-toggle="tooltip" data-placement="top" title='Modificar'><span class="icon-border_color"></span></a>
										</td>
									</tr>
								<?php } ?>
					<?php } ?>
				</tbody>
			</table>
		</div>
     </div>
	
	<?php require "html/footer.php"?>
	<script src="jsBody/residencias.js"></script>
	</div>
</body>
</html>