<?php
//Funções NP para lidar com os módulos
//Função para o imprimir trechos de códigos/gatilho
function np_hook($p1, $p2){
	global $np_hook_array;
	$np_hook_array[$p1][] = $p2;
    return $np_hook_array;
}
function np_hook_loop($look_name){
global $np_hook_array;
for($i = 0; $i < count($np_hook_array[$look_name]); $i++){
	 echo $np_hook_array[$look_name][$i];
}}	   
/****Criação e inclusão de páginas no site para o usuário final*****/
function np_page_app($url, $file, $title="Página sem título"){
     global $np_page_app;
     $np_page_app[$url] = $file;
	 
	 global $np_page_appt;
     $np_page_appt[$url] = $title;
  } 
function np_aux_title_app(){
global $np_page_appt;
global $post_id;
echo $np_page_appt[$post_id];
}  
//Link app inicio
function np_link_app($name, $url, $icon=null, $class=null){
   global $np_link_app;
   if($icon == null){ $icon = null; }else{
	  $icon = "<i class='material-icons'>{$icon}</i>"; 
   }
   
   $link = "<a href='".NP_URL."/app/{$url}' title='{$name}' class='{$class}'>{$icon}{$name}</a>";
   $np_link_app[] = $link;
   return $np_link_app;
}
function np_loop_link_app($a=null, $b=null){  
global $np_link_app;
for($i=0;$i < count($np_link_app); $i++){
    echo $a.$np_link_app[$i].$b;
}}
//Função para contar a quantidade de link de apps criadas
    function np_count_link_app(){
		global $np_link_app;
	    return count($np_link_app);
	  }
function np_cam($file, $type){
	switch($type){
		case "mod": 
		include("../content/modules/{$file}");
		break;
		case "thema": 
		include("../content/themes/thema{$file}");
		break;
	}
}
function np_var_mod($file){
		return NP_URL."/content/modules/{$file}";
}
function np_var_thema(){
		return NP_URL."/content/modules/".NP_THEMA;
}
//Função para execultar uma função sem parametro caso o primeiro argumento da função seja verdadeiro. O terceiro argumento é opcional e se refere a uma mensagem
function np_callback($paran, $callback, $msg=null){
   if($paran == true){
	   call_user_func($callback);
   }else{
	   echo $msg;
   } 
}
function np_subcategory($campo, $id){
	$read = new Read; 
	$read->exeRead(NP."categories", "WHERE subcategory = {$id}"); 
	if($read->getRowCount() >= 1){ 
	foreach($read->getResult() as $lin){ 
	return $lin[$campo]; } }else{
		return "Sem subcategoria";
	}
}
//Função que verifica a existencia de uma sessão aberta de um usuário NP
function np_isession(){
	session_start();
	if(isset($_SESSION['user_id']) AND isset($_SESSION['user_pass']) AND isset($_SESSION['user_email'])){
		return true;
	}else{ return false; }
}
function np_isession2(){
	if(isset($_SESSION['user_id']) AND isset($_SESSION['user_pass']) AND isset($_SESSION['user_email'])){
		return true;
	}else{ return false; }
}
function np_mods_functions(){
$list_mods = new Read;
$list_mods->exeRead(NP."mods", ""); 
if($list_mods->getRowCount() >= 1){
foreach($list_mods->getResult() as $row){
    include_once("content/modules/{$row['mod_id']}/functions.php"); 	  
}}}
function np_aux_contador(){
global $post_id;
$view = np_one(NP."posts", "post_views", $post_id);
$view2 = $view + 1;
$new_view = ["post_views"=>$view2];
@np_update(NP."posts", $new_view, "WHERE ID = {$post_id}");
}
function np_have($x="post"){
	if($x == "post"){
		$w = "WHERE post_type = 1";
	}elseif($x == "page"){
		$w = "WHERE post_type = 2";
	}
	return np_count(NP."posts", $w);
}	

///Opção de folder
function np_folder_list($tag="option", $class=null, $link=null){
$list_mods = new Read;
$list_mods->exeRead(NP."folder", ""); 
if($list_mods->getRowCount() >= 1){
foreach($list_mods->getResult() as $row){
	if($tag == "a"){ $link1 = "href='{$link}{$row['ID']}'";
      $value = null;	
	}else{
		$value = "value='{$row['ID']}'";
	}
	$folder = np_count(NP."files", "WHERE folder_id = {$row['ID']}");
	if($folder > 0){ $bag = "<span class='badge red small'>{$folder}</span>"; }else{ $bag = null; }
	
	if($class == "no-badge"){ $bag = null; }
	
    echo "<{$tag} {$link1} class='{$class}' {$value}>{$row['folder_name']} {$bag}</{$tag}>"; }}}

?>