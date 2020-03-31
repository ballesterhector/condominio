<?php
//AddPage(orientacion[PORTRAIT,LANDSCAPE], TAMAÑO[A3, A4, LETTER, LEGAL],rotacion[90,180,270, 360grados])
//SetFont(tipo[COURIER, HELVETICA, ARIAL, TIMES, SYMBOL, ZAPDINGBATS],ESTILO[normal, B, I, U], tamaño)
//Cell(ancho, alto, texto,bordes[0,1=no,si], ?, alineación[C,L,R], rellenar[0,1=no,si], link)
//Cell ancho=0 ocupa el 100% de la linea
//SetFontSize()tamaño del texto
//OutPut(destino[I, D, F, S],xxx/nombre_archivo.pdf,utf8[true])I=Mostar en navegador, D=descarga directa, F= guarda dentro del servidor web, S= como cadena de texto
//file_get_contents(filename) muestro contenido de archivo de texto 
//Write(alto,utf8_decode(texto))
//Ln(0) salto de linea
//SetFillColor(255,255,255)en rgb color de fondo
//Line(psiciondeizqierda a derecha,distanci de arriba a bajo,largo,igual a distancia arriba a bajo, si quiro una recta o variar para vertial) Lineas
//SetDrawColor()color de lineas
//SetLineWidth() ancho de linea
//COLOCAR O A LA IZQUIERDA $fpdf -> Cell(0,5,str_pad($_GET['numRetir'], 7, "0", STR_PAD_LEFT),0,'','C',0);
//MultiCell(70,5,$direc,0,'','',0);
//function Header{} para el encabezado se puede utilizar cualquier tipo de letra en SetFont
///function footer{} para el pie de pagina
//$this->SetY(-15) para colocarlo al pie
//$this->SetX(-40) para colocarlo al final de la linea
//$fpdf->Image(ruta,posicionX, posicionY,alto, ancho,tipo,link)
//$fpdf->PageNo() número de pagina actual
//$fpdf->AliasNbPages() cantidad de paginas 1 de {Nb}
//$fpdf->SetTextColor()



require('fpdf/fpdf.php');
require 'conectar/conectarCondominio.php';

$obj= new conectarDB();
$datas= $obj->subconsulta("CALL inventarioResumen(0)");


$fpdf = new fpdf();
$fpdf ->AddPage('PORTRAIT','LETTER');

class pdf extends FPDF
{
    public function header()
    {
        $this->SetFont('courier','B',12);
        $this->Image('imagenes/asda.png',190,10,10,10,'png');
        $this->SetTextColor(25,174,194);
        $this->Write(5,'Centro de alumnos');
        $this->SetX(-40);
        $this->Write(10,'Linas');
    }

    public function footer()
    {
        $this->SetFont('courier','B',12);
        $this->SetY(-15);
        $this->Write(5,'Ballester');
        $this->SetX(-40);
        $this->AliasNbPages();
        $this->Write(5,'pag '. $this->PageNo().'/{nb}');
    }
}

$fpdf = new pdf();
$fpdf ->AddPage('PORTRAIT','LETTER');
$fpdf -> SetFont('arial','I',14);
$fpdf ->Ln();
$fpdf -> Cell(0,5,'Listado de alumnos',0,'','C',0);
$fpdf ->Ln(10);
$fpdf -> Line(15,55,200,55);
$fpdf -> SetFont('arial','I',12);
$fpdf ->
$fpdf -> Cell(20,5,'Grado',0,'','',0);
$fpdf ->Ln();
$fpdf -> Cell(20,5,utf8_decode('Sección'),0,'','',0);
$fpdf ->Ln();
$fpdf -> Cell(20,5,'Turno',0,'','',0);
$fpdf ->Ln();
$fpdf -> Cell(20,5,'Docente',0,'','',0);
$fpdf ->Ln(20);
//Pintando tabla

foreach ($datas as $filas) 
{
   /* $code =$row[""];*/
    $coorde = $filas['descripcion_inv'];
    $etiquetas = $filas['cantidad'];
    $recepcio =$filas['unidad'];
	

    $fpdf->Cell(48);
	$fpdf->Cell(45,-75,$coorde,0,0,'L',false); 
	$fpdf->Ln(15); //salto de linea
   


}    

$fpdf ->SetFontSize(10);
$fpdf ->SetFont('Arial','B');
$fpdf ->SetFillColor(11,63,71);
$fpdf ->SetTextColor(255,255,255);
$fpdf -> Cell(20,5,utf8_decode('N°'),1,'0','C',1);
$fpdf -> Cell(30,5,utf8_decode('NIE'),1,'0','C',1);
$fpdf -> Cell(50,5,utf8_decode('Apellido'),1,'0','C',1);
$fpdf -> Cell(50,5,utf8_decode('Nombres'),1,'0','C',1);
$fpdf -> Cell(15,5,utf8_decode('Sexo'),1,'0','C',1);
$fpdf -> Cell(30,5,utf8_decode('Onomástico'),1,'0','C',1);



$fpdf->Image('imagenes/asda.png',40, 20,30, 30,'png','');












$fpdf ->AddPage();


$fpdf -> AddPage('PORTRAIT','LETTER');
$fpdf -> SetFont('arial','I',14);
$fpdf -> SetFillColor(55,89,78);
$fpdf -> Cell(30,5,'Hola Mundo',1,'',2,1);
$fpdf -> AddPage('PORTRAIT','LETTER');
$fpdf -> Write(5, utf8_decode('hola otra vez página #2'));
$fpdf -> AddPage('PORTRAIT','LETTER',90);
$fpdf -> Write(5, utf8_decode('hola otra vez página #3'));
$fpdf->Output();




?>