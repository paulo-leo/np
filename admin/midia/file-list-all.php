<?php np_no_access(np_admins()); ?>
<h2>Mídias <a href="#" class="btn small btn-modal-upload button large circle xlarge indigo"><i class="material-icons selectfile">open_in_browser</i></a> <a href="?page=midia&type=image&paging" class="btn small btn-modal-upload circle xlarge blue"><i class="material-icons selectfile">settings_brightness</i></a> <a href="?page=midia&type=video&paging" class="btn small btn-modal-upload circle xlarge blue"><i class="material-icons selectfile">videocam</i></a> <a href="?page=midia&type=file&paging" class="btn small btn-modal-upload circle xlarge blue"><i class="material-icons selectfile">library_books</i></a>
<a href="?page=midia&type=folder&paging" class="btn small circle xlarge blue"><i class="material-icons">perm_media</i></a>
</h2>
<!---Form de pesquisa por pastas------->
<?php
if(!isset($_GET['folderid'])){
	$folderid =  null;
}else{
	$folder_id = $_GET['folderid'];
	$folderid = "AND folder_id = {$folder_id}";
}

function np_folder_dropdown(){
if(!isset($_GET['folderid'])){
	$folderid2 =  1;
}else{
	$folderid2 = $_GET['folderid'];
}
$name = np_one(NP."folder", "folder_name", $folderid2);
echo "<div class='dropdown-hover right padding' style='z-index:3'>
<button class='button white border' style='border-bottom:none !important;'>Pasta / <b>{$name}</b></button>
<div class='dropdown-content bar-block border'>";
//Monta a url de consultas
$urlpasta = "?page=midia&type=".np_iget("type")."&paging&folderid=";
//Lista as urls
np_folder_list("a", "bar-item button", $urlpasta); 

echo "</div></div>"; }

?>
<!----Script para manipulação dos  arquivos------->
<div class="modal modal-upload">
<div class="modal-content center padding row" style="max-width:800px">
<a href="#" class="btn red display-topright btn-modal-upload">X</a>
<div class="col m6">
<header>
<h4>Enviar um novo arquivo</h4>
<div class="carregando center padding text-blue">
	<div class="progress1">0%</div>
</div>
</header>

<div class="resposta"></div>



<form name="enviardados" action="" method="post" enctype="multipart/form-data" class="form">
	<label>
    	<span class="campo">Arquivo:</span>
        <input type="file" name="arquivo"/>
        
        <span class="filebar"></span>
		<a class="btn blue card">
		<i class="material-icons selectfile">open_in_browser</i></a>
        
    </label>
    <p>Pasta:
    	<select name="pasta_id" class="select">
		   <?php np_folder_list("option", "no-badge"); ?>
		</select>
    </p>
	<p>Titulo:
    	<input class="input" type="text"  name="titulo" />
    </p>
    
    <p>Descrição:
    	<textarea class="input" name="descricao" role="3"></textarea>
    </p>
    <input type="submit" value="Enviar arquivo" class="btn white border border-blue block" />	
</form></div>
<div class="col m6">
<header>
<h4>Arquivos enviados recentemente</h4>
</header><div class="padding center">
    <div class="localfilesrecente"></div></div>
</div>
</div></div>
<!---Arquivo JS para controlar o upload de imagem---->
<script>
$(document).ready(function(){
	$(".btn-modal-upload").click(function(){
		$(".modal-upload").toggle("fast");
		uploadRecente();
	});var sender = $('form[name="enviardados"]');
	var loader = $('.resposta');
	
	var imagefile = $('.selectfile');
	var imputfile = $('input:file');
	var campofile = $('.filebar');
	
	imputfile.css("display","none");
	
	imagefile.click(function(){
		imputfile.one('click',function(){
			$(this).click();	
		})
		.change(function(){
			campofile.text($(this).val());	
		});
	});
	
	var bar = $('.carregando');
	var per = $('.progress1');
	
	bar.css("display","none");
	
	sender.submit(function(){
		$(this).ajaxSubmit({
			url:'midia/upload.php',
			data: {acao: "cadastro"},
			beforeSubmit: function(){
				loader.empty().html("<div class='progress' style='height:10px'><div class='indeterminate red'></div></div>");
			},
			error: function(){ loader.empty().text('Desculpe, erro ao enviar requisição!') },
			//resetForm: true,
			
			uploadProgress: function(evento, posicao, total, completo){
				//loader.empty().text(evento + " - " + posicao + " - " + total + " - " + completo);
				bar.fadeIn("fast");
				var porcetagem = "Carregando arquivo:" + completo + "%";
				per.width(porcetagem).text(porcetagem);
			},
			
			success: function(resposta){
				per.width('100%').text('100%');
				if(resposta == 1 || resposta == true){
					loader.empty().html("<p class='panel pale-green leftbar border-green padding'>Arquivo enviado com sucesso!</p>").css("background","green");
					sender.find("input:text, textarea").val('');
					imputfile.val('');
					campofile.empty();						
				}else{
					loader.empty().html(resposta);
				}				
				//loader.empty().text('Enviado com sucesso!');
				
			},
			complete: function(){
				window.setTimeout( function(){
					bar.fadeOut("fast",function(){
						per.width('0%').text('0%');	
					});	
				}, 1000);
				uploadRecente();
			}
			
		});
		return false;
	});
//Função que irá mostrar  os arquivos enviados recentemente
function uploadRecente(){
	var localfiles = $(".localfilesrecente");
	var carregando = "<div class='padding center'><div class='progress light-gray'><div class='indeterminate blue'></div></div>Carregando...</div>";
	$.ajax({
		   url:"midia/files-recentes.php",
		   type:"get",
		   beforeSend: function(){
			  localfiles.html(carregando);
		   },
		   success: function(data){
			 localfiles.html(data);
		   }
	});
	
}
	
//Visualizar arquivos

$(".btn-view-midia").click(function(){
	var viewID = $(this).attr("id");
	$(".modal-view-midia").show();
	$(".modal-view-midia-loading").hide();
	$.ajax({
		   url:"midia/view-midia.php",
		   data:{id:viewID},
		   type:"get",
		   beforeSend: function(){
			   $(".modal-view-midia-loading").show();
			   $(".content-view-midia").html("<br><br><h3 class='center'>Carregando arquivo...</h3>");
		   },
		   success: function(data){
			   $(".content-view-midia").html(data);
			   $(".modal-view-midia-loading").hide();
		   }
	});
});

//Editar arquivos
$(".content-view-midia").on("submit", ".form-salvar-detalhes-midia", function(){
	$.ajax({
		   url:"midia/file-update.php",
		   data:$(this).serialize(),
		   type:"post",
		   beforeSend: function(){
			   $(".modal-view-midia-loading2").show();
			   $(".content-view-midia2").hide();
		   },
		   success: function(data){
			   $(".modal-view-midia-loading2").hide();
			   $(".content-view-midia2").show();
			   $(".content-view-midia2").html(data);
		   }
	});
	
	return false;
});

//Deletar arquivos
$(".content-view-midia").on("click", ".btn-deletar-midia", function(){
	var id2 = $(this).attr("id");
	$.ajax({
		   url:"midia/file-delete.php",
		   data:{id:id2},
		   type:"post",
		   beforeSend: function(){
			   $(".modal-view-midia-loading").show();
			   $(".content-view-midia").html("<br><br><h3 class='center'>Deletando arquivo permanentemente...</h3>");
		   },
		   success: function(data){
			   $(".modal-view-midia-loading, .btn-open-modal").hide();
			   $(".content-view-midia").html(data);
			   $(".file-mida-"+id2).hide("slow");
		   }
	});
	
	return false;
});

});
</script>
<div class="modal modal-view-midia" id="id01ww">
     <div class="modal-content white row" style="max-width:800px; min-height:100px">
	 <div class="col m12" style="z-index:3; position: absolute">
	 <div class="progress light-gray modal-view-midia-loading" style="position:relative; top:-10px; height:7px">
     <div class="indeterminate red"></div>
     </div>
	 <a href="#" onclick="document.getElementById('id01ww').style.display='none'" class="red btn btn-open-modal display-topright">x</a></div>
	 <div class="content-view-midia">
	 </div>
	 </div>
</div>
<?php
//Excluir arquivo:	
if(np_isset("delete")){
	$id_delete = np_ipost("id_delete");
	$file_path = "../uploads/".np_ipost("file_path");
	unlink($file_path);
	np_delete(NP."files", "WHERE ID = {$id_delete}", "Arquivo excluído com sucesso.");
}
$type_midia = $_GET['type'];
if($type_midia == 'image'){
	include("photos.php");
}elseif($type_midia == 'video'){
	include("videos.php");
}elseif($type_midia == 'file'){
	include("files.php");
}elseif($type_midia == 'folder'){
	include("folder.php");
}
elseif($type_midia == 'folder-create' or $type_midia == 'folder-edit'){
	include("folder-create.php");
}
?>