<?php
/*verifica o numero total de registros*/
np_folder_dropdown();
$tr = np_count(NP."files", "WHERE file_type = 'file' $folderid");
if($tr > 0){ echo "<h4 class=''><i class='material-icons'>library_books</i> Documentos ({$tr})</h4><hr>"; }
if(isset($_GET['paging'])){
	//Total de registros que será exibido por página
	$total_reg = 40; 
	$pagina = $_GET['paging'];
	if(!$pagina){
		$pc = 1;
	}else{
		$pc = $pagina;
	}
	/////
	$inicio = $pc - 1;
	$inicio = $inicio * $total_reg;
	
	$limite = "WHERE file_type = 'file' $folderid ORDER BY id DESC LIMIT $inicio,$total_reg"; 
	
	/*verifica o numero total de páginas*/
	$tp = $tr / $total_reg; 
	 
$list_post = new Read;
$list_post->exeRead(NP."files", $limite); 
if($list_post->getRowCount() >= 1){
echo "<div class='row'><form>";	
foreach($list_post->getResult() as $lin){
 echo "<div class='col m2 margin center card-4 file-mida-{$lin['ID']}' style='width:100px; height:110px'>
       <input type='checkbox'>
      <a href='#' id='{$lin['ID']}' class='btn-view-midia' style='text-decoration:none;'>
      <img  class='border animate-top' id='img' style='height:60px; width:100px' src='../uploads/system/".np_system_img($lin['file_name']).".png'>
	  <p class='tiny center'>"; 
	  if(strlen($lin['file_title']) > 25){
		   echo substr($lin['file_title'], 0, 25)."...";
	  }else{
		  echo $lin['file_title'];
	  }
	  echo "</p>
	  </a>
      </div>"; 	  
	}
	echo "</form></div>";
	}else{
		echo "<h3 class='center'><i class='material-icons'>assignment</i><br> Não há nenhum documento salvo no sistema.<br><a href='#' class='btn white border border-blue medium round btn-modal-upload'>Enviar arquivo.</a></h3>";
}}
?>
</ul>
<?php
//Inicio dos botões proximo e voltar
	 $anterior = $pc - 1;
	 $proximo = $pc + 1;
	 if($pc > 1){
		 echo "<a href='?page=midia&type=file&paging={$anterior}' class='button'><< Anterior </a>";
	 }
	 if($pc < $tp){
		 echo "<a href='?page=midia&type=file&paging={$proximo}' class='button'> Próximo >></a>";
	 }//Fim dos botões 

?>