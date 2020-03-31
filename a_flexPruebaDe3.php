<?php
	session_start();
	if (empty($_SESSION["cedula"])) {
		header('location:index.html');
	}else {
		$nombre = $_SESSION["name"];
		$cedula = $_SESSION["cedula"];
		$cargo = $_SESSION["cargo"];
        $numer = $_SESSION["numero"];
		$correo = $_SESSION["email"];
		$telefo = $_SESSION["telef"];
		$estad = $_SESSION["estado"];
	}
?>

<!DOCTYPE html>
<html lang="es">

	<head>
		<meta charset="UTF-8">
		<meta name="description" content="Aplicación para control de condominios">
		<meta name="keywords" content="asda">
		<meta name="author" content="Ballester Héctor @ballesterhector">
		<meta name="viewport" content="width=device-width, user-scalable=0,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0">
		<title>ASDA On Line</title>
		<link rel="stylesheet" type="text/css" href="../aplicacionesCondominio/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../aplicacionesCondominio/css/bootstrap-submenu.min.css">
		<link rel="stylesheet" type="text/css" href="../aplicacionesCondominio/font-awesome/css/fontawesome-all.css">
		<link rel="stylesheet" type="text/css" href="../aplicacionesCondominio/css/jquery.dataTables.min.css">
		<link rel="stylesheet" type="text/css" href="../aplicacionesCondominio/css/sweetalert.css">
		<link rel="stylesheet" type="text/css" href="../aplicacionesCondominio/css/estilosCondominio.css">
	</head>
	<body>
		<div class="contenedor">
			<header>
				<input type="hidden" value="<?php echo $estad ?>" id="estadoUsua">
				<div class="menu">
					<div class="logo">
						<a href="#"><img src="../aplicacionesCondominio/imagenes/asda.png" alt="" class="" style=""><sub>Condominio</sub></a>
					</div>
					<nav class="enlaces" id="enlaces">
						<?php include "../aplicacionesCondominio/nav/menuarriba.html" ?>
					</nav>
				</div>	
				<div class="saludo">
					<h3 class="titulos">Bienvenido al sistema ASDA</h3>
				</div>
			</header>
			<div id="main">
				<nav>
					<?php include "../aplicacionesCondominio/nav/menuizquierda.html" ?>
				</nav>
				<article class="contenedor2">
					<div class="parteA">
						<input type="text" class="form-control" value="Nombre">
						<input type="text" class="form-control" value="Teléfono">
						<input type="text" class="form-control" value="Correo">
						<input type="text" class="form-control" value="Cargo">
						<input type="text" class="form-control" value="Estado">
					</div> 
					<div class="parteB">
						<input type="text" class="form-control" value="<?php echo $nombre ?>">
						<input type="text" class="form-control" value="<?php echo $telefo ?>">
						<input type="text" class="form-control" value="<?php echo $correo ?>">
						<input type="text" class="form-control" value="<?php echo $cargo ?>">
						<input type="text" class="form-control" value="<?php echo $estad ?>">
					</div>    
					<input type="hidden" value="<?php echo $numer ?>" id="nivelUsuario">
			  </article>
			  <aside>
				<img src="../aplicacionesCondominio/fotos/<?php echo $cedula ?>.jpg   " alt="">
			  </aside>
			</div>
		
			<footer class="dat">
				<script>
					var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
					var diasSemana = new Array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
					var f=new Date();
					document.write(diasSemana[f.getDay()] + ", " + f.getDate() + " de " + meses[f.getMonth()] + " de " + f.getFullYear());
				</script>
			</footer>	
		</div>	
	<div>
		<script src="../aplicacionesCondominio/js/jquery-3.2.1.min.js"></script>
		<script src="../aplicacionesCondominio/js/bootstrap.min.js"></script>
		<script src="../aplicacionesCondominio/js/bootstrap-submenu.min.js"></script>
		<script src="../aplicacionesCondominio/js/jquery.dataTables.min.js"></script>
		<script src="../aplicacionesCondominio/js/sweetalert.min.js"></script>
		<script src="../aplicacionesCondominio/js/jsConstantes.js"></script>
		<script src="../aplicacionesCondominio/js/indexEntrada.js"></script>
	</div>
	</body>
</html>