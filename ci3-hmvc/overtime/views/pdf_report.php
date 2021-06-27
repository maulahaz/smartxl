<?php
$this->load->module('mydatetime');

// echo $_byp_type;die();
//============================================================+
// File name   : example_002.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 002 for TCPDF class
//               Removing Header and Footer
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: Removing Header and Footer
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).
//require_once('tcpdf_include.php');
// ob_start();
// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('Overtime Record');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// add a page PORTRAIT
//SetMargins($left,$top,$right = -1,$keepmargins = false)
$pdf->SetMargins(7, 10, 7, true);

$pdf->AddPage('P', 'A4');
$pdf->SetFont('times', 'B', 14);

// set JPEG quality
$pdf->setJPEGQuality(75);

// Example of Image from data stream ('PHP rules')
//$imgdata = base64_decode('iVBORw0KGgoAAAANSUhEUgAAABwAAAASCAMAAAB/2U7WAAAABlBMVEUAAAD///+l2Z/dAAAASUlEQVR4XqWQUQoAIAxC2/0vXZDrEX4IJTRkb7lobNUStXsB0jIXIAMSsQnWlsV+wULF4Avk9fLq2r8a5HSE35Q3eO2XP1A1wQkZSgETvDtKdQAAAABJRU5ErkJggg==');

// The '@' character is used to indicate that follows an image data stream and not an image file name
//$pdf->Image('@'.$imgdata);

/*
More detail about attribute like cell, writeHtml : https://www.rubydoc.info/gems/rfpdf/1.17.4/TCPDF
*/

#Write(h, txt, link = nil, fill = 0, align = '', ln = false, stretch = 0, firstline = false, firstblock = false, maxh = 0) ⇒ Object
$pdf->Write(0, '               Interlock Bypass Risk Assessment Form', '', 0, 'L', true, 0, false, false, 0);

// Image($file, $x='', $y='', $w=0, $h=0, $type='', $link='', $align='', $resize=false, $dpi=300, $palign='', $ismask=false, $imgmask=false, $border=0, $fitbox=false, $hidden=false, $fitonpage=false)
// $pdf->Image(base_url().'img/borouge.jpg', 140,2,50);
// $pdf->Image(base_url().'img/SafetyCritical.png', 175,-7,40);
// $pdf->Image(base_url().'img/checkbox_1.jpg', 150,20,2);

//Kasih spasi
$pdf->Ln(10);

$html = '
        <table border="1" cellpadding="5">
        <!--
        // <tr style="line-height: 35px;">
        // <td colspan="2" width="220" style="background-color: red;">  "S" Interlock
            
        // </td>
        // <td colspan="2" width="220" style="background-color: rgb(173, 188, 211)">  Fire & Gas System</td>
        // <td colspan="2" width="250">  "I" Interlock</td>
        // </tr>
        
        <tr>
        <td colspan="6" align="center" style="font-size: 11px; background-color:#999">DETAIL ENTRY</td>
        </tr> 
        -->

        <tr>
        <td>Entry No</td>
        <td align="center">'.$_byp_no.'</td>
        <td>Area/Unit</td>
        <td align="center">'.$_area_unit.'</td>
        <td >Date</td>
        <td align="center">'.$_byp_date.'</td>
        </tr>

        <tr>
        <td colspan="2">Tag to be bypassed</td>
        <td colspan="2">'.$_byp_tag.'</td>
        <td>Interlock Number Affected</td>
        <td>'.$_inlock_affected.'</td>
        </tr>

        <tr>
        <td colspan="2">Reason for Bypass</td>
        <td colspan="4">'.$_reason.'</td>
        </tr>

        <tr>
        <td colspan="2">List of actions done to avoid the need of S-interlock bypass</td>
        <td colspan="4">'.$_list_action.'</td>
        </tr>

        <tr>
        <td colspan="2">Method of bypass (software, value forcing, etc.)</td>
        <td colspan="2">'.$_method.'</td>
        <td >Location of bypass (ESD, DCS, PLC,MCM)</td>
        <td>LFCP / DCS</td>
        </tr>

        <tr>
        <td colspan="2">Effect of by pass on the System (Specify ultimate consequences in the absence of Interlock)</td>
        <td colspan="4">'.$_effects.'</td>
        </tr>

        <tr>
        <td colspan="6" align="center" style="font-size: 11px; background-color:#c3c6cc">IDENTIFY MITIGATION ACTIONS ON PAGE 2</td>
        </tr>

        <tr style="font-size: 13px">
        <td colspan="5">1. This is as a last resort </td>
        <td style="text-align: center;">Yes | No</td>
        </tr>

        <tr style="font-size: 13px">
        <td colspan="5">2. All hazard with associate/affected interlocking system are verified and reviewed </td>
        <td style="text-align: center;">Yes | No</td>
        </tr>

        <tr style="font-size: 13px">
        <td colspan="5">3. Cause and Effect Diagram or interlock narrative reviewed and attached </td>
        <td style="text-align: center;">Yes | No</td>
        </tr>

        <tr style="font-size: 13px">
        <td colspan="5">4. All mode of operation has been considered during the risk assessment  </td>
        <td style="text-align: center;">Yes | No</td>
        </tr>

        <tr style="font-size: 13px">
        <td colspan="5" style="font-weight: bold;">5. Fire & Rescue Team informed  </td>
        <td style="text-align: center;">Yes | No</td>
        </tr>

        <!--<tr style="font-size: 13px">
        <td colspan="5" style="background-color: rgb(173, 188, 211)">5. Fire & Rescue Team informed  </td>
        <td style="background-color: rgb(173, 188, 211); text-align: center;">Yes | No</td>
        </tr>-->

        <tr>
        <td colspan="6" align="center" style="font-size: 11px; background-color:#c3c6cc">PREPARED BY</td>
        </tr>

        <tr>
        <td colspan="3">Name (Emp #): '.$_prepared_by.'</td>
        <td colspan="3">Signature & Date : '.$_prepare_date.'</td>
        </tr>

        <tr>
        <td colspan="6" align="center" style="font-size: 11px; background-color:#c3c6cc">APPROVALS</td>
        </tr>

        <tr>
        <td colspan="2" style="text-align: center;">< 72 hours</td>
        <td colspan="2" style="text-align: center;">> 72 hours up to 30days</td>
        <td colspan="2" style="text-align: center;">> 30days</td>
        </tr>

        <tr>
        <td colspan="2" style="color:#fff; background-color: red;text-align: center;">Ops Mgr./delegate/On-call</td>
        <td colspan="2" style="color:#fff; background-color: red;text-align: center;">VP Operations</td>
        <td colspan="2" style="color:#fff; background-color: red;text-align: center;">VP Operations</td>
        </tr>

        <tr>
        <td colspan="2" style="text-align: center;">Shift Controller</td>
        <td colspan="2" style="text-align: center;">Ops Mgr./delegate</td>
        <td colspan="2" style="text-align: center;">Ops Mgr./delegate</td>
        </tr>

        <tr>
        <td>Name (Emp #)</td>
        <td></td>
        <td>Name (Emp #)</td>
        <td></td>
        <td>Name (Emp #)</td>
        <td></td>
        </tr>

        <tr>
        <td>Signature</td>
        <td></td>
        <td>Signature</td>
        <td></td>
        <td>Signature</td>
        <td></td>
        </tr>

        <tr>
        <td>Date</td>
        <td></td>
        <td>Date</td>
        <td></td>
        <td>Date</td>
        <td></td>
        </tr>

        <tr>
        <td colspan="6" align="center" style="font-size: 11px; background-color:#c3c6cc">CLOSURE</td>
        </tr>

        <tr>
        <td colspan="6" style="text-align: center; text-transform: uppercase;">THE BYPASSED IS REMOVED AND SYSTEM IS NORMALIZED</td>
        </tr>

        <tr style="height: 50px;">
        <td colspan="3">Shift Controller Name (Emp #) :</td>
        <td colspan="3">Signature & Date :</td>
        </tr>

        </table>

        ';

// output the HTML content
// // writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='')
$pdf->writeHTML($html, true, false, true, false, ''); 

// reset pointer to the last page
$pdf->lastPage();
//-----------------------

// add a page landscape
$pdf->SetMargins(7, 10, 7, true);
$pdf->AddPage('L', 'A4');
$pdf->SetFont('times', 'B', 14);

$pdf->Write(0, 'Interlock Bypass Risk Assessment Form', '', 0, 'C', true, 0, false, false, 0);
$pdf->Image(base_url().'img/borouge.png', 235,5,30);
$pdf->Image(base_url().'img/SafetyCritical.png', 262,-5,40);

//Kasih spasi
$pdf->Ln(8);

// set some text to print

$html = '
        <table border="1" cellpadding="5">
        <tr>
        <td width="40" style="text-align: center;">SN</td>
        <td width="820" style="text-align: center;">What</td>
        <td width="140" style="text-align: center;">Who</td>
        </tr>

        <tr>
        <td height="135" style="text-align: center;">1.</td>
        <td height="135">'.$_action_what1.'</td>
        <td height="135" style="text-align: center;">'.$_action_who1.'</td>
        </tr>
        <tr height="135">
        <td height="135" style="text-align: center;">2.</td>
        <td height="135">'.$_action_what2.'</td>
        <td height="135" style="text-align: center;">'.$_action_who2.'</td>
        </tr>
        <tr>
        <td height="135" style="text-align: center;">3.</td>
        <td height="135">'.$_action_what3.'</td>
        <td height="135" style="text-align: center;">'.$_action_who3.'</td>
        </tr>

        </table>        
        ';

        $pdf->writeHTML($html, true, false, true, false, ''); 

        $pdf->SetFont('times', 'B', 12);

        $html2 = '
            <p>Attachment</p>
            <br>1.
            <br>2.
            <br>3.
        ';
        $pdf->writeHTML($html2, true, false, true, false, ''); 

// ---------------------------------------------------------
ob_clean();
//Close and output PDF document
$pdf->Output('Bypass_Form.pdf', 'I');
end_ob_clean();