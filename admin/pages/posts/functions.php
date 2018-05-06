<?php
include("../../../core/conn.php");
np_libs("../../../core/libs/");
np_timezone();
if(np_isset("add_post")){
//Campos
$title = np_ipost("title");
$slung = np_set_url($title);
$status = np_post('status', 1);
$content = np_ipost("content");
$keys = np_ipost("keys");
$description = np_ipost("description");
$category = np_post('category', 1);
$type = np_post('type', '1');
$user_id = np_ipost("post_author");
$values = ["post_author" => $user_id,
"post_date" => date('Y-m-d H:i:s'),
"post_title" => $title, 
"slung" => $slung,
"post_content"=> $content,
"post_status"=> $status,
"post_type"=> $type,
"post_order"=> 0,
"post_category"=> $category,
"post_image"=>"0",
"post_description"=>$description,
"post_keys"=>$keys,
"comment_activate"=>np_post('comment_active', '1'),
"post_views"=>0
];
if(strlen($title) < 2 or $title == " "){
	np_msg("O título não pode ser vazio. Tem que conter no mínimo 2 caracteres válidos.", "yellow");
}else{
	
	if(np_count(NP."posts", "WHERE slung = '$slung'") == 0){
		   np_cre(NP."posts", $values, function(){
			  global $type, $title, $user_id;
			  if($type == 1){ $tipo = "Post "; $t = "&menu=post"; }else{ $tipo = "Página"; $t = "&menu=page"; }
			  
			  $post_create = np_obj("SELECT ID FROM ".NP."posts WHERE post_author = $user_id ORDER BY id DESC");
			  $edit = "<br><br><a class='np-btn card small' href='?page=post-edit&id={$post_create->ID}{$t}'>Editar {$tipo}</a>";
			  np_msg("{$tipo} <b>{$title}</b> criado com sucesso. {$edit}", "green");
		  }, "<p class='text-red padding'>Erro interno do servidor, tente novamente!</p>");
	}else{
		np_msg("Erro ao publicar, pois já existe um post ou página com o mesmo título.", "red");
	}
  }
}
if(np_isset("update_post")){
//Campos

$comment_activate = np_post("comment_activate", np_ipost("comment_this"));

$status = np_post("status", np_ipost("visi1"));

$category = np_post("category", np_ipost("cat1"));

$order = np_post("order", 0);

$id = np_ipost("post_id");
$title = np_ipost("title");
$content = np_ipost("content");
$keys = np_ipost("keys");
$description = np_ipost("description");
	
$values = [
"post_date_update" => date('Y-m-d H:i:s'),
"post_title" => $title, 
"post_content"=> $content,
"post_status"=> $status,
"post_order"=> $order,
"post_category"=> $category,
"post_description"=>$description,
"post_keys"=>$keys,
"comment_activate"=>$comment_activate];

if(strlen($title) < 2 or $title == " "){
	np_msg("Campo título não pode ser vazio. Tem que conter no mínimo 2 caracteres válidos.", "yellow");
}else{
	np_upd(NP."posts", $values, intval($id), function(){
		np_msg("Atualização realizada com sucesso.", "blue");
	}, function(){
		np_msg("Erro ao atualizar! O sistema identificou que a atualização é repetida e que não foi alterado nenhum campo pelo usuário.", "red");
	});
  }
}
?>