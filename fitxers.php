<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
       <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

        <title></title>

    </head>
    <body style="background-color:#f5f5f5; position:absolute; left:0px; top:0px; font-family:Arial, Helvetica, sans-serif;	font-size:12px;">
    
<?php

//if(isset($_GET['url'])) $url=$_GET['url'];
//elseif(isset($_POST['url'])) $url=$_POST['url'];
$url = '../upload/';
$error_file = '';

	
if (isset( $_FILES["fitxer"]["tmp_name"]) && isset($_SESSION['dentro_gestor'])) 
{
	if($_FILES["fitxer"]["error"] <= 0)
	{
		$file = $_FILES["fitxer"];
		$file_mida = $_FILES["fitxer"]["size"];
		$file_tipus = $_FILES["fitxer"]["type"];
		$file_nom = $_FILES["fitxer"]["name"];
		//$maximo = 100024000; 
		//if($file_mida <= $maximo)
		//{
			$nom_tmp=explode(".", $file_nom);
			$ext_file=$nom_tmp[count($nom_tmp)-1];
	
			$destino = $url.$file_nom;
			//unlink($destino_foto);
			copy($_FILES['fitxer']['tmp_name'],$destino);
			//echo "copy($_FILES['fitxer']['tmp_name'] - $destino);";
				
		//}else $error_file='Error: Mida fitxer massa gran.';
	}else $error_file='Upload Error';
}

	
?>

    <form id="form" method="post" action="fitxers.php" enctype="multipart/form-data">
    <input type="file" id="fitxer" name="fitxer" />
    <input type="submit" value="Upload" /><br />
    <?php echo $error_file; ?> <br />
    
    <input type="hidden" value="<?php echo $url; ?>" id="url" name="url" />
    </form>
	</div>
   </body>
</html>
