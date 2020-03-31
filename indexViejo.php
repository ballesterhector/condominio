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
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/sweetalert.css">
    <link rel="stylesheet" type="text/css" href="icon/fonts.css">
    <link rel="stylesheet" type="text/css" href="css/styleBody.css">
    <body oncontextmenu="return false"><!--evitar que copien el codigo fuente de mi pagina, no permite boton derecho-->
    
    <style>
		.fondo {
			background-image: url("fondos/apt.jpg");
			background-size:100% 100%;
			background-attachment: fixed; /*la imagen no se mueve con el scroll*/	
		}
	</style>
</head>
<body class="fondo">
    <header class="header">
        <div class=" logo-nav">
            <img src="imagenes/asda.png" width="70" height="30" class="" alt="">
            <span class="icon-list2 menu-icon"></span>
            <nav class="navigation">
                <ul class="">
                    <li id="menuIngresar"><a href="#"><span class="icon-house"></span>Ingresar</a></li>
                    <li id="menuRegistro"><a href="#"><span class="icon-suitcase"></span>Registrar</a></li>
                    <li id="menuReseteo"><a href="#"><span class="icon-rocket"></span>Resetear</a></li>
                </ul>
            </nav>
        </div>
        <h1 id="titulo">Sistema de control de condominio</h1>
    </header>
    <main class="main">
        <div class="container">
            <section>
                    <!--Login-->
                <div id="login" class="formIngresar">
                    <h3 >Ingresar a la base de datos</h3>
                    <form action="index_valida.php" method="get">
                        <input type="text" name="usua" id="usua" class="input" placeholder="Usuario" required="require" autocomplete="off" autofocus="autofocus"/>
                        <input type="password" name="passw" class="input" placeholder="Contraseňa" required="require" />
                        <div class="ayud">
                            <button type="submit" class="btn btn-outline-success btn-sm">Login</button>
                            <a href="#" onclick="window.open('http:../aplicacionesCondominio/ayudas/login.pdf')" /><i class="fas fa-book fa-2x" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Manual"></i></a>
                            <button type="button" class="close" name="close" aria-label="Close">
                                <span aria-hidden="true">Close</span>
                            </button>
                        </div>
                    </form>    
                </div>
                <!--Fin login-->

                <!--registro-->
                <div id="register" class="formRegistrar">
                    <h3 class="letra">Registro de propietarios</h3>
                    <form id="formularioregistro" onsubmit="return registro();">
                        <input type="hidden" name="proceso" value="Registro">
                        <div class="regist">
                            <article class="a">
                                <input type="text" name="name" id="nameregistrar" class="input"  placeholder="Nombre" required="require" autocomplete="off" />
                                <input type="text" name="usua" placeholder="Usuario" class="input padi" required="require" autocomplete="off"  />
                                <input type="email" name="email" placeholder="Email" class="input" autocomplete="off" />
                                <input type="number" name="cedul" id="cedula" class="input" placeholder="Cedula" required="require" autocomplete="off"  />
                                <input type="text" name="telef" class="input" placeholder="Teléfono" autocomplete="off" />
                                <input type="password" name="clave" id="clave" class="input" placeholder="Contraseňa" required="require" autocomplete="off" />
                                <input type="text" name="telef2" class="input" placeholder="Teléfono" autocomplete="off" />
                                <input type="password" id="claveR" class="input" placeholder="Repita contraseňa" required="require" autocomplete="off"/>
                            </article>
                        </div>
                        <div class="ayudR">
                            <button type="submit" class="btn btn-outline-success btn-sm">Registrar</button>
                            <button type="button" class="close" name="close" aria-label="Close">
                                <span aria-hidden="true">Close</span>
                            </button>
                        </div>
                    </form>
                </div>
                <!--fin registro-->

                <!--resetea-->
                <div id="reset" class="formResetar">
                    <h4 class="letra">Resetear contraseňa</h4>
                    <span style="margin-top:-15px">
                        Olvido su contraseña?, ingrese los siguientes datos.
                    </span>
                    <form id="formularioresetea" onsubmit="return resetea();">
                        <input type="hidden" name="proceso" id="resetear" class="input" value="resetea"/>
                        <input type="number" name="cedula" id="cedularesetea" class="input" placeholder="Cedula" autocomplete="off" required="require"/>
                        <input type="text" name="usuario" id="usuarioresetea" class="input" placeholder="Usuario" autocomplete="off" required="require"/>
                        <input type="password" name="clave" id="nuevopass" class="input"  placeholder="Nueva contraseňa" required="require" autocomplete="off" />
                        <div class="ayudR">
                            <button type="submit" class="btn btn-outline-success btn-sm">Resetear</button>
                            <div class="alertas" id="alertasresetea"></div>
                            <button type="button" class="close" name="close" aria-label="Close">
                                <span aria-hidden="true">Close</span>
                            </button>
                        </div>
                    </form>
                </div>
                <!--fin resetea-->
                
            </section>
    
            <footer>
                <div class="">
                    <p>Pagina diseñada por @ballesterhector</p>
                </div>
            </footer>


        </div>
    </main>
    <script src="jsBody/jquery-3.2.1.min.js"></script>
    <script src="jsBody/bootstrap.bundle.min.js"></script>
    <script src="jsBody/bootstrap.js"></script>
    <script src="jsBody/sweetalert.min.js"></script>
	<script src="menu/menu.js"></script>
    <script src="jsBody/index.js"></script>
    
</body>
</html>