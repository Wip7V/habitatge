// JavaScript Document made by ALM ajlombarte@yahoo.es

var url="main.php";
var zindex = 0;
var pagi = 0;

var b_chrono = true;

var evento = 'mousedown';
if(navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPad/i) || navigator.userAgent.match(/android/i)) evento = 'touchend';
			
			function tabla(id)
			{
				$('#'+id).dataTable({
					"bJQueryUI": true,
					"sPaginationType": "full_numbers",
					"oLanguage": {"sUrl": "dataTables.es.txt"}
				});
			}
			
function reseteo(){
				$("#hmenu").hide();
				$("#Usuaris").hide();
				$("#Altres").hide();
				$(".privi").hide();
				$("#menu").hide();
				$('.ventana').hide(); 
				$('#login').show();
}

function wgmail(busca){
	 window.open('https://mail.google.com/mail/u/0/#search/' + busca, 'Gmail', 'width=1200,height=800'); 
}

function ImprimirDocuments(registro = $('#d_id').val())
{
	window.open('imprimir.php?reg=' + registro, 'Imprimir', 'width=600,height=300'); 
}

function form_client(cid)
{
	console.log(cid);
	$.post( url,{ funcion: "form_clients", id_reg: cid}, function(data) { setTimeout(data,0);});	
}

$(document).ready(function(e) {
	
			//$(".ventana").draggable({  cursor: "pointer", opacity: 0.8 });
			//$(".ventana").resizable();
			chrono();
			
			reseteo();
			$.post( url, "&funcion=entrar", function(data) { setTimeout(data,0);});
			//$(".data").datetimepicker({dateFormat:'yy-mm-dd', maxDate: "+4W",firstDay: 1});
			$(".data").datepicker({dateFormat:'yy-mm-dd',firstDay: 1});
			
			$(".ventana").hide();
			$("#login").show();
			
			
			$('#vClients').bind(evento, function(e) {
				$.post( url,{ funcion: "form_clients", id_reg: $('#a_id_clients').val()}, function(data) { setTimeout(data,0);});			
			});
			
			$('#AvisosFClients').bind(evento, function(e) {
				$.post( url,{ funcion: "form_clients", id_reg: $('#av_id_client').val()}, function(data) { setTimeout(data,0);});			
			});
			
			$('#avisos_client').bind(evento, function(e) {
				$.post( url,{ funcion: "sAvisos", id_reg: 2, id_client: $('#c_id').val()}, function(data) { setTimeout(data,0);});			
			});
			
			$('#accions_client').bind(evento, function(e) {
				$('#af_id_clients').val($('#c_id').val());
				$('#af_id_clients').trigger("change");
				$('#lAccions').show();			
			});
			
			$('#AvisosAcClients').bind(evento, function(e) {
				$('#af_id_clients').val($('#av_id_client').val());
				$('#af_id_clients').trigger("change");
				$('#lAccions').show();			
			});
			
			$('#aClients').bind(evento, function(e) {
				$('#af_id_clients').val($('#c_id').val());
				$('#af_id_clients').trigger("change");
				$('#lAccions').show();
			});
			
			$('input, select, textarea').bind("change",function(e){
				console.log($(this).parent().parent().parent().parent().attr('id'));
				$( "#"+$(this).parent().parent().parent().parent().attr('id')+" .enviarform" ).addClass( "rojo" );
			});
			

			$('.ventana').bind(evento, function(e) {
				$("#"+this.id).css('z-index',++zindex);		
			});
			

			
			$('#pass').keyup(function(e) {
				if(e.keyCode==13) $.post( url, $(this).parent().serialize()+"&funcion=entrar", function(data) { setTimeout(data,0);});//$.post( url,{ funcion: "entrar",pass: $('#pass').val(), usuari:$('#usuari').val()}, function(data) { setTimeout(data,0);});
            });
				
			$('#acciones div').bind(evento, function(e) {
				hideall();
				$('#principal').show();
				$.post( url,{ funcion: $(this).attr('id')}, function(data) { setTimeout(data,0);});
			});	
			
			$('#iavisos').bind(evento, function(e) {
				$.post( url,{ funcion: 'Avisos'}, function(data) { setTimeout(data,0);});
				$('#sAvisos').val(0);
			});				
			
			
			
			$('.enviarform').bind(evento, function(e) {
				var textarea = $('textarea[class="mceEditor"]').toArray();
				for(t in textarea) $("#"+textarea[t].id).val(tinyMCE.get(textarea[t].id).getContent());
				$.post( url, $(this).parent().serialize()+"&funcion="+this.id, function(data) { setTimeout(data,0);});	
				this.form.reset();
				$('#tit_document').html('Document');
				b_chrono = true;
			});
			
			$('.responder').bind(evento, function(e) {
				tinyMCE.get('av_observa').setContent('<p><b>Resposta:</b></p><br><hr>'+tinyMCE.get('av_observa').getContent());
				//$("#av_observa").val('');
				$("#av_id_avisos").val(0);				
			});
			
			
			$('.pagi').bind(evento, function(e) {
				$.post( url, "&funcion="+this.id+"&pagi="+pagi, function(data) { setTimeout(data,0);});	
			});
			
			$('.buscar').change(function() {
 				 $.post( url, "&funcion="+this.id+"&id_reg="+$(this).val(), function(data) { setTimeout(data,0);});	
 				 $("#a_id_clients").val($(this).val());
			});
			
			$('.borrar').bind(evento, function(e) {
				if(confirm('Realment vols borrar aquestes dades?')) $.post( url, $(this).parent().serialize()+"&funcion="+this.id, function(data) { setTimeout(data,0);});	
				this.form.reset();
				$('#tit_document').html('Document');
				b_chrono = true;
			});
		
	
			$('.close').bind(evento, function(e) {
				$(this).parent().parent().hide();
				//console.log($(this).parent().parent().attr('id'));
				$('#'+$(this).parent().parent().attr('id')+ " form").trigger("reset");
			});
				
				
			$('input[type=reset]').bind(evento, function(e) {
				$('.id').val(0);
				console.log('reset');
				b_chrono=true;
				$('#tit_document').html('Document');
			});
			
			$('#file_url').click('onfocus',function(e){
				$(this).select();
			});
			
			//sessionviva();
			
});



function salir()
{
	$.post( url,{ funcion: "salir"}, function(data) { setTimeout(data,0);});	
}

function bindBotones()
{
			$('.borrar_fila').bind(evento, function(e) {
				if(confirm('¿Desea borrar este registro?')) $.post( url,{ funcion: "borrar", dBorrar: this.id}, function(data) { setTimeout(data,0);});
			});
			
				
			$('.editar_fila').bind(evento, function(e) {
				$.post( url,{ funcion: "editar_"+this.id.substring(0,this.id.indexOf("_")), id_reg: this.id.substring(this.id.indexOf("_")+1,150)}, function(data) { setTimeout(data,0);});
			});	
}

function hideall()
{
			$(".ventana").hide();
			$("#menu").show()	
}

function accio_fet(id_accio)
{
				$.post( url,{ funcion: "accio_feta", id_reg: id_accio.substring(10,150)}, function(data) { setTimeout(data,0);});
}

function sessionviva()
{
	$.post( url,{ funcion: "UpdateDocument"}, function(data) { setTimeout(data,0);});
	setTimeout(" sessionviva(); ",60000);
}

function chrono()
{
	var d = new Date();
	if(b_chrono){
		$('#d_data').val(d.getFullYear()+"-"+(d.getMonth()+1)+"-"+d.getDate());
		$('#d_hora').val(d.getHours()+":"+d.getMinutes()+":"+d.getSeconds());
	}
	setTimeout("chrono();",1000);
}


