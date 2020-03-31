<?php
    require "html/head.php";
    
?>
    <div class="titulo">
        <div class="columna1">
            <h2 class="letra">Data proveedores</h2>
        </div>
        <div class="columna2">
            <a href="#" onclick="window.open('http:ayudas/proveedores.pdf')" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Manual"><span class="icon-local_library"></span></a>
        </div>
        <div class="columna3">
            <button class="button" name="nuevo" id="nuevo" style="vertical-align:middle;height: 4rem"><span>Nuevo </span></button>
        </div>
    </div>
    <div class="container"  id=''>
        <div class="tabla">
            <table class="table  table-bordered table-responsive display compact" id="dataTables">
                <thead>
                    <tr class="alert alert-info">
                        <th class="text-center">Código</th>
                        <th class="text-center">Actividad</th>
                        <th class="text-center">Proveedor</th>
                        <th class="text-center">Contacto</th>
                        <th class="text-center">RIF</th>
                        <th class="text-center">Dirección</th>
                        <th class="text-center">Teléfono</th>
                        <th class="text-center">Teléfono</th>
                        <th class="text-center">Correo</th>
                        <th class="text-center">Acción</th>
                    </tr>
                </thead>
                <tbody style="cursor:pointer">
                    <?php
                        $obj= new conectarDB();
                        $data= $obj->subconsulta("CALL proveedorSelect('0')");
                        $dat= json_encode($data);
                            if ($dat=='null') {
                                echo '';
                            }else{
                                foreach ($data as $filas) { ?>
                                    <tr>
                                        <td align="center"><?php echo str_pad($filas['numprovee'], 7, "0", STR_PAD_LEFT) ?></td>
                                        <td><?php echo $filas['actividad'] ?></td>
                                        <td><?php echo $filas['proveedor'] ?></td>
                                        <td><?php echo $filas['proveedorcontacto'] ?></td>
                                        <td><?php echo $filas['rifprovee'] ?></td>
                                        <td><?php echo $filas['direccionprovee'] ?></td>
                                        <td><?php echo $filas['telefo1'] ?></td>
                                        <td><?php echo $filas['telefo2'] ?></td>
                                        <td><?php echo $filas['emailprov'] ?></td>

                                        <td class="icono">
                                            <?php if ($permiso==1) { ?>
                                                <a href='proveedoresModificar.php?numProvee=<?php echo $filas['numprovee'] ?>' aria-hidden="true" data-toggle="tooltip" data-placement="top" title='Modificar'><span class="icon-border_color"></span></a>
                                            <?php } else { ?>
                                               
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            <?php } ?>
                </tbody>
            </table>
        </div>
        <!--Inicio Modal-->
        <div>
            <div class="modal fade" id="abreModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog ">
					<div class="modal-content">
						<div class="modal-header bg-info" id="titulo">
							<h3 class="modal-title fondoLs" id="myModalLabel"><b>Registro de proveedores</b></h3>
							<div class="respuesta" id="respuesta"></div>
						</div>
						<form id="formulario" class="form-horizontal" onsubmit="return modificar();">
							<div class="modal-body">
                                <input type="hidden" name="modificador" value="<?php echo $usuario ?>">
                                <input type="hidden" name="proceso" id="proceso">
								<section class="datosCliente">
									<article class="datosA">
										<label for="" class="labelA">Proveedor
											<input type="text" class="form-control names" name="proveedor" id="proveedor" autocomplete="off" autofocus style="width:340px" required="require">
										</label>
										<label for="" class="labelB">Actividad
											<input type="text" name="activi" id="activi" class="form-control center"  autocomplete="off" required="require">
											</label>
										<label for="" class="labelC">Dirección
											<input type="text" class="form-control center" name="direccion" id="direccion"  autocomplete="off" style="width:440px" required="require">
									    </label>
                                    </article>
									<article class="datosB">
										<label for="" class="labelA">Rif
												<input type="text" class="form-control names" name="rif" id="rif"  autocomplete="off" style="width:120px" required="require">
											</label>
										<label for="" class="labelB">Teléfono
											<input type="text" name="teleContacto" id="teleContacto" class="form-control center"  autocomplete="off" style="width:120px" required="require">
                                        </label>
                                        <label for="" class="labelB">Teléfono
											<input type="text" name="teleContacto2" id="teleContacto2" class="form-control center"  autocomplete="off" style="width:120px">
										</label>
										<label for="" class="labelC">Email
												<input type="email" class="form-control center" name="email" id="email"  autocomplete="off" style="width:185px" required="require">
                                        </label>
                                        <label for="" class="labelC">Contacto
                                            <input type="text" class="form-control" name="contacto" id="contacto" required="require">
                                        </label>
									</article>
								</section>
							</div>
							<div class="modal-footer bg-info" id="pie">
								<button type="button" class="button" data-dismiss="modal">Close</button>
								<input type="submit" value="Rigistro" class="button" style="width:90px " id="reg" />
							</div>
						</form>
					</div>
				</div>
			</div>
        </div>
        <!--Fin Modal-->
    </div>
	
	<?php require "html/footer.php"?>
    <script src="jsBody/proveedores.js"></script>
    </div>
</body>
</html>