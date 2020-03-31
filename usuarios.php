<?php

    require "html/head.php";

    if ($juntaCond==1 || $esPropietario==3) {
        $codig = 0;        
    } else {
        $codig = $numusua;
    }
    
?>
    <div class="titulo">
        <div class="columna1">
            <h2 class="letra">Data usuarios</h2>
        </div>
        <div class="columna2">
            <a href="#" onclick="window.open('http:ayudas/usuariosNoPropietarios.pdf')" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Manual"><span class="icon-local_library"></span></a>
        </div>
    </div>
    <div class="container"  id=''>
        <div class="tabla">
            <table class="table  table-bordered table-responsive display compact" id="dataTables">
                <thead>
                    <tr class="alert alert-info">
                        <th class="text-center">Código</th>
                        <th class="text-center">Usuario</th>
                        <th class="text-center">Cedula</th>
                        <th class="text-center">Es propietario</th>
                        <th class="text-center">Teléfono</th>
                        <th class="text-center">Teléfono</th>
                        <th class="text-center">Correo</th>
                        <th class="text-center">Estado</th>
                        <th class="text-center">Acción</th>
                    </tr>
                </thead>
                <tbody style="cursor:pointer">
                    <?php
                        $obj= new conectarDB();
                        $data= $obj->subconsulta("CALL usuarioSelectPorNumero('".$codig."')");
                        $dat= json_encode($data);
                            if ($dat=='null') {
                                echo '';
                            }else{
                                foreach ($data as $filas) { ?>
                                    <tr>
                                        <td align="center"><?php echo str_pad($filas['numusuario'], 7, "0", STR_PAD_LEFT) ?></td>
                                        <td><?php echo $filas['nombreUsuario'] ?></td>
                                        <td><?php echo $filas['cedulaUsuario'] ?></td>
                                       

                                        <?php if ($filas['es_propietario']=='No') {?>
                                            <td align="center" style="background:#fca171;color:#fff"><?php echo $filas['es_propietario'] ?></td>
                                        <?php } else {?>
                                            <td align="center" style="background:#D0F5A9;color:#000"><?php echo $filas['es_propietario'] ?></td>
                                        <?php }?>




                                        <td><?php echo $filas['telefonoUsuario'] ?></td>
                                        <td><?php echo $filas['telefonoUsuario2'] ?></td>
                                        <td><?php echo $filas['correoUsuario'] ?></td>

                                        <?php if ($filas['estadoUsuario']=='Inactivo') {?>
                                            <td style="background:#fca171;color:#fff;font-size:14px"><?php echo $filas['estadoUsuario'] ?></td>
                                        <?php } else {?>
                                            <td class=""><?php echo $filas['estadoUsuario'] ?></td>
                                        <?php }?>    
                                        <td class="text-center">
                                            <a href='usuariosModificar.php?numPropi=<?php echo $filas['numusuario'] ?>' aria-hidden="true" data-toggle="tooltip" data-placement="top" title='Modificar'><span class="icon-border_color"></span></a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
	
	<?php require "html/footer.php"?>
    <script src="jsBody/usuarios.js"></script>
    </div>
</body>
</html>