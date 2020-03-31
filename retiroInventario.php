<?php
    require "html/head.php";

       

?>
    <div class="titulo">
        <div class="columna1">
            <h2 class="letra">Data empleados</h2>
        </div>
        <div class="columna2">
            <a href="#" onclick="window.open('http:ayudas/retiroInventario.pdf')" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Manual"><span class="icon-local_library"></span></a>
        </div>
        <div class="columna3">
            <button class="button" name="nuevo" id="nuevo" style="vertical-align:middle"><span>Nuevo </span></button>
        </div>
    </div>
    <input type="hidden" id="juntasC" value="<?php echo $permiso?>">
    <input type="hidden" id="juntasCargo" value="<?php echo $juntaCargo?>">
    <div class="container"  id=''>
        <div class="tabla">
            <table class="table  table-bordered table-responsive display compact" id="dataTables">
                <thead>
                    <tr class="alert alert-info">
                        <th class="text-center">Código</th>
                        <th class="text-center">Empleado</th>
                        <th class="text-center">Cedula</th>
                        <th class="text-center">Teléfono</th>
                        <th class="text-center">Correo</th>
                        <th class="text-center">Cargo</th>
                        <th class="text-center">Estado</th>
                        <th class="text-center">Acción</th>
                    </tr>
                </thead>
                <tbody style="cursor:pointer">
                    <?php
                        $obj= new conectarDB();
                        $data= $obj->subconsulta("CALL empleadosSelect('1')");/* el 1 es el numero de CJresidencial*/
                        $dat= json_encode($data);
                            if ($dat=='null') {
                                echo '';
                            }else{
                                foreach ($data as $filas) { ?>
                                    <tr>
                                        <?php if ($filas['estado']=='Inactivo') {?>
                                            <td class="bg-danger" align="center"><?php echo str_pad($filas['numEmpleado'], 7, "0", STR_PAD_LEFT) ?></td>
                                            <td class="bg-danger"><?php echo $filas['nombreemple'] ?></td>
                                            <td class="bg-danger"><?php echo $filas['cedulaemple'] ?></td>
                                            <td class="bg-danger"><?php echo $filas['telefonoemple'] ?></td>
                                            <td class="bg-danger"><?php echo $filas['emailemple'] ?></td>
                                            <td class="bg-danger"><?php echo $filas['cargoemple'] ?></td>
                                            <td class="bg-danger"><?php echo $filas['estado'] ?></td>
                                        <?php } else {?>
                                            <td align="center"><?php echo str_pad($filas['numEmpleado'], 7, "0", STR_PAD_LEFT) ?></td>
                                            <td><?php echo $filas['nombreemple'] ?></td>
                                            <td><?php echo $filas['cedulaemple'] ?></td>
                                            <td><?php echo $filas['telefonoemple'] ?></td>
                                            <td><?php echo $filas['emailemple'] ?></td>
                                            <td><?php echo $filas['cargoemple'] ?>
                                            <td><?php echo $filas['estado'] ?></td>
                                        <?php }?>    
                                        <td class="text-center">
                                            <a href='empleadosModificar.php?numPropi=<?php echo $filas['numEmpleado'] ?>' aria-hidden="true" data-toggle="tooltip" data-placement="top" title='Complemento'><span class="icon-border_color"></span></a>
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
							<h3 class="modal-title fondoLs" id="myModalLabel"><b>Registro de empleados</b></h3>
							<div class="respuesta" id="respuesta"></div>
						</div>
						<form id="formulario" class="form-horizontal" onsubmit="return modificar();">
							<div class="modal-body">
                                <input type="hidden" name="modificador" value="<?php echo $usuario ?>">
                                <input type="hidden" name="proceso" id="proceso">
								<section class="datosCliente">
									<article class="datosA">
										<label for="" class="labelA">Nombre
											<input type="text" class="form-control names" name="nombre" id="nombre" autocomplete="off" autofocus  required="require">
										</label>
										<label for="" class="labelB">Cedula
											<input type="number" name="cedula" id="cedula" class="form-control center"  autocomplete="off" maxlength="11" required="require">
											</label>
                                        <label for="" class="labelB">Teléfono
											<input type="text" name="telef" id="telef" class="form-control center"  autocomplete="off" required="require" >
											</label>
										<label for="" class="labelC">Correo
											<input type="email" class="form-control center" name="email" id="email"  autocomplete="off" required="require" >
                                        </label>
                                    	<label for="" class="labelC">Dirección
											<input type="text" class="form-control center" name="direccion" id="direccion"  autocomplete="off"  required="require">
                                        </label>
                                        
                                        <label for="" class="labelB">Cargo
											<input type="text" name="cargo" id="cargo" class="form-control center"  autocomplete="off" required="require">
                                        </label>
                                        <label for="" class="labelC">Nomina
                                            <select name="nomina" id="nomina" class="form-control" >
                                                <option value="1">Semanal</option>
                                                <option value="0">Mensual</option>
                                            </select>
										</label>
                                        <label for="" class="labelC">Ingreso
                                            <input type="text" class="form-control" name="salario" id="salario" required="require" >
                                        </label>
                                        <label for="" class="labelC">Fecha ingreso
                                            <input type="date" class="form-control" name="fechaIng" id="fechaIng" required="require">
                                        </label>
                                    </article>
									<article class="datosB">
									    <input type="hidden" name="residencia" value="1">
                                        <input type="hidden" name="edificio" value="Todos">
                                        <input type="hidden" name="estado" value="0">
                                        <label for="" class="labelC">Observación
											<input type="text" class="form-control center" name="observa" id="observa"  autocomplete="off" >
									    </label>
									</article>
								</section>
							</div>
							<div class="modal-footer bg-info" id="pie">
								<button type="button" class="button" data-dismiss="modal">Close</button>
								<input type="submit" value="Rigistro" class="button" style="" id="reg" />
							</div>
						</form>
					</div>
				</div>
			</div>
        </div>
        <!--Fin Modal-->
    </div>
	
	<?php require "html/footer.php"?>
    <script src="jsBody/empleados.js"></script>
    </div>
</body>
</html>