<?php
App::import('Vendor','tcpdf/tcpdf'); 

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
$pdf->SetCreator(PDF_CREATOR); 

$pdf->SetAuthor('MoEST-HE'); 

$pdf->SetTitle('Ministry of Education-Science and Technology-Higer Education'); 

$pdf->SetSubject('Last Nominated Student Report');

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

$html .= "<h1 align=\"center\">THE REPUBLIC OF SOUTH SUDAN<br>MINISTRY OF EDUCATION, SCIENCE & TECHNOLOGY<br>Directorate of Admission, Evaluation and Authentication</h1><br><br>";
$html .= "<h1 align=\"center\">Percentage of Last Nominated Students</h1><br><br>";

$html .= "<table width=\"100%\" cellspacing=\"0\" cellpadding=\"3\" border=\"2\" bgColor=\"#BFBFBF\" >";

	$html .= "<tr>
	<th><b>S.No</b></th>
        <th><b>College code</b></th>
        <th><b>College</b></th>
        <th><b>Marks(%)</b></th>
        <th><b>Allocation year</b></th>
	</tr>";
	
	        $i = 1;
        
	 foreach ($listallocatedpercentage as $list):
             if(!empty($list['Colleges']['name'])){
                 $html .= "<tr><td>".$i."</td>";
                 $html .= "<td>".@$list['Colleges']['college_code']."</td>";
                 $html .= "<td>".@$list['Colleges']['name']."</td>";
                 $html .= "<td>".@$list[0]['total_percentage']."</td>";
                 $html .= "<td>".@$list['StudentAlotment']['allocation_year']."</td></tr>";
             } $i++;   endforeach;
             $html .= "</talble>";
             
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);


$pdf->Output('LastNominated_students'.'.pdf', 'D'); 
?>