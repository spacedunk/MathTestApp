<?php 
require_once '../libs/dompdf/dompdf/autoload.inc.php';
use Dompdf\Dompdf;
class PDFExporter
{
	public static function ExportToPDF($html)
	{
		// instantiate and use the dompdf class
		$dompdf = new Dompdf();
		$dompdf->loadHtml($html);

		// (Optional) Setup the paper size and orientation
		$dompdf->setPaper('A4', 'landscape');

		// Render the HTML as PDF
		$dompdf->render();

		// Output the generated PDF to Browser
		$dompdf->stream("sample.pdf");
	}
}
?>