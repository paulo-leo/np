<?php

if(np_iget("type") == "folder-create"){
	
	if(isset($_POST['folder']) and $_POST['folder'] == "create"){
		
		if(strlen(np_ipost("name")) > 0){
			
			$name = np_ipost("name");
			$description = np_ipost("description");
			$dados33 = ["folder_name"=>$name, "folder_description"=>$description];
			np_insert(NP."folder", $dados33, "Pasta criada com sucesso", "Erro ao criar pasta");
			
		}else{
			np_msg("O nome da pasta é obrigatório", "yellow");
		}
		
	}
	
	echo "<form method='post' style='max-width:500px'>
		   <input type='hidden' name='folder' value='create'>
	       <p>Nome da pasta:
	       <input type='text' name='name' class='input border'></p>
		   <p>Descrição da pasta:
		   <textarea name='description' class='input border'></textarea></p>
		   <input type='submit' value='Criar' class='btn green'>
	      </form>";
		  	
}


////Folder edição
if(np_iget("type") == "folder-edit"){
	$id = np_iget("id");  
	$list_post = new Read;
      $list_post->exeRead(NP."folder", "WHERE ID = {$id}"); 
	  if($list_post->getRowCount() >= 1){
         foreach($list_post->getResult() as $lin){
			 
	  }}
	
   if(isset($_POST['folder']) and $_POST['folder'] == "edit"){
	
		
		if(strlen(np_ipost("name")) > 0){
			 
		    $idx = np_ipost("id");
			$name = np_ipost("name");
			$description = np_ipost("description");
			$dados33 = ["folder_name"=>$name, "folder_description"=>$description];
			np_update(NP."folder", $dados33, "WHERE ID = {$idx}", "Pasta atualizada com sucesso", "Erro ao atualizar pasta");
			
		}else{
			np_msg("O nome da pasta é obrigatório", "yellow");
		}
		
	}
	
	echo "<form method='post' style='max-width:500px'>
		   <input type='hidden' name='folder' value='edit'>
		   <input type='hidden' name='id' value='{$lin['ID']}'>
	       <p>Nome da pasta:
	       <input type='text' name='name' value='{$lin['folder_name']}' class='input border'></p>
		   <p>Descrição da pasta:
		   <textarea name='description' class='input border'>{$lin['folder_description']}</textarea></p>
		   <a href='#' onclick=\"document.getElementById('id0101').style.display='block'\" class='btn border white'>Apagar pasta</a>
		   <input type='submit' value='Salvar edição' class='btn green'/>
	      </form>
		  <div id='id0101' class='modal'>
       <div class='modal-content animate-zoom white round padding center' style='max-width:400px'>
	<header class='container'> 
    <h3 class='center'>Apagar pasta?</h3><p class='tiny center'>Ao apagar esta pasta todos os arquivos relacionados a ela serão transferidos automaticamente para a pasta padrão do sistema.</p>
</header>
<a href='#' onclick=\"document.getElementById('id0101').style.display='none'\" 
class='btn border round text-red'>Cancelar</a>
<a href='?page=midia&type=folder&folder-delete-id={$id}&paging' class='btn border round'>Apagar</a>
	 </div>
</div>
		  ";
		  	
}
?>

