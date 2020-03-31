<?php
    require '../aplicacionesCondominio/php/session_start.php';
	require '../conectarBD/conectarCondominio.php';
	require_once ("../plantillas/dompdf/dompdf_config.inc.php");
	$fecha = date("d-m-Y H:i:s");
	set_time_limit(320);
	echo $usuario;
$codigohtml='
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" >
        <link rel="stylesheet" type="text/css" href="../aplicacionesCondominio/css/estilosCondominio.css">
	</head>
	<body>';

			$obj= new conectarDB();
			$data= $obj->subconsulta("CALL facturacionEvolucionPropietarioFull('".$_GET['propi']."')");
                
            
$codigohtml.='
    <div class="tablaPdf">
        <div class="tablaA">        
            <table width="60%" border="0" >
				<tr>
					<td align="center" width="80"><img src="../aplicacionesCondominio/imagenes/internet.png" width="80" height="85"></td>
					<td align="center"><h2>ESTADO DE CUENTA</h2><br>
					
					</td>
				</tr>
			</table>
            <table border="0" >
				<tr>
					<td width="340px">
						<div><b>Residencia </b>'.$data[0]['nombrecj'].'</div>
						<div><b>Dirección </b>'.$data[0]['direccioncj'].'</div>
						<div><b>Apartamento</b>'.$data[0]['aptfactura'].'</div>
					</td>
					<td width="350px" >
						<div style="">
							<div><b>Propietario </b>'.$data[0]['propietario'].'</div>
							<div><b>Teléfono </b>'.$data[0]['telefonoP1'].' <b>/ </b>'.$data[0]['telefonoP2'].' </div>
							<div><b>Inquilino </b>'.$data[0]['inquilino'].'</div>
							<div><b>Teléfono </b>'.$data[0]['telefonoI1'].' <b>/ </b>'.$data[0]['telefonoI2'].' </div>
						</div>
					</td>
				</tr>
			</table>
        </div>
        
    <table width="100%" border="0" style="border-collapse: collapse" class="tablasEnc letra">
		<thead>
			<tr class="bg-info">
				<th class="text-center">Recibo</th>
				<th class="text-center">Periodo</th>
				<th class="text-center">Concepto</th>
                <th align=right>Adeudado</th>
				<th align=right>Tot deuda</th>
				<th class="text-center" colspan=2 style="width:220px">Cobrado</th>
           </tr>';
			$totalE=0;
         	foreach ($data as $filas) {
				$totalE=$totalE+$filas['acobrar'];
        	$codigohtml.='
				<tr>
					<td align=center>'. $filas['numrecibo'].'</td>
					<td align=center>'. $filas['periodofact'].'</td>
					<td style="width:220px">'. $filas['subconcepto'].'</td>
				    <td align=right >'.number_format($filas['acobrar'],2).'</td>';
					if($filas['acobrar']==0){
						$codigohtml.='
							<td align=right id=uno>'.number_format($filas['tot'],2).'</td>
						';
					}else{
						$codigohtml.='
							<td align=right>'.number_format($filas['tot'],2).'</td>
						';
					}
					
				$codigohtml.='	
					<td style="text-align:center" colspan=2>'. $filas['estado'].'</td>
					';
			
			}
			
			$codigohtml.='
				<tr>
					<td>-------------------------------------------------------------------------------------------------------------------------------------</td>
				</tr>
			
				<tr>
					<td align=right colspan=2><b>Total</b></td>
					<td align=right style=background:#ddd>'.number_format($totalE,2).'</td>
    			</tr>
			</thead>
			<tfoot>
    	</table>
    </div>
    <div style=margin:60px 0 0 20px><b>Emitido por   <i><u> '.$usuario.'</u></i>     Firma y sello _____________________________</b></div>
    	';	
			
			

$codigohtml.='  
    <script src="../aplicacionesCondominio/js/jquery-3.2.1.min.js"></script>
	<script src="../aplicacionesCondominio/js/qart.min.js"></script>
    </body>
</html>';

		$dompdf  =  new DOMPDF ( ) ;
		$dompdf -> load_html ( $codigohtml ) ;
		$dompdf -> set_paper ( "leter" ,  "portrait"  ) ;
		//$dompdf->set_paper(array(0, 0, 595, 431), 'portrait');
			ini_set ("memory_limit", "124M") ;
		$dompdf -> render () ;
		$dompdf -> stream ( "my_pdf.pdf" , array ( "Attachment"  =>  0 )); //para que se vea en pantalla
		$dompdf -> stream ( " pickinglist.pdf" ) ; 

//	echo $codigohtml;
?>
