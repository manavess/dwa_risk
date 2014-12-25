<?php
App::import('Vendor','tcpdf/tcpdf'); 

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
$pdf->SetCreator(PDF_CREATOR); 

$pdf->SetAuthor('MoEST-HE'); 

$pdf->SetTitle('Ministry of Education-Science and Technology-Higer Education'); 

$pdf->SetSubject('Result Report');

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
$pdf->SetFontSize(6);

// add a page 
$pdf->AddPage(); 
$html = "";

$html .=    "<h1 align=\"center\">THE REPUBLIC OF SOUTH SUDAN<br>MINISTRY OF EDUCATION, SCIENCE & TECHNOLOGY<br>Directorate of Admission, Evaluation and Authentication</h1><br><br>";
$html .=    "<h1 align=\"center\">Results report for the year 2012/2013</h1><br><br>";

$html .= "<table width=\"100%\" cellspacing=\"0\" cellpadding=\"3\" border=\"1\" >";

    $html .= "  <tr>
                <th width=\"05%\"><b>S.No</b></th>
                
                <th width=\"15%\"><b>College Code</b></th>
                <th width=\"18%\"><b>College</b></th>
                <th width=\"14%\"><b>Planned Nos</b></th>
                <th width=\"14%\">Nominated Student<br><table><tr><td>Male</td><td>Female</td><td>Total</td></tr></table></th>
                ";
    
    
    $html .= "<th width=\"6%\">Percentage</th>";
    $html .= "<th width=\"6%\"><b>Remarks</b></th></tr>";
    $i=1;
            foreach ($exceptionsadmissions as $exceptionallotment){
            $remarks = 0; //(String) $remarks =  @$exceptionallotment[0]['opt']-$exceptionallotment['Colleges']['no_of_seats'];
            
    
            $html .= "<tr><td width=\"5%\">".$i."</td>";
                
            $html .= "<td width=\"15%\">".@$exceptionallotment['Colleges']['college_code']."</td>";
            $html .= "<td width=\"18%\">".@$exceptionallotment['Colleges']['name']."</td>";
            $html .= "<td width=\"14%\">".@$exceptionallotment['Colleges']['no_of_seats']."</td>";
            $html .= "<td width=\"14%\"><table><tr><td>".@$exceptionallotment[0]['malecount']."</td><td>". @$exceptionallotment[0]['femalecount']."</td><td>".@$exceptionallotment[0]['opt']."</td></tr></table></td>";
            
            
            $html .= "<td width=\"6%\">".$this->StdRegistrations->getlastadmper($exceptionallotment['Colleges']['id'],$exceptionallotment['StudentAlotment']['allocation_year'])."</td>";
            $html .= "<td width=\"6%\">".(String) $remarks =  @$exceptionallotment[0]['opt']-$exceptionallotment['Colleges']['no_of_seats']."</td></tr>";
            
            
           $i++; }
    $html .= "</table>";
             
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);


$pdf->Output('results_report'.'.pdf', 'D'); 
//ob_end_clean();
?>