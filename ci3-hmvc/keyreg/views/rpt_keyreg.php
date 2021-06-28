<?php

/// INITIATOR: 
/// ================================================================
// $this->load->library('Lib_tcpdf');
$pdf = new Lib_tcpdf();
$pdf->AddPage('L', 'mm', 'A4');
// A4 Landscape 297x210mm, margin each Left and Right = 10mm; 
// Formula => $pdf->Cell(width,height,'content',border,eof,align,fill);
// Formula => $pdf->MultiCell(width,height,'content',border,eof,align,fill)

/// Converted variable: 
/// ================================================================
// $validFrom = getNiceDateFromStr(qryP->Valid_from, "overtime");
// $validUntil = getNiceDateFromStr(qryP->Valid_until, "overtime");

/// PAGE HEADER: 
/// ================================================================
$pdf->SetFont('helvetica','',12);
$pdf->Cell(40,10,'Borouge Logo',1,1,'C');
// $pdf->Cell(197,10,'',0,0,'C');
// $pdf->Cell(40,10,'Barcode',1,1,'C');
$pdf->Ln(5);

/// PAGE TITLE: 
/// ================================================================
$pdf->SetFont('freesans','B',12);
$pdf->SetFillColor(245,110,0);
$pdf->SetTextColor(255,255,255);
$pdf->Cell(277,10,'KEY REGISTER LIST',0,1,'C',1);
$pdf->Ln(3);

/// TABLE HEADER: 
/// ================================================================
$pdf->SetFont('freesans','',10);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(10,7,'No',1,0,'C');
$pdf->Cell(50,7,'Key Type',1,0,'C');
$pdf->Cell(30,7,'Taken date',1,0,'C');
$pdf->Cell(20,7,'Taken by',1,0,'C');
$pdf->Cell(60,7,'Reason',1,0,'C');
$pdf->Cell(30,7,'Return date',1,0,'C');
$pdf->Cell(20,7,'Return by',1,0,'C');
$pdf->Cell(60,7,'Notes',1,1,'C');

/// TABLE CONTENT: 
/// ================================================================
$no = 1;
foreach ($qry->result() as $row) {
	$pdf->Cell(10,7,$no,1,0,'C');
	$pdf->Cell(50,7,$row->Keyreg_type,1,0,'C');
	$pdf->Cell(30,7,$row->Taken_dtm,1,0,'C');
	$pdf->Cell(20,7,$row->Taken_by,1,0,'C');
	$pdf->Cell(60,7,$row->Reason,1,0,'L');
	$pdf->Cell(30,7,$row->Return_dtm,1,0,'C');
	$pdf->Cell(20,7,$row->Return_by,1,0,'C');
	$pdf->Cell(60,7,$row->Notes,1,1,'L');
	$no++;
}


//------------Detail:
// $pdf->SetFont('freesans','B',12);
// $pdf->SetFillColor(245,110,0);
// $pdf->SetTextColor(255,255,255);
// $pdf->Cell(0,7,'Details',0,1,'L',1);
// $pdf->Ln(3);
//Detail section:
// $pdf->SetFont('freesans','',10);
// $pdf->SetTextColor(0,0,0);
// $pdf->Cell(50,7,'Planned Start Date',0,0,'L',0);
// $pdf->Cell(0,7,': validFrom',0,1,'L',0); //eol
// $pdf->Cell(50,7,'Planned End Date',0,0,'L',0);
// $pdf->Cell(0,7,': validUntil',0,1,'L',0); //eol
// $pdf->Cell(50,7,'Work Area',0,0,'L',0);
// $pdf->Cell(0,7,': xArea',0,1,'L',0); //eol
// $pdf->Cell(50,7,'Work Location',0,0,'L',0);
// $pdf->Cell(0,7,': xLocation',0,1,'L',0); //eol
// $pdf->Cell(50,7,'Tag Number',0,0,'L',0);
// $pdf->Cell(0,7,': xTag_uid',0,1,'L',0); //eol
// $pdf->Cell(50,7,'ICC Number',0,0,'L',0);
// $pdf->Cell(0,7,': xICC_uid',0,1,'L',0); //eol
// $pdf->Ln(8);

$pdf->Output('Keyreg.pdf', 'I');
exit(); 
?>