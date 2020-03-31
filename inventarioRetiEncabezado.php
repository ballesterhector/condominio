<?php

    require 'conectar/conectarCondominio.php'; 
    $obj= new conectarDB();   

   switch($_GET['proceso']){

        case 'retiroEncabezado':
            $data= $obj->actualizar("CALL invRetiroInsertEncabezado('".$_GET['usuario']."','".$_GET['retiPor']."',
																		'".$_GET['usobien']."','".$_GET['usoExterno']."',
																		'".$_GET['aprobadoP']."'	
				)");
        break;     

   }     

?>