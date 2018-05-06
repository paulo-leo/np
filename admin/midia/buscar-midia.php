<?php
include("../../core/conn.php");
include("../../core/read.php");
include("../../functions.php");
$where = $_GET['where'];

/*Ofset*/


/*Limite*/
$l  =  10;


$limite1 = "WHERE file_title = '{$where}' ORDER BY id DESC LIMIT  $l";



$ct1 = new Read; 
$ct1->exeRead(NP."files", $limite1); 
if($ct1->getRowCount() > 0){ 
echo "<div class='row-padding' style='margin:0 -16px'>";
echo "<p>Exibindo o resultado da busca por \"{$where}\"</p>";
foreach($ct1->getResult() as $row){ 
		 //Imagem
		 if($row['file_type'] == "image"){
			 echo "<div class='third tooltip card'>
               <img src='".NP_URL."/uploads/{$row['file_name']}' style='width:100%; height:180px' alt='Northern Lights'>
			   <p class='text black padding' style='position:absolute;left:0;bottom:70px'>Imagem: {$row['file_title']}</p>
			   <a href='#' name='image' src='".NP_URL."/uploads/{$row['file_name']}' class='btn-add-file block btn white border-bottom hover-green'>Adicionar</a>
             </div>";
		 }
		 //Videos
		 elseif($row['file_type'] == "video"){
			 echo "<div class='third tooltip card'>
			 <i class='material-icons display-topmiddle padding text-red'>videocam</i>
			 <video style='width:100%; height:180px'><source class='btn-add-file' src='".NP_URL."/uploads/{$row['file_name']}' type='video/mp4'></video>
			  <p class='text black padding' style='position:absolute;left:0;bottom:70px'>Vídeo: {$row['file_title']}</p>
			 <a href='#' name='video' src='".NP_URL."/uploads/{$row['file_name']}' class='btn-add-file block btn white border-bottom hover-green'>Adicionar</a>
             </div>";

		 }
		 //Arquivos
		 else{
			 echo "<div class='third tooltip card'>
			 <i class='material-icons display-topmiddle text-green padding'>assignment</i>
			 <img src='".NP_URL."/uploads/system/doc.png' style='width:100%; height:180px' alt='Northern Lights' class=''>
			 <p class='text black padding' style='position:absolute;left:0;bottom:70px'>Arquivo: {$row['file_title']}</p>
			 <a href='#' name='doc' title='{$row['file_title']}' src='".NP_URL."/uploads/{$row['file_name']}' class='btn-add-file block btn white border-bottom hover-green'>Adicionar</a>
             </div>";
		 }  
   }
echo "</div>";
}else{
	echo "Nenhum arquivo com o título <b>\"{$where}\"</b> foi encontrado!";
}
?>

