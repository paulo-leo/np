<?php
include("../../../core/conn.php");
np_libs("../../../core/libs/");
include("../../../core/thema.php");
if(np_isset("createCategory")){
	$name = np_ipost("name");
	$slung = np_set_url($name);
	$description = np_ipost("description");
	$subcategoria = np_post("subcategoria", 0);
	if(strlen($name) < 2 or $name == " "){
		np_msg("O campo nome não pode ser vazio", "red");
	}else{
		
		if(np_count(NP."categories", "WHERE slung = '$slung'") == 0){
	      $values = ['category_name'=>$name,'category_description'=>$description, 'subcategory'=>$subcategoria, 'slung'=>$slung];
		  
		  np_cre(NP."categories", $values, function(){ 
		      global $name;
			  np_msg("Categoria \"<b>{$name}</b>\" criada com sucesso!");
		  }, "<p class='text-red padding'>Erro interno do servidor, tente novamente!</p>");
	
	}else{
		np_msg("Erro ao criar, pois já existe uma categoria com o mesmo título.", "yellow");
	}
		
	}
}
if(np_isset("editCategory")){
	$name = np_ipost("name");
	$id = np_ipost("category_id");
	$description = np_ipost("description");
	$subcategoria = np_post("subcategoria", false);
	if($subcategoria == false){
		$inputs = ['category_name'=>$name,'category_description'=>$description];
	}else{
		$inputs = ['category_name'=>$name,'category_description'=>$description, "subcategory"=>$subcategoria];
	}
		
	if(strlen($name) < 2 or $name == " "){
		np_msg("O campo nome não pode ser vazio", "red");
	}else{
		np_upd(NP."categories", $inputs, intval($id), function(){
		np_msg("Categoria atualizada com sucesso.", "blue");
	}, function(){
		np_msg("Erro ao atualizar! O sistema identificou que a atualização é repetida e que não foi alterado nenhum campo pelo usuário.", "red");
	});
	}
}
?>