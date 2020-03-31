<?php
    include "conectar/conectarModificar.php";
  
    $data = (string)strip_tags($_POST['value']);
    $field = (string)strip_tags($_POST['field']);

    $update = 'UPDATE conjuntoresidencial SET '.$field.' = "'.$data.'" WHERE 1';

    $mysqli->query($update);
    

    echo $data;
?>