<?php
    require "html/head.php";
    
            
?>
    <div class="titulo">
        <div class="columna1">
            <h3 class="letra">Registro de adquisición de productos</h3>
        </div>
        <div class="columna2">
            <a href="#" onclick="window.open('http:ayudas/compras.pdf')" /><span class="icon-local_library" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Manual"></span></a>

            <a href="javascript: onclick(reporte())"><span class="icon-local_print_shopprint" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Reporte"></span></a>
            
        </div>
        <div class="columna3">
        <input type="hidden" id="juntasC" value="<?php echo $permiso?>">
        <h3 class="letra"><?php echo $residencias ?></h3>
        </div>
    </div>
    <div class="container-fluid cajarConTabla" id=''>
        <div class="column1">
            <div>
                <span class="form-control">Proveedor</span>
                <span class="form-control">Factura</span>
                <span class="form-control">Fecha</span>
                <span class="form-control">Total</span>
                <span class="form-control">Periodo</span>
            </div>
            <div>
            <form id="formulario" class="form-horizontal" onsubmit="return modificar();">
                <input type="hidden" name="proceso"  value="Registro">
                <label for="" class="">
					<select class="form-control" name="proveedor" id="proveedor"  required="require">
						<option value=""></option>
						<?php
							$obj = new conectarDB();
							$data = $obj->consultar("CALL proveedorSelect('0')");
								foreach($data as $key){
									echo "<option value='".$key['numprovee']."'>".$key['proveedor']."</option>";
								}
						?>
					</select>
				</label>
                <input type="text" class="form-control" name="factura" id="factura" value="0" style="margin-top:-5px" required="require">
                <input type="date" class="form-control" name="fecha" value="<?php echo date('Y-m-d') ?>" autocomplete="off" style="">
                <input type="text" class="form-control" name="total" value="0" required="require">
                <input type="text" class="form-control" name="periodo" value="11/2019" required="require">
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
                    <tr class="bg-info" >
                        <th class="text-center" colspan=7>Gastos no cerrados</th>
                    </tr>
                    <tr class="alert alert-info">
                        <th class="text-center">Código</th>
                        <th class="text-center">Proveedor</th>
                        <th class="text-center">Fecha</th>
                        <th class="text-center">Factura</th>
                        <th class="text-center">Periodo</th>
                        <th class="text-center">Gasto</th>
                        <th class="text-center">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $obj= new conectarDB();
                        $data= $obj->subconsulta("CALL gastosPorCerrar()");
                        $dat= json_encode($data);
                            if ($dat=='null') {
                                echo '';
                            }else{
                                foreach ($data as $filas) { ?>
                                    <tr>
                                        <td align="center"><?php echo str_pad($filas['numgasto'], 7, "0", STR_PAD_LEFT) ?></td>
                                        <td><?php echo $filas['proveedor'] ?></td>
                                        <td style="text-align:center"><?php echo date("d/m/Y",strtotime($filas['fechagast'])) ?></td>
                                        <td style="padding-left:15px"><?php echo $filas['facturagast'] ?></td>
                                        <td style="text-align:center"><?php echo $filas['periodo'] ?></td>
                                        <td class="text-right"><?php echo number_format($filas['totalfactura'],2) ?></td>
                                        <td class="text-center">
                                            <a href='comprasdetalle.php?numgasto=<?php echo $filas['numgasto'] ?>' aria-hidden="true" data-toggle="tooltip" data-placement="top" title='Cerrar'><span class="icon-no_meeting_room"></span></a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            <?php } ?>
                </tbody>
            </table>
        </div>
        </div>
    </div>
    <div id="respuesta"></div>

	    <?php require "html/footer.php"?>
    </div>
    
    <script type="text/javascript">
        $(document).ready(function() {
            initControls(); //Para evitar devolverse

            $('#dataTables').dataTable({
                "order": [[0, 'desc']],
                "lengthMenu": [[10], [10]],
            });

        });

        function modificar() {
            var factu=document.getElementById('factura').value;
            $('#reg').attr('disabled', true);
            $.ajax({
                type: 'GET',
                url: "compras_modificar.php",
                data: $('#formulario').serialize(),
                success: function (data) {
                    if (data == 'Registro completado con exito') {
                        $('#reg').attr('disabled', false);
                        $('#respuesta').addClass('mensaje').html(data).show(200).delay(1500).hide(200);
                        document.location = 'compras.php?factura=' + factu;
                    } else {
                        $('#reg').attr('disabled', false);
                        $('#respuesta').addClass('mensajeError').html(data).show(200).delay(1500).hide(200);
                    }
                }
            });
            return false;
        }


        function reporte() {
            swal({
                    title: "<span style='color:#F8BB86'>Imprimir reporte<span>",
                    text: "<small class='text-info'><h3>Indique número de retiro</h3></small>",
                    type: "input",
                    showCancelButton: true,
                    closeOnConfirm: true,
                    animation: "slide-from-top",
                    inputPlaceholder: "Write something",
                    html: true
                },
                function (inputValue) {
                    if (inputValue === false) return false;

                    if (inputValue === "") {
                        swal.showInputError("<small class='text-danger'>No has ingresado ninguna data</small>");
                        return false
                    }
                    window.open("inventariosComprasPDF.php?numCompra=" + inputValue, "Reporte");
                });
        }



        //evitar devolverse
        function initControls() {
            window.location.hash = "red";
            window.location.hash = "Red" //chrome
            window.onhashchange = function () {
                window.location.hash = "red";
            }
        }

    </script>
</body>
</html>