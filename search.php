<?php
include("core/conn.php");
include("core/read.php");
include("functions.php"); 
include("core/thema.php"); 

function the_search_result($class="padding"){
if(isset($_GET['q'])){
$q = stripcslashes(htmlspecialchars($_GET['q']));

if(strlen($q) < 2){
	echo "<h4 class='margin'>Para iniciar uma pesquisa é necessário digitar no mínimo 2 caracteres (letras ou números).</h4>";
}else{

$sql = "WHERE post_title LIKE '{$q}%' OR post_date LIKE '{$q}%' AND post_status in (1, 2) ORDER BY ID DESC LIMIT 30";
echo "<div class='{$class}'>";
$read = new Read;
$read->exeRead(NP."posts", $sql);
if($read->getRowCount() >= 1){
	//Quanta a quantidade de rsultados localizados
		if($read->getRowCount() > 1){
			echo "<i>{$read->getRowCount()} itens encontrados para <b>\"{$q}\"</b></i>";
		}else{
             echo "<i>{$read->getRowCount()} item encontrado para <b>\"{$q}\"</b></i>";
		}
		////Fim
	foreach($read->getResult() as $lin){
		
		if($lin['post_type'] == 1){
			echo "<h5><b>{$lin['post_title']}</b></h5>
			<p>Publicação do blog/portal <a class='text-blue' href='".NP_URL."/post/{$lin['slung']}'>visualizar post</a></p> <b style='font-size:10px'>{$lin['post_date']}</b><hr>";
		}else{
			echo "<h5><b>{$lin['post_title']}</b></h5>
			<p>Página estática/institucional <a class='text-blue' href='".NP_URL."/page/{$lin['slung']}'>Acessar página</a></p> <b style='font-size:10px'>{$lin['post_date']}</b><hr>";
		}
		
		
	 }
  }else{
	  echo "<h4>Desculpe! A sua pesquisa não retornou nenhum resultado para \"{$q}\".</h4>";
       }
	    echo "</div>";
	}
	
   }
  
}
the_style();
include("content/themes/".NP_THEMA."/search.php");

?>