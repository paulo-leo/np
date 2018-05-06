<?php
/*verifica o numero total de registros*/
$tr = np_count(NP."folder");
echo "<a href='?page=midia&type=folder-create' class='btn white border right'>Criar nova pasta</a><h4 class=''> Pastas ({$tr})</h4><hr>"; 
if(isset($_GET['folder-delete-id'])){
	$iddeletefol = $_GET['folder-delete-id'];
	$namefolder123 = np_one(NP."folder", "folder_name", $iddeletefol);
	if($iddeletefol == 1){ np_msg("A pasta  <b>\"{$namefolder123}\"</b> não pode ser excluída por se tratar de uma pasta padrão do sistema.", "yellow"); }else{
		 $dados2323 = ['folder_id'=>1];
	     np_update(NP."files", $dados2323, "WHERE folder_id = $iddeletefol");
		 np_delete(NP."folder", "WHERE ID = {$iddeletefol}", "Pasta <b>\"{$namefolder123}\"</b> deletada com sucesso.");
	}
}

if(isset($_GET['paging'])){
	//Total de registros que será exibido por página
	$total_reg = 10; 
	$pagina = $_GET['paging'];
	if(!$pagina){
		$pc = 1;
	}else{
		$pc = $pagina;
	}
	/////
	$inicio = $pc - 1;
	$inicio = $inicio * $total_reg;
	
	$limite = "ORDER BY id LIMIT $inicio,$total_reg"; 
	
	/*verifica o numero total de páginas*/
	$tp = $tr / $total_reg; 
	 
$list_post = new Read;
$list_post->exeRead(NP."folder", $limite); 
if($list_post->getRowCount() >= 1){
foreach($list_post->getResult() as $lin){
 echo "<div class='col margin center file-mida-{$lin['ID']}' style='width:140px'>";
 $file_folder = np_count(NP."files", "WHERE folder_id = {$lin['ID']}");
 if($file_folder > 0){
	 echo "<span style='position:relative; top:40px; right:-10px; z-index:2' class='badge blue'>{$file_folder}</span>";
 }else{ echo "<span style='position:relative; top:40px; right:-10px; z-index:2' class='badge red'>{$file_folder}</span>"; }

      echo "<img  class='animate-top' style='height:100px; width:140px' src='../uploads/system/folder.png'>
	 <a href='?page=midia&type=folder-edit&id={$lin['ID']}' id='{$lin['ID']}' class='center hover-text-blue' style='text-decoration:none;'>{$lin['folder_name']}"; if($lin['ID'] == 1){ echo "<br><span class='tiny text-blue'>(Padrão do sistema)</span>"; } echo"</a></div>"; 	  
	}
	}else{
		echo "<h3 class=''>Não existe nenhuma pasta criada no momento.</h3>";
}}
?>
</ul>
<?php
//Inicio dos botões proximo e voltar
	 $anterior = $pc - 1;
	 $proximo = $pc + 1;
	 if($pc > 1){
		 echo "<a href='?page=midia&type=folder&paging={$anterior}' class='button'><< Anterior </a>";
	 }
	 if($pc < $tp){
		 echo "<a href='?page=midia&type=folder&paging={$proximo}' class='button'> Próximo >></a>";
	 }//Fim dos botões 

?>
