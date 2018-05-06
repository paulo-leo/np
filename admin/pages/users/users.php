<?php np_no_access(np_admin()); 
$tr = np_count(NP."users", "");  
echo "<h5>Usuários ({$tr})  <a href='?page=add-user&menu=users' class='np-btn border border-green'>Adicionar</a></h5>";

//Apagar usuário
if(isset($_POST['delete']) and $_POST['delete'] == "true"){
	$id = intval($_POST['id']);
	
	$type = intval($_POST['user_type']);
	$td = np_count(NP."users", "WHERE user_type = 1");
	if($id != NP_USER_ID){
		if($type == 1 AND $td <= 1){
			np_msg("Você não pode excluir este usuário! Pois sua função é do tipo <b>administrador</b> e só consta um administrador ativo no sistema.", "yellow");
		}else{
			 np_del(NP."users", $id, function(){
			 $img = $_POST['img'];
			 if($img != "system/img-perfil.png"){
                unlink("../uploads/{$img}");
			 }
			 np_msg("Usuário deletado com sucesso.", "red");
		 });
		}	
	}else{
		np_msg("Você não pode excluir a si mesmo.", "yellow");
	}
}
echo "<hr>";
$pg = np_paging(np_p("users"), 10, $limite);

np_paging_num("Página ", " de ");

if(np_paging_count()){
	 echo "<table class='table bordered striped hoverable'>
	 <tr class='medium'><td><i class='material-icons'>perm_contact_calendar</i> Nome de exibição</td><td><i class='material-icons'>email</i> E-mail</td> <td><i class='material-icons'>perm_data_setting</i> Função</td> <td><i class='material-icons'>edit</i> Posts</td> <td><i class='material-icons'>schedule</i> Acessos</td></tr>";   
            foreach($pg as $id){
			echo "<tr><td><span style='position:relative;left:-15px;bottom:-10px; z-index:2'>";
			if($id['user_status'] == 1){ echo "<i title='Conectado' class='material-icons text-green'>stars</i>"; }
			if($id['user_status'] == 2){ echo "<i title='Desconectado' class='material-icons'>offline_pin</i>"; }
			if($id['user_status'] == 3){ echo "<i title='Bloqueado' class='material-icons text-orange'>warning</i>"; }
			if($id['user_status'] == 4){ echo "<i title='Desativado' class='material-icons text-red'>warning</i>"; }
			echo "</span><span style='position:relative;left:-32px;'><img src='../content/uploads/{$id['user_img']}' style='height:50px; width:50px' class='circle xlarge'><b style='position:relative;top:-12px;'>{$id['user_display']}</b></span>
			<div class='post-links'><a href='?page=edit-user&id={$id['ID']}&paging={$_GET['paging']}&menu=users' class='hover-text-green'>Editar</a> | <a class='hover-text-red' href='?page=user-delete&id={$id['ID']}&paging={$_GET['paging']}&menu=users'>Excluir</a></div>
			</td>
			<td>{$id['user_email']}</td><td>";
			$type = intval($id['user_type']);
			if($type == 1){ echo "<i class='material-icons'>lock</i> Administrador";}
			elseif($type == 2){ echo "<i class='material-icons'>edit</i> Editor";}
			elseif($type == 3){ echo "<i class='material-icons'>class</i> Autor";}
			else{ echo "<i class='material-icons'>turned_in</i> Leitor";}
			echo"</td><td>"; 
			$post = np_count(NP."posts", "WHERE post_status !=4 AND post_author = {$id['ID']}");
			if($post == 1){ echo "<i class='material-icons text-green'>done</i>Uma publicação"; }
			elseif($post > 1){ echo "<span class='badge indigo'>{$post}</span> publicações"; }
			else{ echo "Nenhuma publicação"; }
			echo "</td><td>";
			if($id['user_access_count'] == 0){ echo "Nenhum acesso";}
			else{ 
				echo "<span>Total: {$id['user_access_count']}</span><br><span class='text-green tiny'>".np_time($id['user_date_login'], "time+", " às ")."</span>";
			}
			echo "</td></tr>";
			}
     echo "</table>"; 	
}else{
	np_paging_count(true);
}
np_paging_btn("next/numeric", "btn hover-light-gray border white btn-nav tiny", "Avançar, Voltar", "page=users&menu=users");
?>