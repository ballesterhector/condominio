<?php
    session_start();
    require 'conectar/conectarCondominio.php';
    $obj= new conectarDB();
    $login=$_GET['usua'];
    $pass=$_GET['passw'];

    $contador=0;
    $datos = $obj->consultar('CALL indexValida("'.$login.'")');
    foreach ($datos as $row) {
        $_SESSION["cedula"]=$row['cedulaUsuario'];
		    $_SESSION["usuario"]=$row['usuario'];
        $_SESSION["name"]=$row['nombreUsuario'];
        $_SESSION["estado"]=$row['estadoUsuario'];
        $_SESSION["idusu"]=$row['idusuario'];
        $_SESSION["numeusu"]=$row['numusuario'];
      	$_SESSION["email"]=$row['correoUsuario'];
        $_SESSION["telefo"]=$row['telefonoUsuario'];
        $_SESSION["esPropieta"]=$row['es_propietario'];
        $_SESSION["juntaCond"]=$row['condominio'];
        $_SESSION["juntaCondCargo"]=$row['cargo'];
        $_SESSION["Residencia"]=$row['residencia'];
	    	$_SESSION["ultimoAcceso"]=date("i:s");

    };

//echo json_encode($datos);

foreach ($datos as $key ) {
   $key['nombreUsuario'];
   $clave= $key['contrasena'];

    if (password_verify($pass,$clave)) {
       $contador++;
    }

}
if ($contador>0) {
   // echo 'Usuario registrado';
   header('Location: index_Entrada.php');
}else{
  //  echo 'usuario no registrado;';
    header('Location:index_Fallido.php');
}

 ?>
