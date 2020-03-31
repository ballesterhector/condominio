<?php
    require "html/head.php";

    $obj= new conectarDB();
    $data= $obj->subconsulta("CALL usuariosNoPropietarioSelect('".$_GET['numPropi']."')");
    foreach ($data as $filas) {
        
    }    
?>
    <div class="titulo">
        <div class="columna1">
            <h2 class="letra">Actualizar data del usuario</h2>
        </div>
        <div class="columna2">
            <a href="#" onclick="window.open('http:ayudas/usuariosNoPropietarios.pdf')" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Manual"><span class="icon-local_library"></span></a>
        </div>
        <div class="columna3">
            <a href="usuarios.php"><span class="icon-menu_open" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Devolverse"></span></a>
        </div>
    </div>
    <div class="container-fluid cajaresidencia" id=''>
        <input type="hidden" id="juntasC" value="<?php echo $permiso?>">
        <input type="hidden" name="numero" id="numero" value="<?php echo $_GET['numPropi']?>">
        <input type="hidden" id="estado" value="<?php echo $filas['estadoUsuario']?>">
            <div class="column1">
                <div>
                    <span class="form-control">Código</span>
                    <span class="form-control">Propietario</span>
                    <span class="form-control">Cedula</span>
                </div>
                <div>
                    <input type="text" class="form-control" value="<?php echo str_pad($filas['numusuario'], 7, "0", STR_PAD_LEFT) ?>" disabled >
                    <input type="text" class="form-control" value="<?php echo $filas['nombreUsuario'] ?>" disabled >
                    <input type="text" class="form-control" value="<?php echo $filas['cedulaUsuario'] ?>" disabled >
                </div>   
            </div>
            <div class="column2">
                <div>
                    <span class="form-control">Teléfono</span>
                    <span class="form-control">Teléfono</span>
                    <span class="form-control">Correo</span>
                </div>
                <div>
                    <input type="text" class="form-control" name="telefonoUsuario" value="<?php echo $filas['telefonoUsuario'] ?>" >
                    <input type="text" class="form-control" name="telefonoUsuario2" value="<?php echo $filas['telefonoUsuario2'] ?>" >
                    <input type="text" class="form-control" name="correoUsuario" value="<?php echo $filas['correoUsuario'] ?>" >
                </div>
            </div>
            <div class="column3">
                <div>
                    <span class="form-control">Propietario?</span>
                    <span class="form-control">Estado</span>
                    <span class="form-control">Motivo</span>
                </div>
                <div>
                    <select class="form-control" id="esPropieta" name="es_propietario" id="">
                        <option value=""><?php echo $filas['propietar'] ?></option>
                        <option value="1">Si</option>
                        <option value="0">No</option>
                    </select>
                    <select class="form-control" name="estadoUsuario" id="estadoUsuario">
                        <option value=""><?php echo $filas['estadoUsuario'] ?></option>
                        <option value="Activo">Activo</option>
                        <option value="Inactivo">Inactivo</option>
                    </select>
                    <textarea class="form-control" name="motivoestado" id="motivoestado" cols="30" rows="2" style="margin-top:-2px" ><?php echo $filas['motivoestado'] ?></textarea>    
                </div>
            </div>
    </div>
	<div id="respuesta"></div>
	<?php require "html/footer.php"?>
	<script src="jsBody/usuarios.js"></script>
    </div>
</body>
</html>