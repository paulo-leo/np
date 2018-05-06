<?php
np_no_access(np_admins());
/*verifica o numero total de registros*/
	$tr = np_count(NP."categories", "");  
	echo "<h5>Categorias ({$tr})  <a href='?page=add-category&menu=category' class='np-btn border border-green'>Adicionar</a></h5><hr>";

if(isset($_GET['delete'])){
	$post_delete = $_GET['delete'];
	if($post_delete != 1){
	np_del(NP."categories", $post_delete, function(){
		np_msg("Categoria excluida com sucesso.", "red");
	});
	$values = ['post_category'=>1];
	np_upd(NP."posts", $values, "post_category = $post_delete", function(){
		np_msg("Todos os posts relacionados a essa categoria foram atualizados para a categoria padrão.", "yellow");
	}, function(){
		np_msg("Nenhum post foi afetado com a exclusão desta categoria.", "yellow");
	});
	}
	else{ np_msg("Essa categoria não pode ser excluída por se tratar de uma categoria padrão do sistema.", "yellow");}
}

$pg = np_paging(np_p("categories"), 10, $limite);

np_paging_num("Página ", " de ");


if(np_paging_count()){
	 echo "<table class='table bordered striped hoverable'>
	 <tr class='medium'><td><i class='material-icons'>label_outline</i> Nome</td><td><i class='material-icons'>clear_all</i> Subcategoria</td> <td><i class='material-icons'>view_headline</i> Descrição</td> <td><i class='material-icons'>spellcheck</i> Slung/URL</td> <td><i class='material-icons'>toc</i> Itens</td></tr>";   
            foreach($pg as $id){
				echo "<tr class='small posts-tr'><td><b>{$id['category_name']}</b><br><br>
				<div class='post-links'><a href='?page=edit-category&id={$id['ID']}&paging={$_GET['paging']}&menu=category' class='hover-text-green'>Editar</a> | <a class='hover-text-red' href='?page=category&delete={$id['ID']}&paging={$_GET['paging']}&menu=category'>Excluir</a></div>
				</td><td>";
				      $catnull = "<i class='material-icons text-red'>report_problem</i>";
					  $cattrue = "<i class='material-icons text-green'>done</i>";
				      if($id['subcategory'] == null){  echo $catnull; }
					  else{ 
					        $catresul = np_obj_id("categories", $id['subcategory'], "category_name");
					        if($catresul){ echo $cattrue.$catresul; }else{ echo $catnull; }
					      } 
				 echo"</td><td>{$id['category_description']}</td><td>{$id['slung']}</td><td>";
				 the_category_count($id['ID']);
				 echo "</td></tr>";
			}
     echo "</table>"; 	
}else{
	np_paging_count(true);
}
np_paging_btn("next/numeric", "btn hover-light-gray border white btn-nav tiny", "Avançar, Voltar", "page=category");
?>