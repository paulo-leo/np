<?php
include("../../core/conn.php");
include("../../core/read.php");
include("../../core/update.php");
include("../../functions.php");
/*Ofset*/

if(isset($_GET['action']) or isset($_POST['action'])){
	
if(isset($_POST['action'])){
	$action = $_POST['action'];
}else{ $action = $_GET['action']; }


///Leitura das midias
if($action == "ler"){
$o = $_GET['offset']; 
/*Limite*/
$l  =  $_GET['limit'];
//Condição
if(isset($_GET['where']) and $_GET['where'] != ""){
	$w = $_GET['where'];
	$w2 = "{$w} AND file_type = 'image'";
}else{ $w2 = "WHERE file_type = 'image'"; }
 
$limite1 = "$w2 ORDER BY id DESC LIMIT $o, $l";



$ct1 = new Read; 
$ct1->exeRead(NP."files", $limite1); 
if($ct1->getRowCount() >= 1){ 
foreach($ct1->getResult() as $row){ 
	  echo "<div class='col card' style='width:120px; margin:3px'>
                   <div class='tooltip'>
				   <p class='text light-gray' style='position:absolute;left:0;top:-15px; z-index:2; padding:3px; font-size:9px'>{$row['file_title']}</p>
				   <img src='".NP_URL."/uploads/{$row['file_name']}' style='width:100%; height:90px'>
				   </div>
				   <p>
                   <input type='radio' id='midia{$row['ID']}' class='input' name='a' value='{$row['ID']}'/>
				   <label for='midia{$row['ID']}'><span style='font-size:10px'>".np_time($row['file_datetime'])."<br>Imagem</span></label></p>
                  </div>";
		 }  
   } else{ echo 100;}
  }
/////Ler e adiciona as midias
elseif($action == "ler-add"){

$ids = $_POST['idImage'];
$post_id = $_POST['idPost'];

$nid = preg_replace("/[a=&]/i", " ", $ids);
$nid = trim($nid);
$nid = str_replace(" ", ",", $nid);
$nid = str_replace(array(",,,", ",,"), ", ", $nid);
$image_id = trim($nid);
$dados = ["post_image"=>$image_id];
@np_update(NP."posts", $dados, "WHERE ID = {$post_id}", "Imagem destacada definida com sucesso");
  
}elseif($action == "ler-image"){
$post_id = $_GET['id'];

$image = np_one(NP."posts", "post_image", "$post_id");


if($image != "0"){
	$image2 = np_one(NP."files", "file_name", "$image");
	echo "<img src='".NP_URL."/uploads/{$image2}' style='width:100%; max-height:400px' />";
}else{
	echo "<img src='".NP_URL."/uploads/system/post.jpg' style='width:100%; max-height:400px' />";
}
	
}elseif($action == "ler-remove"){
$post_id = $_GET['id'];

$image = np_one(NP."posts", "post_image", "$post_id");


if($image == "0"){
	np_msg("Já não existe imagem destacada definida para este post/página.", "yellow");
}else{
	$dados = ["post_image"=>"0"];
   @np_update(NP."posts", $dados, "WHERE ID = {$post_id}");
   echo "<p class='panel padding pale-red leftbar border-red'>Imagem destacada removida com sucesso.</p>";
}
	
}

}
    
?>

