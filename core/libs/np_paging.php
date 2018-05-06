<?php
//Funções para criar páginação
function np_paging($table, $total=3, $cond=null, $paging="paging"){
global $np_paging_this_url_show;
$np_paging_this_url_show = $paging;
if(isset($_GET[$paging])){
	//Total de registros que será exibido por página
	$total_reg = $total; 
	$pagina = $_GET[$paging];
	if(!$pagina){
		$pc = 1;
	}else{
		$pc = $pagina;
	}
	$inicio = $pc - 1;
	$inicio = $inicio * $total_reg;
	
if($cond == null){
	$w = null;
}else{ $w = "WHERE ".$cond; }
	
$sql = "SELECT * FROM {$table} {$w} ORDER BY id DESC LIMIT $inicio,$total_reg";
$sql_total = "SELECT * FROM {$table} {$w}";
/*verifica o numero total de registros*/
$tr = count(np_query($sql_total)); 
$result = np_query($sql);
/*verifica o numero total de páginas*/
$tp = ($tr / $total_reg);
//Declaração das varivais globais
global $np_paging_total_pages;
global $np_paging_this_page;
global $np_paging_this_url;
global $np_paging_this_count;
global $np_paging_page_total;
$np_paging_this_count = $tr;
$np_paging_this_url = $paging;
$np_paging_total_pages = $tp;
$np_paging_this_page = $pc;
$np_paging_page_total = $total_reg;

return $result;
}else{ return false; }}
 
//Inicio dos botões proximo e voltar
function np_paging_btn($type="next", $class=" ", $text=" >> , << ", $url_more=null){
global $np_paging_this_url;
if(isset($_GET[$np_paging_this_url])){
global $np_paging_total_pages;
global $np_paging_this_page;
global $np_paging_this_count;
global $np_paging_page_total;
$total = ceil($np_paging_this_count/$np_paging_page_total);
$text = explode(",", $text);
if(!isset($text[1])){ $text[1] = " >> "; }


if($url_more != null){
	$url_bt = "?{$url_more}&{$np_paging_this_url}";
}else{
	$url_bt = "?{$np_paging_this_url}";
}

$tp = $np_paging_total_pages;
$pc = $np_paging_this_page;
	 $anterior = $pc - 1;
	 $proximo = $pc + 1;
if($tp > 1){
	  if($type == "next" or $type == "next/numeric"){
	  if($pc > 1){
		 echo "<a href='{$url_bt}={$anterior}' class='{$class}'>{$text[1]}</a>";
	  }}
	 //Botões numericos
	 if($type == "numeric" or $type == "next/numeric"){
	  for($i=1; $i < $total + 1; $i++){
	  echo "<a class='{$class}' href='{$url_bt}={$i}'>{$i}</a>";
	  }}
	  if($type == "next" or $type == "next/numeric"){
	 if($pc < $tp){
		 echo "<a href='{$url_bt}={$proximo}' class='{$class}'>{$text[0]}</a>";
}}}
//Fim dos botões 
}}
//Função para contar o numero de páginas
function np_paging_num($text1="", $text2="/"){
	global $np_paging_total_pages, $np_paging_this_page, $np_paging_this_url;
	$tp = $np_paging_total_pages;
    $pc = $np_paging_this_page;
	if(isset($_GET[$np_paging_this_url])){
		if($tp > 1){
			echo  $text1.$pc.$text2.ceil($tp);
		}
	}	
}
//Função para contar o numero de registros
function np_paging_count($print=false, $null="<b style='color:red'>Não há registros no momento.</b>"){
	global $np_paging_this_count;
	if($print == true){
		if($np_paging_this_count >= 1){
			echo $np_paging_this_count;
		}else{
			echo $null; 
		}
	}else{
	 return $np_paging_this_count; }	
}
//Mostrar os botoes
function np_paging_btn_show($text="Visualizar", $class=""){
	global $np_paging_this_url_show;
	$url =  $np_paging_this_url_show;
	if(!isset($_GET[$url])){
		echo "<a class='{$class}' href='?{$url}'>{$text}</a>";
	}		
}
?>