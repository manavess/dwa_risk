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
$pdf->SetFontSize(7);

// add a page 
$pdf->AddPage(); 
$html = "";

$html .=    "<h1 align=\"center\">THE REPUBLIC OF SOUTH SUDAN<br>MINISTRY OF EDUCATION, SCIENCE & TECHNOLOGY<br>Directorate of Admission, Evaluation and Authentication</h1><br><br>";
$html .=    "<h1 align=\"center\">Results report for the year 2012/2013</h1><br><br>";
if(!empty($university_id && $course_id)){
    $html .= "  <table width=\"100%\" cellspacing=\"0\" cellpadding=\"3\" border=\"1\" >";  
    $html .= "  <tr>
                <td><b><h2 align=\"center\">".@$this->StdRegistrations->getuniversity($exceptionsadmissions[0]['Colleges']['university_id'])."</h3></b></td>
                <td><b><h2 align=\"center\">".@$this->StdRegistrations->getcourse($exceptionsadmissions[0]['StudentAlotment']['course_id'])."</h3></b></td>
                </tr></table>";
}else if(!empty($course_id)){
    $html .= "  <table width=\"100%\" cellspacing=\"0\" cellpadding=\"3\" border=\"1\" >";  
    $html .= "  <tr>
                <td><b><h2 align=\"center\">".@$this->StdRegistrations->getcourse($exceptionsadmissions[0]['StudentAlotment']['course_id'])."</h3></b></td>
                </tr></table>";
}else if(!empty($university_id)){
    $html .= "  <table width=\"100%\" cellspacing=\"0\" cellpadding=\"3\" border=\"1\" >";  
    $html .= "  <tr>
                <td><b><h2 align=\"center\">".@$this->StdRegistrations->getuniversity($exceptionsadmissions[0]['Colleges']['university_id'])."</h3></b></td>
                </tr></table>";
}

$html .= "  <div></div>";
$html .= "<table width=\"100%\" cellspacing=\"0\" cellpadding=\"3\" border=\"1\" >";

    $html .= "  <tr>
                <th width=\"05%\"><b>S.No</b></th>
                
                <th width=\"10%\"><b>College Code</b></th>
                <th width=\"27%\"><b>College</b></th>
                <th width=\"10%\"><b>Planned Nos</b></th>
                <th width=\"23%\"><b>Nominated Student</b><br><table><tr><td>Male</td><td>Female</td><td>Total</td></tr></table></th>
                ";
    
    
    $html .= "<th width=\"7%\"><b>Percentage</b></th>";
    $html .= "<th width=\"12%\"><b>Differentiation</b></th>";
    $html .= "<th width=\"6%\"><b>Remarks</b></th></tr>";
    $i=1;
        
            $totalplanned = 0;
            $totalmale = 0;
            $totalfemale = 0;
            $totalnominated = 0;
            $totalremarks = 0;
            
            if(count($exceptionsadmissions) > 0){
    
            foreach ($exceptionsadmissions as $exceptionallotment){
            $remarks = 0; //(String) $remarks =  @$exceptionallotment[0]['opt']-$exceptionallotment['Colleges']['no_of_seats'];
            
    
            $html .= "<tr><td width=\"5%\">".$i."</td>";
                
            $html .= "<td width=\"10%\">".@$exceptionallotment['Colleges']['college_code']."</td>";
            $html .= "<td width=\"27%\">".@$exceptionallotment['Colleges']['name']."</td>";
            $html .= "<td width=\"10%\">".@$exceptionallotment['Colleges']['no_of_seats']."</td>";
                        $totalplanned = $totalplanned + $exceptionallotment['Colleges']['no_of_seats'];
            $html .= "<td width=\"23%\"><table><tr>";
            $html .= "<td>".@$exceptionallotment[0]['malecount']."</td>";
                        $totalmale = $totalmale + $exceptionallotment[0]['malecount'];
            $html .= "<td>".@$exceptionallotment[0]['femalecount']."</td>";
                        $totalfemale = $totalfemale + $exceptionallotment[0]['femalecount'];
            $html .= "<td>".@$exceptionallotment[0]['opt']."</td>";
                        $totalnominated = $totalnominated + $exceptionallotment[0]['opt'];
            $html .= "</tr></table></td>";
            
            
            $html .= "<td width=\"7%\">".$this->StdRegistrations->getlastadmper($exceptionallotment['Colleges']['id'],$exceptionallotment['StudentAlotment']['allocation_year'])."</td>";
            $html .= "<td width=\"12%\">".$this->StdRegistrations->getsummationspecialized($exceptionallotment['Colleges']['id'],$exceptionallotment['StudentAlotment']['allocation_year'])."</td>";
            $html .= "<td width=\"6%\">".(String) $remarks =  @$exceptionallotment[0]['opt']-$exceptionallotment['Colleges']['no_of_seats']."</td>";
                        $totalremarks = $totalremarks + $remarks;
            $html .= "</tr>";
            
            
           $i++; }
            }else{
                
            }
    $html .= "</table>";
    
    $html .= "<table width=\"100%\" cellspacing=\"0\" cellpadding=\"3\" border=\"1\">";
    $html .= "<tr><td align=\"center\" width=\"42%\">
                <b>Total:</b></td>
                <td width=\"10%\">".$totalplanned."</td>
                <td width=\"23%\"><table><tr><td>".$totalmale."</td><td>".$totalfemale."</td><td>".$totalnominated."</td></tr></table></td>
                <td width=\"7%\"></td>
                <td width=\"12%\"></td>
                <td width=\"6%\">".$totalremarks."</td>
                </tr>";
    $html .= "</table>";
             
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);


$pdf->Output('results_report'.'.pdf', 'D'); 
//ob_end_clean();
?>