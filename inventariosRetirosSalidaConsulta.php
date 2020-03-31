<?php 
    include_once 'conectar/conectarAjax.php';
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();
    
    $consulta = "CALL inventarioResumen(0)";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
    
    print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
    $conexion=null;
?>