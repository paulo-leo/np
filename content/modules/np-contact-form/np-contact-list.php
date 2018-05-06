<h2><i class="material-icons">chat</i>Mensagens do site</h2>
<?php
np_no_access(np_admins());
/*verifica o numero total de registros*/
	$tr = np_count(NP."contact_form"); 
?>
<div class="row">
<div class="col m12">
<hr>
<?php
if(isset($_GET['post-delete'])){
	$post_delete = $_GET['post-delete'];
	np_delete(NP."contact_form", "WHERE ID = $post_delete", "Mensagem deletada com sucesso");
}
?>
<!----Consultar posts------>
<ul class='ul'>
<?php
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
	
	
	$limite = "ORDER BY id DESC LIMIT $inicio,$total_reg"; 
    

	/*verifica o numero total de páginas*/
	$tp = $tr / $total_reg; 
	 
$list_post = new Read;
$list_post->exeRead(NP."contact_form", $limite); 
if($list_post->getRowCount() >= 1){ 
foreach($list_post->getResult() as $lin){
 echo "<li class='display-container card margin-bottom' style='height:110px'>
       <span class='display-topleft padding large'><b>{$lin['subject']} |</b>  {$lin['message']}</span>
	   <span class='display-left padding'><i>".np_time($lin['datetime'], "time+")."</i></span>
	   <span class='display-topright padding tiny'></span>
       <span class='display-bottomleft'>
       <a href='?page=np-contact-view&id={$lin['ID']}&paging={$pagina}' class='btn transparent hover-text-blue' title='Visualizar mensagem'><i class='material-icons'>email</i></a>
       <a href='?page=np-contact-list&post-delete={$lin['ID']}&paging={$pagina}' class='btn transparent hover-text-blue' title='Apagar'><i class='material-icons text-teal'>delete</i></a>
      </span>"; 	  
	}}else{
		echo "<h3><i class='material-icons'>info_outline</i> Não há nenhuma mensagem no momento.</h3>";
}}
?>
</ul>
<?php
//Inicio dos botões proximo e voltar
	 $anterior = $pc - 1;
	 $proximo = $pc + 1;
	 if($pc > 1){
		 echo "<a class='btn card margin-bottom' href='?page=np-contact-list&paging={$anterior}' class='button'><< Anterior </a> ";
	 }
	 if($pc < $tp){
		 echo "<a class='btn card margin-bottom'  href='?page=np-contact-list&paging={$proximo}' class='button'> Próximo >></a>";
	 }//Fim dos botões 

?>