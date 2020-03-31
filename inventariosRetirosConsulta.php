<?php 
    require "html/head.php";

        
?>
        <div class="titulo">
            <div class="columna1">
                <h3 class="letra">Retiro de rubros del inventario</h3>
            </div>
            <div class="columna2">
                <div id="info"></div>
                <a href="#" onclick="window.open('http:ayudas/compras.pdf')" /><span class="icon-local_library" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Manual"></span></a>

                     <a href="javascript: onclick(reporte())"><span class="icon-local_print_shopprint" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Reporte"></span></a>
       
            </div>
            <div class="columna3">
            <h4 class="letra"><?php echo $residencias ?></h4>
            </div>
        </div>
        <div class="container-fluid cajarConTabla" id=''>
            <div class="column2">
                <div class="tabla" id="tablas" style="margin-left: 260px">
                    <table class="table  table-bordered table-responsive display compact" id="dataTables">
                        <thead>
                            <tr class="bg-info">
                                <th class="text-center">Retiro</th>
                                <th class="text-center">Fecha</th>
                                <th class="text-center">Retirodo por</th>
                                <th class="text-center">Uso</th>
                                <th class="text-center">Movimiento</th>
                                <th class="text-center">Insumo</th>
                                <th class="text-center">Cantidad</th>
                                <th class="text-center">Presentación</th>                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $obj= new conectarDB();
                                $data= $obj->subconsulta("CALL retirosDetalleSelect('0')");
                                $dat= json_encode($data);
                                    if ($dat=='null') {
                                        echo '';
                                    }else{
                                        foreach ($data as $filas) { ?>
                                            <tr>
                                                <td style=""><?php echo $filas['numRetiro'] ?></td>
                                                <td style=""><?php echo $filas['fecha_ret'] ?></td>
                                                <td style=""><?php echo $filas['retiradoPor'] ?></td>
                                                <td style=""><?php echo $filas['usoDelBien'] ?></td>   
                                                <td style=""><?php echo $filas['movimiento'] ?></td>
                                                <td style=""><?php echo $filas['insumo'] ?></td>
                                                <td style=""><?php echo $filas['cantidad'] ?></td>
                                                <td style=""><?php echo $filas['presenta'] ?></td>
                                            </tr>
                                        <?php } ?>
                                    <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>                            
        
            <?php require "html/footer.php"?>
        </div>
        
        <script type="text/javascript">
            $(document).ready(function() {

                $('#dataTables').dataTable({
                    "order": [[0, 'asc']],
                    "lengthMenu": [[10], [10]],

                    "language": 
                    {
                        "lengthMenu": "Mostrar _MENU_ registros",
                        "zeroRecords": "No se encontraron resultados",
                        "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                        "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                        "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                        "sSearch": "Buscar:",
                        "oPaginate": {
                            "sFirst": "Primero",
                            "sLast":"Último",
                            "sNext":"Siguiente",
                            "sPrevious": "Anterior"
                        },
                        "sProcessing":"Procesando...",
                    }
                });

                    //Para cambiar el lenguaje a español
                

            });

            function registra() {
                $('#reg').attr('disabled', true);
                if($('input:radio[name=usoExterno]:checked').val()=='Si' && ($('#aprobado').val()).length < 1){
                    swal('Alerta!', 'Debe indicar el aprobado por ', 'error');
                    $('#aprobado').css('background-color','#74f594');
                    $('#reg').attr('disabled', false);
                    return false;
                }else{
                    $.ajax({
                        type: 'GET',
                        url: "inventarioRetiEncabezado.php",
                        data: $('#formulario').serialize(),
                        success: function (data) {
                            if (data == 'Registro completado con exito') {
                                $('#reg').attr('disabled', false);
                                $('#info').addClass('mensaje').html(data).show(200).delay(1500).hide(200);
                                setTimeout('location.reload()', 550);
                            } else {
                                $('#reg').attr('disabled', false);
                                $('#info').addClass('mensajeError').html(data).show(200).delay(1500).hide(200);
                                return false;
                            }
                        }
                    });
                }
                return false;
            }

            function retira() {
                $.ajax({
                    type: 'GET',
                    url: "inventariosRetiros_modificar.php",
                    data: $('#formularioModal').serialize(),
                    success: function (data) {
                        if (data == 'Registro completado con exito') {
                            $('#reg').attr('disabled', false);
                            $('#info').addClass('mensaje').html(data).show(200).delay(1500).hide(200);
                            location.reload();
                        } else {
                            $('#reg').attr('disabled', false);
                            $('#info').addClass('mensajeError').html(data).show(200).delay(1500).hide(200);
                            return false;
                        }
                    }
                });     
            }

            function pdf(num){
                window.open("inventariosRetirosPDF.php?numRetir=" + num, "Reporte"); 
                return false
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
                    window.open("inventariosRetirosPDF.php?numRetir=" + inputValue, "Reporte");
                });
        }



        </script>
    </body>
</html>    