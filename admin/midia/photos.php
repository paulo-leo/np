<?php
/*verifica o numero total de registros*/
np_folder_dropdown();
$tr = np_count(NP."files", "WHERE file_type = 'image' $folderid");
if($tr > 0){ echo "<h4 class=''><i class='material-icons'>settings_brightness</i> Imagens ({$tr})</h4><hr>"; }
if(isset($_GET['paging'])){
	//Total de registros que será exibido por página
	$total_reg = 30; 
	$pagina = $_GET['paging'];
	if(!$pagina){
		$pc = 1;
	}else{
		$pc = $pagina;
	}
	/////
	$inicio = $pc - 1;
	$inicio = $inicio * $total_reg;
	
	
	$limite = "WHERE file_type = 'image' $folderid ORDER BY id DESC LIMIT $inicio,$total_reg"; 
	
	
	
	/*verifica o numero total de páginas*/
	$tp = $tr / $total_reg; 
	 
$list_post = new Read;
$list_post->exeRead(NP."files", $limite); 
if($list_post->getRowCount() >= 1){
echo "<div class='row'><form>";	
foreach($list_post->getResult() as $lin){
 echo "<div class='col blue margin card file-mida-{$lin['ID']}' style='width:140px'>
       <input type='checkbox'>
      <a href='#' id='{$lin['ID']}' class='btn-view-midia'>
      <img  class='border animate-top' id='img' style='height:100px; width:140px' src='../uploads/{$lin['file_name']}'>
	  </a>
      </div>"; 	  
	}
	echo "</div>";
	}else{
		echo "<h3 class='center'><i class='material-icons'>perm_media</i><br> Não há nenhum arquivo de imagem no momento.<br><a href='#' class='btn white border border-blue medium round btn-modal-upload'>Enviar arquivo.</a></h3>";
}}
?>
</ul>
<?php
//Inicio dos botões proximo e voltar
	 $anterior = $pc - 1;
	 $proximo = $pc + 1;
	 if($pc > 1){
		 echo "<a href='?page=midia&type=image&paging={$anterior}' class='button'><< Anterior </a>";
	 }
	 if($pc < $tp){
		 echo "<a href='?page=midia&type=image&paging={$proximo}' class='button'> Próximo >></a>";
	 }//Fim dos botões 

?>