<?php


// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', 'B', 20);

// add a page
$pdf->AddPage();

$pdf->Write(22, 'Product: '.$asset->name.' - '.$asset->unicode, '', 0, 'L', true, 0, false, false, 0);


$pdf->SetFont('helvetica', '', 8);

$data = '<h3 style="font-weight:300">Date of acquisition</h3>';
$data .= '<p><b>'.date_format(date_create($asset->date_of_acquisition), "F d, Y").'</b></p>'; 
$data .= '<h3 style="font-weight:300">Acquisition price</h3>';
$data .= '<p><b>'.number_format(($asset->original_price), 2, ".", "").'</b></p>'; 
$data .= '<h3 style="font-weight:300">Daily depreciation rate</h3>';
$data .= '<p><b>'.number_format(($depreciation_percent/100), 2, ".", "").' ('.number_format($daily_depreciation_charge,2, '.', '').' br)</b></p>'; 

if($asset_depreciation_schedule){
    $data .= '<h1>Asset book value</h1>';
    $data .= '<hr>';
    $data .= '<table style="border:1px solid #000; padding: 6px;">';
    $data .= '<tr>
                <th>Date</th>
                <th>Book value on the day</th>
                <th>Depreciation expense on the day</th>
            </tr>'; 
            foreach($asset_depreciation_schedule as $row){
                $data .= '<tr>
                    <td>'.date_format(date_create($row->date), "F d, Y").'</td>
                    <td>'.number_format(($row->book_value), 2, ".", "").'</td>
                    <td>'.number_format(($row->depreciation_expense), 2, ".", "").'</td>
                </tr>';
            } 

}

if($maintenance_record){
    $data .= '<h1>Asset maintenance record</h1>';
    $data .= '<hr>';
        $data .= '<table style="border:1px solid #000; padding: 6px;">';
        $data .= '<tr>
                <th>Unicode</th>
                <th>Date</th>
                <th>Name</th>
                <th>Cost</th>
            </tr>'; 
            foreach($maintenance_record as $row){
                $data .= '<tr>
                    <td>'.$asset->unicode.'-'.$row->maintenance_id.'</td>
                    <td>'.date_format(date_create($row->date), "F d, Y").'</td>
                    <td>'.$row->name.'</td>
                    <td>'.number_format(($row->cost), 2, ".", "").'</td>
                </tr>';
            } 

}
            
$pdf->writeHTML($data, true, false, false, false, '');

// -----------------------------------------------------------------------------

//Close and output PDF document
$pdf->Output('example_048.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
