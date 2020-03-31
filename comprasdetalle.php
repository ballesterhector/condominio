<?php
    require "html/head.php";
    
    $obj= new conectarDB();
    $data= $obj->subconsulta("CALL gastosSelectNumgasto('".$_GET['numgasto']."')");
    foreach ($data as $filas) {
   
?>
    <div class="titulo">
        <div class="columna1">
            <h2 class="letra">Detalle de la compra de insumos</h2>
        </div>
        <div class="columna2">
            <a href="#" onclick="window.open('http:ayudas/proveedores.pdf')" /><span class="icon-local_library" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Manual"></span></a>
             <div class="columna2">
            <a href="#" onclick="window.open('http:inventariosComprasPDF.php?numCompra=<?php echo $filas['numgasto']  ?>')" /><span class="icon-local_print_shopprint" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Reporte"></span></a>
        </div>
       
        </div>
        <div class="columna3">

        <h3 class="letra"><?php echo $filas['nombrecj'] ?></h3>
        </div>
    </div>
    <div class="container-fluid cajarConTabla" id=''>
        <div class="column1">
            <div>
                <span class="form-control">Código</span>
                <span class="form-control">Factura</span>
                <span class="form-control">Periódo</span>
                <span class="form-control">Total</span>
                <span class="form-control">Proveedor</span>
                <span class="form-control">Producto</span>
                <span class="form-control">Adquisición</span>
                <span class="form-control">Observación</span>
            </div>
            <div>
               <input type="text" class="form-control" id="numprovee" value="<?php echo str_pad($filas['numgasto'], 7, "0", STR_PAD_LEFT) ?>" disabled style="width:280px">
                <input type="text" class="form-control" value="<?php echo $filas['facturagast'] ?>" disabled style="width:280px">
                <input type="text" class="form-control" name="proveedorcontacto" value="<?php echo $filas['periodo'] ?>" style="width: 100px;text-align: center;" disabled>

                <div class="gasto">
                    <input type="text" class="form-control" name="" id="totFactu" value="<?php echo $filas['totalfactura'] ?>" disabled>
        Registradas <input type="text" class="form-control" id="total" value=0 disabled>
                </div>
                
                <input type="text" class="form-control" name="" value="<?php echo $filas['proveedor'] ?>" disabled>
               
               
                <form id="formulario" class="form-horizontal" onsubmit="return compraDetalle();">
                    <input type="hidden" class="form-control" name="numgas" id="numgas" value="<?php echo $filas['numgasto'] ?>" >
                    <input type="hidden" class="form-control" name="proceso" value="compraDetalle" >
                  
                    <select class="form-control" name="descrip" id="descrip" required="require">
                        <option value=""></option>
                        <?php
                            $obj = new conectarDB();
                            $data = $obj->consultar("CALL insumoRubroSelect()");
                            foreach($data as $key){
                                echo "<option value='".$key['codigRubro']."'>".$key['insumoRubr']."</option>";
                            }
                        ?>
                    </select>

                    <div class="gasto">
                        <input type="text" class="form-control" name="cantid" id="cantid" value="" placeholder="Cantidad" >
                        <input type="text" class="form-control" name="cost" id="cost" value="" placeholder="Costo" >
            Registrar <input type="text" class="form-control" name="gastotot" id="gastotot" value="0" readonly>
                    </div>
                    <input type="text" class="form-control" name="observ" value="">
                    <input type="hidden" name="usua" id="usua"  value="<?php echo $usuario ?>">
                    
                    <div class="modal-footer" id="cerrando">
                        <input type="submit" value="Registrar" class="btn btn-success text-center" id="reg" />
                        <input type="button" class="btn btn-info text-center" id="cerrar" value="Cerrar">
                    </div>
				</form>
            </div>   
        </div>
         <?php } ?>
        <div class="column2">
        <div class="tabla">
            <table class="table  table-bordered table-responsive display compact" id="dataTables">
                <thead>
                    <tr class="">
                        <th class="text-center">Correlativo</th>
                        <th class="text-center">Producto</th>
                        <th class="text-center">Cantidad</th>
                        <th class="text-center">Costo</th>
                        <th class="text-center">Gasto</th>
                        <th class="text-center">Presentación</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $obj= new conectarDB();
                        $data= $obj->subconsulta("CALL gastosDetallePorGastoSelect('".$_GET['numgasto']."')");
                        $dat= json_encode($data);
                            if ($dat=='null') {
                                echo '';
                            }else{
                                foreach ($data as $filas) { ?>
                                    <tr>
                                        <td align="center"><?php echo str_pad($filas['numgasto'], 7, "0", STR_PAD_LEFT) ?></td>
                                        <td style=""><?php echo $filas['descripcion'] ?></td>
                                        <td style="text-align:center"><?php echo $filas['cantidad'] ?></td>
                                        <td class="text-right"><?php echo $filas['costo'] ?></td>
                                        <td class="text-right"><?php echo $filas['gastoTot'] ?></td>
                                        <td class="text-right"><?php echo $filas['presentacion'] ?></td>
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
	<script src="jsBody/comprasdetalle.js"></script>
    </div>
</body>
</html>