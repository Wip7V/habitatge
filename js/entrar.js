// JavaScript Document
var url="main.php";
var zindex = 0;

var evento = 'mousedown';
if(navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPad/i) || navigator.userAgent.match(/android/i)) evento = 'touchend';

$(document).ready(function(e) {
	
			$(".ventana").draggable({  cursor: "pinter", opacity: 0.8 }); 
			$(".ventana").hide();
			$("#login").show();
			
				
    		$('#entrar').bind(evento, function(e) {
				$.post( url,{ funcion: "entrar", pass: $('#pass').val()}, function(data) { setTimeout(data,0);});			
			});
			
			$('#recuperar').bind(evento, function(e) {
				$.post( url,{ funcion: "recuperar"}, function(data) { setTimeout(data,0);});			
			});
			
			
			$('.ventana').bind(evento, function(e) {
				$("#"+this.id).css('z-index',++zindex);		
			});
							
});

function vTerminales()
{
	$.post( url,{ funcion: "vTerminales"}, function(data) { setTimeout(data,0);});	
}

function salir()
{
	$.post( url,{ funcion: "salir"}, function(data) { setTimeout(data,0);});	
}
