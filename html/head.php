<?php
	require 'php/session_start.php';

	require 'conectar/conectarCondominio.php';
	
	/*autorizar ingreso del administrador del programa*/
	if ($esPropietario==3) {
        $permiso=1;
    } else{
        $permiso=$juntaCond; 
    }
    

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Aplicación para control de bienes y suministros">
	<meta name="keywords" content="asda">
	<meta name="author" content="Ballester Héctor @ballesterhector">
	<meta name="viewport" content="width=device-width, user-scalable=0,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ASDA On Line</title>
    <link rel="icon" type="image/png" href="imagenes/asda.png" sizes="32x32">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap-submenu.min.css">
	<link rel="stylesheet" type="text/css" href="css/all.css">
	<link rel="stylesheet" type="text/css" href="css/sweetalert.css">
    <link rel="stylesheet" type="text/css" href="icon/fonts.css">
    <!--datables CSS básico-->
    <link rel="stylesheet" type="text/css" href="datatables/datatables.min.css"/>
    <!--datables estilo bootstrap 4 CSS-->  
    <link rel="stylesheet"  type="text/css" href="datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">       
  
    <link rel="stylesheet" type="text/css" href="css/stylePaginas.css">
    <body oncontextmenu="return false"><!--evitar que copien el codigo fuente de mi pagina, no permite boton derecho-->
   
</head>
<body class="fondo">
    <header class="header">
        <input type="hidden" id="propie" value="<?php echo $permiso  ?>">
        <input type="hidden" id="cedujs" value="<?php echo $cedula?>">
        <input type="hidden" id="juntasC" value="<?php echo $juntaCond?>">
        <input type="hidden" id="usuario" value="<?php echo $usuario ?>">
        <input type="hidden" id="residencia" value="<?php echo $residencias ?>">
        <div class=" logo-nav">
            <div class="menu-bar">
                <a href="#" class="btn-menu"><span class="icon-list2"></span></a>
            </div>
            <div id="header">
                <ul class="nav">
                    <div class="imag">
                        <img src="imagenes/asda.png" width="70" height="30" class="" alt="">
                    </div>
                    
                    <div class="cuerpo">

                        <li><a href="index_Entrada.php"><span class="icon-house"></span>Principal</a></li>

                        <li><a href=""><span class="icon-businessdomain"></span> Finca</a>
                            <ul>
                                <li><a href="residencia.php"><span class="icon-apartment"></span>Residencia</a></li>
                                <li><a href="apartamentos.php"><span class="icon-building-o"></span>Apartamentos</a></li>
                                <li><a href="usuarios.php"><span class="icon-wc"></span> usuarios</a></li>
                            </ul>
                        </li>

                        <li><a href="#"><span class="icon-devices_other"></span> Gastos</a>
                            <ul>
                                <li><a href="#"><span class="icon-storefront"></span>Compras</a>
                                    <ul>
                                        <li><a href="proveedores.php"><span class="icon-apartment"></span>Proveedores</a></li>
                                        <li><a href="productos.php"><span class="icon-post_add"></span>Productos</a></li>
                                        <li><a href="compras.php?factura=0"><span class="icon-add_shopping_cart"></span>Adquisiciones</a></li>
                                    </ul>
                                </li>
                                <li><a href="#"><span class="icon-inventory"></span>Inventarios</a>
                                    <ul>
                                        
                                        <li><a href="inventariosRetiros.php"><span class="icon-transfer_within_a_station"></span> Retiros</a></li>
                                        <li>
                                            <li><a href="#"><span class="icon-inventory"></span>Consultas</a>
                                            <ul>
                                                <li><a href="inventarios.php"><span class="icon-storage"></span> Resumen</a></li>
                                                <li><a href="inventariosDetalles.php?periodo=01/2016"><span class="icon-menu"></span> Por período</a></li>
                                            </ul>
                                        </li>
                                        
                                        </li>
                                    </ul>
                                </li>
                                <li><a href="#"><span class="icon-storefront"></span>Servicios</a>
                                    <ul>
                                        <li><a href="gastosPorServicios.php"><span class="icon-apartment"></span>Registro</a></li>
                                        <li><a href="productos.php"><span class="icon-post_add"></span>gasto</a></li>
                                    </ul>
                                </li>
                                <li><a href="#"><span class="icon-storefront"></span>Cuota especial</a>
                                    <ul>
                                        <li><a href="empleados.php"><span class="icon-apartment"></span>Empleados</a></li>
                                        <li><a href="productos.php"><span class="icon-post_add"></span>Sueldos</a></li>
                                        <li><a href="compras.php?factura=0"><span class="icon-add_shopping_cart"></span>Vacaciones</a></li>
                                    </ul>
                                </li>
                                <li><a href="#"><span class="icon-storefront"></span>Nómina</a>
                                    <ul>
                                        <li><a href="empleados.php"><span class="icon-apartment"></span>Empleados</a></li>
                                        <li><a href="productos.php"><span class="icon-post_add"></span>Sueldos</a></li>
                                        <li><a href="compras.php?factura=0"><span class="icon-add_shopping_cart"></span>Vacaciones</a></li>
                                    </ul>
                                </li>
                                <li><a href="#"><span class="icon-storefront"></span>Consultas</a>
                                    <ul>
                                        <li><a href="gastosdata.php?periodo=<?php echo date('m/Y') ?>"><span class="icon-apartment"></span>consul</a></li>
                                        <li><a href="productos.php"><span class="icon-post_add"></span>Sueldos</a></li>
                                        <li><a href="compras.php?factura=0"><span class="icon-add_shopping_cart"></span>Vacaciones</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li><a href="#"><span class="icon-devices_other"></span> Ingresos</a>
                            <ul>
                                <li><a href="#"><span class="icon-storefront"></span>Compras</a>
                                    <ul>
                                        <li><a href="proveedores.php"><span class="icon-apartment"></span>Proveedores</a></li>
                                        <li><a href="productos.php"><span class="icon-post_add"></span>Productos</a></li>
                                        <li><a href="compras.php?factura=0"><span class="icon-add_shopping_cart"></span>Adquisiciones</a></li>
                                    </ul>
                                </li>
                                <li><a href="#"><span class="icon-inventory"></span>Inventarios</a>
                                    <ul>
                                        <li><a href="inventarios.php"><span class="icon-storage"></span> Resumen</a></li>
                                        <li><a href="inventariosRetiros.php"><span class="icon-transfer_within_a_station"></span> Retiros</a></li>
                                        <li>
                                            <li><a href="#"><span class="icon-inventory"></span>Consultas</a>
                                            <ul>
                                            <a href="inventariosDetalles.php?periodo=01/2016"><span class="icon-menu"></span> Por período</a>
                                                <li><a href="inventariosRetiros.php"><span class="icon-transfer_within_a_station"></span> Retiros</a></li>
                                                <li><a href="inventariosDetalles.php?periodo=01/2019"><span class="icon-menu"></span> Movimientos</a>
                                                
                                                
                                                </li>
                                            </ul>
                                        </li>
                                        
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    </div>
                    <div class="cerrar">    
                        <li >
                            <form class="" action="cerrarSession.php">
                                <button id="iconSalida" type="submit" title="Salir"><span class="icon-close"></span></button>
                            </form>
                        </li>

                        <li style="margin-top: -10px">
                            <img src="fotos/<?php echo $cedula ?>.jpg" alt="" class="foto" >
                        </li>
                    </div>
                </ul>
            </div>
        </div>
    </header>    
