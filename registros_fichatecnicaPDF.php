<?php
	require '../conectarBD/conectarCondominio.php';
	require_once ("../plantillas/dompdf/dompdf_config.inc.php");
	$fecha = date("d-m-Y H:i:s");
	set_time_limit(320);
$codigohtml='
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" >
        <link rel="stylesheet" type="text/css" href="../aplicacionesCondominio/css/estilosCondominio.css">
	</head>
	<body>';

			$obj= new conectarDB();
			$data= $obj->subconsulta("CALL propietarioSelect('".$_GET['numRegistro']."')");
                
            
$codigohtml.='
    <div class="tablaPdf">
        <div class="tablaA">        
            <table width="100%" border="0" >
				<tr>
					<td align="center" width="80"><img src="../aplicacionesCondominio/imagenes/internet.png" width="80" height="85"></td>
					<td align="center"><h2>FICHA TÉCNICA</h2>
						<h3 ><u>Número de registro '.str_pad($data[0]['propietanum'], 7, "0", STR_PAD_LEFT).'</u></h3>
					</td>
				</tr>
			</table>
            <table border="0" >
				<tr>
					<td width="340px">
						<div><b>Fecha registro </b>'.$data[0]['registrado'].'</div>
						<div><b>Unidad habitacional </b>'.$data[0]['nombrecj'].'</div>
						<div><b>Dirección </b>'.$data[0]['direccioncj'].'</div>
						<div><b>Edificio</b> '.$data[0]['edificio'].'</div>
						<div><b>Apartamento</b> '.$data[0]['apartamento'].'</div>
						<div><b>Alicuota</b> '.$data[0]['alicuota'].'</div>
					
					</td>
					<td width="420px" >
						<div style="">
							<div><b>Propietario </b>'.$data[0]['propietario'].'</div>
							<div><b>Cedula </b>'.$data[0]['cedulaP'].'</div>
							<div><b>Teléfono </b>'.$data[0]['telefonoP1'].' <b>/ </b>'.$data[0]['telefonoP2'].' </div>
							<div><b>Inquilino </b>'.$data[0]['inquilino'].'</div>
							<div><b>Cedula </b>'.$data[0]['cedulaI'].'</div>
							<div><b>Teléfono </b>'.$data[0]['telefonoI1'].' <b>/ </b>'.$data[0]['telefonoI2'].' </div>
						</div>
					</td>
				</tr>
			</table>
        </div>
        
    <table width="50%" align=center border="1" style="border-collapse: collapse" class="tablasEnc letra">
		<thead>
			<tr class="bg-info">
				<th class="text-center">Recibo</th>
				<th class="text-center">Periodo</th>
                <th class="text-center">Adeudado</th>
           </tr>';
			$obj= new conectarDB();
			$datas= $obj->subconsulta("CALL deudaPorPropietarioFull('".$_GET['numRegistro']."')");
			$totalE=0;
         	foreach ($datas as $filas) {
				$totalE=$totalE+$filas['acobrar'];
        	$codigohtml.='
				<tr>
					<td align=center>'. str_pad($filas['numrecibo'], 7, "0", STR_PAD_LEFT).'</td>
					<td align=center>'. $filas['periodofact'].'</td>
				    <td align=right >'.number_format($filas['acobrar'],2).'</td>
				</tr>';
			}
			$codigohtml.='
				<tr>
					<td align=right colspan=2><b>Total adeudado</b></td>
					<td align=right>'.number_format($totalE,2).'</td>
    			</tr>
			</thead>
			<tfoot>
    	</table>
    </div>
    	';	
	
	

$codigohtml.='  
    <script src="../aplicacionesCondominio/js/jquery-3.2.1.min.js"></script>
	<script src="../aplicacionesCondominio/js/qart.min.js"></script>
    </body>
</html>';

		$dompdf  =  new DOMPDF ( ) ;
		$dompdf -> load_html ( $codigohtml ) ;
		$dompdf -> set_paper ( "letter" ,  "portrait"  ) ;
			ini_set ("memory_limit", "124M") ;
		$dompdf -> render () ;
		$dompdf -> stream ( "my_pdf.pdf" , array ( "Attachment"  =>  0 )); //para que se vea en pantalla
		$dompdf -> stream ( " pickinglist.pdf" ) ; 

//	echo $codigohtml;
?>
