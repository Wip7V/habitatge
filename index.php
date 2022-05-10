<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Expires" content="0">
<meta http-equiv="Last-Modified" content="0">
<meta http-equiv="Cache-Control" content="no-cache, mustrevalidate"> 
<meta http-equiv="Pragma" content="no-cache">

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="initial-scale=1; maximum-scale=1; user-scalable=1;" />
<meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
<title>Habitatge</title>
<link rel="stylesheet" type="text/css" href="css/estilo.css"  />
<link rel="stylesheet" type="text/css" href="css/timepicker.css"  />
		<style type="text/css" title="currentStyle">
			@import "css/demo_page.css";
			@import "css/demo_table_jui.css";
		</style>
<link href="css/smoothness/jquery-ui-1.10.3.custom.css" rel="stylesheet">
<script src="js/jquery.js"></script>
<script src="js/jquery-ui-1.10.3.custom.min.js"></script>
<script src="js/jquery-ui-timepicker-addon.js"></script>
<script src="js/jquery.ui.touch-punch.min.js"></script>
<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">

<script src="js/main.js"></script>
<script type="text/javascript" src="js/jquery.dataTables.min.js"></script>	
<?php 
//include("textarea_simple.inc"); 
?>
</head>

<body>

<div class="head">Habitatge


<div id="menu" >

<!--img src="img/Dtafalonso-Android-L-Gmail.ico" width="35" style="position: absolute; left:120px;" onclick=" window.open('https://mail.google.com/mail/u/0/#inbox', 'Gmail', 'width=1200,height=800');" /-->

            <div id="acciones">           
                <div id="Document">Documents</div>
                <div id="Usuaris">Usuaris</div>
                <div id="Salir">Sortir</div>
            </div>
</div>

<div id="hmenu"><div><label>Usuario</label> <!--img src="icons/mail.png" id="iavisos" width="30"><span id="navisos"></span--></div> </div></div>


<br>





<div class="ventana d1000" id="ldocuments">
    <div class="vtit deg">Llistat Documents<div class="close"></div></div>

    <div id="lldocuments"></div>
    <form>
    <input type="button" class="enviarform" id="form_documents" value="Formulari Documents" />
    </form>
    <br><br>
    <form>
<strong>IMPRIMIR LLISTAT</strong><br>
    Inici: <input type="text" class="data" name="ini" value="<?php echo date("Y-m-d"); ?>" style="width: 80px; margin-right: 10px;">
    Fi: <input type="text" class="data" name="fin" value="<?php echo date("Y-m-d"); ?>" style="width: 80px; margin-right: 10px;">
    <input type="button" class="enviarform" id="listado" value="Mostrar Llistat" />
    </form>
    <div style="height: 10px"></div>
</div>


<div class="ventana" id="fdocuments">
<div class="vtit deg" id="tit_document">Document<div class="close"></div></div>

        <div class="bloc">
        

        <form>
        <div class="left">
        <input type="hidden" class="id" name="id" id="d_id"  />
        
        <label>Programa/Àrea:</label> 
        <select name="tipus" id="d_tipus">
			<option>Prestacions d’Urgència Especial</option>
			<option>Prestacions pagament Lloguer</option>
			<option>Cèdules</option>
			<option>Ajuts Rehabilitació</option>
			<option>Borsa de Mediació</option>
			<option>Altres</option>
		</select>
        
        <label>Entrada o sortida:</label> 
        <select name="en_sa" id="d_en_sa">
        	<option>Entrada</option>
        	<option>Sortida</option>
        </select>
      	<br>

        </select>
        
        <label>Remiten/Destinatari:</label> <input type="text" name="ciutada" id="d_ciutada" value=""  />
        <label>Telèfon:</label> <input type="text" name="tlf" id="d_tlf" value=""  />
        
        <br>
        <label>Departament/Àrea:</label> <input type="text" name="area" id="d_area" value=""  /><br>
        
        <label>Data:</label> <input type="text" name="data" class="data" id="d_data" value="<?php echo date("Y-m-d"); ?>"  />
        <label>Hora:</label> <input type="text" name="hora" class="hora" id="d_hora" value=""  />
        <br>
        
        <label>Documentació:</label> <textarea  name="document" class="mceNoEditor" id="d_document" ></textarea>
      	<label>Observacions:</label> <textarea  name="observ" class="mceNoEditor" id="d_observ" ></textarea>

        </div>
        
         <input type="button" value="Imprimir" id="imprimir_documents" onclick="ImprimirDocuments()" />
         <input type="reset" value="Nou" />
         <input type="button" class="enviarform" id="guardar_documents" value="Guardar" />
         <input type="button" class="borrar" value="Borrar" id="borrar_documents" />
         </form>
        </div>

</div>



<div class="ventana" id="fusuaris">
<div class="vtit deg">Usuaris<div class="close"></div></div>

        <div class="bloc">
        

        <form>
        <div class="left">
        <input type="hidden" class="id" name="id" id="u_id"  />
        <label>Usuari:</label> <input type="text" name="usuari" id="u_usuari" value=""  />
        <label>Nou password:</label> <input type="text" name="pass" id="u_pass" value=""  /><br>
        <div class="privi"><label>Privilegis:</label> 
	        <select name="privi" id="u_privi">
		        <option value=0>Treballador</option>
		        <option value=5>Administrador</option>
		        <option value=10>Super Admin</option>
	        </select>
        </div>      
        </div> 
        <br />
        Buscar: <select class="buscar" id="b_usuaris"></select> <span id="u_contador"></span>

        <br><br>
         <input type="reset" value="Nou" />
         <input type="button" class="enviarform" id="guardar_usuaris" value="Guardar" />
         <input type="button" class="borrar" value="Borrar" id="borrar_usuaris" />
         </form>
        </div>
</div>





<div class="ventana" id="login">
    <div class="vtit deg">Acces a l'aplicació</div>
    <div class="cent">
        <div class="bloc">
        <form id="login">
        <label>Usuari:</label> 
        <input type="text" id="user" name="user" /><br>
                <label>Contrasenya:</label> 
        <input type="password" id="pass" name="pass" />
        <div id="e_entrar" class="error_label"></div>
        <br />
        <input class="enviarform" type="button" value="Entrar" id="entrar" />
        </form>
        </div>
    </div>
</div>


<script>
function UpdateDocument()
{
	$.post( url,{ funcion: "UpdateDocument"}, function(data) { setTimeout(data,0);});
	setTimeout(" UpdateDocument(); ",60000);
}

	UpdateDocument();
</script>


</body>
</html>