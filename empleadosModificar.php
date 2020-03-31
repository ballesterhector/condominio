<?php
    require "html/head.php";

    $obj= new conectarDB();
    $data= $obj->subconsulta("CALL empleadosVer('".$_GET['numPropi']."')");
    foreach ($data as $filas) {
        
    }    
?>
    <div class="titulo">
        <div class="columna1">
            <h2 class="letra">Ficha Empleado</h2>
        </div>
        <div class="columna2">
            <a href="#" onclick="window.open('http:ayudas/empleados.pdf')" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Manual"><span class="icon-local_library"></span></a>
            <a href="empleadosHistoModifi.php?numPropi=<?php echo $_GET['numPropi'] ?>" data-toggle="tooltip" data-placement="right" title="Histórico modificaciones"><span class="icon-menu"></span></i></a>
        </div>
        <div class="columna3">
            <a href="empleados.php"><span class="icon-menu_open" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Devolverse"></span></a>
        </div>
    </div>
    <div class="container cajaresidencia" id=''>
        <input type="hidden" id="juntasC" value="<?php echo $permiso?>">
        <input type="hidden" id="juntasCargo" value="<?php echo $juntaCargo?>">
        <input type="hidden" id="usuari" value="<?php echo $usuario?>">
        <input type="hidden" id="numEmpleado" value="<?php echo $_GET['numPropi']?>">
            <div class="column1">
                <div>
                    <span class="form-control">Código</span>
                    <span class="form-control">Empleado</span>
                    <span class="form-control">Cedula</span>
                    <span class="form-control">Dirección</span>
                    <span class="form-control">Teléfono</span>
                    <span class="form-control">Correo</span>
                </div>
                <div class="columnb">
                    <input type="text" class="form-control" value="<?php echo str_pad($filas['numEmpleado'], 7, "0", STR_PAD_LEFT) ?>" disabled >
                    <input type="text" class="form-control" value="<?php echo $filas['nombreemple'] ?>" disabled >
                    <input type="text" class="form-control" value="<?php echo $filas['cedulaemple'] ?>" disabled >
                    <input type="text" class="form-control bloquear" value="<?php echo $filas['direccionemple'] ?>" disabled >
                    <input type="text" class="form-control bloquear" name="telefonoemple" value="<?php echo $filas['telefonoemple'] ?>" disabled >
                    <input type="text" class="form-control bloquear" name="emailemple" value="<?php echo $filas['emailemple'] ?>" disabled >
                
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
                </div>
                <div>
                    <select class="form-control bloquear" name="cargoemple" disabled="disabled" >
                        <option value=""><?php echo $filas['cargoemple'] ?></option>
                        <option value="Supervisor">Supervisor</option>
                        <option value="Administrador">Administrador</option>
                        <option value="Secretario(a)">Secretario(a)</option>
                        <option value="Obrero">Empleado</option>
                        <option value="Obrero">Obrero</option>
                    </select>
                    <input type="text" class="form-control desbloq" name="salario" value="<?php echo $filas['salario'] ?>" disabled >
                    <select class="form-control bloquear" name="estado" disabled="disabled" >
                        <option value=""><?php echo $filas['estado'] ?></option>
                        <option value="Activo">Activo</option>
                        <option value="Inactivo">Inactivo</option>
                    </select>
                   
                    <select class="form-control bloquear" name="situacionEmple" id="" disabled="disabled" >
                        <option value=""><?php echo $filas['situacion'] ?></option>
                        <option value="0">Laborando</option>
                        <option value="1">Vacaciones</option>
                        <option value="2">Reposo</option>
                        <option value="3">Permiso</option>
                        <option value="4">Renuncia</option>
                        <option value="5">Despedido</option>
                    </select>
                    <input type="date" class="form-control bloquear" name="situacionDel" value="<?php echo $filas['situacionDel'] ?>" disabled >
                    <input type="date" class="form-control bloquear" name="situacionAl" value="<?php echo $filas['situacionAl'] ?>" disabled > 
                    <textarea class="form-control bloquear" name="observemple" id="" disabled  ><?php echo $filas['observemple'] ?></textarea>
                </div>
            </div>
           
    </div>
	<div id="respuesta"></div>
	<?php require "html/footer.php"?>
	<script src="jsBody/empleados.js"></script>
    </div>
</body>
</html>