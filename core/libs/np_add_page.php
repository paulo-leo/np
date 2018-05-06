<?php
/****Criação e inclusão de páginas*****/
function np_add_page($url, $file, $title="Página sem título"){
     global $np_add_page;
     $np_add_page[$url] = $file;
	 
	 global $np_add_paget;
     $np_add_paget[$url] = $title;
  }         
function np_include_page(){
global $np_add_page;
 if(isset($_GET['page'])){
    $page = $_GET['page'];
	$file = $np_add_page[$page];
	if(file_exists($file)){
		include($file);
	}else{ np_msg("<b>ERROR</b>: page there or not been defined with the function: <b>void np_add_page(string url, string file, option string title)</b><br><span class='tiny'>pt-br: página não existe ou não foi definida com a função: <b>np_add_page()</b></span>", "red"); }
    }}

	
function np_page_title(){
global $np_add_paget;
 if(isset($_GET['page'])){
       $nomet = $_GET['page'];
       echo $np_add_paget[$nomet]; }}
?>