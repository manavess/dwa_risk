<?php

App::import('Vendor','tcpdf/tcpdf'); 

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
$pdf->SetCreator(PDF_CREATOR); 

$pdf->SetAuthor('MoEST-HE'); 

$pdf->SetTitle('Ministry of Education-Science and Technology-Higer Education'); 

$pdf->SetSubject('Nominated Student Report');

$pdf->SetAuthor('MoEST-HE'); 

$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, '','');

$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN)); 

$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA)); 

// set default monospaced font 
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED); 

//set margins 
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT); 

$pdf->SetHeaderMargin(PDF_MARGIN_HEADER); 

$pdf->SetFooterMargin(PDF_MARGIN_FOOTER); 

//set auto page breaks 
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM); 

//set image scale factor 

$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);  

// set font 
$pdf->SetFontSize(7);

// add a page 
$pdf->AddPage(); 
$html = "";

$html .=    "   <h1 align=\"center\">THE REPUBLIC OF SOUTH SUDAN<br>MINISTRY OF EDUCATION, SCIENCE & TECHNOLOGY<br>Directorate of Admission, Evaluation and Authentication</h1><br><br>";
$html .=    "   <h1 align=\"center\">Non-Nominated Students</h1><br><br>";

    $html .= "<div>";
    $html .= "  <table width=\"100%\" cellspacing=\"0\" cellpadding=\"3\" border=\"1\" >";

    $html .= "  <tr>
                <th width=\"05%\"><b>S.No.</b></th>
                <th width=\"20%\"><b>Application Number</b></th>
                <th width=\"15%\"><b>Certificate Index</b></th>
                <th width=\"30%\"><b>Student Name</b></th>
                <th width=\"30%\"><b>School Name</b></th>";
             
       
    $html .= "  </tr>";
	$i = 1;
        
	 foreach ($studentRegistrations as $studentRegistration):
            //pr($studentRegistration);die;
             if(empty($this->StdRegistrations->isallotted($studentRegistration['StudentRegistration']['id']))){
                $html .= "<tr><td width=\"05%\">".$i."</td>";
                $html .= "<td width=\"20%\">".@$studentRegistration['StudentRegistration']['application_number']."</td>";
                $html .= "<td width=\"15%\">".@$studentRegistration['StudentRegistration']['certificate_index']."</td>";
                $html .= "<td width=\"30%\">".@$studentRegistration['StudentRegistration']['applicant_name']."</td>";
                $html .= "<td width=\"30%\">".@$studentRegistration['StudentRegistration']['secondary_school_name']."</td></tr>";
                            
             } $i++;  endforeach;
    $html .= "  </table>";
    $html .= "</div>";
             
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

$pdf->Output('Non_Nominated_students'.'.pdf', 'D'); 
?>