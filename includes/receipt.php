<?php if(session_status()==PHP_SESSION_NONE){
session_start();} ?>
<?php
//function receipt(array $items){
//PDF USING MULTIPLE PAGES
require('fpdf/fpdf.php');

//Create new pdf file
$pdf=new FPDF();

//Disable automatic page break
$pdf->SetAutoPageBreak(false);

//Add first page
$pdf->AddPage();

//Add title
		$pdf->SetFont("Times","U","14");
		$pdf->SetX(95);
		$pdf->Cell(10,8,"EVENTS AND EQUIPMENT SERVICES BOOKING SYSTEM",0,1,"C");
		$pdf->SetX(95);
		$pdf->Cell(10,8,"ORDER PLACED ON ".$_SESSION['dt']."",0,2,"C");
//set initial y axis position per page
$y_axis_initial = 25;
$row_height = 8;
//print column titles
$pdf->SetY($y_axis_initial);
$pdf->SetFont("","B","12");		
$pdf->Cell(13,8,"Sr.",1,0,"C",FALSE);
$pdf->Cell(27,8,"Type",1,0,"C",FALSE);
$pdf->Cell(40,8,"Company",1,0,"C",FALSE);
$pdf->Cell(27,8,"Size",1,0,"C");
$pdf->Cell(27,8,"People",1,0,"C",FALSE);
$pdf->Cell(27,8,"Quantity",1,0,"C",FALSE);
$pdf->Cell(27,8,"Price(/=)",1,0,"C",FALSE);

$y_axis = $y_axis_initial + $row_height;

//initialize counter
$i = 0;

//Set maximum rows per page
$max = 25;

//Set Row Height
$row_height = 8;

$sr = 1; //serial number
foreach($_SESSION["items"] as $item)
{
$pdf->SetFillColor(255,255,255);
$pdf->SetFont("","","11");	
	//If the current row is the last one, create new page and print column title
	if ($i == $max)
	{
		$pdf->AddPage();        
	   
		//print column titles for the current page
		$pdf->SetY($y_axis_initial);
		//$pdf->SetX(25);
        $pdf->SetFont("","B","12");		
		$pdf->Cell(13,8,"Sr.",1,0,"C",FALSE);
		$pdf->Cell(27,8,"Type",1,0,"C",FALSE);
		$pdf->Cell(40,8,"Company",1,0,"C",FALSE);
		$pdf->Cell(27,8,"Size",1,0,"C");
		$pdf->Cell(27,8,"People",1,0,"C",FALSE);
		$pdf->Cell(27,8,"Quantity",1,0,"C",FALSE);
		$pdf->Cell(27,8,"Price(/=)",1,0,"C",FALSE);
		
		//Go to next row
		$y_axis = $y_axis + $row_height;
		
		//Set $i variable to 0 (first row)
		$i = 0;
	}	
    
    $type = $item['svstyp'];
    $company = $item['companyName'];
    $size = $item['size'];
    $people = $item['people'];
    $quantity = $item['quantity'];
    $price = $item['price'];

	$pdf->SetY($y_axis);
	//$pdf->SetX(25);
	$pdf->Cell(13,8,$sr,1,0,'C',1);
	$pdf->Cell(27,8,$type,1,0,'C',1);
	$pdf->Cell(40,8,$company,1,0,'C',1);
	$pdf->Cell(27,8,$size,1,0,'C',1);
	$pdf->Cell(27,8,$people,1,0,'C',1);
	$pdf->Cell(27,8,$quantity,1,0,'C',1);
	$pdf->Cell(27,8,$price,1,0,'C',1);

	//Go to next row
	$y_axis = $y_axis + $row_height;
    $i = $i + 1;
    
    $sr = $sr + 1; //next serial
}
	
$stmt = null;
//unset($_SESSION["items"]);
//Send file
$pdf->Output();
//} 
?>
