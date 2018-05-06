<?php
include("../../../core/conn.php");
np_libs("../../../core/libs/");
include("../../../core/thema.php");

if(isset($_GET["info"]) and isset($_GET["id"])){
	$info = $_GET["info"];
	$id = intval($_GET["id"]);
	
	switch($info){
		//Categoria do post
		case "category" : 
		the_category($id);
		break;
		//Status do post
		case "visibility" :
		$v1 = np_obj("SELECT post_status FROM ".NP."posts WHERE ID = {$id}");
		$v = $v1->post_status;
		if($v == 1){
			echo "<i class='material-icons' style='position:relative;top:5px;'>language</i> Publico";
		}elseif($v == 2){
			echo "<i class='material-icons text-green' style='position:relative;top:5px;'>lock_outline</i> Restrito";
		}else{
			echo "<i class='material-icons text-red' style='position:relative;top:5px;'>visibility_off</i> Pendente";
		}
		break;
		//Informações gerais de comentários entre outros
		case "post-info-geral" :		
		
		break;
		
	 default : np_msg("Info não existe", "red");
	}
	
	
}else{
	np_msg("Erro ao selecionar ação", "red");
}

?>