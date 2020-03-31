<?php
	require 'conectar/conectarCondominio.php';
	require_once ("dompdf/dompdf_config.inc.php");
	$fecha = date("d-m-Y H:i:s");
	set_time_limit(320);
$codigohtml='
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" >
        <link rel="stylesheet" type="text/css" href="/css/stylePaginas.css ">
	</head>
	<body>';

			$obj= new conectarDB();
			$data= $obj->subconsulta("CALL despachosEncabezado('".$_GET['num']."')");
                
            
$codigohtml.='
    <div class="tablaPdf">
        <div class="tablaA">        
            <table width="380" border="0" >
				<tr>
					<td align="center" width="80"><img src="imagenes/logo.png" width="80" height="85"></td>
					<td align="center"><b>PASE DE SALIDA</b><br>
					<b><u>Número '.str_pad($data[0]['num_retiro'], 7, "0", STR_PAD_LEFT).'</u></b><br>
					</td>
                    <td><div id="codigoQR"></div></td>
				</tr>
			</table>
            <table border="0" >
				<tr>
					<td width="440px">
						<div><b>Cliente </b>'.$data[0]['cliente_retiro'].'</div>
						<div><b>Fecha </b>'.date("d-m-Y",strtotime($data[0]['fecha_retiro'])).'</div>
						<div><b>Movimiento </b>'.$data[0]['movimient_retir'].'</div>
						<div><b>Elaborado por </b>'.$data[0]['usuario_retiro'].'</div>
						<div><b>Documento cliente </b>'.$data[0]['documento_client_retiro'].'</div>
                        <div><b>Valido contabilidad </b>'.$data[0]['valido_contabi_retiro'].'</div>
						<div><b>Paletas despachadas </b>'.$data[0]['paletas_retiro'].' <b>Llenas </b>'.$data[0]['paletas_llena_retir'].' <b>Vacias </b>'.$data[0]['paletas_vacia_retir'].' <b>Malas </b>'.$data[0]['paletas_malas_retir'].' </div>
						<div class="letras3"><b>Observaciones </b>'.$data[0]['observa_retir'].'</div>
					</td>
					<td width="350px" >
						<div style="margin-left:10px">
							<div><b>Transporte </b>'.$data[0]['transporte'].'</div>
							<div><b>Conductor </b>'.$data[0]['conductor'].'</div>
							<div><b>Vehículo </b>'.$data[0]['vehiculo_retiro_palcas'].' <b>Trailer </b>'.$data[0]['trailer'].' </div>
							<div><b>Contenedor </b>'.$data[0]['contenedor'].'</div>
							<div><b>Salida </b>'.date("d-m-Y",strtotime($data[0]['salida'])).'&nbsp;&nbsp;&nbsp; <b>Hora </b>'.$data[0]['salida_hora'].'</div>
							<div><b>Empaques </b>'.$data[0]['unidades_pedidas'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <b>Peso </b>'.$data[0]['kilos_pedidos'].'</div>
							<div><b>Temperatura </b>'.$data[0]['temperatura_retiro'].'</div>
							<div class=""><b>Precintos </b><span class="letras3">'.$data[0]['precintos_retir'].'</span></div>
						</div>
					</td>
				</tr>
			</table>
        </div>
         <div class="tablaB">
            <table border="1" style="border-collapse: collapse" width="95%">
				<tr align="center">
					<th>Código</th>
					<th>Producto</th>
					<th>Lote</td>
					<th>Vencimiento</th>
					<th>Picking</th>
					<th>Unidades</th>
					<th>Kilos</th>
				</tr>
    		
';
    
            $obj= new conectarDB();
			$datas= $obj->subconsulta("CALL despachadasPdf('".$_GET['num']."')");
			$totalE=0;
            $total=0;
			$totalK=0;
			foreach ($datas as $filas) {
				$totalE=$totalE+$filas['empaques'];
                $total=$total+$filas['unidades'];
				$totalK=$totalK+$filas['kilos'];
			$codigohtml.='
				<tr>
					<td>'. $filas['codigoEtiqueta'].'</td>
					<td style="width:190px">'. $filas['productoEtiqueta'].'</td>
					<td>'. $filas['loteEtiqueta'].'</td>
					<td align=center>'. $filas['venceEtiqueta'].'</td>
					<td align=center>'. $filas['pickingEvol'].'</td>
					<td align=right style="width:80px">'. number_format(abs($filas['unidades']),0).'</td>
					<td align=right style="width:80px">'. number_format(abs($filas['kilos']),2).'</td>
				</tr>';
			}
			$codigohtml.='
				<tr>
					<td colspan=5 align=right><b>Totales</b></td>
				    <td align=right>'. number_format(abs($total),0).'</td>
					<td align=right>'. number_format(abs($totalK),2).'</td>
				</tr>
			</thead>
			<tfoot>
    	</table>
    </div>
    <div class="tablaC"> 
        <table class="" border="1" style="border-collapse: collapse" width="400" >
				<tr align="center">
					<th>Código</th>
					<th>Producto</th>
					<th style="width:80px">Unidades</th
					<th style="width:80px">Kilos</th>
				</tr>';
    
            $obj= new conectarDB();
			$datas= $obj->subconsulta("CALL despachadasCestasPdf('".$_GET['num']."')");
			$totalcest=0;
			$totalKcest=0;
			foreach ($datas as $filas) {
				$totalUC=$totalcest+$filas['cestas'];
				$totalUK=$totalKcest+$filas[''];
			$codigohtml.='
				<tr>
					<td>'. $filas['codigoEtiqueta'].'</td>
					<td>'. $filas['productoEtiqueta'].'</td>
					<td align=right>'. number_format(abs($filas['cestas']),0).'</td>
					<td align=right>'. number_format(abs($filas['']),2).'</td>
				</tr>';
			}
			$codigohtml.='
				<tr>
					<td colspan=2 align=right><b>Total cestas</b></td>
					<td align=right>'. number_format(abs($totalUC),0).'</td>
					<td align=right>'. number_format(abs($totalUK),2).'</td>
				</tr>
                
                <tr>
                	<td colspan=2 align=right><b>Total despacho</b></td>
					<td align=right>'. number_format(abs($total+$totalUC),0).'</td>
					<td align=right>'. number_format(abs($totalK+$totalUK),2).'</td>
				</tr>
			</thead>
			<tfoot>
		</table>
    </div>	
    <div class="tablaD">  
        <div id="capa1"> 
            <h4>Conductor:&nbsp;'.$data[0]['conductor'].' &nbsp;Hago constar que he verificado los productos y estoy de acuerdo con su cantidad y estado</h4><br/><br/>
            <b>Elaborado por :'.$data[0]['usuario_retiro'].' &nbsp;&nbsp;   Chequado por_____________________________  &nbsp;&nbsp;  Supervisado por:_____________________________</b><br/>
		</div>
        
        <div id="capa2"> 
            <img src="imagenes/logo.png" width="80" height="85" style="filter:alpha(opacity=38);-moz-opacity:.38;opacity:.38"> 
        </div>
 	</div>
    <div class="fixed letras"> Despacho '.$_GET['num'].' Emitido el '.date('d/m/Y h:i:s').'</div>
		';	
			

$codigohtml.='  
    	<script src="jsBody/jquery-1.11.1.min.js"></script>
		<script src="jsBody/qart.min.js"></script>
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
