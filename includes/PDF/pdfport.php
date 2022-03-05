<?php
	$lig= new mysqli ("papserver.aelc.pt", "Joao31523", "Leal2020", "Joao31523"); 
	$sql="select * from Utilizador";
	$res=$lig->query($sql);
	
	
require("tcpdf_include2.php");
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('João Campello');
$pdf->SetTitle('XLO - Users');
$pdf->SetSubject('Listagem de Usuarios');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.'', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
$pdf->setFooterData(array(0,64,0), array(0,64,128));

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

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('dejavusans', '', 10, '', true);

$pdf->AddPage();
/*Conteúdo que irá aparecer no PDF*/
$html = "<h2 align=\"center\">Listagem de Usuarios</h2> <br><br>  
	<table  border=\"1\" align=\"center\" class=\"table table-striped\">
    <thead>
      <tr>
              
                <th>Login</th>
                <th>Email</th>
				        <th>Telemovel</th>
				        <th>Nome</th>
                <th>Foto</th>
      </tr><br>
    </thead>
	 <tbody>";
while ($lin = $res->fetch_array()) {
  $html .= ' <tr>
         
                <td>' . $lin['Login'] . '</td>
                <td>' . $lin['Email'] . '</td>
				        <td>' . $lin['Telemovel'] . '</td>
				        <td>' . $lin['Nome'] . '</td>
                <td>  <img src="../../imgs/' . $lin['Foto'] . '" height="30" width="30"></td>
		  </tr>';
}
$html .= "<br></tbody>
  </table>";
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
$pdf->Output('example_001.pdf', 'I');
?>
