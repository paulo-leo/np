<?php
function np_file_news($title="Últimos arquivos enviados", $class="col right center m6 padding card-4"){
echo "<div class='{$class}'>
    <h5>{$title}</h5>";	
     $news_files = np_query("SELECT * FROM ".NP."files ORDER BY id DESC limit 9");
     if($news_files){
		foreach($news_files as $id){
		if($id['file_type'] == "image"){
			echo "<div class='col m4 border border-white card'><a href='../{$id['file_url']}' data-fancybox='galeria' data-caption='{$id['file_title']} | Enviada em ".np_time($id['file_datetime'])."'><img style='width:100%; height:140px' class='example-image' src='../{$id['file_url']}' alt=''/></a>
           </div>";
		}elseif($id['file_type'] == "video"){
			echo "<div class='col m4 border border-white display-container'><a data-fancybox='galeria' href='../{$id['file_url']}'><img style='width:100%; height:140px' class='example-image' src='../content/uploads/system/video.png' alt=''/></a><span class='display-bottommiddle tiny text-white'>".substr($id['file_title'],0,30); if(strlen($id['file_title']) > 30){ echo "...</span></div>"; }else{ echo "</span></div>"; }
		}
		elseif($id['file_type'] == "som"){
			echo "<div class='col m4 border border-white display-container'><a data-fancybox='galeria' data-type='ajax' data-src='pages/files/functions/file-view?view-audio={$id['ID']}'><img style='width:100%; height:140px' class='example-image' src='../content/uploads/system/audio.png' alt=''/></a>
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
			echo "<div class='col m4 border border-white display-container'><a data-fancybox='galeria' data-type='iframe' data-src='".NP_URL."/{$id['file_url']}' href='javascript:;'><img style='width:100%; height:140px' class='example-image' src='../content/uploads/system/{$img}' alt=''/></a><span class='display-bottommiddle tiny text-white'>".substr($id['file_title'],0,30); if(strlen($id['file_title']) > 30){ echo "...</span></div>"; }else{ echo "</span></div>"; }
   
		}
		
	} 
	}
echo "</div>";
}
?>