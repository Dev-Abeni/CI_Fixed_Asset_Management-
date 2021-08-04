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

$pdf->Write(22, 'Asset depreciation schedule', '', 0, 'L', true, 0, false, false, 0);


$pdf->SetFont('helvetica', '', 8);

$table = '<table style="border:1px solid #000; padding: 6px;">'; 
$table .= '<tr>
	<th style="border: 1px solid #000;">Date</th>
	<th style="border: 1px solid #000;">Unicode</th>
	<th style="border: 1px solid #000;">Name</th>
	<th style="border: 1px solid #000;">Acquisition date</th>
	<th style="border: 1px solid #000;">Acquisition cost</th>
	<th style="border: 1px solid #000;">Rate</th>
	<th style="border: 1px solid #000;">Book value</th>
	<th style="border: 1px solid #000;">Depreciation Expense</th>
    </tr>'; 
    foreach($asset_depreciation_schedule as $row){
        $table .= '<tr>
            <td style="border: 1px solid #000;">'.date_format(date_create($row->date), "F d, Y").'</td>
            <td style="border: 1px solid #000;">'.$row->unicode.'</td>
            <td style="border: 1px solid #000;">'.$row->name.'</td>
            <td style="border: 1px solid #000;">'.date_format(date_create($row->date_of_acquisition), "F d, Y").'</td>
            <td style="border: 1px solid #000;">'.number_format(($row->original_price), 2, ".", "").'</td>
            <td style="border: 1px solid #000;">'.($row->depreciation_percent/100).'</td>
            <td style="border: 1px solid #000;">'.number_format(($row->book_value), 2, ".", "").'</td>
            <td style="border: 1px solid #000;">'.number_format(($row->depreciation_expense), 2, ".", "").'</td>
        </tr>';
    }
$table .= '</table>';
$pdf->writeHTML($table, true, false, false, false, '');

// -----------------------------------------------------------------------------

//Close and output PDF document
$pdf->Output('example_048.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
