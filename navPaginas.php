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
	<link rel="stylesheet" type="text/css" href="css/datatables.css">
	<link rel="stylesheet" type="text/css" href="css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/sweetalert.css">
    <link rel="stylesheet" type="text/css" href="icon/fonts.css">
    <link rel="stylesheet" type="text/css" href="css/stylePaginas.css">
    <body oncontextmenu="return false"><!--evitar que copien el codigo fuente de mi pagina, no permite boton derecho-->
   
</head>
<body class="fondo">
    <header class="header">
        <div class=" logo-nav">
            <div class="menu-bar">
                <img src="imagenes/asda.png" width="70" height="30" class="" alt="">
                <a href="#" class="btn-menu"><span class="icon-list2"></span>Menu</a>
            </div>
            <nav class="">
                <ul>
                    <li><a href="#"><span class="icon-house"></span>Principal</a></li>
                    <li class="submenu"><!--con <span class="caret icon-arrow-down6"></span> colocamos la flechita en el menu-->
                        <a href="#"><span class="icon-suitcase"></span>Administración <span class="caret icon-arrow-down6"></span></a>
                        <ul class="children">
                            <li><a href="#">Junta Directiva <span class="icon-fiber_manual_record"></span></a></li>
                            <li><a href="#">Empleados <span class="icon-fiber_manual_record"></span></a></li>
                            <li><a href="#">Inventaio <span class="icon-fiber_manual_record"></span></a></li>
                        </ul>
                    </li>
                    <li><a href="#"><span class="icon-rocket"></span>Residencia</a></li>
                    <li><a href="#"><span class="icon-house"></span>Movimientos</a></li>
                    <li><a href="#"><span class="icon-mail"></span>Contactos</a></li>
                </ul>            
            </nav>

            
        </div>
    </header>
    <div>
        <script src="jsBody/jquery-3.2.1.min.js"></script>
        <script src="jsBody/bootstrap.bundle.min.js"></script>
        <script src="jsBody/bootstrap.js"></script>
        <script src="jsBody/bootstrap-submenu.min.js"></script>
        <script src="jsBody/jquery.dataTables.min.js"></script>
        <script src="jsBody/sweetalert.min.js"></script>
        <script src="jsBody/jsBarcode.all.min.js"></script>
        <script src="jsBody/all.js"></script>
        <script src="jsBody/jsPaginas.js"></script>
        <script src="jsBody/general.js"></script>
        </div>
</body>
</html>