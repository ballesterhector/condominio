<?php
    require "html/head.php";
    
    $obj= new conectarDB();
    $data= $obj->subconsulta("CALL apartamentosSelect('".$_GET['numApt']."')");
    foreach ($data as $filas) {
        
    }    
?>
    <div class="titulo">
        <div class="columna1">
            <h2 class="letra">Actualizar data de la unidad habitacional</h2>
        </div>
        <div class="columna2">
            <a href="#" onclick="window.open('http:aplicaciones/ayudas/apartamentos.pdf')" /><i class="fas fa-book fa-2x" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Manual"></i></a>
        </div>
        <div class="columna3">
            <a href="apartamentos.php"><i class="fas fa-angle-double-left fa-2x" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Devolverse"></i></a>
        </div>
    </div>
    <input type="hidden" id="juntasC" value="<?php echo $juntaCond?>">
    <div class="container-fluid cajaresidencia" id=''>
        <input type="hidden" name="numeapto" id="numeapto" value="<?php echo $_GET['numApt']?>">
        <div class="column1">
            <div>
                <span class="form-control">Código</span>
                <span class="form-control">Residencia</span>
                <span class="form-control">Edificio</span>
                <span class="form-control">Apartamento</span>
            </div>
            <div>
                <input type="text" class="form-control" value="<?php echo str_pad($filas['numApt'], 7, "0", STR_PAD_LEFT) ?>" disabled style="width:280px">
                <input type="text" class="form-control" value="<?php echo $filas['nombrecj'] ?>" disabled style="width:280px">
                <input type="text" class="form-control" value="<?php echo $filas['edificio'] ?>" disabled style="width:280px">
                <input type="text" class="form-control" value="<?php echo $filas['apartamento'] ?>" disabled style="width:280px">
            </div>   
        </div>
        <div class="column2">
            <div>
                <span class="form-control">Propietario</span>
                <span class="form-control">Teléfono</span>
                <span class="form-control">Teléfono</span>
                <span class="form-control">Correo</span>
            </div>
            <div>
                <label for="" class="">
					<select class="form-control desbloq" name="numpropiet" id="numpropiet" style="width:240px;padding-bottom: 0" disabled>
						<option value=""><?php echo $filas['nombreUsuario'] ?></option>
						<?php
							$obj = new conectarDB();
							$data = $obj->consultar("CALL usuariosSelect('0')");
							foreach($data as $key){
								echo "<option value='".$key['numusuario']."'>".$key['nombreUsuario']."</option>";
					    	}
						?>
				    </select>
				</label>
                <input type="text" class="form-control" name="telefonoP1" value="<?php echo $filas['telefonoUsuario']?>" style="width:240px;margin-top:-5px" disabled>
                <input type="text" class="form-control" name="telefonoP2" value="<?php echo $filas['telefonoUsuario2'] ?>" style="width:240px" disabled>
                <input type="text" class="form-control" name="emailpropi" value="<?php echo $filas['correoUsuario'] ?>" style="width:240px" disabled>
            </div>
        </div>
        <div class=" column3">
            <div>
                <span class="form-control">Inquilino</span>
                <span class="form-control">Cedula</span>
                <span class="form-control">Teléfono</span>
                <span class="form-control">Teléfono</span>
                <span class="form-control">Correo</span>
            </div>
            <div>
                <input type="text" class="form-control desbloq"  name="inquilino" value="<?php echo $filas['inquilino'] ?>" style="width:200px" disabled>
                <input type="text" class="form-control desbloq"  name="cedulaInquilino" value="<?php echo $filas['cedulaInquilino'] ?>" style="width:200px" disabled>
                <input type="text" class="form-control desbloq" name="telefonoInqilino1" value="<?php echo $filas['telefonoInqilino1'] ?>" style="width:200px" disabled>
                <input type="text" class="form-control desbloq" name="telefonoInqilino2" value="<?php echo $filas['telefonoInqilino2'] ?>" style="width:200px" disabled>
                <input type="text" class="form-control desbloq"  name="emailInqilino" value="<?php echo $filas['emailInqilino'] ?>" style="width:200px" disabled>
            </div>   
        </div> 
    </div>
	<div id="respuesta"></div>
	<?php require "html/footer.php"?>
	<script src="aplicaciones/js/paginas/apartamento.js"></script>