<h2><i class='material-icons'>add_alert</i>Notificações já lidas</h2>
<?php
$tr = np_count(NP."notifications", "WHERE user_id = ".NP_USER_ID." AND status = 2");



if(isset($_GET['delete'])){
	$delete = $_GET['delete'];
	np_delete(NP."notifications", "WHERE ID = {$delete}", "Notificação deletada com sucesso.");
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
	/////, "WHERE user_id = {$id} AND status = 1 ORDER BY ID desc
	$inicio = $pc - 1;
	$inicio = $inicio * $total_reg;
	
    $limite = "WHERE user_id = ".NP_USER_ID." AND status = 2 ORDER BY id DESC LIMIT $inicio,$total_reg";
	
	/*verifica o numero total de páginas*/
	$tp = $tr / $total_reg; 
	 
$list_post = new Read;
$list_post->exeRead(NP."notifications", $limite); 
if($list_post->getRowCount() >= 1){ 
foreach($list_post->getResult() as $row){
	    echo "<li class='panel pale-white leftbar card border-green' style='border-bottom:none;'>{$row['message']}<br><b>".np_time($row['datetime'], "time+", " às ")."</b><br><a title='Visualizar' class='btn' href='{$row['link']}'><i class='material-icons'>visibility</i></a>
				 <a title='Deletar' class='btn' href='?page=notifications2&delete={$row['ID']}&paging'><i class='material-icons'>delete</i></a>
	         </li>";
	}}else{
		echo "<h3 class=''><i class='material-icons'>report_problem</i>Nenhuma notificação já lida no momento.</h3>";
}}
?>
</ul>
<?php
//Inicio dos botões proximo e voltar
	 $anterior = $pc - 1;
	 $proximo = $pc + 1;
	 if($pc > 1){
		 echo "<a href='?page=notifications2&paging={$anterior}' class='button'><< Anterior </a>";
	 }
	 if($pc < $tp){
		 echo "<a href='?page=notifications2&paging={$proximo}' class='button'> Próximo >></a>";
	 }//Fim dos botões 

?><br>