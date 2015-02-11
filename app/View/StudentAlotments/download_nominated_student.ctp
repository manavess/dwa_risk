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
$html .=    "   <h1 align=\"center\">Nominated Students</h1><br><br>";
$html .=    "   <h1 align=\"center\">Year of Admission: ".@$studentAlotments[0]['StudentAlotment']['allocation_year']."</h1><br><br>";
if(!empty($nominate)){
    $html .= "  <table width=\"100%\" cellspacing=\"0\" cellpadding=\"3\" border=\"1\" >";  
    $html .= "  <tr>
                <td><b><h2 align=\"center\">".@$this->StdRegistrations->getuniversity($studentAlotments[0]['Colleges']['university_id'])."</h3></b></td></tr></table>";
            if($coll){ 
                    $html .= "  <table width=\"100%\" cellspacing=\"0\" cellpadding=\"3\" border=\"1\" >"; 
    
                    $html .= "  <tr>
                               <td width=\"50%\" align=\"center\"><h3>".@$studentAlotments[0]['Colleges']['name']."</h3></td><td width=\"50%\" align=\"center\">".@$studentAlotments[0]['Colleges']['college_code']."</td></tr></table>";
                    }
        }

    $html .= "  <div></div>";
    $html .= "<div>";
    $html .= "  <table width=\"100%\" cellspacing=\"0\" cellpadding=\"3\" border=\"1\" >";

    $html .= "  <tr>
                <th ><b>S.No.</b></th>
                <th ><b>Certificate Index</b></th>
                <th ><b>Application Number</b></th>
                <th ><b>Student Name</b></th>
                <th ><b>School Name</b></th>";
        if(!empty($nominate)){
            
        }else{
    $html .= "  <th ><b>Allotted College</b></th>
                <th ><b>University</b></th>";
        }
       
    $html .= "<th><b>Total Percentage</b></th>";   
    $html .= "  <th ><b>Rank</b></th>
                </tr>";
	
	        $i = 1;
        
	 foreach ($studentAlotments as $studentAlotment):
             if(!empty($studentAlotment['StudentRegistration']['certificate_index']) && !empty($studentAlotment['StudentAlotment']['grade'])){
                $html .= "<tr><td >".$i."</td>";
                $html .= "<td >".@$studentAlotment['StudentRegistration']['certificate_index']."</td>";
                $html .= "<td >".@$studentAlotment['StudentRegistration']['application_number']."</td>";
                $html .= "<td >".@$studentAlotment['StudentRegistration']['applicant_name']."</td>";
                $html .= "<td >".@$studentAlotment['StudentRegistration']['secondary_school_name']."</td>";
                 if(!empty($nominate)){
            
                }else{
                $html .= "<td >".@$studentAlotment['Colleges']['name']."</td>";
                $html .= "<td >".@$this->StdRegistrations->getuniversity($studentAlotment['Colleges']['university_id'])."</td>";
               }
                $html .= "<td >".@$studentAlotment['StudentRegistration']['total_percentage']."</td>";
                $html .= "<td >".@$studentAlotment['StudentAlotment']['grade']."</td></tr>";
             } $i++;   endforeach;
    $html .= "  </table>";
    $html .= "</div>";
             
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);


$pdf->Output('Nominated_students'.'.pdf', 'D'); 
?>