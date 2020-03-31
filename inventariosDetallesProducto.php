<?php
    require "html/head.php";
    
    $obj= new conectarDB();
    $data= $obj->subconsulta("CALL residenciasSelect('1')");
    foreach ($data as $filas) {
            
?>
    <div class="titulo">
        <div class="columna1">
            <h2 class="letra">Inventarios por rubro</h2>
        </div>
        <div class="columna2">
            <a href="#" onclick="window.open('http:/compras.pdf')" /><span class="icon-local_library" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Manual"></span></a>
            <a href="inventariosDetalles.php?periodo=<?php echo $_GET['peri']?>"><span class="icon-reply1" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Devolverse"></span></a>
        </div>
        <div class="columna3">

            <h3 class="letra"><?php echo $filas['nombrecj'] ?></h3>
        </div>
    <?php } ?>
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
                        <th class="text-center">Fecha</th>
                        <th class="text-center">Periodo</th>
                        <th class="text-center">Rubro</th>
                        <th class="text-center">Cantidad</th>
                        <th class="text-center">Presentación</th>
                        <th class="text-center">Movimiento</th>
                        <th class="text-center">Usuario</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $obj= new conectarDB();
                        $data= $obj->subconsulta("CALL inventarioDetallePorInsumo('".$_GET['rubro']."')");
                        $dat= json_encode($data);
                            if ($dat=='null') {
                                echo '';
                            }else{
                                foreach ($data as $filas) { ?>
                                    <tr class="">
                                        <?php if ($filas['cantidad_inv']>=0) { ?>
                                            <td align="center" style="background: #cbf8d7"><?php echo str_pad($filas['idinventario'], 7, "0", STR_PAD_LEFT) ?></td>
                                            <td style="background: #cbf8d7"><?php echo $filas['fechaMovimiento'] ?></td>
                                            <td style="text-align:center;background: #cbf8d7"><?php echo $filas['periodo'] ?></td>
                                            <td style="text-align:center;background: #cbf8d7"><?php echo $filas['descripcion_inv'] ?></td>
                                            <td style="text-align:right;background: #cbf8d7"><?php echo $filas['cantidad_inv'] ?></td>
                                            <td style="text-align:right;background: #cbf8d7"><?php echo $filas['unidad'] ?></td>
                                            <td style="text-align:right;background: #cbf8d7"><?php echo $filas['movimiento_inv'] ?></td>
                                            <td style="text-align:right;background: #cbf8d7"><?php echo $filas['usuarioRetiro_inv'] ?></td>
                                        <?php } else {?>    
                                            <td align="center" style="background: #f3ceed"><?php echo str_pad($filas['idinventario'], 7, "0", STR_PAD_LEFT) ?></td>
                                            <td style="background: #f3ceed"><?php echo $filas['fechaMovimiento'] ?></td>
                                            <td style="text-align:center;background: #f3ceed"><?php echo $filas['periodo'] ?></td>
                                            <td style="text-align:center;background: #f3ceed"><?php echo $filas['descripcion_inv'] ?></td>
                                            <td style="text-align:right;background: #f3ceed"><?php echo $filas['cantidad_inv'] ?></td>
                                            <td style="text-align:right;background: #f3ceed"><?php echo $filas['unidad'] ?></td>
                                            <td style="text-align:right;background: #f3ceed"><?php echo $filas['movimiento_inv'] ?></td>
                                            <td style="text-align:right;background: #f3ceed"><?php echo $filas['usuarioRetiro_inv'] ?></td>
                                        <?php }?>    
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
            "order": [[0, 'asc']],
            "lengthMenu": [[10], [10]],

            });
    

        });

    </script>
</body>
</html>