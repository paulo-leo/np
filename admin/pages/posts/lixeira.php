<?php np_no_access(np_adminss());  
if(isset($_GET['post-delete'])){
	$post_delete = $_GET['post-delete'];
	$dado = ['post_status'=> 4];
	np_delete(NP."posts", "WHERE ID = $post_delete", "Item excluído permanentemente do sistema");
}
if(isset($_GET['post-r'])){
	$post_r = $_GET['post-r'];
	$values = ['post_status'=> 3];
	np_upd(NP."posts", $values, intval($post_r), function(){
		np_msg("Item restaurado com sucesso! Porém o mesmo teve o seu status alterado para <b>pendente</b>.", "yellow");
	});
}

	if(np_author()){ $limite = "post_status = 4 AND post_author = ".NP_USER_ID; }
	else{ $limite = "post_status = 4";  }
		
$pg = np_paging(np_p("posts"), 10, $limite);

if(np_paging_count()){
	 echo "<h3 class='center'><i class='material-icons xxlarge'>delete</i><span style='position:relative; left:-15px; top:-23px' class='badge small red'>".np_paging_count()."</span></h3>";
	 np_paging_num("Página ", " de ");
	 echo "<table class='table bordered striped hoverable'>
	 <tr class='medium'><td><i class='material-icons'>label_outline</i> Título</td> <td><i class='material-icons'>perm_identity</i> Autor</td><td><i class='material-icons'>list</i> Categoria</td> <td><i class='material-icons'>schedule</i> Data</td></tr>";   
            foreach($pg as $id){
				echo "<tr class='small posts-tr' id=post-{$id['ID']}><td>".np_icons_status($id["post_status"])." <b>"; 
                if(strlen($id['post_title']) > 34){ echo substr($id['post_title'],0, 33)."..."; }
				else{ echo $id['post_title']; }
				echo "</b><br><br>
				<div class='post-links'><a href='?page=lixeira&post-r={$id['ID']}&paging={$_GET['paging']}' class='hover-text-green'>Restaurar</a> | <a class='hover-text-red' href='?page=lixeira&post-delete={$id['ID']}&paging={$_GET['paging']}'>Excluir permanentemente</a></div>
				</td><td>"; the_author($id);
				echo "</td> <td>"; the_category($id);
				echo "</td> <td>".np_time($id["post_date"], "time+", " às ")."</td></tr>";
			}
     echo "</table>"; 	
}else{
	np_paging_count(true, "<h2 class='text-red'><i class='material-icons'>warning</i> No momento a lixeira está vazia!</h2>");
}
np_paging_btn("next/numeric", "btn hover-light-gray border white btn-nav tiny", "Avançar, Voltar", "page=lixeira");
?>