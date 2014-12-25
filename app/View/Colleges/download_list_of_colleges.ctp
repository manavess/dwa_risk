<?php

App::import('Vendor', 'tcpdf/tcpdf');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetCreator(PDF_CREATOR);

$pdf->SetAuthor('MoEST-HE');

$pdf->SetTitle('Ministry of Education-Science and Technology-Higer Education');

$pdf->SetSubject('List of Colleges');

$pdf->SetAuthor('MoEST-HE');

$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, '', '');

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

if(!empty($university)){
    $university = '('.$university['University']['name'].')';
}else{
    $university = '';
}

$html .= "   <h1 align=\"center\">THE REPUBLIC OF SOUTH SUDAN<br>MINISTRY OF EDUCATION, SCIENCE & TECHNOLOGY<br>Directorate of Admission, Evaluation and Authentication</h1><br><br>";
$html .= "   <h1 align=\"center\">List of Colleges</h1><br>";
$html .= "   <h2 align=\"center\">".$university."</h2><br>";
$html .= "  <div></div>";
$html .= "  <table width=\"100%\" cellspacing=\"0\" cellpadding=\"3\" border=\"1\" >";

$html .= "  <tr>
                <th width=\"05%\"><b>S.No.</b></th>
                <th width=\"15%\"><b>College Code</b></th>
                <th width=\"25%\"><b>College</b></th>
                <th width=\"20%\"><b>University</b></th>
                <th width=\"15%\"><b>Number of Seats</b></th>
                <th width=\"10%\"><b>Affilated From</b></th>
                <th width=\"10%\"><b>Affilated to</b></th></tr>";

$i = 1;
foreach ($colleges as $college):
    if (!empty($college['College']['college_code'])) {
        $html .= "<tr><td width=\"5%\">" . $i . "</td>";
        $html .= "<td width=\"15%\">" . @$college['College']['college_code'] . "</td>";
        $html .= "<td width=\"25%\">" . @$college['College']['name'] . "</td>";
        $html .= "<td width=\"20%\">" . @$college['University']['name'] . "</td>";
        $html .= "<td width=\"15%\">" . @$college['College']['no_of_seats'] . "</td>";
        $html .= "<td width=\"10%\">" . @date("d-m-Y", strtotime($college['College']['affilated_from'])). "</td>";
        $html .= "<td width=\"10%\">" . @date("d-m-Y", strtotime($college['College']['affilated_to'])). "</td></tr>";
        
    } $i++;
endforeach;
$html .= "</table>";

$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);


$pdf->Output('Colleges_list' . '.pdf', 'D');
?>