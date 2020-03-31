<?php
    include "conectar/conectarModificar.php";
    $fecha = date("Y-m-d");
    
    $data = (string)strip_tags($_POST['value']);
	$field = (string)strip_tags($_POST['field']);
	$numer = (string)strip_tags($_POST['numero']);

        $update = 'UPDATE empleados SET '.$field.' = "'.$data.'",
                                            modificaEmple = "'.$_POST['nomusua'].'",
                                            modificaFecha = "'.$fecha.'"
                     WHERE numEmpleado="'.$numer.'" ';
    
    $mysqli->query($update);

    echo $data;
?>