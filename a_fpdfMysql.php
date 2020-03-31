<?php
require('fpdf/fpdf.php');
require 'conectar/conectarCondominio.php';

$fpdf = new fpdf();

$fpdf ->AddPage('PORTRAIT','LETTER');

$obj= new conectarDB();
$datas= $obj->subconsulta("CALL residenciasSelect(1)");
$resid = $datas[0]['nombrecj'];
$direc = $datas[0]['direccion'];
$tele = $datas[0]['telefo1cj'];
$email = $datas[0]['emailcj'];

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
$fpdf -> Cell(0,5,utf8_decode('Relación de existencia en inventarios'),0,'','C',0);
$fpdf ->Ln(10);
$fpdf -> SetDrawColor(119,158,241);
$fpdf -> SetLineWidth(1);
$fpdf-> Line(10,56,200,56);

$fpdf -> SetFont('arial','I',12);

$fpdf -> Cell(20,5,'Residencia:  '.$resid,0,'','',0);
$fpdf ->Ln();
$fpdf -> Cell(20,5,utf8_decode('Dirección:    ') .$direc,0,'','',0);
$fpdf ->Ln();
$fpdf -> Cell(20,5,utf8_decode('Teléfono      ').$tele,0,'','',0);
$fpdf ->Ln();
$fpdf -> Cell(20,5,'Correo         '.$email,0,'','',0);
$fpdf ->Ln(20);
//Pintando tabla
$fpdf -> SetDrawColor(0,0,0);
$fpdf -> SetLineWidth(0);

$fpdf -> SetX(40);
$fpdf ->SetFontSize(10);
$fpdf ->SetFont('Arial','B');
$fpdf ->SetFillColor(255,255,255);
$fpdf ->SetTextColor(0,0,0);
$fpdf -> Cell(60,5,utf8_decode('Insumo'),1,'0','C',1);
$fpdf -> Cell(30,5,utf8_decode('Cantidad'),1,'0','C',1);
$fpdf -> Cell(50,5,utf8_decode('Unidad'),1,'0','C',1);

$obj= new conectarDB();
$datas= $obj->subconsulta("CALL inventarioResumen(0)");

foreach ($datas as $filas) 
{
   /* $code =$row[""];*/
    $descri = $filas['descripcion_inv'];
    $cantidad = $filas['cantidad'];
    $unidad =$filas['unidad'];
    
    $fpdf -> Ln();
    $fpdf -> SetX(40);
    $fpdf -> Cell(60,5,utf8_decode($descri),1,'0','',1);
    $fpdf -> Cell(30,5,$cantidad,1,'0','C',1);
    $fpdf -> Cell(50,5,$unidad,1,'0','C',1);

}    





$fpdf->Output();
?>