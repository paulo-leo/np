<?php
include("../../core/conn.php");
include("../../core/read.php");
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
if(isset($_GET['where'])){
	$w = $_GET['where'];
}else{ $w = null; }

$limite1 = "$w ORDER BY id DESC LIMIT $o, $l";



$ct1 = new Read; 
$ct1->exeRead(NP."files", $limite1); 
if($ct1->getRowCount() >= 1){ 
foreach($ct1->getResult() as $row){ 
		 //Imagem
		 if($row['file_type'] == "image"){
			 echo "<div class='col card' style='width:120px; margin:3px'>
                   <div class='tooltip'>
				   <p class='text light-gray' style='position:absolute;left:0;top:-15px; z-index:2; padding:3px; font-size:9px'>{$row['file_title']}</p>
				   <img src='".NP_URL."/uploads/{$row['file_name']}' style='width:100%; height:90px'>
				   </div>
				   <p>
                   <input type='checkbox' id='midia{$row['ID']}' class='input' name='a' value='{$row['ID']}'/>
				   <label for='midia{$row['ID']}'><span style='font-size:10px'>".np_time($row['file_datetime'])."<br>Imagem</span></label></p>
                  </div>";
		 }
		 //Videos
		 elseif($row['file_type'] == "video"){
			echo "<div class='col card' style='width:120px; margin:3px'>
                   <div class='tooltip'>
				   <p class='text light-gray' style='position:absolute;left:0;top:-15px; z-index:2; padding:3px; font-size:9px'>{$row['file_title']}</p>
				   <img src='../uploads/system/video.png' style='width:100%; height:90px'>
				   </div>
				   <p>
                   <input type='checkbox' id='midia{$row['ID']}' class='input' name='a' value='{$row['ID']}'/>
				   <label for='midia{$row['ID']}'><span style='font-size:10px'>".np_time($row['file_datetime'])."<br>Vídeo</span></label>
				   </p>
                  </div>";

		 }
		 //Arquivos
		 else{
			echo "<div class='col card' style='width:120px; margin:3px'>
                   <div class='tooltip'>
				   <p class='text light-gray' style='position:absolute;left:0;top:-15px; z-index:2; padding:3px; font-size:9px'>{$row['file_title']}</p>
				   <img src='../uploads/system/".np_system_img($row['file_name']).".png' style='width:100%; height:90px'>
				   </div>
				   <p>
                   <input type='checkbox' id='midia{$row['ID']}' class='input' name='a' value='{$row['ID']}'/>
				   <label for='midia{$row['ID']}'><span style='font-size:10px'>".np_time($row['file_datetime'])."<br>Documento</span></label>
				   </p>
                  </div>";
		 }  
   } 
}else{
	echo 100;
}
  }
/////Ler e adiciona as midias
elseif($action = "ler-add"){

$ids = $_POST['ids'];

$nid = preg_replace("/[a=&]/i", " ", $ids);
$nid = trim($nid);
$nid = str_replace(" ", ",", $nid);
$nid = str_replace(array(",,,", ",,"), ", ", $nid);
$nid = trim($nid);


$where = "WHERE ID in($nid)";
$ct1 = new Read; 
$ct1->exeRead(NP."files", $where); 
if($ct1->getRowCount() >= 1){ 
foreach($ct1->getResult() as $row){ 
		 //Imagem
		 if($row['file_type'] == "image"){
			 echo "<img src='".NP_URL."/uploads/{$row['file_name']}' width='321' height='341'>";
		 }
		 //Videos
		 elseif($row['file_type'] == "video"){
			

		 }
		 //Arquivos
		 else{
			echo "<p style='card round center' style='padding:5px; font-size:12px;'>{$row['file_title']} <a style='text-decoration:none' href='".NP_URL."/uploads/{$row['file_name']}' target='_blank' class='btn round hover-gray light-gray border'>Baixar arquivo</a></p>";
		 }  
   } 
} 

	
  }
    }
?>

