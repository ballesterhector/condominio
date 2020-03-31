<?php
    require "html/head.php";
            
?>
    <div class="titulo">
        <div class="columna1">
            <h2 class="letra">Registro de productos</h2>
        </div>
        <div class="columna2">
            <a href="#" onclick="window.open('http:ayudas/compras.pdf')" /><span class="icon-local_library" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Manual"></span></a>
        </div>
        <div class="columna3">
        <input type="hidden" id="juntasC" value="<?php echo $permiso?>">
        <h3 class="letra"><?php echo $residencias ?></h3>
        </div>
    </div>
    <div class="container-fluid cajarConTabla" id=''>
        <div class="column1">
            <div>
                <span class="form-control">Producto</span>
                <span class="form-control">Tipo</span>
                <span class="form-control">Presentación</span>
            </div>
            <div>
            <form id="formulario" class="form-horizontal" onsubmit="return agregar();">
                <input type="hidden" name="proceso"  value="Registro">
                <input type="text" class="form-control" name="insumo" required="require" style="width:180px">
                <label for="" class="tipox">
					<select class="form-control" name="tipo" required="require" style="width:180px">
						<option value=""></option>
						<?php
                            $obj = new conectarDB();
                            $data = $obj->consultar("CALL productoUtensilio()");
                            foreach($data as $key){
                                echo "<option value='".$key['utensilio']."'>".$key['utensilio']."</option>";
                            }
                        ?>
                    </select>  
                    <select class="form-control" name="presentacion" id="presentacion" style="width:180px" required="require">
                        <option value=""></option>
                        <?php
                            $obj = new conectarDB();
                            $data = $obj->consultar("CALL insumosPresentacionSelect()");
                            foreach($data as $key){
                                echo "<option value='".$key['presentacion']."'>".$key['presentacion']."</option>";
                            }
                        ?>
                    </select>  
                    <div class="ingreso">
                        <span class="icon-save_alt" id="tipos" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Ingresar nuevo tipo"></span>
				        <span class="icon-save_alt" id="presenta" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Ingresar nueva presentación"></span>
                    </div>  
                </label>
                <input type="hidden" name="usuario"  value="<?php echo $usuario ?>">
                <div class="modal-footer" id="cerrando">
                    <input type="submit" value="Registrar" class="btn btn-success" style="" id="reg" />
                </div>
			</form>
            </div>   
        </div>
         
        <div class="column2">
            <div class="tabla">
                <table class="table  table-bordered table-responsive display compact" id="dataTables">
                    <thead>
                        <tr class="alert alert-info">
                            <th class="text-center">Código</th>
                            <th class="text-center">Tipo</th>
                            <th class="text-center">Producto</th>
                            <th class="text-center">Presentación</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $obj= new conectarDB();
                            $data= $obj->subconsulta("CALL insumoRubroSelect()");
                            $dat= json_encode($data);
                                if ($dat=='null') {
                                    echo '';
                                }else{
                                    foreach ($data as $filas) { ?>
                                        <tr>
                                            <td align="center"i><?php echo str_pad($filas['codigRubro'], 7, "0", STR_PAD_LEFT) ?></td>
                                            <td><?php echo $filas['tipoRubr'] ?></td>
                                            <td><?php echo $filas['insumoRubr'] ?></td>
                                            <td><?php echo $filas['presentacion'] ?></td>
                                        </tr>
                                    <?php } ?>
                                <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!--Inicio modal nuevo-->
		<div class="form-group">
			<div class="modal fade" id="abreModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header bg-info cabeza">
							<h3 class="modal-title fondoLs" id="myModalLabel"><b>Registro de clientes</b></h3>
							<div class="respuesta" id="respuesta"></div>
						</div>
						<form id="formulario" class="form-horizontal" onsubmit="return modificarCliente();">
							<div class="modal-body">
								<input type="hidden" id="id-prod" name="id-prod">
								<input type="hidden" name="modificador" value="<?php echo $usuario ?>">
								<input type="hidden" id="proceso" name="proceso">
								<section class="datosCliente">
									<article class="datosA">
										<label for="" class="labelA">Cliente
												<input type="text" class="form-control names" name="name" id="name" disabled autocomplete="off" autofocus>
											</label>
										<label for="" class="labelB">Teléfono
												<input type="text" name="telef" id="telef" class="form-control center"  autocomplete="off">
											</label>
										<label for="" class="labelC">RIF
												<input type="text" class="form-control center" name="rif" id="rif"  autocomplete="off">
											</label>

									</article>
									<article class="datosB">
										<label for="" class="labelA">Contacto
												<input type="text" class="form-control names" name="contacto" id="contacto"  autocomplete="off">
											</label>
										<label for="" class="labelB">Teléfono
												<input type="text" name="teleContacto" id="teleContacto" class="form-control center"  autocomplete="off">
											</label>
										<label for="" class="labelC">Email
												<input type="text" class="form-control center" name="email" id="email"  autocomplete="off">
											</label>
									</article>
									<article class="datosC">
										<label for="" class="control-label">Dirección</label>
										<input type="text" name="direcc" id="direcc" class="form-control direccion">
									</article>
									<article class="datosD">
										<label for="" class="toler">Tolerancia
											<input type="text" class="form-control aling" value="90" name="tolera" id="tolera" data-container="body" data-toggle="popover" data-placement="bottom" title="Bloqueo automático" data-content="Días previos al vencimiento, para enviar la etiqueta al almacen de bloqueadas" autocomplete="off">
										</label>
										<label for="" class="">Paletas peso
											<input type="text" class="form-control aling" value="30" name="paleta" id="paleta" data-toggle="tooltip" data-placement="right" title="Peso de la paleta"  autocomplete="off">
										</label>
										<label for="" class="">Contratadas
											<input type="text" class="form-control aling" value="0" name="contratada" id="contratada" data-toggle="tooltip" data-placement="top" title="Paletas contratadas"  autocomplete="off">
										</label>
										<label for="" class="">Bloqueo
											<select class="form-control aling" name="bloqueo" id="bloqueo" data-container="body" data-toggle="popover" data-placement="top" title="Envio al almacen de bloqueadas" data-content="Activa procedimiento para el envío de la etiqueta al almacen de bloqueadas, depende de los días de tolerancia." autocomplete="off">
												<option value="0">No</option>
												<option value="1">Si</option>
											</select>
										</label>
										<label for="" class="">Estado
											<select class="form-control estado aling" name="estado" id="estado" style="width:120px">
												<option value="0">Activo</option>
												<option value="1">Inactivo</option>
											</select>
										</label>
									</article>
									<article class="datosC">
										<label for="" class="direccion">Observaciones
												<input type="text" class="form-control direccion" name="observ" id="observ">
											</label>
									</article>
								</section>
							</div>
							<div class="modal-footer bg-info">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								<input type="submit" value="Modificar" class="btn btn-success text-center" style="width:90px " id="reg" />
							</div>
						</form>
					</div>
					<!--fin modal-content-->
				</div>
				<!--fin modal-dialog-->
			</div>
			<!--fin modal-fade-->
		</div>
		
    </div>
    <div id="respuesta"></div>
	<?php require "html/footer.php"?>
	<script src="jsBody/productos.js"></script>

    <script type="text/javascript">
        $('#tipos').on('click',function(){
            swal({
            title: "Agregar data",
            text: "Indique el nuevo tipo a registrar:",
            type: "input",
            showCancelButton: true,
            closeOnConfirm: false,
            animation: "slide-from-top",
            inputPlaceholder: "Write something"
            },
            function(inputValue){
            if (inputValue === false) return false;
            
            if (inputValue === "") {
                swal.showInputError("No hay data a registrar!","error");
                return false
            }else{
				var usua = document.getElementById('usuario').value;
                $.ajax({
						type: 'GET',
						url: "productos_funciones.php",
						data: 'proceso=' + 'registroTipo' + '&tipo=' + inputValue + '&usuario=' + usua,
						success: function (repuesta) {
							setTimeout('location.reload()', 1000);
						}
					});
            }
            
            swal("Procesado!", "Nuevo tipo: " + inputValue + " ingresado", "success");
            });
        });

        $('#presenta').on('click',function(){
            swal({
            title: "Agregar data",
            text: "Indique la nueva presentación a registrar:",
            type: "input",
            showCancelButton: true,
            closeOnConfirm: false,
            animation: "slide-from-top",
            inputPlaceholder: "Write something"
            },
            function(inputValue){
            if (inputValue === false) return false;
            
            if (inputValue === "") {
                swal.showInputError("No hay data a registrar!","error");
                return false
            }else{
                var usua = document.getElementById('usuario').value;
                $.ajax({
                        type: 'GET',
                        url: "productos_funciones.php",
                        data: 'proceso=' + 'registroPresentacion' + '&present=' + inputValue + '&usuario=' + usua,
                        success: function (repuesta) {
                            setTimeout('location.reload()', 1000);
                        }
                    });
            }
            
            swal("Procesado!", "Nuevo tipo: " + inputValue + " ingresado", "success");
            });
        });    
    </script>
    </div>
</body>
</html>