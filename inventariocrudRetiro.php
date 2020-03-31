<?php
include_once 'conectar/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

// Recepción de los datos enviados mediante POST desde el JS   

$idinsumo = (isset($_POST['idinsumo'])) ? $_POST['idinsumo'] : '';
$retiro = (isset($_POST['retiro'])) ? $_POST['retiro'] : '';
$aretirar = (isset($_POST['aretirar'])) ? $_POST['aretirar'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';

switch($opcion){
    case 1: //alta
        $consulta = "CALL  inventariosInsertRetiro('$idinsumo', '$retiro', '$aretirar')";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

        $consulta = "CAll inventarioResumen($idinsumo)";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
