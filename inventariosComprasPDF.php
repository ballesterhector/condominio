<?php
require('fpdf/fpdf.php');
require 'conectar/conectarCondominio.php';

$fpdf = new fpdf();

$fpdf ->AddPage('PORTRAIT','LETTER');

$obj= new conectarDB();
$datas= $obj->subconsulta("CALL gastoFacturaEncabezadoSelect('".$_GET['numCompra']."')");
$resid = $datas[0]['nombrecj'];
$direc = $datas[0]['direccion'];
$tele = $datas[0]['telefo1cj'];
$email = $datas[0]['emailcj'];
$contacto = $datas[0]['contactocj'];
$elabora= $datas[0]['usuarioGasto'];
$fecha= $datas[0]['fechagast'];
$proveedor= $datas[0]['proveedor'];
$proveContac= $datas[0]['proveedorcontacto'];
$factura= $datas[0]['facturagast'];
$proveTele= $datas[0]['telefo1'];

class pdf extends FPDF
{
    public function header()
    {
        $this->SetFont('courier','B',12);
        $this->Image('imagenes/asda.png',10,10,20,'','png');
        $this->SetXY(30,10);
        $this->SetTextColor(25,174,194);
        $this->Write(5,'Sistema de control de condominios');
        $this->SetXY(-40,10);
        $this->Write(5,'Venezuela');
    }

    public function footer()
    {
        $this->SetFont('courier','BI',8);
        $this->SetY(-15);
        $this->Write(5,utf8_decode('Reporte programado por Héctor Ballester Téle: 0412-5422593 ballesterhector@gmail.com'));
        $this->SetX(-40);
        $this->AliasNbPages();
        $this->Write(5,'pag '. $this->PageNo().'/{nb}');
    }
}

$fpdf = new pdf();
$fpdf ->AddPage('PORTRAIT','LETTER');
$fpdf -> SetFont('arial','I',14);
$fpdf -> SetY(20);
$fpdf ->Ln();
$fpdf -> Cell(0,5,utf8_decode('Compras de insumos:'),0,'','C',0);
$fpdf -> Ln();
$fpdf -> Cell(0,5,str_pad($_GET['numCompra'], 7, "0", STR_PAD_LEFT),0,'','C',0);
$fpdf ->Ln(10);
$fpdf -> SetDrawColor(119,158,241);
$fpdf -> SetLineWidth(1);
$fpdf-> Line(10,75,200,75);

$fpdf -> SetFont('arial','I',12);

$fpdf -> Cell(20,5,'Residencia         '.$resid,0,'','',0);
$fpdf ->Ln();
$fpdf -> Write(5,'Direccion');
$fpdf -> SetX(42);
$fpdf -> MultiCell(70,5,$direc,0,'','',0);
$fpdf -> Cell(20,5,utf8_decode('Teléfono             ').$tele,0,'','',0);
$fpdf ->Ln();
$fpdf -> Cell(20,5,'Correo                '.$email,0,'','',0);
$fpdf ->Ln();
$fpdf -> Cell(20,5,'Elaborado por    '.$elabora,0,'','',0);
$fpdf ->Ln();
$fpdf -> Cell(20,5,'Fecha                '.$fecha,0,'','',0);

$fpdf->SetXY(130,40);
$fpdf -> Cell(20,5,'Proveedor:  '.$proveedor,0,'','',0);
$fpdf ->Ln();
$fpdf->SetXY(130,45);
$fpdf -> Cell(20,5,'Contacto:  '.$proveContac,0,'','',0);
$fpdf ->Ln();
$fpdf->SetXY(130,50);
$fpdf -> Cell(20,5,utf8_decode('Teléfono:  ').$proveTele,0,'','',0);
$fpdf ->Ln();
$fpdf->SetXY(130,55);
$fpdf -> Cell(20,5,utf8_decode('Factura:  ').$factura,0,'','',0);


$fpdf -> Sety(60);
$fpdf ->Ln(20);
//Pintando tabla
$fpdf -> SetDrawColor(0,0,0);
$fpdf -> SetLineWidth(0);

$fpdf -> SetX(15);
$fpdf ->SetFontSize(10);
$fpdf ->SetFont('Arial','B');
$fpdf ->SetFillColor(255,255,255);
$fpdf ->SetTextColor(0,0,0);




$fpdf -> Cell(50,5,utf8_decode('Insumo'),1,'0','C',1);
$fpdf -> Cell(25,5,utf8_decode('Compradas'),1,'0','C',1);
$fpdf -> Cell(25,5,utf8_decode('Costo'),1,'0','C',1);
$fpdf -> Cell(25,5,utf8_decode('Gasto'),1,'0','C',1);
$fpdf -> Cell(30,5,utf8_decode('Tipo'),1,'0','C',1);
$fpdf -> Cell(30,5,utf8_decode('Presentación'),1,'0','C',1);

$obj= new conectarDB();
$datos= $obj->subconsulta("CALL gastosFacturaDetalleSelect('".$_GET['numCompra']."')");
foreach ($datos as $filas) 
{

    $descri = $filas['insumoRubr'];
    $cantidad = $filas['cantidad'];
    $costo =number_format($filas['costo'],2,',','');
    $gasto =number_format($filas['gasto'],2,',','');
    $tipo =$filas['tipoRubr'];
    $presentacion =$filas['presentacion'];
   

    $fpdf -> Ln();
    $fpdf -> SetX(15);
    $fpdf -> SetFontSize(10);
    $fpdf -> Cell(50,5,utf8_decode($descri),1,'0','',1);
    $fpdf -> Cell(25,5,$cantidad,1,'0','R',1);
    $fpdf -> Cell(25,5,$costo,1,'0','R',1);
    $fpdf -> Cell(25,5,$gasto,1,'0','R',1);
    $fpdf -> Cell(30,5,$tipo,1,'0','R',1);
    $fpdf -> Cell(30,5,$presentacion,1,'0','R',1);
}




$fpdf->Output();
?>