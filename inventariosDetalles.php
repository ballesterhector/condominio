<?php
    require "html/head.php";
    
    if($_GET['periodo']=='01/2016'){
        $peri=date('m/Y');
    }else{
        $peri=$_GET['periodo'];
    }       
?>
    <div class="titulo">
        <div class="columna1">
            <h3 class="letra">Inventario evolución por periodo</h3>
        </div>
        <div class="columna2">
            <input type="text" class="form-control" id="peri" style="width:100px;text-align:center" value="<?php echo $peri ?>">
            <a href="#" onclick="window.open('http:ayudas/compras.pdf')" /><span class="icon-local_library" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Manual"></sp></a>
        </div>
        <div class="columna3">

            <h3 class="letra"><?php echo $residencias ?></h3>
        </div>
    
    </div>
    <div class="container-fluid cajarConTabla" id=''>
        <div class="column1">
        </div>
        <div class="column2">
        <div class="tabla">
            <table class="table  table-bordered table-responsive display compact" id="dataTables">
                <thead>
                    <tr class="alert alert-info">
                        <th class="text-center">Código</th>
                        <th class="text-center">Documento</th> 
                        <th class="text-center">Fecha</th>
                        <th class="text-center">Movimiento</th>
                        <th class="text-center">Rubro</th>
                        <th class="text-center">Cantidad</th>
                        <th class="text-center">Presentación</th>
                        <th class="text-center">Usuario</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $obj= new conectarDB();
                        $data= $obj->subconsulta("CALL inventarioDetallePeriodo('".$peri."')");
                        $dat= json_encode($data);
                            if ($dat=='null') {
                                echo '';
                            }else{
                                foreach ($data as $filas) { ?>
                                    <tr>
                                        <td align="center" style=""><?php echo str_pad($filas['idinventario'], 7, "0", STR_PAD_LEFT) ?></td>
                                        <td style="color: blue; text-align: center;cursor: pointer;text-decoration:underline "><?php echo $filas['numeDocumento_inv'] ?></td>
                                        <td style=""><?php echo $filas['fechaMovimiento'] ?></td>
                                        <td style="text-align:right;"><?php echo $filas['movimiento_inv'] ?></td>
                                        <td style="text-align:center;"><?php echo $filas['descripcion_inv'] ?></td>
                                        <td style="text-align:right;"><?php echo $filas['cantidad_inv'] ?></td>
                                        <td style="text-align:right;"><?php echo $filas['unidad'] ?></td>
                                        <td style="text-align:right;"><?php echo $filas['usuarioRetiro_inv'] ?></td>
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
            $('#dataTables').dataTable({
                "order": [[4, 'asc'],[3, 'asc']],
                "lengthMenu": [[10], [10]],                
            });
        });

        $('#peri').on('change',function(){
            var data = document.getElementById('peri').value;
            document.location = 'inventariosDetalles.php?periodo=' + data;
        });


        $("tr").click(function(){
            var nume = ($(this).find("td").eq(1).html());


            if(nume>=1){
                if(($(this).find("td").eq(3).html())==='Retiro'){
                    window.open("inventariosRetirosPDF.php?numRetir=" + nume, "Reporte");
                }else{
                    window.open("inventariosComprasPDF.php?numCompra=" + nume, "Reporte");
                }
            }    
        });



     </script>   
</body>
</html>