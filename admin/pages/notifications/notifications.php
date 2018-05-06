<h2><i class='material-icons'>add_alert</i>Notificações</h2>
<?php
$trt = np_count(NP."notifications", "WHERE user_id = ".NP_USER_ID);
$tr = np_count(NP."notifications", "WHERE user_id = ".NP_USER_ID." AND status = 1");
$tr2 = np_count(NP."notifications", "WHERE user_id = ".NP_USER_ID." AND status = 2"); 

if($tr2 > 0 or $trt > 2){
echo "<div class='dropdown-hover display-topright'>
<button class='button white'><i class='material-icons'>settings_applications</i> Opções avançadas</button>
<div class='dropdown-content bar-block border'>";
if($tr2 > 0){
echo "<a href='?page=notifications2&paging' class='bar-item button border-bottom'><i class='material-icons'>visibility</i> Visualizar notificações que já foram lidas.</a>";
}
echo "<a href='?page=notifications&update-all&paging' class='bar-item button border-bottom'><i class='material-icons'>done</i> Marcar todas as notificações como já lidas.</a>
<a href='?page=notifications&delete-all&paging' class='bar-item button'><i class='material-icons'>delete</i> Apagar todas as notificações </a>
</div>
</div>";}

if(isset($_GET['delete'])){
	$delete = $_GET['delete'];
	np_delete(NP."notifications", "WHERE ID = {$delete}", "Notificação deletada com sucesso.");
}
if(isset($_GET['update'])){
	$update = $_GET['update'];
	$note = ["status"=>2];
	np_update(NP."notifications", $note, "WHERE ID = {$update}", "Notificação marcada como lida com sucesso");
}
if(isset($_GET['delete-all'])){
	np_delete(NP."notifications", "WHERE user_id = ".NP_USER_ID, "Todas as suas notificações foram deletadas com sucesso.");
}
if(isset($_GET['update-all'])){
	$note = ["status"=>2];
	np_update(NP."notifications", $note, "WHERE user_id = ".NP_USER_ID, "Todas as suas notificações foram marcadas como já lidas.");
}
if($trt > 1){
	echo "<p class='border padding center'>Total de notificações:{$trt} | Não lidas:{$tr} | Já lidas:{$tr2}</p>";
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
	
    $limite = "WHERE user_id = ".NP_USER_ID." AND status = 1 ORDER BY id DESC LIMIT $inicio,$total_reg";
	
	/*verifica o numero total de páginas*/
	$tp = $tr / $total_reg; 
	 
$list_post = new Read;
$list_post->exeRead(NP."notifications", $limite); 
if($list_post->getRowCount() >= 1){ 
foreach($list_post->getResult() as $row){
	    echo "<li class='panel pale-white leftbar border-yellow card' style='border-bottom:none;'>{$row['message']}<br><b>".np_time($row['datetime'], "time+", " às ")."</b><br><a title='Visualizar' class='btn' target='_blank' href='{$row['link']}'><i class='material-icons'>visibility</i></a>
				 <a class='btn' title='Deletar' href='?page=notifications&delete={$row['ID']}&paging'><i class='material-icons'>delete</i></a>
				 <a title='Marcar como lida' class='btn' href='?page=notifications&update={$row['ID']}&paging'><i class='material-icons'>done</i></a>
	         </li>";
	}}else{
		echo "<h3 class=''><i class='material-icons'>report_problem</i>Nenhuma notificação não lida no momento.</h3>";
}}
?>
</ul>
<?php
//Inicio dos botões proximo e voltar
	 $anterior = $pc - 1;
	 $proximo = $pc + 1;
	 if($pc > 1){
		 echo "<a href='?page=notifications&paging={$anterior}' class='button'><< Anterior </a>";
	 }
	 if($pc < $tp){
		 echo "<a href='?page=notifications&paging={$proximo}' class='button'> Próximo >></a>";
	 }//Fim dos botões 

?><br>