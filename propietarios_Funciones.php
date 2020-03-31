<?php
    include "conectar/conectarModificar.php";
  
    $data = (string)strip_tags($_POST['value']);
	$field = (string)strip_tags($_POST['field']);
	$numer = (string)strip_tags($_POST['numero']);

    if ($data=='Inactivo') {
        $update = 'UPDATE usuario SET '.$field.' = "'.$data.'",
                                        es_propietario = 0
                     WHERE numusuario="'.$numer.'" ';
    } else {
        $update = 'UPDATE usuario SET '.$field.' = "'.$data.'" WHERE numusuario="'.$numer.'" ';
    }
    
    

    $mysqli->query($update);

    echo $data;
?>