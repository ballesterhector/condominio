<?php
	require 'php/session_start.php';

	require 'conectar/conectarCondominio.php';
	
	/*autorizar ingreso del administrador del programa*/
	if ($esPropietario==3) {
        $permiso=1;
    } else{
        $permiso=$juntaCond; 
    }

    $obj= new conectarDB();
    $data= $obj->subconsulta("CALL residenciasSelect(1)");
                        

?>
<!DOCTYPE html>
<html lang="es">

	<head>
		<meta charset="UTF-8">
		<meta name="description" content="Aplicación para control de bienes y suministros">
		<meta name="keywords" content="asda">
		<meta name="author" content="Ballester Héctor @ballesterhector">
		<meta name="viewport" content="width=device-width, user-scalable=0,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0">
		<title>ASDA On Line</title>
		<link rel="icon" type="image/png" href="imagenes/asda.png" sizes="32x32">
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/bootstrap-submenu.min.css">
		<link rel="stylesheet" type="text/css" href="font-awesome/css/all.css">
		<link rel="stylesheet" type="text/css" href="datatable/datatables.css">
		<link rel="stylesheet" type="text/css" href="css/dataTables.bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/sweetalert.css">
		<link rel="stylesheet" type="text/css" href="css/condominio.css">
		<script src="jsBody/jsBarcode.all.min.js"></script>

		
	</head>
  <body>
        <header>
			<div class="titulo">
				<div class="columna1">
					<img src="aplicaciones/imagenes/asda.png" width="70" height="30" class="" alt="">
	            	<span style="font-size: x-small">Condominio</span>
				</div>
				<div class="columna4">
					<label for="" class="control-label">ACTA DE RETIRO</label>
	                <u><?php echo 'Número ' .str_pad($_GET['numMovimi'], 9, "0", STR_PAD_LEFT) ?></u>

				</div>
				<div class="columna3">
					<img id="barcode2" >
				</div>
			</div>	
		</header>
	<div class=" container cajaReportes" id=''>
	
        <div class="columna1">
		    <article class="ladoA">
                <div><b>Residencia </b></div>
                <div><b>Dirección </b></div>
                <div><b>Contacto </b></div>
                <div><b>Teléfonos </b></div>
                <div><b>Correo </b></div>
            </article>
            <article class="ladoB">
                <div><?php echo $residencias  ?></div>
                <div><?php echo $data[0]['direccion']  ?></div>
                <div><?php echo $data[0]['contactocj2']  ?></div>
                <div><?php echo $data[0]['telefo1cj']  ?> / <?php echo $data[0]['telefo2cj']  ?></div>
                <div><?php echo $data[0]['emailcj']  ?></div>
            </article>
        </div>
    	<div class="columna2">
    		
    	</div>

    	
	</div>
	<div class="cajaReportes">
		<div class="columna1">
		    <div class="tabla">
            <table class="table  table-bordered table-responsive display compact" id="dataTables">
                <thead>
                    <tr class="alert alert-info">
                        <th class="text-center">Código</th>
                        <th class="text-center">Código</th> 
                        <th class="text-center">Fecha</th>
                        <th class="text-center">Periodo</th>
                        <th class="text-center">Rubro</th>
                        <th class="text-center">Cantidad</th>
                        <th class="text-center">Presentación</th>
                        <th class="text-center">Movimiento</th>
                        <th class="text-center">Usuario</th>
                        <th class="text-center">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $obj= new conectarDB();
                        $data= $obj->subconsulta("CALL inventarioDetallePeriodo('".$_GET['periodo']."')");
                        $dat= json_encode($data);
                            if ($dat=='null') {
                                echo '';
                            }else{
                                foreach ($data as $filas) { ?>
                                    <tr>
                                        <?php if ($filas['cantidad_inv']>=0) { ?>
                                            <td align="center" style="background: #cbf8d7"><?php echo str_pad($filas['idinventario'], 7, "0", STR_PAD_LEFT) ?></td>

                                            <td><a href="javascript:documento(<?php echo $filas['idinventario']  ?>)"><?php echo $filas['idinventario'] ?></a></td>


                                            <td style="background: #cbf8d7"><?php echo $filas['fechaMovimiento'] ?></td>
                                            <td style="text-align:center;background: #cbf8d7"><?php echo $filas['periodo'] ?></td>
                                            <td style="text-align:center;background: #cbf8d7"><?php echo $filas['descripcion_inv'] ?></td>
                                            <td style="text-align:right;background: #cbf8d7"><?php echo $filas['cantidad_inv'] ?></td>
                                            <td style="text-align:right;background: #cbf8d7"><?php echo $filas['unidad'] ?></td>
                                            <td style="text-align:right;background: #cbf8d7"><?php echo $filas['movimiento_inv'] ?></td>
                                            <td style="text-align:right;background: #cbf8d7"><?php echo $filas['usuarioRetiro_inv'] ?></td>
                                        <?php } else {?>    
                                            <td align="center" style="background: #f3ceed"><?php echo str_pad($filas['idinventario'], 7, "0", STR_PAD_LEFT) ?></td>

                                            <td><a href="javascript:documento(<?php echo $filas['idinventario']  ?>)"><?php echo $filas['idinventario'] ?></a></td>


                                            <td style="background: #f3ceed"><?php echo $filas['fechaMovimiento'] ?></td>
                                            <td style="text-align:center;background: #f3ceed"><?php echo $filas['periodo'] ?></td>
                                            <td style="text-align:center;background: #f3ceed"><?php echo $filas['descripcion_inv'] ?></td>
                                            <td style="text-align:right;background: #f3ceed"><?php echo $filas['cantidad_inv'] ?></td>
                                            <td style="text-align:right;background: #f3ceed"><?php echo $filas['unidad'] ?></td>
                                            <td style="text-align:right;background: #f3ceed"><?php echo $filas['movimiento_inv'] ?></td>
                                            <td style="text-align:right;background: #f3ceed"><?php echo $filas['usuarioRetiro_inv'] ?></td>
                                        <?php }?>
                                        <td class="icono">
                                            <a href='inventariosDetallesProducto.php?rubro=<?php echo $filas['rubroCodigo_inv'] ?>' aria-hidden="true" data-toggle="tooltip" data-placement="top" title='Data por rubro'><i class="fas fa-eye"></i></a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            <?php } ?>
                </tbody>
            </table>
        </div>
	</div>
	
	 <div>
            <script src="aplicaciones/js/jquery-3.2.1.min.js"></script>
            <script>
                JsBarcode("#barcode2", "<?php echo str_pad($_GET['numMovimi'], 7, "0", STR_PAD_LEFT) ?>", {
                    format: "CODE39",
                    displayValue: true,
                    fontSize: 24,
                    height: 50
                });

            </script>
        </div>		
	</body>	
</html>	