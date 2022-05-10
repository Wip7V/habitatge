  <?php 

  echo "holsa";
  
  $directory = '../upload/';
  
function scandir($directory, $sorting_order = 0) 
{
	$dh = opendir($directory);
	while( false !== ($filename = readdir($dh)) ) {
	$files[] = $filename;
	}
	if( $sorting_order == 0 ) {
	sort($files);
	} else {
	rsort($files);
	}
	
	return($files);
}	
	
	function FileTree($url)
{
	
	$c_array = scandir($url);
	//foreach($c_array as $nom => $valor) if(substr($valor,0,1)=='.') unset($c_array[$nom]);
	
	$cant=count($c_array);
	//$html = $url.' - '.$cant.' - '.count(scandir($url));
	if($cant==0) return 0; //si no contiene nada lo saco de la recursividad
	
	
	$html = '<ul>
	';
	
	foreach($c_array as $nom => $valor)
	{
		//$valor=$c_array[$nom];
		if(substr($valor,0,1)!='.' )
		{
		
		$tipo='';
		if(strrpos(strtolower($valor),'.jpg')) $tipo='jpg';
		if(strrpos(strtolower($valor),'.pdf')) $tipo='pdf';
		if(strrpos(strtolower($valor),'.doc')) $tipo='doc';
		if(strrpos(strtolower($valor),'.gif')) $tipo='gif';
		
		global $url_web;		
		//if(strrpos($valor,'.')) 
		$html .= '<li onclick="$(\'#file_url\').val(\''.str_replace('../',$url_web.'/',$url).utf8_encode($valor).'\')" ><span class="file '.$tipo.'">'.utf8_encode($valor).'</span></li>';
		
		
		
			if(!strrpos($valor,'.'))
			{
				$html .= '<li class="closed"><span class="folder">'.$valor.'</span>
				';
				$html .= FileTree($url.'/'.$valor);
				$html .= '</li>	
				';
			}
			
		}
		
	}
	$html .= '</ul>	';
	return $html;
}


		//$html = mysql_real_escape_string(FileTree('../upload/'));
		$html = (FileTree('../upload/'));
		echo " $('#archivos').css('z-index',++zindex); ";
		echo " $('#browser').html('<li><span class=folder >Upload</span>$html</li>'); $('#browser').treeview(); ";


	var_dump(scandir($directory));


  ?>