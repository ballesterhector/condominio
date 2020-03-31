<?php
    require "html/head.php";
                
?>

        <div class="titulo">
            <div class="columna1">
                <h2 class="letra">Registro de servicios efectuados</h2>
            </div>
            <div class="columna2">
                 <a href="#" onclick="window.open('http:ayudas/empleados.pdf')" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Manual"><span class="icon-local_library"></span></a>
            </div>
            <div class="columna3">
                <h3 class="letra"><?php echo $residencias ?></h3>
            </div>
        </div>
        
        <div class="container-fluid cajaServicios" id=''>
            <div class="column1">
                <div>
                    <span class="form-control">Propietario</span>
                    <span class="form-control">Fecha</span>
                    <span class="form-control">Factura</span>
                    <span class="form-control">Proveedor</span>
                    <span class="form-control">Gasto</span>
                    <span class="form-control">Periodo</span>   
                    <span class="form-control">Tipo</span>
                </div>
            </div>   
            <div class="column1A">
                <form id="formulario" class="form-horizontal" onsubmit="return modificar();">    
                    <div>
                        <input type="hidden" name="proceso" value="Registro">
                        <input type="text" class="form-control" name="usuario" value="<?php echo $usuario ?>" readonly style="width:280px">
                        <input type="date" class="form-control" name="fecha" id="fechaComp" style="width:280px" >
                        <input type="text" class="form-control" name="factura" style="width:280px">
                        <select class="form-control" name="proveedor" id="proveedor" style="width:280px"  required="require">
                            <option value=""></option>
                            <?php
                                $obj = new conectarDB();
                                $data = $obj->consultar("CALL proveedorSelect('0')");
                                foreach($data as $key){
                                    echo "<option value='".$key['numprovee']."'>".$key['proveedor']."</option>";
                                }
                            ?>
                        </select>
                        <input type="text" class="form-control" name="gasto" style="width:280px"  required="require">
                        <input type="text" class="form-control " name="period" id="period" style="width:90px;text-align:center" required="require"pattern="(0[1-9]|1[012])[/](\d{4})" placeholder=" mm/aaaa" data-toggle="tooltip" data-placement="top" title='Formato MM/AAAA' autocomplete="off">
                        <select class="form-control" name="moimiento" style="width:280px" required="require">
                            <option value=""></option>
                            <?php
                                $obj = new conectarDB();
                                $data = $obj->consultar("CALL gastosTipo()");
                                foreach($data as $key){
                                    echo "<option value='".$key['gastosTipocol']."'>".$key['gastosTipocol']."</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="ingreso">
                       <span class="icon-save_alt" id="presenta" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Ingresar nueva presentación"></span>
                    </div>
            </div>    
                    <div class="column2">
                        <div class="">
                            <textarea name="motivo" class="form-control estilotextarea" cols="25" rows="10" placeholder="Motivo"></textarea>
                        </div>
                        <div>
                            <textarea name="observa" class="form-control estilotextarea" cols="20" rows="10" placeholder="Observación"></textarea>
                        </div>
                    </div>    
                    <div class="column3">
                            <div class="modal-footer" id="cerrando">
                                <input type="submit" value="Registrar" class="btn btn-success text-center" id="reg" />
                                <input type="button" class="btn btn-info text-center" id="cerrar" value="Cerrar">
                            </div>
                    </div>
                </form>
                
        </div>

        <div id="respuesta"></div>
    	<?php require "html/footer.php"?>

    	<script src="jsBody/gastosPorServicios.js"></script>

        <script type="text/javascript">

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
                            url: "gastosPorServicios_modificar.php",
                            data: 'proceso=' + 'tipo' + '&tipo=' + inputValue ,
                            success: function (repuesta) {
                                setTimeout('location.reload()', 1000);
                            }
                        });
                }
                    swal("Procesado!", "Nuevo tipo: " + inputValue + " ingresado", "success");
                });
            });

            var hoy = new Date();
            var mes = hoy.getMonth();
            var mes2 = mes < 10 ? "0" + (hoy.getMonth()+1) : mes+1;
            var fecha=  mes2 + "/" + hoy.getFullYear();
            
            $('#period').on('change',function(){
                if ($('#period').val()<fecha){
                    swal("Oops!", "El periódo regitrado es inferior al actual", "error");
                    $('#period').val(fecha);
                }
            });
            
            
        </script>
    </body>
</html>