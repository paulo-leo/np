<?php
include("core/conn.php");
np_libs();
np_the();
include("core/create.php");
include("core/read.php");
include("core/update.php");
include("core/delete.php");
include("core/thema.php"); 
np_mods_functions();
//Verifica se existe a variável URL para realizar a inserção de páginas correspondente ao template
np_ds();
if(isset($_GET['id'])){
	
	$post_id = addslashes($_GET['id']);
	
	///Vai identificar a páginas
	if($_GET['url'] == "post" or $_GET['url'] == "page" or $_GET['url'] == "category"){
		
		if(!is_numeric($_GET['id'])){
			if($_GET['url'] == "category"){
				$post_id =  np_return_id(NP."categories", "ID", "WHERE slung = '$post_id'");
			}else{
				
				$post_id =  np_return_id(NP."posts", "ID", "WHERE slung = '$post_id'");
			}
			
			
			$post_id = intval($post_id);
			///Query para consulta
			if($_GET['url'] == "post" or $_GET['url'] == "page"){
				$postQueryObject = np_obj("SELECT * FROM ".NP."posts WHERE ID = {$post_id}");
				if($postQueryObject == false){
					header("Location:../404/");
				}
			}
			
			
		}
		
	}
	
	
	
}

define("NP_PATH_THEMA", "content/themes/".NP_THEMA."/");


function getHome(){
	global $post_id;
	if(isset($_GET["url"])){
	$url = $_GET['url'];	 
	
	if($url == null){
		$url = "home";
	}
	
   	
	
	//Função para verificar a existencia de uma certa publicação
	if($url == "post" or $url == "page"){ 
	   if(np_count(NP."posts", "WHERE ID = $post_id") == 1){
		   
		   if(file_exists(NP_PATH_THEMA.$url.".php")){
			 require_once(NP_PATH_THEMA.$url.".php");
		}else{
			 require_once(NP_PATH_THEMA."404.php");
		}
		  
	   }else{
		    require_once(NP_PATH_THEMA."404.php"); 
	   }
	}else{
		
		if(file_exists(NP_PATH_THEMA.$url.".php")){
			 require_once(NP_PATH_THEMA.$url.".php");
		}else{
			 require_once(NP_PATH_THEMA."404.php");
		}
		
	}

	}else{
		require_once(NP_PATH_THEMA."home.php");
	}
}


getHome();







?>