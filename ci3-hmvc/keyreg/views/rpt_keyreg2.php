<?php

$pdf = new Lib_tcpdf();

$pdf->SetTitle('Key Register - SMARTXL By MHz');
// $pdf->SetHeaderMargin(20);
// $pdf->SetTopMargin(20);
// $pdf->setFooterMargin(10);
$pdf->SetAutoPageBreak(false);
$pdf->SetAuthor('MHz');
// $pdf->SetDisplayMode('real', 'default');
$pdf->AddPage('L', 'mm', 'A4');
//------------Header:
$pdf->SetFont('helvetica','',12);
$pdf->Cell(40,10,'Borouge Logo',1,1,'C');
// $pdf->Cell(197,10,'',0,0,'C');
// $pdf->Cell(40,10,'Barcode',1,1,'C');
$pdf->Ln(2);

$pdfTitle = '<h3>'.$title.'</h3>';
$pdf->writeHTMLCell(0,0,'','',$pdfTitle,0,1,0,true,'C',true); 
$pdf->Ln(5);

$table = '
	<style>
	  th{text-align: center; font-weight: bold;}
	  .center-it{text-align: center;}
	</style>
	<table style="border:1px solid #000; padding:2px">
		<thead>
		<tr>
			<th style="border:1px solid #000; padding:2px; width:30px;">No</th>
			<th style="border:1px solid #000; padding:2px">Key</th>
			<th style="border:1px solid #000; padding:2px">Taken Date&Time</th>
			<th style="border:1px solid #000; padding:2px">Taken By</th>
			<th style="border:1px solid #000; padding:2px">Reason</th>
			<th style="border:1px solid #000; padding:2px">Return Date&Time</th>
			<th style="border:1px solid #000; padding:2px">Return By</th>
			<th style="border:1px solid #000; padding:2px;">Notes</th>
		</tr>
		</thead>
		<tbody>
	';
$sn = 1;
foreach ($qry->result() as $row) {
	$table .= 	'<tr>
					<td class="center-it" style="border:1px solid #000; padding:2px; width:30px;">'.$sn++.'</td>
					<td class="center-it" style="border:1px solid #000; padding:2px">'.$row->Keyreg_type.'</td>
					<td class="center-it" style="border:1px solid #000; padding:2px">'.$row->Taken_dtm.'</td>
					<td class="center-it" style="border:1px solid #000; padding:2px">'.$row->Taken_by.'</td>
					<td style="border:1px solid #000; padding:2px">'.$row->Reason.'</td>
					<td class="center-it" style="border:1px solid #000; padding:2px">'.$row->Return_dtm.'</td>
					<td class="center-it" style="border:1px solid #000; padding:2px">'.$row->Return_by.'</td>
					<td style="border:1px solid #000; padding:2px;">'.$row->Notes.'</td>
				</tr>';				
}

$table .= '
		</tbody>
	</table>

';

$pdf->writeHTMLCell(0,0,'','',$table,0,1,0,true,'',true); 
// move pointer to last page
$pdf->lastPage();

// ---------------------------------------------------------

ob_clean();
//Close and output PDF document
$pdf->Output('Keyreg.pdf', 'I');
exit(); 
//============================================================+
// END OF FILE
//============================================================+
