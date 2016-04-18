<?php 
include "/home/ekeehn/Code Work/MathTestApp/POC/Source/Development/prince-php5-r15/prince.php";
require_once("/home/ekeehn/Code Work/MathTestApp/POC/Source/Development/dompdf/autoload.inc.php");
use Dompdf\Dompdf;

function main()
{
	return "Hi";
}

function Prince_ExportToPDF($fpath)
{
	$prince = new Prince('/usr/bin/prince');

	$prince->addStyleSheet("/bootstrap-.3.3.6/css/bootstrap.min.css");
	$prince->setHTML(1);

	$prince->convert_file_to_passthru($fpath);
}

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