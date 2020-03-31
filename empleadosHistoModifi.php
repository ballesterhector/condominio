<?php
    require "html/head.php";
?>
    <div class="titulo">
        <div class="columna1">
            <h2 class="letra">Ficha Empleado</h2>
        </div>
        <div class="columna2">
            <a href="#" onclick="window.open('http:aplicaciones/ayudas/propietarios.pdf')" /><i class="fas fa-book fa-2x"  data-toggle="tooltip" data-placement="right" title="Manual"></i></a>
        </div>
    </div>
    <div class="container-fluid cajaresidencia" id=''>
    <?php
        $obj= new conectarDB();
        $data= $obj->subconsulta("CALL empleadosHistoModifica('".$_GET['numPropi']."')");
        foreach ($data as $filas) {
    ?>
            <div class="column1">
                <div>
                    <span class="form-control">Código</span>
                    <span class="form-control">Empleado</span>
                    <span class="form-control">Cedula</span>
                    <span class="form-control">Dirección</span>
                    <span class="form-control">Teléfono</span>
                    <span class="form-control">Correo</span>
                </div>
                <div>
                    <input type="text" class="form-control" value="<?php echo str_pad($filas['numEmpleado'], 7, "0", STR_PAD_LEFT) ?>" disabled style="width:280px">
                    <input type="text" class="form-control" value="<?php echo $filas['nombreemple'] ?>" disabled style="width:280px">
                    <input type="text" class="form-control" value="<?php echo $filas['cedulaemple'] ?>" disabled style="width:280px">
                    <input type="text" class="form-control bloquear" value="<?php echo $filas['direccionemple'] ?>" disabled style="width:280px">
                    <input type="text" class="form-control bloquear" name="telefonoemple" value="<?php echo $filas['telefonoemple'] ?>" disabled style="width:280px">
                    <input type="text" class="form-control bloquear" name="emailemple" value="<?php echo $filas['emailemple'] ?>" disabled style="width:280px">
                
                </div>   
            </div>
            <div class="column2">
                <div>
                    <span class="form-control">Cargo</span>
                    <span class="form-control">Salario</span>
                    <span class="form-control">Estado</span>
                    <span class="form-control">Situación</span>
                    <span class="form-control">Del</span>
                    <span class="form-control">Al</span>
                    <span class="form-control">Observaciones</span>
               
                    <select class="form-control bloquear" name="cargoemple" disabled="disabled" style="width:180px">
                        <option value=""><?php echo $filas['cargoemple'] ?></option>
                        <option value="Supervisor">Supervisor</option>
                        <option value="Administrador">Administrador</option>
                        <option value="Secretario(a)">Secretario(a)</option>
                        <option value="Obrero">Empleado</option>
                        <option value="Obrero">Obrero</option>
                    </select>
                    <input type="text" class="form-control desbloq" name="salario" value="<?php echo $filas['salario'] ?>" disabled style="width:180px">
                    <select class="form-control bloquear" name="estado" disabled="disabled" style="width:180px">
                        <option value=""><?php echo $filas['estado'] ?></option>
                        <option value="Activo">Activo</option>
                        <option value="Inactivo">Inactivo</option>
                    </select>
                   
                    <select class="form-control bloquear" name="situacionEmple" id="" disabled="disabled" style="width:180px">
                        <option value=""><?php echo $filas['situacion'] ?></option>
                        <option value="0">Laborando</option>
                        <option value="1">Vacaciones</option>
                        <option value="2">Reposo</option>
                        <option value="3">Permiso</option>
                        <option value="4">Renuncia</option>
                        <option value="5">Despedido</option>
                    </select>
                    <input type="date" class="form-control bloquear" name="situacionDel" value="<?php echo $filas['situacionDel'] ?>" disabled style="width:180px">
                    <input type="date" class="form-control bloquear" name="situacionAl" value="<?php echo $filas['situacionAl '] ?>" disabled style="width:180px"> 
                    <textarea class="form-control bloquear" name="observemple" id="" disabled style="width:278px" ><?php echo $filas['observemple'] ?></textarea>
                </div>
            </div>
            <?php }?>   
    </div>
	<div id="respuesta"></div>
	<?php require "html/footer.php"?>
	<script src="aplicaciones/js/paginas/empleados.js"></script>