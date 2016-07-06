<?php 
require_once '../libs/dompdf/dompdf/autoload.inc.php';
use Dompdf\Dompdf;
class PDFExporter
{
	public static function ExportToPDF($html)
	{
		$html = PDFExporter::CleanHTML($html);

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

	public static function CleanHTML($html)
	{
		$domHTML = new DOMDocument();
		$domHTML->loadHtml($html);
		foreach ($domHTML->getElementsbyTagName('img') as $img) 
		{
			$temp = $img->getAttribute('src');
			$img->setAttribute('src', $_SERVER['DOCUMENT_ROOT'] . '/' . $temp);

			//return $img->getAttribute('src');
		}

		return $domHTML->saveHTML();
	}
}

/*
echo PDFExporter::CleanHTML('<html><body>
                    <h4 name="Title" class="ng-binding">1: Hi</h4>
                  
                    <p name="Description" class="ng-binding">Hi</p>
                    <img src="Images/MathQ.png" class="img-thumbnail img-responsive" alt="Hi">
                  
                    <h4 name="Title" class="ng-binding">2: Happy</h4>
                  
                    <p name="Description" class="ng-binding">Hi</p>
                    <img src="Images/MathQ.png" class="img-thumbnail img-responsive" alt="Happy">
                  
                    <h4 name="Title" class="ng-binding">3: Hi</h4>
                  
                    <p name="Description" class="ng-binding">Hi</p>
                    <img src="Images/MathQ.png" class="img-thumbnail img-responsive" alt="Hi">
                  
                    <h4 name="Title" class="ng-binding">4: Happy</h4>
                  
                    <p name="Description" class="ng-binding">Hi</p>
                    <img src="Images/MathQ.png" class="img-thumbnail img-responsive" alt="Happy">
                  </body></html>'
);
*/
?>