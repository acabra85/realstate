<?php
    include_once("../ctrl/security.php");
    include_once('../fpdf/fpdf.php');
    require_once('../fpdf/fpdf.php');
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class PDFGenerator extends FPDF
{
    /*static private $instance;
    private function  __construct()
    {
    }
    static public function getInstance()
    {
        if(self::$instance==NULL)
            self::$instance= new PDFGenerator();
        return self::$instance;
    }*/
    // Load data
    public $title;
    function LoadData($file)
    {
        // Read file lines
        $lines = file($file);
        $data = array();
        foreach($lines as $line)
            $data[] = explode(';',trim($line));
        return $data;
    }

    // Colored table
    function FancyTable($header, $data)
    {
        // Colors, line width and bold font
        $this->SetFillColor(191,188,203);
        $this->SetTextColor(255);
        $this->SetDrawColor(0,0,0);
        $this->SetLineWidth(.3);
        $this->SetFont('','B');
        // Header
        $w = array(33, 45, 32, 35, 32);
        for($i=0;$i<count($header);$i++)
            $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
        $this->Ln();
        // Color and font restoration
        $this->SetFillColor(224,235,255);
        $this->SetTextColor(0);
        $this->SetFont('');
        // Data
        $fill = false;
        foreach($data as $row)
        {
            $this->Cell($w[0],6,$row[0],'LR',0,'L',$fill);
            $this->Cell($w[1],6,$row[1],'LR',0,'L',$fill);
            $this->Cell($w[2],6,$row[2],'LR',0,'R',$fill);
            $this->Cell($w[3],6,$row[3],'LR',0,'R',$fill);
            $this->Cell($w[4],6,$row[4],'LR',0,'R',$fill);
            $this->Ln();
            $fill = !$fill;
        }
        // Closing line
        $this->Cell(array_sum($w),0,'','T');
    }


    // Page header
    function Header()
    {
        // Logo
        $this->Image('../files/inmosys.png',10,6,40);
        // Arial bold 15
        $this->SetFont('Arial','B',15);
        // Move to the right
        $this->Cell(65);
        // Title
        $this->Cell(65,10,$this->title,1,0,'C');
        // Line break
        $this->Ln(35);
    }

    // Page footer
    function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Page number
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }
    function imprimirFactura($header_tabla,$strFactura)
    {

        $pdf = $this;
        $this->title="FACTURA DE VENTA";
        $pdf->AliasNbPages();
        $data = $pdf->LoadData($strFactura);
        $pdf->SetFont('Arial','',14);
        $pdf->AddPage();
        $pdf->FancyTable($header_tabla,$data);
	$pdf->Cell(0,5,' ',0,1);
	$pdf->Cell(0,5,'                                           Inmosys - Nit: 830945930-1 ',0,1);
	$pdf->Cell(0,5,'                             Politecnico Grancolombiano CL 57 No. 3-00E',0,1);
	$pdf->Cell(0,5,'                                                       Bogota D.C. ',0,1);
	$pdf->Cell(0,5,'                                            Tels: 3468800 - 3468801 ',0,1);
	$pdf->Cell(0,5,'                                         Ventas Regimen Simplificado ',0,1);
	$pdf->Cell(0,5,'                                            E-mail:info@inmosys.com ',0,1);
        $pdf->Output();
    }
}

?>
