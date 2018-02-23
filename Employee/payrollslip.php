<?php 
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
session_start();

include "../util/connection.php";

  $mth=$_GET['mth'];
  $yr=$_GET['yr'];
  $id=$_GET['id'];

  $ref=$yr.'/'.$mth.'/'.$id;

//echo $id;die();
//get basic salary
$psm=explode("/", $ref);

//data staff
$sqlid="select * from staffinfosalary where staffid='".$psm[2]."'";
$sqlid1=mysqli_query($con, $sqlid);
$sqlobj=mysqli_fetch_object($sqlid1);
//basic 
$basicSALA=$sqlobj->salary;
$zkt=$sqlobj->zakat;
$te=$sqlobj->elauntravel;

//salary staff
$sqladmin="SELECT * FROM salarystaff where refno='".$ref."'";
$rs=mysqli_query($con, $sqladmin);
$data=mysqli_fetch_object($rs);

$row=mysqli_num_rows($rs);
//echo $row;die();
if(!$row)
{
  echo " Your Pay Slip In Progress.";
}


$getm="select * from month where MONTH='$psm[1]'";
$getma=mysqli_query($con, $getm);
$datam=mysqli_fetch_object($getma);


//echo $basicSALA;die();
//////////////pdf create/////////////////////

require_once('pdfeditor/fpdf.php');

require_once('pdfeditor/fpdi.php');
  

// initiate FPDI

$pdf = new FPDI();

// add a page

$pdf->AddPage();

// set the source file

$pdf->setSourceFile("temppayslip.pdf");

// import page 1

$tplIdx = $pdf->importPage(1);

// use the imported page and place it at point 10,10 with a width of 100 mm

$pdf->useTemplate($tplIdx, 0, 0, 210);



//font setting

$pdf->SetTextColor(0, 0, 0);

$pdf->SetFont('Arial','B',14);

//staff id

$pdf->SetFont('Arial','',6);

$pdf->SetXY(45, 40);

$pdf->Cell(99.9,5,$sqlobj->staffid);

//name

$pdf->SetFont('Arial','',6);

$pdf->SetXY(45, 43);

$pdf->Cell(99.9,5,$sqlobj->name);

//no ic

$pdf->SetFont('Arial','',6);

$pdf->SetXY(45, 46);

$pdf->Cell(99.9,5,$sqlobj->ic);

// department

$pdf->SetFont('Arial','',6);

$pdf->SetXY(45, 49);

$pdf->Cell(99.9,5,$sqlobj->department);

// position

$pdf->SetFont('Arial','',6);

$pdf->SetXY(45, 52);

$pdf->Cell(99.9,5,$sqlobj->position);

//siri no

$pdf->SetFont('Arial','',6);

$pdf->SetXY(173, 40);

$pdf->Cell(99.9,5,$ref);

//noepf

$pdf->SetFont('Arial','',6);

$pdf->SetXY(173, 43);

$pdf->Cell(99.9,5,$sqlobj->epf);

//nosocso

$pdf->SetFont('Arial','',6);

$pdf->SetXY(173, 46);

$pdf->Cell(99.9,5,$sqlobj->socso);

// income tax no

$pdf->SetFont('Arial','',6);

$pdf->SetXY(173, 49);

$pdf->Cell(99.9,5,$sqlobj->tax);

// month

$pdf->SetFont('Arial','',6);

$pdf->SetXY(173, 52.3);

$pdf->Cell(99.9,5,$datam->FULL_NAME);

// basic

$pdf->SetFont('Arial','',6);

$pdf->SetXY(55, 64);

$pdf->Cell(99.9,5,"$basicSALA");

// ALLOWANCE
$opsel=$data->opsallownce;
if($opsel==0)
{
  $opsel='    -';
}else
{
  $opsel=$opsel;
}
$pdf->SetFont('Arial','',6);

$pdf->SetXY(55, 67);

$pdf->Cell(99.9,5,$opsel);


// PARENTS ALLOWANCE
$pel=$data->parentsallowance;
if($pel==0)
{
  $pel='    -';
}else
{
  $pel=$pel;
}
$pdf->SetFont('Arial','',6);

$pdf->SetXY(55, 70);

$pdf->Cell(99.9,5,$pel);

// TRAVEL ALLOWANCE
$tel=$sqlobj->elauntravel;
if($tel==0)
{
  $tel='    -';
}else
{
  $tel=$tel;
}
$pdf->SetFont('Arial','',6);

$pdf->SetXY(55, 73);

$pdf->Cell(99.9,5,$tel);

// OVERTIME
$tot=$data->totalot;
if($tot==0)
{
  $tot='    -';
}else
{
  $tot=$tot;
}
$pdf->SetFont('Arial','',6);

$pdf->SetXY(55, 76);

$pdf->Cell(99.9,5,$tot);

// total gross

$pdf->SetFont('Arial','',6);

$pdf->SetXY(55, 89);

$pdf->Cell(99.9,5,$data->grosssalary);


// total net

$pdf->SetFont('Arial','',6);

$pdf->SetXY(55, 95);

$pdf->Cell(99.9,5,$data->netpay);

// epf staff
$pdf->SetFont('Arial','',6);

$pdf->SetXY(120, 64);

$pdf->Cell(99.9,5,$data->epfs);

// socso staff

$pdf->SetFont('Arial','',6);

$pdf->SetXY(120, 67);

$pdf->Cell(99.9,5,$data->socs);

//ZAKAT
$tza=$data->zakat;
if($tza==0)
{
  $tza='    -';
}else
{
  $tza=$tza;
}
$pdf->SetFont('Arial','',6);

$pdf->SetXY(120, 70);

$pdf->Cell(99.9,5,$tza);

// TAX
$ttax=$data->tax;
if($ttax==0)
{
  $ttax='    -';
}else
{
  $ttax=$ttax;
}
$pdf->SetFont('Arial','',6);

$pdf->SetXY(120, 73);

$pdf->Cell(99.9,5,$ttax);

// DEBT
$tdex=$data->upl+$data->oth;
if($tdex==0)
{
  $tdex='    -';
}else
{
  $tdex=$tdex;
}
$pdf->SetFont('Arial','',6);

$pdf->SetXY(120, 76);

$pdf->Cell(99.9,5,$tdex);

// total deduction

$pdf->SetFont('Arial','',6);

$pdf->SetXY(120, 89);

$pdf->Cell(99.9,5,$data->totaldeduction);

// epf comp

$pdf->SetFont('Arial','',6);

$pdf->SetXY(180, 64);

$pdf->Cell(99.9,5,$data->epfc);

// socso comp

$pdf->SetFont('Arial','',6);

$pdf->SetXY(180, 67);

$pdf->Cell(99.9,5,$data->socc);

// socso+epf comp

$pdf->SetFont('Arial','',6);

$pdf->SetXY(180, 89);

$pdf->Cell(99.9,5,$data->epfc);




$pdf->Output();

?>