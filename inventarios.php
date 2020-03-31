<?php
    require "html/head.php";
    
            
?>
    <div class="titulo">
        <div class="columna1">
            <h2 class="letra">Inventarios existencia</h2>
        </div>
        <div class="columna2">
            <a href="#" onclick="window.open('http:ayudas/compras.pdf')" /><span class="icon-local_library" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Manual"></span></a>
            <a href="#" onclick="window.open('http:inventariosPDF.php')" /><span class="icon-local_print_shopprint" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Reporte"></span></a>
        </div>
        <div class="columna3">
        <h3 class="letra"><?php echo $residencias ?></h3>
        </div>
    </div>
    <div class="container-fluid cajarConTabla" id=''>
        <div class="column2">
            <div class="tabla" style="width: 40%">
                <table class="table  table-bordered table-responsive display compact" id="dataTables">
                    <thead>
                        <tr class="bg-info">
                            <th class="text-center">Insumo</th>
                            <th class="text-center">Existencia</th>
                            <th class="text-center">Presentación</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $obj= new conectarDB();
                            $data= $obj->subconsulta("CALL inventarioResumen(0)");
                            $dat= json_encode($data);
                                if ($dat=='null') {
                                    echo '';
                                }else{
                                    foreach ($data as $filas) { ?>
                                        <tr>
                                            <td style=""><?php echo $filas['insumoRubr'] ?></td>
                                            <td class="text-right" style="padding-right: 20px"><?php echo number_format($filas['cantidad'],0) ?></td>
                                            <td style=""><?php echo $filas['presentacion'] ?></td>
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
                <div class="modal-dialog ">
                    <div class="modal-content">
                        <div class="modal-header bg-info " style="height: 2%">
                            <h3 class="modal-title fondoLs" id="myModalLabel"></h3>
                            
                        </div>
                        <form id="formulario" class="form-horizontal" onsubmit="return retiros();">
                            <div class="modal-body">
                                <input type="hidden" id="id-prod" name="id-prod">
                                <input type="hidden" name="modificador" value="<?php echo $usuario ?>">
                                <input type="hidden" id="proceso" name="proceso">
                                <input type="hidden" id="presenta" name="presenta">
                                <section class="">
                                    <article class="datosA">
                                        <label style="width: 20%">Código
                                            <input type="text" class="form-control" name="rubcod" id="rubcod" readonly style="text-align: center;" >
                                        </label>   
                                        <label style="width: 58%">Rubro
                                            <input type="text" name="" id="rubro" class="form-control center"  disabled >
                                        </label>
                                        <label style="width: 20%">Existencia
                                            <input type="text" class="form-control center" name="" id="exist"  disabled style="text-align: center;">
                                        </label>
                                    </article>
                                    <article class="datosB">
                                        <label for="" style="width: 20%">A Retirar
                                            <input type="text" class="form-control names" name="aRetirar" id="aRetirar" value="1"  autocomplete="off" required="require">
                                        </label>
                                        <label for="" style="width: 36%">Entregado a
                                            <input type="text" name="entrega" id="entrega" class="form-control center"  autocomplete="off" required="require">
                                        </label>
                                        <label for="" style="width: 42%">Uso
                                            <input type="text" class="form-control center" name="uso" id="uso"  autocomplete="off" required="require">
                                        </label>
                                    </article>
                                    <article class="datosC">
                                        <label for="" style="width: 15%">Uso en exterior
                                            <select class="form-control aling" name="saleDe" id="saleDe" data-container="body" data-toggle="popover" data-placement="top" title="Sale de la residencia" data-content="Indique si el recurso será retirado de la residencia." autocomplete="off">
                                                <option value="No">No</option>
                                                <option value="Si">Si</option>
                                            </select>
                                        </label>
                                        <label for="" id="Motiv" style="width: 84%">Aprobado por
                                            <select class="form-control" name="aprobado" id="aprobado">
                                                <option value=""></option>
                                                <?php
                                                    $obj = new conectarDB();
                                                    $data = $obj->consultar("CALL juntaCondominioSelect('0')");
                                                        foreach($data as $key){
                                                            echo "<option value='".$key['nombreUsuario']."'>".$key['nombreUsuario']."</option>";
                                                        }
                                                ?>
                                            </select>
                                        </label>
                                    </article>
                                    <article class="datosC">
                                        <label for="" style="width: 100%">Observaciones
                                            <input type="text" class="form-control direccion" name="observ" id="observ">
                                       </label>
                                    </article>
                                </section>
                            </div>
                            <div class="modal-footer bg-info ">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <input type="submit" value="Registrar" class="btn btn-success text-center" style="width:90px " id="reg" />
                            </div>
                        </form>
                    </div>
                    <!--fin modal-content-->
                </div>
                <!--fin modal-dialog-->
            </div>
            <!--fin modal-fade-->
        </div>
        <!--Fin form-group id=formG1-->
        <!--Fin modal nuevo-->
      
    </div>
    <div id="respuesta"></div>
	   <?php require "html/footer.php"?>
   </div>

    <script type="text/javascript">
        $(document).ready(function() {
            initControls(); //Para evitar devolverse
            
            $('#Motiv').hide();

            $('#dataTables').dataTable({
            "order": [[0, 'asc']],
            "lengthMenu": [[10], [10]],

            "columnDefs": [
                { "width": "40%", "targets": 0,
                    "width": "10%", "targets": 1,
                    "width": "10%", "targets": 2,
                }]
            });
    

        });
       
        function modal(id, cant) {
            $('#formulario')[0].reset();
            $('#titulo').removeClass('text-danger');
            $('#titulo').addClass('text-info');
            $('#reg').attr('disabled', false);
            $('#arranq').attr('readonly', true);

            $.ajax({
                type: 'GET',
                url: 'inventariosRetiros_modificar.php',
                data: 'proceso=' + 'existencia' + '&codprod=' + id,
                success: function (valores) {
                    var datos = eval(valores);
                    $('#myModalLabel').html('Retiro del inventario');
                    $('#myModalLabel').addClass('text-danger');
                    $('#proceso').val("Retirar");
                    $('#rubcod').val(id);
                    $('#rubro').val(datos[0]['descripcion_inv']);
                    $('#exist').val(datos[0]['cantidad']);
                    $('#presenta').val(datos[0]['unidad']);
                    $('#abreModal').modal({
                        show: true,
                        backdrop: 'static'
                    });
                }
            });
        }

        $('#aRetirar').on('change',function(){
            var existec =document.getElementById('exist').value;
            var aretir =parseInt(document.getElementById('aRetirar').value);
            if (aretir<0) {
                swal("Data inconsistente!", "La cantidad a retirar es inferior a 1", "error");
                document.getElementById('aRetirar').value=1;
                $('#aRetirar').css('background', 'rgb(205, 248, 207)').css('color', '#0a29d1');
            } 
            else if(aretir>existec) {
                swal("Data inconsistente!", "La cantidad a retirar es superior a la existencia", "error");
                $('#aRetirar').css('background', 'rgb(252, 215, 235)').css('color', '#0a29d1');
                $('#exist').css('background', 'rgb(252, 215, 235)').css('color', '#0a29d1');
                document.getElementById('aRetirar').value=1;
            }
        });

   
        $('#saleDe').on('change',function(){
            var sale =document.getElementById('saleDe').value;
            
            if (sale=='Si') {
                $('#Motiv').show();
                $('#aprobado').attr('required','require');

            } else {
                $('#Motiv').hide();
            }
        });

        function retiros() {
            $('#reg').attr('disabled', true);
            $.ajax({
                type: 'GET',
                url: 'inventariosRetiros_modificar.php',
                data: $('#formulario').serialize(),
                success: function (data) {
                    if (data == 'Registro completado con exito') {
                        $('#clos').attr('disabled', true);
                        $('#myModalLabel').addClass('mensaje').html(data).show(200).delay(91500).hide(200);
                        setTimeout('location.reload()', 1550);
                    } else {
                        $('#reg').attr('disabled', false);
                        $('#myModalLabel').addClass('mensajeError').html(data).show(200).delay(1500).hide(200);
                    }
                }
            });
            return false;
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