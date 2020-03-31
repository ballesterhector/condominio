<?php
    require "html/head.php";
    
    $obj= new conectarDB();
    $data= $obj->subconsulta("CALL usuariosSelect('".$_GET['numPropi']."')");
    foreach ($data as $filas) {
        
    }    
?>
    <div class="titulo">
        <div class="columna1">
            <h2 class="letra">Actualizar data Junta Condominio</h2>
        </div>
        <div class="columna2">
        <a href="#" onclick="window.open('http:ayudas/juntaCondominio.pdf')" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Manual"><span class="icon-local_library"></span></a>
        </div>
    </div>
    <div class="container cajaEntrada" id=''>
        <input type="hidden" name="numusu" id="numusu" value="<?php echo $_GET['numPropi']?>">
        <div class="column">
            <div class="column1">
                <div>
                    <span class="form-control">Código</span>
                    <span class="form-control">Propietario</span>
                </div>
                <div>
                    <input type="text" class="form-control" value="<?php echo str_pad($filas['numusuario'], 7, "0", STR_PAD_LEFT) ?>" disabled style="width:280px">
                    <input type="text" class="form-control" value="<?php echo $filas['nombreUsuario'] ?>" disabled style="width:280px">
                </div>   
            </div>
            <div class="column2">
                <div>
                    <span class="form-control">Teléfono</span>
                    <span class="form-control">Teléfono</span>
                    <span class="form-control">Correo</span>
                    <span class="form-control">Integrante</span>
                    <span class="form-control">Cargo</span>
                </div>
                <div>
                    <input type="text" class="form-control" name="telefonoUsuario" value="<?php echo $filas['telefonoUsuario'] ?>" >
                    <input type="text" class="form-control" name="telefonoUsuario2" value="<?php echo $filas['telefonoUsuario2'] ?>" >
                    <input type="text" class="form-control" name="correoUsuario" value="<?php echo $filas['correoUsuario'] ?>" >
                    <select class="form-control" name="condominio" id="condominio">
                        <option value="<?php echo $filas['condominio'] ?>"><?php echo $filas['integracondominio'] ?></option>
                        <option value="1">Si</option>
                        <option value="0">No</option>
                    </select>
                    <input type="text" class="form-control" name="cargo" id="cargo" value="<?php echo $filas['cargo'] ?>" style="width:280px">
                </div>
            </div>
        </div> 
    </div>
	<div id="respuesta"></div>
	<?php require "html/footer.php"?>
	<script src="jsBody/juntacondominioModificar.js"></script>
    </div>
</body>
</html>    