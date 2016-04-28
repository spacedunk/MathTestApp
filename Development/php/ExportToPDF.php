<?php 
use Dompdf\Dompdf;

function DOMPDF_ExportToPDF($fpath)
{
	// instantiate and use the dompdf class
	$dompdf = new Dompdf();
	$dompdf->loadHtml(file_get_contents($fpath));

	// (Optional) Setup the paper size and orientation
	$dompdf->setPaper('A4', 'landscape');

	// Render the HTML as PDF
	$dompdf->render();

	// Output the generated PDF to Browser
	$dompdf->stream("sample.pdf");

	//$output = $dompdf->output();

	//file_put_contents("sample.pdf", $output);

	//echo "http://localhost/sample.pdf";
}


//Prince_ExportToPDF("SampleTest.html");
DOMPDF_ExportToPDF("MathMLPOC.html");
?>