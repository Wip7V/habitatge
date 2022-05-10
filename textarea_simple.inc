<script type="text/javascript" src="jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		// General options
		
		language: "es",
		mode : "textareas",
		editor_selector : "mceEditor",
		editor_deselector : "mceNoEditor",
		theme : "advanced",
				skin : "o2k7",
		skin_variant : "silver",

		plugins : "style,layer,advhr,advimage,advlink,iespell,inlinepopups,paste,directionality,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,fullscreen,media,insertdatetime,table",

		// Theme options
		theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,forecolor,backcolor,|,undo,redo, | , removeformat, charmap, code,|,image,media,code,insertdate,|,fullscreen",
		theme_advanced_buttons2 : "cut,copy,paste,pasteword,|,link,unlink,|,charmap,sub,sup,|,bullist,numlist,|,tablecontrols",
		theme_advanced_buttons3 : "",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : false,

		// Example content CSS (should be your site CSS)
		content_css : "css/content.css",

		// Drop lists for link/image/media/template dialogs
		/*template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",*/


		// Style formats
		/*style_formats : [
			{title : 'Bold text', inline : 'b'},
			{title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
			{title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
			{title : 'Example 1', inline : 'span', classes : 'example1'},
			{title : 'Example 2', inline : 'span', classes : 'example2'},
			{title : 'Table styles'},
			{title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
		],*/

		// Replace values for the template plugin
		/*template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}*/
		setup : function(ed) {
          ed.onChange.add(function(ed, l) {
                  console.log($("#"+ed.id).parent().parent().parent().attr('id'));
                  $( "#"+$("#"+ed.id).parent().parent().parent().attr('id')+" .enviarform" ).addClass( "rojo" );
          });
   }
	});
</script>