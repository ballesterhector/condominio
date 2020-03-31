<?php
    require "html/head.php";
    
    $obj= new conectarDB();
    $data= $obj->subconsulta("CALL residenciasSelect('1')");
    foreach ($data as $filas) {
            
?>
    <div class="titulo">
        <div class="columna1">
            <h2 class="letra">Gastos por servicios por año</h2>
        </div>
        <div class="columna2">
            <input type="text" class="form-control" id="del" style="width:80px" value="<?php echo $_GET['del'] ?>">
            <input type="text" class="form-control" id="al" style="width:80px" value="<?php echo $_GET['al'] ?>">
            <input type="button" id="busca"  value="busca">
            <a href="#" onclick="window.open('http:aplicaciones/ayudas/compras.pdf')" /><i class="fas fa-book fa-2x" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Manual"></i></a>
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
                        <th class="text-center">Tipo gasto</th>
                        <th class="text-center">Proveedor</th>
                        <th class="text-center">Factura</th>
                        <th class="text-center">Fecha</th>
                        <th class="text-center">Año</th>
                        <th class="text-center">Periodo</th>
                        <th class="text-center">Producto</th>
                        <th class="text-center">Motivo</th>
                        <th class="text-center">Observaciones</th>
                        <th class="text-center">Gasto</th>
                        <th class="text-center">Registro por</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $obj= new conectarDB();
                        $data= $obj->subconsulta("CALL gastosPorServiciosPorAno('".$_GET['del']."','".$_GET['al']."')");
                        $dat= json_encode($data);
                            if ($dat=='null') {
                                echo '';
                            }else{
                                foreach ($data as $filas) { ?>
                                    <tr>
                                        <td><?php echo $filas['tipogastoServ'] ?></td>
                                        <td><?php echo $filas['proveedor'] ?></td>
                                        <td style="text-align:center"><?php echo $filas['factura_serv'] ?></td>
                                        <td style="text-align:center"><?php echo $filas['fecha_serv'] ?></td>
                                        <td style="text-align:center"><?php echo $filas['año'] ?></td>
                                        <td style="text-align:center"><?php echo $filas['periodo_serv'] ?></td>
                                        <td><?php echo $filas['movimiento_serv'] ?></td>
                                        <td style="text-align:right"><?php echo $filas['motivo_serv'] ?></td>
                                        <td style="text-align:right"><?php echo $filas['observacion_serv'] ?></td>

                                        <?php if ($filas['observacion_serv']=='Total') {?>
                                            <td style="background:#fca171;color:#fff;font-size:12px;text-align:right"><?php echo $filas['gastoTot'] ?></td>
                                        <?php } else {?>
                                            <td style="text-align:right"><?php echo $filas['gastoTot'] ?></td>
                                        <?php }?>
                                       
                                        <td style="text-align:right"><?php echo $filas['usuarioregistro_serv'] ?></td>
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
		"order": [[4, 'desc'],[3, 'desc']],
        "lengthMenu": [[10], [10]]
        
	 });

    });

    $('#busca').on('click',function(){
	var del = document.getElementById('del').value;
	var al = document.getElementById('al').value;
	document.location = 'gastosPorServiciosPorAno.php?del=' + del + '&al=' + al;
    });
    
    </script>

</body>
</html>

