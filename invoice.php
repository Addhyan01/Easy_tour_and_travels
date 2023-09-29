<?php
session_start();
error_reporting(0);
include('includes/config.php');


require('./fpdf/fpdf.php');

$info=[
    "customer"=>"Ram Kumar",
    "address"=>"India",
    "Ph:"=>"77828445613",
    "invoice_no"=>"100001",
    "invoice_date"=>"30-11-2023",
    "total_amt"=>"30000.00",


];


class PDF extends FPDF{
    function Header(){
        $this->SetFont('Arial','B',14);
        $this->Cell(50,10,"Easy Tour & Travels",0,1);
        $this->SetFont('Arial','',14);
        $this->Cell(50,7,"1632 5th main Cross,",0,1);
        $this->Cell(50,10,"Kumaraswami Layout, Bangalore",0,1);
        $this->Cell(50,10,"Ph : 7782844613",0,1);
        

        $this->SetY(15);
        $this->SetX(-40);
        $this->SetFont('Arial','B',18);
        $this->Cell(50,10,"Invoice",0,1);

        $this->Line(0,48,210,48);

    }

    function body($info,$product_info){
        $this->SetY(55);
        $this->SetX(10);
        $this->SetFont('Arial','B',12);
        $this->Cell(50,10,"Bill To:",0,1);
        $this->SetFont('Arial','',12);
        $this->Cell(50,10,$info["customer"],0,1);
        $this->Cell(50,10,$info["address"],0,1);
        $this->Cell(50,10,$info["Ph:"],0,1);

        $this->SetY(55);
        $this->SetX(-60);
        $this->Cell(50,7,"Invoice_No: ".$info["invoice_no"]);

        $this->SetY(63);
        $this->SetX(-60);
        $this->Cell(50,7,"Invoice_No: ".$info["invoice_date"]);

        $this->SetY(95);
        $this->SetX(10);
        $this->SetFont('Arial','B',12);
        $this->Cell(80,9,"DESCRIPTION",1,0);
        $this->Cell(40,9,"PRICE",1,0,"C");
        $this->Cell(30,9,"QTY",1,0,"C");  
        $this->Cell(40,9,"TOTAL",1,1,"C");
        $this->SetFont('Arial','',12);
        foreach($product_info as $row){
            $this->Cell(80,9,$row["name"],"LR",0);
            $this->Cell(40,9,$row["price"],"R",0,"R");
            $this->Cell(30,9,$row["qty"],"R",0,"C");
            $this->Cell(40,9,$row["total"],"R",0,"R");

        }
        
        
        $this->SetFont('Arial','B',12);
        $this->Cell(150,9,"TOTAL",1,0,"R");
        $this->Cell(40,9,$info["total_amt"],1,0,"R");




    }
}




$pdf = new PDF("p","mm","A4");
$pdf-> AddPage();

$pdf->body($info,$product_info);





$pdf->Output();




?>
