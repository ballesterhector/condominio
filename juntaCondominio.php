<?php
    require "html/head.php";
?>
    <div class="titulo">
        <div class="columna1">
            <h2 class="letra">Junta Condominio</h2>
        </div>
        <div class="columna2">
            <a href="#" onclick="window.open('http:ayudas/juntaCondominio.pdf')" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Manual"><span class="icon-local_library"></span></a>
        </div>
        <div class="columna3">
            <label for="" class="">
                <select class="form-control" name="condominio" id="numpropie" style="width:240px">
                    <option value="">Propietarios</option>
                    <?php
                        $obj = new conectarDB();
                        $data = $obj->consultar("CALL usuariosJCSelect('0')");
                        foreach($data as $key){
                            echo "<option value='".$key['numusuario']."'>".$key['nombreUsuario']."</option>";
                        }
                    ?>
                </select>
            </label>
        </div>
    </div>
    <div class="container "  id=''>
        <div class="tabla">
            <table class="table  table-bordered table-responsive display compact" id="dataTables">
                <thead>
                    <tr class="alert alert-info">
                        <th class="text-center">Código</th>
                        <th class="text-center">Propietario</th>
                        <th class="text-center">Cargo</th>
                        <th class="text-center">Teléfono</th>
                        <th class="text-center">Teléfono</th>
                        <th class="text-center">Correo</th>
                        <th class="text-center">Acción</th>
                    </tr>
                </thead>
                <tbody style="cursor:pointer">
                    <?php
                        $obj= new conectarDB();
                        $data= $obj->subconsulta("CALL juntaCondominioSelect('0')");
                        $dat= json_encode($data);
                            if ($dat=='null') {
                                echo '';
                            }else{
                                foreach ($data as $filas) { ?>
                                    <tr>
                                        <td align="center"><?php echo str_pad($filas['numusuario'], 7, "0", STR_PAD_LEFT) ?></td>
                                        <td><?php echo $filas['nombreUsuario'] ?></td>
                                        <td><?php echo $filas['cargo'] ?></td>
                                        <td><?php echo $filas['telefonoUsuario'] ?></td>
                                        <td><?php echo $filas['telefonoUsuario2'] ?></td>
                                        <td><?php echo $filas['correoUsuario'] ?></td>
                                        <td class="text-center">
                                            <a href='juntacondominioModificar.php?numPropi=<?php echo $filas['numusuario'] ?>' aria-hidden="true" data-toggle="tooltip" data-placement="top" title='Modificar'><span class="icon-border_color"></span></a>
                                        </td>
                                    </tr>
                            <?php } ?>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
	
	<?php require "html/footer.php"?>
    <script src="jsBody/juntacondominio.js"></script>
   </div>
</body>
</html>