<?php
/*call the FPDF library*/
include("../Auth/connection.php");
require('../fpdf/fpdf.php');
date_default_timezone_set('Asia/Kuala_Lumpur');	
$currentdate = date('d-m-Y', time());	
/*A4 width : 219mm*/
$pdf = new FPDF('P','mm','A4');
$string = array();
$pdf->AddPage();
/*output the result*/

/*set font to arial, bold, 14pt*/
$pdf->SetFont('Arial','B',20);

/*Cell(width , height , text , border , end line , [align] )*/

$pdf->Cell(71 ,10,'',0,0);
$pdf->Cell(59 ,5,'Catering Report',0,0);
$pdf->Cell(59 ,10,'',0,1);

$pdf->SetFont('Arial','B',10);
/*Heading Of the table*/
$pdf->Cell(15 ,6,'ID',1,0,'C');
$pdf->Cell(70 ,6,'Name',1,0,'C');
$pdf->Cell(20 ,6,'Quantity',1,0,'C');
$pdf->Cell(25 ,6,'Price',1,0,'C');
$pdf->Cell(25 ,6,'Date',1,0,'C');
$pdf->Cell(25 ,6,'Total Sales',1,1,'C');/*end of line*/
/*Heading Of the table end*/
$pdf->SetFont('Arial','',10);
$total = 0;
$no = 0;
$result = mysqli_query($link, "SELECT * FROM orders ");
while($rowP= mysqli_fetch_array($result, MYSQLI_BOTH))
{
	$menuarr = explode("|",$rowP['menuID']);
	foreach ($menuarr as $item){
		$resultGetMenu = mysqli_query($link,"SELECT name, price FROM menu WHERE id = '".$item."'");
		$rowMenu = mysqli_fetch_array($resultGetMenu, MYSQLI_BOTH);
		$menuSTR[] = $rowMenu['name'];
		$priceSTR[] = $rowMenu['price'];
		$no++;
	}
	$pdf->Cell(15 ,$no*10,$rowP['id'],1,0,'C');
	$total += $rowP['total'];
	$tmp = $rowP['datetime'];
	$Dtime = new DateTime($tmp);
	$date = $Dtime->format('d/m/Y');
	$time = $Dtime->format('g:i A');
	
	
	/* 
	foreach ($menuarr as $item){
		$resultGetMenu = mysqli_query($link,"SELECT name FROM menu WHERE id = '".$item."'");
		$rowMenu = mysqli_fetch_array($resultGetMenu, MYSQLI_BOTH);
		$string[] = $rowMenu['name'];
	} */
	//print_r($string);
	$menu = implode("\n", $menuSTR);
	$price = implode("\nRM", $priceSTR);
	
	//echo $menu;
	$x = $pdf->GetX();
	$y = $pdf->GetY();
	$pdf->MultiCell(70 ,10,$menu,1,'L', false);
	
	$pdf->SetXY($x + 70, $y);
	$quantityarr = explode("|",$rowP['quantity']);
	foreach ($quantityarr as $quan){
		$quanSTR[] = $quan;
	} 
	$quantity = implode("\n", $quanSTR);	
	$pdf->MultiCell(20 ,10,$quantity,1,'C', false);
	$pdf->SetXY($x + 70 + 20, $y); 
	$pdf->MultiCell(25 ,10,'RM'.$price,1,'L', false);
	$pdf->SetXY($x + 70 + 45, $y); 
	$pdf->Cell(25 ,$no*10,$date,1,0,'C');
	$pdf->Cell(25 ,$no*10,'RM'.$rowP['total'],1,1,'C');
	
}
$pdf->Cell(130 ,6,'',0,0);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(25 ,6,'Total :',1,0,'C');
$pdf->Cell(25 ,6,'RM'.$total,1,1,'C');
$pdfname = $currentdate . '_report.pdf';
$pdf->Output('I',$pdfname);

?>