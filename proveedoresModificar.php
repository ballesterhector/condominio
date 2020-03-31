<?php
    require "html/head.php";
    
    $obj= new conectarDB();
    $data= $obj->subconsulta("CALL proveedorSelect('".$_GET['numProvee']."')");
    foreach ($data as $filas) {
        
    }    
?>
    <div class="titulo">
        <div class="columna1">
            <h2 class="letra">Actualizar data del proveedores</h2>
        </div>
        <div class="columna2">
            <a href="#" onclick="window.open('http:ayudas/proveedores.pdf')" /><span class="icon-local_library" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Manual"></s></a>
        </div>
        <div class="columna3">
            <a href="proveedores.php"><span class="icon-reply1" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Devolverse"></s></a>
        </div>
    </div>
    <div class="container-fluid cajaresidencia" id=''>
        <div class="column1">
            <div>
                <span class="form-control">Código</span>
                <span class="form-control">Propietario</span>
                <span class="form-control">RIF</span>
                <span class="form-control">Dirección</span>
            </div>
            <div>
               <input type="text" class="form-control" id="numprovee" value="<?php echo str_pad($filas['numprovee'], 7, "0", STR_PAD_LEFT) ?>" disabled style="width:280px">
                <input type="text" class="form-control" value="<?php echo $filas['proveedor'] ?>" disabled style="width:280px">
                <input type="text" class="form-control" value="<?php echo $filas['rifprovee'] ?>" disabled style="width:280px">
               <textarea class="form-control" name="" id="" cols="12" rows="2" disabled><?php echo $filas['direccionprovee'] ?></textarea>
            </div>   
        </div>
        <div class="column2">
            <div>
                <span class="form-control">Contacto</span>
                <span class="form-control">Teléfono</span>
                <span class="form-control">Teléfono</span>
                <span class="form-control">Correo</span>
            </div>
            <div>
                <input type="text" class="form-control" name="proveedorcontacto" value="<?php echo $filas['proveedorcontacto'] ?>" >
                <input type="text" class="form-control" name="telefo1" value="<?php echo $filas['telefo1'] ?>" >
                <input type="text" class="form-control" name="telefo2" value="<?php echo $filas['telefo2'] ?>" >
                <input type="text" class="form-control" name="emailprov" value="<?php echo $filas['emailprov'] ?>" >
            </div>
        </div>
    </div>
    <div id="respuesta"></div>
	<?php require "html/footer.php"?>
	<script src="jsBody/proveedores.js"></script>
    </div>
</body>
</html>