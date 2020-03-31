<?php
	session_start();
	if (empty($_SESSION["cedula"])) {
		header('location:index.php');
	}else {
		$nombre = $_SESSION["name"];
		$usuario =  $_SESSION["usuario"];
		$cedula = $_SESSION["cedula"];
		$correo = $_SESSION["email"];
		$telefo = $_SESSION["telefo"];
		$estad = $_SESSION["estado"];
		$esPropietario = $_SESSION["esPropieta"];
		$numusua = $_SESSION["numeusu"];
		$juntaCond =  $_SESSION["juntaCond"];
		$juntaCargo =  $_SESSION["juntaCondCargo"];
		$residencias = $_SESSION['Residencia'];
	}

	//toma los valores de index_valida.php
	//para que tome los datos debo salir y volver a entrar
?>
