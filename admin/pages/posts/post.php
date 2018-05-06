<?php
np_no_access(np_adminss());
/*verifica o numero total de registros*/
if(np_author()){
	$tr = np_count(NP."posts", "WHERE post_type = 1 AND post_author = ".NP_USER_ID." AND post_status != 4"); 
}else{
	$tr = np_count(NP."posts", "WHERE post_type = 1 AND post_status != 4"); 
}

if(np_author()){
	$limite = "post_type = 1 AND post_author = ".NP_USER_ID." AND post_status != 4";
    }else{
	$limite = "post_type = 1 AND post_status != 4"; 
    }
?>
<h5>Posts (<?php echo $tr; ?>)  <a href="?page=post-form&menu=post" class="np-btn border border-green">Adicionar</a>
<a href="?page=page&menu=page&paging" class="np-btn">Páginas</a>
<?php 
if(np_admins()){
np_print("<a href='?page=category&menu=category&paging' class='np-btn'>Categorias</a>"); }
echo "<a href='?page=lixeira&menu=post&paging' class='np-btn'>Lixeira</a></h5>";

//Envio do item para lixeira
if(isset($_GET['post-delete'])){
	$post_delete = $_GET['post-delete'];
	$values = ['post_status'=> 4];
	np_upd(NP."posts", $values, intval($post_delete), function(){
		np_msg("Post movido para a lixeira. <a href='?page=post&post-resert={$_GET['post-delete']}&status={$_GET['status']}&paging={$_GET['paging']}&menu=post' class='np-btn border border-red small'>Desfazer</a>", "red");
	});
}
if(isset($_GET['post-resert'])){
	$post_resert = $_GET['post-resert'];
	$status = $_GET['status'];
	$values = ['post_status'=> intval($status)];
	np_upd(NP."posts", $values, intval($post_resert), function(){
		np_msg("O post foi restaurado com sucesso.", "green");
	});
}
$pg = np_paging(np_p("posts"), 10, $limite);

np_paging_num("Página ", " de ");
echo "<hr>";

if(np_paging_count()){
	 echo "<table class='table bordered striped hoverable'>
	 <tr class='medium'><td><i class='material-icons'>label_outline</i> Título</td> <td><i class='material-icons'>perm_identity</i> Autor</td> <td><i class='material-icons'>list</i> Categoria</td> <td><i class='material-icons'>comment</i> Comentários</td> <td><i class='material-icons'>schedule</i> Data</td> <td><i class='material-icons'>visibility</i> Visualizações</td></tr>";   
            foreach($pg as $id){
				echo "<tr class='small posts-tr' id=post-{$id['ID']}><td>".np_icons_status($id["post_status"])." <b>"; 
                if(strlen($id['post_title']) > 34){ echo substr($id['post_title'],0, 33)."..."; }
				else{ echo $id['post_title']; }
				echo "</b><br><br>
				<div class='post-links'><a href='?page=post-edit&id={$id['ID']}&menu=post' class='hover-text-green'>Editar</a> | <a class='hover-text-red' href='?page=post&post-delete={$id['ID']}&status={$id['post_status']}&paging={$_GET['paging']}&menu=post'>Colocar na lixeira</a></div>
				</td><td>"; the_author($id);
				echo "</td> <td>"; the_category($id);
				echo "</td> <td>"; the_comment_count($id);
				echo "</td> <td>".np_time($id["post_date"], "time+", " às ")."</td><td>";
                the_view_count($id, "blue");
				echo"</td></tr>";
			}
     echo "</table>"; 	
}else{
	np_paging_count(true, "<h2 class='text-red'><i class='material-icons'>warning</i> Não há nenhum post criado no momento.</h2>");
}
np_paging_btn("next/numeric", "btn hover-light-gray border white btn-nav tiny", "Avançar, Voltar", "page=post");
?>