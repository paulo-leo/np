<?php
np_no_access(np_adminss());
echo "<h4><i class='material-icons'>view_quilt</i><span style='position:relative;top:-5px'>Galeria de arquivos</span> <button title='Filtrar arquivos' class='np-btn hover-text-blue card' style='position:relative;top:-5px'><i class='material-icons'>search</i></button></h4>";
$limite = "";
$file = np_paging(np_p("files"), 24, $limite);
echo "<div class='padding-left; padding-right;'>"; 
if(np_paging_count()){
	foreach($file as $id){
		if($id['file_type'] == "image"){
			echo "<div class='left border border-white display-container'>
			<a href='?page=file-edit&id={$id['ID']}&menu=file' class='np-btn display-topleft hover-red'><i class='material-icons'>edit</i></a>
			<a href='../{$id['file_url']}' data-fancybox='galeria' data-caption='{$id['file_title']} | Enviada em ".np_time($id['file_datetime'])."'><img style='width:160px; height:140px' class='animate-zoom' src='../{$id['file_url']}' alt=''/></a>
           </div>";
		}elseif($id['file_type'] == "video"){
			echo "<div class='left border border-white display-container'>
			<a href='?page=file-edit&id={$id['ID']}&menu=file' class='np-btn display-topleft hover-red'><i class='material-icons'>edit</i></a>
			<a data-fancybox='galeria' href='../{$id['file_url']}'><img style='width:160px; height:140px' class='animate-zoom' src='../content/uploads/system/video.png' alt=''/></a><span class='display-bottommiddle tiny text-white'>".substr($id['file_title'],0,30); if(strlen($id['file_title']) > 30){ echo "...</span></div>"; }else{ echo "</span></div>"; }
		}
		elseif($id['file_type'] == "som"){
			echo "<div class='left border border-white display-container'>
			<a href='?page=file-edit&id={$id['ID']}&menu=file' class='np-btn display-topleft hover-red'><i class='material-icons'>edit</i></a>
			<a data-fancybox='galeria' href='#' data-type='ajax' data-src='pages/files/functions/file-view?view-audio={$id['ID']}'><img style='width:160px; height:140px' class='animate-zoom' src='../content/uploads/system/audio.png' alt=''/></a>
			<span class='display-bottommiddle tiny text-white'>".substr($id['file_title'],0,30); if(strlen($id['file_title']) > 30){ echo "...</span></div>"; }else{ echo "</span></div>"; }
		}else{
			$file_ext = strchr($id['file_url'],'.');
			switch($file_ext){
				case ".pdf" : $img = "pdf.png"; break;
				case ".docx" : $img = "docx.png"; break;
				case ".html" : $img = "html.png"; break;
				case ".css" : $img = "css.png"; break;
				case ".xlsx" : $img = "xlsx.png"; break;
				default : $img = "doc.png"; break;
			}
			echo "<div class='left border border-white display-container'>
			<a href='?page=file-edit&id={$id['ID']}&menu=file' class='np-btn display-topleft hover-red'><i class='material-icons'>edit</i></a>
			<a data-fancybox='galeria' data-type='iframe' data-src='".NP_URL."/{$id['file_url']}' href='javascript:;'><img style='width:160px; height:140px' class='animate-zoom' src='../content/uploads/system/{$img}' alt=''/></a><span class='display-bottommiddle tiny text-white'>".substr($id['file_title'],0,30); if(strlen($id['file_title']) > 30){ echo "...</span></div>"; }else{ echo "</span></div>"; }
   
		}
		
	}
echo "<div class='col m12'><span style='position:relative;top:10px'>"; np_paging_num(" Página ", " de "); echo "</span>";
np_paging_btn("next/numeric", "btn hover-light-gray border white btn-nav tiny", "Avançar, Voltar", "page=file&menu=file");
echo "</div>";
}
	
echo "</div>";
?>
      