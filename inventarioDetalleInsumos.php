<?php
    require "html/head.php";
    
    $obj= new conectarDB();
    $data= $obj->subconsulta("CALL residenciasSelect('1')");
    foreach ($data as $filas) {
            
?>
    <div class="titulo">
        <div class="columna1">
            <h2 class="letra">Relación detallada del inventario</h2>
        </div>
        <div class="columna2">
            <input type="text" class="form-control" id="peri" style="width:80px" value="<?php echo $_GET['periodo'] ?>">
            <a href="#" onclick="window.open('http:aplicaciones/ayudas/proveedores.pdf')" /><i class="fas fa-book fa-2x" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Manual"></i></a>
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
                    <tr class="">
                        <th class="text-center">Proveedor</th>
                        <th class="text-center">Factura</th>
                        <th class="text-center">Fecha</th>
                        <th class="text-center">Periodo</th>
                        <th class="text-center">Producto</th>
                        <th class="text-center">Cantidad</th>
                        <th class="text-center">Presentación</th>
                        <th class="text-center">Movimiento</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                        $obj= new conectarDB();
                        $data= $obj->subconsulta("CALL inventarioDetalleSelect('".$_GET['periodo']."')");
                        $dat= json_encode($data);
                            if ($dat=='null') {
                                echo '';
                            }else{
                                foreach ($data as $filas) { ?>
                                    <tr>
                                        <td><?php echo $filas['proveedor'] ?></td>
                                        <td style="text-align:center"><?php echo $filas['facturagast'] ?></td>
                                        <td style="text-align:center"><?php echo $filas['fechagast'] ?></td>
                                        <td style="text-align:center"><?php echo $filas['periodo'] ?></td>
                                        <td><?php echo $filas['descripcion_inv'] ?></td>
                                        <td style="text-align:center"><?php echo $filas['cantidad_inv'] ?></td>
                                        <td style="text-align:center"><?php echo $filas['unidad'] ?></td>
                                        <td style="text-align:center"><?php echo $filas['movimiento_inv'] ?></td>
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
	<script src="aplicaciones/js/paginas/inventarios.js"></script>
    </div>
</body>
</html>