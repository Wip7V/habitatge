<?php

	session_start();
	include("db.php");
	$privi = 0;
	$id_reg = 0;
	
	
	foreach($_POST as $n => $v){
		if(!is_array($v)) $$n = $mysqli->real_escape_string($v);
		else $$n = $v;
		}


	/* debug */
	ob_start();
	var_dump($_POST);
	//var_dump($_SESSION);
	echo " console.log('".$mysqli->real_escape_string(strip_tags(ob_get_clean()))."'); ";
	
	$pagina = 0;
	
	if($funcion=='entrar') entrar();
	
	if($funcion!='sigo_vivo') echo " $('.enviarform').removeClass('rojo'); ";

	
	if(isset($_SESSION['dentro_gestor']))
	{
		//nAvisos();	
		if($funcion=='Salir') salir();
		//if($funcion=='Gmail') echo " window.open('https://mail.google.com/mail/u/0/#inbox', 'Gmail', 'width=1200,height=800'); ";
		
		if($funcion=='Document'){ lDocuments(); echo "$('#ldocuments').show();"; }
		if($funcion=='UpdateDocument') lDocuments();
		if($funcion=='form_documents') vDocuments();
		if($funcion=='editar_documents') vDocuments();
		
		if($funcion=='listado') echo "window.open('listado.php?ini=$ini&fin=$fin', 'Listado', 'width=1200,height=800'); ";
		
		if($funcion=='borrar_documents') BorrarDocuments();
		if($funcion=='guardar_documents') if($id == 0) addDocuments(); else guardaDocuments();
		
		
		if($funcion=='Usuaris') vUsuaris();
		if($funcion=='b_usuaris') vUsuaris();		
		if($funcion=='borrar_usuaris') BorrarUsuaris();
		if($funcion=='guardar_usuaris') if($id == 0) addUsuaris(); else guardaUsuaris();
		
		
	}
	else{
	if($funcion != 'entrar') echo " reseteo(); ";	
	}
	
		
	
	function entrar()
	{
		global $user,$pass,$mysqli, $prefijo;
		//echo "console.log('".md5($pass)."');";
		if(isset($_SESSION['dentro_gestor'])) {
			echo " $('#login').hide(); $('#menu').show(); $('#hmenu').show(); ";
			if($_SESSION['privi'] < 5) echo " $('#Usuaris').hide();";
			if($_SESSION['privi'] >= 5) echo " $('#Usuaris').show();  ";
			if($_SESSION['privi'] == 10) echo " $('.privi').show();";

			$sql="SELECT * FROM ".$prefijo."usuaris WHERE id = ".$_SESSION['dentro_gestor'];
			$result = $mysqli->query($sql);
			$linia=$result->fetch_array();
			echo " $('#hmenu label').html('".$linia['usuari']."'); ";
			return 0;	
		}
		
		if(strlen($user)>0){
		$sql="SELECT * FROM ".$prefijo."usuaris WHERE usuari = '$user'";
		$result = $mysqli->query($sql) or js_alert($mysqli->error);
		while($linia=$result->fetch_array()){
			if($linia['pass'] == md5($pass)){
				$_SESSION['dentro_gestor'] = $linia['id'];
				$_SESSION['privi'] = $linia['privi'];
				if($_SESSION['privi'] < 5) echo " $('#Usuaris').hide(); ";
				if($_SESSION['privi'] >= 5) echo " $('#Usuaris').show();";
				if($_SESSION['privi'] == 10) echo " $('.privi').show(); ";
				echo " $('#login').hide(); $('#e_entrar').html(''); $('#menu').show(); $('#pass').val(''); $('#user').val(''); $('#hmenu').show(); ";
				echo "$('#hmenu label').html('$user');";
				return 0;
			}
		}
		echo "$('#e_entrar').html('Error d\'usuari o contrasenya'); ";
		}
		
	}
	
	function salir()
	{
		unset($_SESSION['dentro_gestor']);
		echo " reseteo(); ";
	}
	
	//encuentra un id dentro de un array
	function buscaArray($array, $valor){
		foreach($array as $i => $v){
			if($v == $valor) return $i;
		}
		return -1;
	}


	function vDocuments()
	{
		global $mysqli,$id_reg, $prefijo;
		
	echo "$('#tit_document').html('Document');";
	
			//if($_SESSION['privi'] < 5) 


		//$data = gmdate("Y-m-d"); //solo los administradores pueden poner fechas
		//if($_SESSION['privi'] < 5) 
		//$hora = gmdate("h:m:s",time() + 3600*($timezone+date("I")));
		//echo "$('#d_data').prop('disabled', true); ";
		//echo "$('#d_hora').prop('disabled', true); ";
		//echo " $('#d_data').val('$data');";
		//echo " $('#d_hora').val('$hora');";
		echo " b_chrono=true;";
		
		if($_SESSION['privi'] > 5){
			//echo "$('#d_data').prop('disabled', false); ";
			//echo "$('#d_hora').prop('disabled', false); ";
			echo " b_chrono=false;";	
		}
					
			if($id_reg > 0) 
			{
				echo " b_chrono=false;";	
			$sql = "SELECT * FROM ".$prefijo."document WHERE id = $id_reg";
						
			$result = $mysqli->query($sql) or js_alert($mysqli->error);
			$linia=$result->fetch_array();
			foreach($linia as $n => $v) echo " $('#d_$n').val('".$mysqli->real_escape_string($v)."');";
			$id_reg = $linia['num']."/".$linia['any'];
			$cont = 0;
			echo "$('#tit_document').html('Document Nº $id_reg');";
			}


		echo " $('#fdocuments').show();";	//$('#lClients').hide();
	}
	
	
	
	function addDocuments()
	{
		global $mysqli,$en_sa, $ciutada, $tipus, $data, $observ, $tlf, $prefijo, $area, $hora, $document;
		
		$num = 1;
		$sql = "SELECT max(num) as mnum FROM ".$prefijo."document WHERE any = YEAR(NOW())";
		$result = $mysqli->query($sql) or js_alert($mysqli->error);
		$linia=$result->fetch_array();
		$num = $linia['mnum'] + 1;
		//js_alert($num);
		
		//$timezone  = +1; //(GMT -5:00) EST (U.S. & Canada) 
		
		//if($_SESSION['privi'] < 5) $data = gmdate("Y-m-d",time() + 3600*($timezone+date("I"))); //solo los administradores pueden poner fechas
		//if($_SESSION['privi'] < 5) $hora = gmdate("h:m:s",time() + 3600*($timezone+date("I")));
		
		$sql="INSERT INTO ".$prefijo."document (en_sa, ciutada, tipus , data, observ, tlf, usuari, area, hora, document, any, num) VALUES ('$en_sa', '$ciutada', '$tipus', '$data', '$observ', '$tlf','".$_SESSION['dentro_gestor']."','$area','$hora','$document',YEAR(NOW()), $num )";
		
		$mysqli->query($sql) or js_alert($mysqli->error);
		echo " alert('Afegit'); ImprimirDocuments(".$mysqli->insert_id."); ";
		lDocuments();

	}
	
	function guardaDocuments()
	{
		
		global $mysqli, $prefijo, $id, $en_sa, $ciutada,$tipus, $data, $observ, $tlf, $area, $hora, $document;
		
		if($_SESSION['privi'] < 5) {js_alert('Aquesta opció es nomes per a Administradors.'); return 0;}
		
		$sql="UPDATE ".$prefijo."document SET en_sa = '$en_sa', ciutada = '$ciutada', tipus = '$tipus' , data = '$data', observ='$observ', tlf='$tlf', area='$area', hora='$hora', document='$document' WHERE id=$id";
		$mysqli->query($sql) or js_alert($mysqli->error);

		echo " alert('Guardat'); ";
	}
	
	function BorrarDocuments(){
		global $mysqli,$id,$prefijo;
		if($_SESSION['privi'] < 5) {js_alert('Aquesta opció es nomes per a Administradors.'); return 0;}
		$sql = "DELETE FROM ".$prefijo."document WHERE id=".$id;
		$mysqli->query($sql);
		lDocuments();
		
	}
	

function lDocuments()
	{
		global $mysqli, $prefijo;
		$salida = "";
		

		$sql = "SELECT ".$prefijo."document.*, ".$prefijo."usuaris.usuari FROM ".$prefijo."document, ".$prefijo."usuaris WHERE ".$prefijo."document.usuari = ".$prefijo."usuaris.id ORDER BY ".$prefijo."document.id DESC";

		
		$salida = "<table id=tDocuments><thead><tr><th width=30>Edit</th><th>Num</th><th></th><th>Data</th><th>Hora</th><th>Tipus</th><th>Remitent/Destinatari</th><th>Dept./Àrea</th><th>Treballador</th></tr></thead><tbody>";
		$result = $mysqli->query($sql) or js_alert($mysqli->error);
		while($linia=$result->fetch_array())
		{	
			
			$salida.="<tr><td ><div class='editar_fila' id=\"documents_".$linia['id']."\"><input type='image' src=\"img/editar.png\" /></div></td><td>".$linia['num']."/".$linia['any']."</td><td><b>".$linia['en_sa']."</b></td><td>".$linia['data']."</td><td>".$linia['hora']."</td><td>".$linia['tipus']."</td><td>".$linia['ciutada']."</td><td>".$linia['area']."</td><td>".$linia['usuari']."</td></tr>";
		}
		$salida.="</tbody></table>";
		
		echo " $('#lldocuments').html(\"".$mysqli->real_escape_string($salida)."\"); ";		
		echo " tabla('tDocuments'); bindBotones(); ";
		
	}		


	function vUsuaris()
	{
		global $mysqli,$pagi,$pagina,$id_reg, $prefijo;
		$num = 0;
		$sql = "SELECT count(*) as cont FROM ".$prefijo."usuaris WHERE privi < ".$_SESSION['privi']." ORDER BY usuari";
		if($_SESSION['privi']==10) $sql = "SELECT count(*) as cont FROM ".$prefijo."usuaris ORDER BY usuari";
		$result = $mysqli->query($sql) or js_alert($mysqli->error);
		$linia=$result->fetch_array();
		if($linia['cont'] > 0){
		
			$sql = "SELECT * FROM ".$prefijo."usuaris WHERE privi < ".$_SESSION['privi']." ORDER BY usuari LIMIT $num,1";
			if($_SESSION['privi']==10) $sql = "SELECT * FROM ".$prefijo."usuaris ORDER BY usuari LIMIT $num,1";
			
			if($id_reg > 0) $sql = "SELECT * FROM ".$prefijo."usuaris WHERE id = $id_reg";
						
			$result = $mysqli->query($sql) or js_alert($mysqli->error);
			$linia=$result->fetch_array();
			foreach($linia as $n => $v) echo " $('#u_$n').val('".$mysqli->real_escape_string($v)."');";
			echo " $('#u_pass').val('');";
		}
		echo " $('#fusuaris').show(); ";
		BuscaUsuaris();	
	}
	
	function BuscaUsuaris()
	{
		//return 0;
		
		global $mysqli, $prefijo;
		$sql = "SELECT * FROM ".$prefijo."usuaris WHERE privi < ".$_SESSION['privi']." ORDER BY usuari";
		if($_SESSION['privi']==10) $sql = "SELECT * FROM ".$prefijo."usuaris ORDER BY usuari";
		$buscador = "";
		$result = $mysqli->query($sql) or js_alert($mysqli->error);
		while($linia=$result->fetch_array())
		{
			$buscador.= "<option value=".$linia['id'].">".$linia['usuari']."</option>";
		}
		echo " $('#b_usuaris').html('".$mysqli->real_escape_string($buscador)."'); ";
		
		$sql = "SELECT count(*) as cont FROM ".$prefijo."usuaris WHERE privi < ".$_SESSION['privi'];
		if($_SESSION['privi']==10) $sql = "SELECT count(*) as cont FROM ".$prefijo."usuaris ";
		
		$result = $mysqli->query($sql) or js_alert($mysqli->error);
		$linia=$result->fetch_array();
		echo " $('#u_contador').html('Total de usuaris:".$linia['cont']."'); ";
		
	}
	
	function addUsuaris()
	{
		global $mysqli,$usuari, $pass,$privi, $prefijo;
		
		if(strlen($usuari) < 5){
			echo "alert('Mínim 5 caracters pel nom.'); ";
			return 0;
		}
				
		if(strlen($pass) < 5){
			echo "alert('Mínim 5 caracters per la contrasenya.'); ";
			return 0;
		}
		
		$sql="INSERT INTO ".$prefijo."usuaris (usuari, pass , privi) VALUES ('$usuari', '".md5($pass)."','$privi')";
		$mysqli->query($sql) or js_alert($mysqli->error);
		echo " alert('Afegit'); ";
		BuscaUsuaris();
	}
	
	function guardaUsuaris()
	{
		global $mysqli,$id, $usuari, $pass, $privi, $prefijo ;
		
		if(strlen($usuari) < 5){
			echo "alert('Mínim 5 caracters pel nom.'); ";
			return 0;
		}
		
		if(strlen($pass) < 5){
			echo "alert('Mínim 5 caracters per la contrasenya.'); ";
			return 0;
		}
		
		$sql="UPDATE ".$prefijo."usuaris SET usuari = '$usuari', pass = '".md5($pass)."' , privi = '$privi' WHERE id=$id";
		$mysqli->query($sql) or js_alert($mysqli->error);
		//echo "$('input[type=text]').val(''); ";
		echo " alert('Guardat'); ";
		BuscaUsuaris();
	}
	
	function BorrarUsuaris(){
		global $mysqli,$id, $prefijo;
		$sql = "DELETE FROM ".$prefijo."usuaris WHERE id=".$id;
		$mysqli->query($sql);
		BuscaUsuaris();
		$pagina = -5;
		vUsuaris();
		C_comercial();	
	}
	function FiltreAccions(){
		lAccions();
		echo "$('#lAccions').show(); "; 
	}


?>
