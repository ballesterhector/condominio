<?php
    require "html/head.php";

    $obj= new conectarDB();
    $data= $obj->subconsulta("CALL usuarioSelectPorCedula('".$cedula."')");
    foreach ($data as $fila) {
?>
    <div class="titulo">
        <div class="columna1">
            <h4 class="letra" style="text-align:center">BIENVENIDO AL SISTEMA ASDA DE CONTROL DE CONDOMINIOS</h4>
        </div>
        <div class="columna2">
			<a href="#" onclick="window.open('http:ayudas/index.pdf')" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Manual"><span class="icon-local_library"></span></a>
		</div>
    </div>    
    <div>
        <input type="hidden" id="cedul" value="<?php echo $cedula ?>">
        <input type="hidden" id="propiet" value="<?php echo $esPropietario ?>">
    </div>    
    <div class="container cajaIndex" >
        <article class="regist" style="">
            <div class="usuA">
                <input type="text" class="form-control" value="USUARIO" style="width:100px"><br>
                <input type="text" class="form-control" value="E-MAIL"style="width:100px"><br>
                <input type="text" class="form-control" value="TELÉFONO"style="width:100px"><br>
                <input type="text" class="form-control" value="ESTADO"style="width:100px"><br>
            </div> 
            <div class="usuB">
                <input type="text" class="form-control estado" value="<?php echo  $fila['nombreUsuario'] ?>" disabled><br>
                <input type="text" class="form-control estado" name="correoUsuario" value="<?php echo $fila['correoUsuario']  ?>"><br>
                <input type="text" class="form-control estado" name="telefonoUsuario" value="<?php echo $fila['telefonoUsuario'] ?>"><br>
                <input type="text" class="form-control estado" name="estadoUsuario" id="estado" value="<?php echo $fila['estadoUsuario']  ?>" disabled><br>
            </div>    
	    </article>
         <input type="hidden" id="numusua" value="<?php echo $numusua?>" >
        <?php } ?>
    </div>

    <?php require "html/footer.php"?>
    </div>

    <script type="text/javascript">
        var numero = document.getElementById('numusua').value;
    
        $('input').on('change', function() {
            var field = $(this);
            var dataString = 'value='+field.val()+'&field='+field.attr('name')+'&numero='+numero;
        
            $.ajax({
                type: "POST",
                url: "index_EntradaFunciones.php",
                data: dataString,
                success: function () {
                    location.reload();
                }
            });
        });

    </script>
 </body> 
</html>			
	
    
    