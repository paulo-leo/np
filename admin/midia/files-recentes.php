<?php
include("../../core/conn.php");
include("../../core/read.php");
include("../../functions.php");

/*Limite*/
$l  =  2;


$limite1 = "ORDER BY id DESC LIMIT  $l";



$ct1 = new Read; 
$ct1->exeRead(NP."files", $limite1); 
if($ct1->getRowCount() > 0){ 

foreach($ct1->getResult() as $row){ 
		 //Imagem
		 if($row['file_type'] == "image"){
			 echo "<div class='animate-zoom'>
                   <img src='".NP_URL."/uploads/{$row['file_name']}' style='width:100%; max-width:150px; height:100px'><p class='small animate-left'>Arquivo de imagem<br>Enviado em: ".np_time($row['file_datetime'],"time+", " às ")."<br> Nome do arquivo:<br>{$row['file_title']}</p>
                  </div>";
		 }
		 //Videos
		 elseif($row['file_type'] == "video"){
			  echo "<div class='animate-zoom'>
                   <img src='../uploads/system/video.png' style='width:100%; max-width:150px; height:100px'><p class='small animate-left'>Arquivo de vídeo<br>Enviado em: ".np_time($row['file_datetime'],"time+", " às ")."<br> Nome do arquivo:<br>{$row['file_title']}</p>
                  </div>";

		 }
		 //Arquivos
		 else{
			  echo "<div class='animate-zoom'>
                   <img src='../uploads/system/".np_system_img($row['file_name']).".png' style='width:100%; max-width:150px; height:100px'><p class='small animate-left'>Arquivo de documento<br>Enviado em: ".np_time($row['file_datetime'],"time+", " às ")."<br> Nome do arquivo:<br>{$row['file_title']}</p>
                  </div>";
		 }  
   }
}else{
	echo "Nenhum arquivo enviado";
}
?>

