<?php
    require "html/head.php";
    
    $obj= new conectarDB();
    $data= $obj->subconsulta("CALL residenciasSelect('0')");
    foreach ($data as $filas) {
?>
    <div class="titulo">
        <div class="columna1">
            <h2 class="letra">Conjunto residencial</h2>
        </div>
        <div class="columna2">
            <a href="#" onclick="window.open('http:ayudas/residencias.pdf')" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Manual"><span class="icon-local_library"></span></a>
        </div>
    </div>
    
    <div class="container-fluid cajaEntrada" id=''>
        <div class="column">
            <div class=" column1">
                <div>
                    <span class="form-control">Código</span>
                    <span class="form-control">Residencia</span>
                    <span class="form-control">Rif</span>
                    <span class="form-control">Dirección</span>
                </div>
                <div>
                    <input type="text" class="form-control" value="<?php echo str_pad($filas['numcj'], 7, "0", STR_PAD_LEFT) ?>" disabled>
                    <input type="text" class="form-control" value="<?php echo $filas['nombrecj'] ?>" disabled>
                    <input type="text" class="form-control" value="<?php echo $filas['rifcj'] ?>" disabled>
                    <input type="text" class="form-control" value="<?php echo $filas['direccion'] ?>" disabled>
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
                    <input type="text" class="form-control desbloq" name="contactocj2" value="<?php echo $filas['contactocj2']?>" disabled>
                    <input type="text" class="form-control desbloq" name="telefo1cj" value="<?php echo $filas['telefo1cj']?>" disabled>
                    <input type="text" class="form-control desbloq" name="telefo2cj" value="<?php echo $filas['telefo2cj'] ?>" disabled>
                    <input type="text" class="form-control desbloq" name="emailcj" value="<?php echo $filas['emailcj'] ?>" disabled>
                </div>
                 
            </div>
        </div>   
     <?php } ?>
    </div>
	
	<?php require "html/footer.php"?>
	<script src="jsBody/residencias.js"></script>
    </div>
</body>
</html>