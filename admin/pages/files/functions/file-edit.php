<?php
include("../../../../core/conn.php");
np_libs("../../../../core/libs/");
if(isset($_POST['file_edit'])){
	$id = $_POST['file_edit'];
	$title = $_POST['title'];
	$description = $_POST['description'];
	$folder = $_POST['folder'];
	
	if(strlen($title) < 2 or $title == " "){
		np_msg("O título não pode ser vazio!", "red");
	}else{
		$values = array("file_title"=>$title,
				  "file_description"=>$description,
				  "folder_id"=>$folder);
		np_upd(NP."files", $values, $id, function(){
			np_msg("Detalhes do arquivo atualizado com sucesso.", "blue");
		}, function(){
			np_msg("Nenhum dado novo foi informado para atualização do arquivo. ", "yellow");
		});
	}
}
?>