<?php

$direccion = 'localhost';
$usuario = 'root';
$password = 'root';
$base_datos = "habitatge";

$prefijo = "hab_";

$mysqli = new mysqli($direccion, $usuario, $password, $base_datos);


if ($mysqli->connect_errno) {
 

    echo "Error: Fallo al conectarse a MySQL debido a: \n";
    echo "Errno: " . $mysqli->connect_errno . "\n";
    echo "Error: " . $mysqli->connect_error . "\n";

    exit;
}
//else echo "conectado";

	function js_alert($string) //para poder hacer alert de javascript con ' comillas simples y dobles "
	{	
		global $mysqli;
		//print("alert('".$mysqli->real_escape_string($string)."');" );
		echo " alert('".$mysqli->real_escape_string($string)."'); ";	
		
	}

	function js_console_error($string)
	{
		global $mysqli;
		echo "console.log(\"".$mysqli->real_escape_string($string)."\");";	
	}
?>