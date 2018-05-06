<?php
//Inseri um formulário para o upload de arquivos
function np_file_upload($array=null){
	if(!isset($array['folder'])){ $array['folder'] = 1; }
	if(!isset($array['style'])){ $array['style'] = null; }
	if(!isset($array['class'])){ $array['class'] = "col m6 card padding"; }
	if(!isset($array['dir_module'])){ $array['dir_module'] = "false"; }
	if(!isset($array['return_img'])){ $array['return_img'] = "false"; }
	if(!isset($array['id'])){ $array['id'] = "1"; }
	if(!isset($array['text_send'])){ $array['text_send'] = "Enviar arquivo"; }
	if(!isset($array['text_loading'])){ $array['text_loading'] = "Enviando arquivo..."; }
	if(!isset($array['url'])){ $array['url'] = "pages/files/functions/file-update.php"; }
	if(!isset($array['types'])){ $array['types'] = ".mp4,.wmv,.avi,.mp3,.png,.gif,.jpg,.jpeg,.pdf,.txt,.text,.docx,.log,.xlsx"; }
	$np_url = NP_URL;
	$form_id = "form-upload-".$array['id'];
	echo 
	"<form id='{$form_id}' style='{$array['style']}' class='{$array['class']}' action='{$array['url']}' method='post' enctype='multipart/form-data'>
	<div class='{$form_id}-status margin-bottom'><div class='status_send'></div></div>
    <input type='hidden' name='folder_id' value='{$array[folder]}'/>
	<input type='hidden' name='file_types' value='{$array[types]}'/>
	<input type='hidden' name='dir_module' value='{$array[dir_module]}'/>
	<input type='hidden' name='return_img' value='{$array[return_img]}'/>
    <input type='hidden' name='action' value='file_upload_db'/>
	<label>
    	<span class='campo'>Arquivo:</span>
        <input type='file' class='input-file-{$form_id}' id='input_file' name='file_upload'>
        
        <span class='filebar-{$form_id}'></span>
		<a class='np-btn blue card'>
		<i class='material-icons selectfile-{$form_id}'>open_in_browser</i></a>
  </label><br>
    <input type='submit' class='np-btn border hover-blue border-blue margin-top' value='{$array['text_send']}'/>
    </form>";
	echo "<script>
	 $(document).ready(function(){
	 var imputfile = $('.input-file-{$form_id}');
	 imputfile.css('display','none');
	 
	 var imagefile = $('.selectfile-{$form_id}');
	 var campofile = $('.filebar-{$form_id}');
	
	imagefile.click(function(){
		imputfile.one('click',function(){
			$(this).click();	
		})
		.change(function(){
			campofile.text($(this).val());	
		});
	});
	
	  var formUpload = $('#{$form_id}');
	  var status = $('.{$form_id}-status > .status_send');
	  formUpload.submit(function(){
		  $(this).ajaxSubmit({
			url:'{$array['url']}',
			data: $(this).serialize(),
			beforeSubmit: function(){
				
			},
			error: function(){ },
			uploadProgress: function(){
				status.empty().html('<div class=\"loader loader-small\"></div><span style=\"position:relative;top:-25px;left:35px\">{$array['text_loading']}</span>');
			},
			success: function(data){
			   imputfile.val(''); campofile.empty();
			   if(data == 'FILE_SEND'){  status.html('<p><i class=\"text-green material-icons\">done</i>Arquivo enviado com sucesso</p>');
			   }
			   else if(data == 'FILE_NO'){ status.html('<p class=\"text-red\">Nenhum arquivo válido foi selecionado.</p>'); $('.ips').val('testando'); }
			   else if(data == 'FILE_MAX'){ status.html('<p class=\"text-red\">Arquivo não suportado ou ultrapassa o tamanho máximo permitido.</p>'); }
			   else if(data == 'FILE_ERROR'){ status.html('<p class=\"text-red\">Um erro não identificado foi lançado pelo servidor.</p>'); }
			   else{
				   var pdf = data.charAt(data.length-4);
                   var pdf1 = data.charAt(data.length-3);
                   var pdf2 = data.charAt(data.length-2);
                   var pdf3 = data.charAt(data.length-1);
                   var exe = pdf+pdf1+pdf2+pdf3;
				   if(exe == '.pdf'){
					   status.html('<img src=\"{$np_url}/content/uploads/system/pdf.png\" style=\"width:130px; height:120px\" class=\"card margin-bottom animate-opacity\">');
				   }else if(exe == 'docx'){
					   status.html('<img src=\"{$np_url}/content/uploads/system/docx.png\" style=\"width:130px; height:120px\" class=\"card margin-bottom animate-opacity\">');
				   }else if(exe == '.mp4' || exe == '.wmv' || exe == '.avi'){
					   status.html('<img src=\"{$np_url}/content/uploads/system/video.png\" style=\"width:130px; height:120px\" class=\"card margin-bottom animate-opacity\">');
				   }else if(exe == '.mp3'){
					   status.html('<img src=\"{$np_url}/content/uploads/system/audio.png\" style=\"width:130px; height:120px\" class=\"card margin-bottom animate-opacity\">');
				   }else if(exe == '.zip'){
					   status.html('<img src=\"{$np_url}/content/uploads/system/zip.png\" style=\"width:130px; height:120px\" class=\"card margin-bottom animate-opacity\">');
				   }else if(exe == '.rar'){
					   status.html('<img src=\"{$np_url}/content/uploads/system/rar.png\" style=\"width:130px; height:120px\" class=\"card margin-bottom animate-opacity\">');
				   }else if(exe == '.png' || exe == 'jpeg' || exe == '.jpg' || exe == '.gif'){
					   status.html('<img src='+data+' style=\"width:130px; height:120px\" class=\"card margin-bottom animate-opacity\">'); 
				   }else{
					  status.html('<img src=\"{$np_url}/content/uploads/system/doc.png\" style=\"width:130px; height:120px\" class=\"card margin-bottom animate-opacity\">');
				   }
				   $('{$array['return_img']}').val(data);
				   
			   }     
			},
			complete: function(data){
			}	
		});
		  return false;
	  });
	   
	 });
	  </script>";
}
?>