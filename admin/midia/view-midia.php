<?php
include("../../core/conn.php");
include("../../core/read.php");
include("../../functions.php");
include("../../core/thema.php");

$file_id = np_iget("id");
$midiaType = np_one(NP."files", "file_type", $file_id);

if(np_isset("edit")){
	$title = np_ipost("title");
	$description = np_ipost("description");
	if(strlen($title) < 2 or $title == " "){
		np_msg("O campo título não pode ser vazio", "red");
	}else{
		$inputs = ['file_title'=>$title,'file_description'=>$description];
		np_update(NP."files", $inputs, "WHERE ID = {$file_id}", "Detalhes do arquivo alterado com sucesso");
	}
}
$ct = new Read; 
$ct->exeRead(NP."files", "WHERE ID = {$file_id}"); 
if($ct->getRowCount() >= 1){ 
foreach($ct->getResult() as $lin){ 

//Se midia for uma imagem
if($midiaType == "image"){
	echo "<div class='col m8'><img  class='border animate-top card' id='img' style='width:100%; max-height:500px' src='../uploads/{$lin['file_name']}'>
	<a href='#' class='btn text-red border margin btn-deletar-midia' id='{$lin['ID']}'>Excluir</a>
	</div><div class='col m4 padding'>
   <form class='form-salvar-detalhes-midia'>
 <input type='hidden' name='id' value='{$lin['ID']}'>
    <p>Título:
    <input type='text' class='input' name='file_title' value='{$lin['file_title']}'></p>
	<p>Pasta:
    	<select name='pasta_id' class='select'>";
		     np_folder_list("option", "no-badge");
		echo "</select></p>
	<p>Descrição:
    <textarea class='input' name='file_description' >{$lin['file_description']}</textarea></p>
	<p>Data:
    <input type='text' class='input' disabled value='{$lin['file_datetime']}'></p>
	<p>URL do arquivo:
    <textarea class='input' disabled >{$lin['file_name']}</textarea></p>
	<div class='progress light-gray modal-view-midia-loading2' style='display:none;'>
     <div class='indeterminate green'></div></div>
	<div class='content-view-midia2'></div>
	<input type='submit' class='btn block green margin-top' value='Salvar detalhes'>
</form></div>";
	

}
//Se midia for um vídeo
elseif($midiaType == "video"){
	
echo "<div class='col m8'><video controls style='width:100%;' class='card'>
     <source src='../uploads/{$lin['file_name']}' type='video/mp4'>
    </video>
	<a href='#' class='btn text-red border margin btn-deletar-midia' id='{$lin['ID']}'>Excluir</a>
	</div>";
	
echo "<div class='col m4 padding'>
   <form class='form-salvar-detalhes-midia'>
 <input type='hidden' name='id' value='{$lin['ID']}'>
    <p>Título:
    <input type='text' class='input' name='file_title' value='{$lin['file_title']}'></p>
	<p>Pasta:
    	<select name='pasta_id' class='select'>";
		     np_folder_list("option", "no-badge");
		echo "</select></p>
	<p>Descrição:
    <textarea class='input' name='file_description' >{$lin['file_description']}</textarea></p>
	<p>Data:
    <input type='text' class='input' disabled value='{$lin['file_datetime']}'></p>
	<p>URL do arquivo:
    <textarea class='input' disabled >{$lin['file_name']}</textarea></p>
	<div class='progress light-gray modal-view-midia-loading2' style='display:none;'>
     <div class='indeterminate green'></div></div>
	<div class='content-view-midia2'></div>
	<input type='submit' class='btn block green margin-top' value='Salvar detalhes'>
</form>

</div>";	
    }else{

echo "<div class='col m4'><img  class='border animate-top card' id='img' style='width:100%; max-height:300px' src='../uploads/system/".np_system_img($lin['file_name']).".png'>
    <a href='../uploads/{$lin['file_name']}' class='btn text-blue border margin'>Baixar arquivo</a>
	<a href='#' class='btn text-red border margin btn-deletar-midia' id='{$lin['ID']}'>Excluir</a>
	</div><div class='col m8 padding'>
   <form class='form-salvar-detalhes-midia'>
 <input type='hidden' name='id' value='{$lin['ID']}'>
    <p>Título:
    <input type='text' class='input' name='file_title' value='{$lin['file_title']}'></p>
	<p>Pasta:
    	<select name='pasta_id' class='select'>";
		     np_folder_list("option", "no-badge");
		echo "</select></p>
	<p>Descrição:
    <textarea class='input' name='file_description' >{$lin['file_description']}</textarea></p>
	<p>Data:
    <input type='text' class='input' disabled value='{$lin['file_datetime']}'></p>
	<p>URL do arquivo:
    <textarea class='input' disabled >{$lin['file_name']}</textarea></p>
	<div class='progress light-gray modal-view-midia-loading2' style='display:none;'>
     <div class='indeterminate green'></div></div>
	<div class='content-view-midia2'></div>
	<input type='submit' class='btn block green margin-top' value='Salvar detalhes'>
</form></div>";


	
	}
  } 
}
?>