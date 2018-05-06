<h4><i class='material-icons'>edit</i><span style='position:relative;top:-5px'>Editar arquivo</span></h4>
<?php
if(isset($_GET['id'])){
$id =$_GET['id'];
$file = np_obj("SELECT * FROM ".NP."files WHERE ID = {$id}");
if($file){
	   echo "<form style='padding-left:10px;' id='form-post-update' method='post' padding-top:10px'>
	         <div class='col m8'>
			 <input name='file_edit' type='hidden' value='{$file->ID}'/>
	         <p>URL
	         <input class='input card' disabled type='text' value='".NP_URL."/{$file->file_url}'/></p>
	         <p>Título
	         <input name='title' class='input card' type='text' value='{$file->file_title}'/></p>
			 <p>Álbum<select name='folder' class='select'>"; 
			 $fi = np_return_id(NP."folder", "folder_name", $file->folder_id);
			 $folder = np_sel(NP."folder", "WHERE ID != {$file->folder_id}");
			 echo "<option value='{$file->folder_id}'>{$fi}</option>";
             foreach($folder as $fol){
	               echo "<option value='{$fol['ID']}'>{$fol['folder_name']}</option>";
	            }
			 echo"</select></p>";
			 ///Lista o arquivlo pelo tipo
	       if($file->file_type == "image"){
			echo "<div class='card'>
			<a href='../{$file->file_url}' data-fancybox='galeria' data-caption='Enviada em ".np_time($file->file_datetime)."'><img style='width:100%; height:250px' class='example-image' src='../{$file->file_url}' alt=''/></a>
           </div>";
		}elseif($file->file_type == "video"){
			echo "<div class='card'><a data-fancybox='galeria' href='../{$file->file_url}'><img style='width:100%; height:250px' class='example-image' src='../content/uploads/system/video.png' alt=''/></a><span class='display-bottommiddle tiny text-white'>".substr($id['file_title'],0,30); if(strlen($id['file_title']) > 30){ echo "...</span></div>"; }else{ echo "</span></div>"; }
		}
		elseif($file->file_type == "som"){
			echo "<div class='card'><a href='#' data-fancybox='galeria' data-type='ajax' data-src='pages/files/functions/file-view?view-audio={$file->ID}'><img style='width:100%; height:250px' class='example-image' src='../content/uploads/system/audio.png' alt=''/></a>
			<span class='display-bottommiddle tiny text-white'>".substr($id['file_title'],0,30); if(strlen($id['file_title']) > 30){ echo "...</span></div>"; }else{ echo "</span></div>"; }
		}else{
			$file_ext = strchr($file->file_url,'.');
			switch($file_ext){
				case ".pdf" : $img = "pdf.png"; break;
				case ".docx" : $img = "docx.png"; break;
				case ".html" : $img = "html.png"; break;
				case ".css" : $img = "css.png"; break;
				case ".xlsx" : $img = "xlsx.png"; break;
				default : $img = "doc.png"; break;
			}
			echo "<div class='card'><a data-fancybox='galeria' data-type='iframe' data-src='".NP_URL."/{$file->file_url}' href='javascript:;'><img style='width:100%; height:250px' class='example-image' src='../content/uploads/system/{$img}' alt=''/></a><span class='display-bottommiddle tiny text-white'>".substr($id['file_title'],0,30); if(strlen($id['file_title']) > 30){ echo "...</span></div>"; }else{ echo "</span></div>"; }
   
		}
		   echo "<p>Descrição
	         <textarea name='description' class='input card'>{$file->file_description}</textarea></p><br><br></div>
			
			 <div class='col m4'>
			 <div class='margin card-4 light-gray round' style='min-height:110px'>
			 <input type='submit' class='np-btn round small padding margin left blue np-animate-submit' value='Atualizar '/>
			 <br><br>
			 <div class='msg-post-sender'></div>
			 </div>
			 </div>
			 </form>";
 }else{
	np_msg("Erro: arquivo não encontrado", "red");
 }
	
}
?>
<script>
$(document).ready(function(){
	//Função para salvar edições no formulário
var msgPost = $(".msg-post-sender");
$("#form-post-update").submit(function(){
	$.ajax({
		   url:"pages/files/functions/file-edit.php",
		   data:$(this).serialize(),
		   type:"post",
		   beforeSend: function(){
				msgPost.html("<p class='animate-fading panel padding pale-blue'>Por favor, aguarde! Adicionando nova categoria...</p>");
				$(".np-animate-submit-image").show("fast");
		     },
		   success: function(data){
				msgPost.html(data);
				$(".np-animate-submit-image").hide("fast");
		      }
	      });
	
	return false;
  });
});
</script>