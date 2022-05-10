<?php
	require_once 'dompdf/autoload.inc.php';
	use Dompdf\Dompdf;
	
$f_ini = " CURDATE() - INTERVAL 60 DAY ";
$f_fin = " CURDATE() ";

if(isset($_GET['ini'])) $f_ini = "'".$_GET['ini']."'";
if(isset($_GET['fin'])) $f_fin = "'".$_GET['fin']."'";

	session_start();
	include("db.php");

	$html = file_get_contents("listado.html");
	$datos = "";
	if(isset($_SESSION['dentro_gestor']))
	{

	$sql = "SELECT * FROM ".$prefijo."document WHERE data >= $f_ini AND data <= $f_fin ORDER BY data";
	$result = $mysqli->query($sql) or js_alert($mysqli->error);
	while($linia=$result->fetch_array()){	
		foreach($linia as $n => $v)	$$n = $mysqli->real_escape_string($v);
		$datos.="<tr><td>$num/$any</td><td>$en_sa</td><td>$tipus</td><td>$ciutada</td><td>$tlf</td><td>$area</td><td>$data</td><td>$hora</td></tr>";
		}
	}
	
	$dompdf_options = array(
    'chroot' => '/',
    'logOutputFile' => __DIR__ . '/dompdf.log.html',
    'isHtml5ParserEnabled' => true,
    'debugPng' => false,
    'debugKeepTemp' => false,
    'debugCss' => false,
    'debugLayout' => false,
    'debugLayoutLines' => false,
    'debugLayoutBlocks' => false,
    'debugLayoutInline' => false,
    'debugLayoutPaddingBox' => false
);
	
	$html = str_replace("_BODY_",$datos,$html);
	//echo $html;
	$dompdf = new Dompdf($dompdf_options);

	$dompdf->loadHtml($html);
	$dompdf->setPaper('A4'); // (Opcional) Configurar papel y orientación
	$dompdf->render(); // Generar el PDF desde contenido HTML
	$pdf = $dompdf->output(); // Obtener el PDF generado
	//$dompdf->stream(); // Enviar el PDF generado al navegador
	$dompdf->stream("listado.pdf", array("Attachment" => false));
?>