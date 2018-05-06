<?php
include("../../../../core/conn.php");
np_libs("../../../../core/libs/");
np_timezone();
if(isset($_POST['action']) AND $_POST['action'] == "file_upload_db"){	
		if(isset($_FILES['file_upload'])){
		$folder_id 	= $_POST['folder_id'];
		$dir_module 	= $_POST['dir_module'];
		$return_img = $_POST['return_img'];
		
		$file_upload	= $_FILES['file_upload'];
	    $file_title = $file_upload['name'];
		$file_description 	= $file_upload['name'];
		$file_ext = strchr($file_upload['name'],'.');
		$file_types = $_POST['file_types'];
		$imagem2 = explode(",", $file_types);
		if(in_array($file_ext,$imagem2)){
		if(!$folder_id){ $folder_id = 1; }
		
		//Verfica se já existe algum arquivo no db com o mesmo título
		$file_count = np_count(NP."files", "WHERE file_title = '{$file_title}'");
		if($file_count == 0){
			 $file_name = $file_title;
		}else{
			 $file_num =  $file_count + 1;
		     $file_name = "{$file_num}_".$file_upload['name']; 
		}
			$folder = '../../../../content/uploads/';
			if(!file_exists($folder)) mkdir($folder,0755);
			
			if($file_upload['tmp_name']){
				
				
				$imagem = array('.jpg','.jpeg','.png','.gif');
				$video  = array('.mp4','.wmv','.avi');
				$som  =   array('.mp3');
				
				if(in_array($file_ext,$imagem)){
					$folder 	= $folder.'images/';
					$tipo	= 'image';
					$file_url = "content/uploads/images/{$file_name}";
				}elseif(in_array($file_ext,$video)){
					$folder 	= $folder.'videos/';
					$tipo	= 'video';
					$file_url = "content/uploads/videos/{$file_name}";
				}elseif(in_array($file_ext,$som)){
					$folder 	= $folder.'sons/';
					$file_url = "content/uploads/sons/{$file_name}";
					$tipo	= 'som';
				}else{
					
					$folder 	= $folder.'files/';
				    $file_url = "content/uploads/files/{$file_name}";
					$tipo	= 'file';  }
				if($dir_module != "false"){ 
				$folder = "../../../../content/modules/".$dir_module;
                $file_url = "content/modules/".$dir_module.$file_name;
				}
				if(!file_exists($folder)){ mkdir($folder,0755);}
				if(move_uploaded_file($file_upload['tmp_name'],$folder.$file_name)){
					$imagem = $tipo.'s/'.$file_name;
					$data = date('Y-m-d');				
					$sql  = "INSERT INTO ".NP."files (file_url, file_title, file_description, file_type, file_datetime, folder_id) ";
					$sql .= "VALUES ('$file_url','$file_title', '$file_description', '$tipo', '$data', '$folder_id')";
					np_exec($sql);	
                    if($return_img != "false" AND in_array($file_ext,$imagem2)){
						echo NP_URL."/{$file_url}"; 
					}else{
						/*Arquivo enviado com sucesso*/ echo "FILE_SEND";
					}					
				}else{ /*Erro desconhecido e interno ao enviar o arquivo ao enviar o arquivo. Tente novamente.*/ echo "FILE_ERROR";
				}			
			}else{ /*Arquivo não suportado pelo sistema ou ultrapassa o limite máximo permitido pelo servidor*/ echo "FILE_MAX";	}
		}else{ /*Arquivo não suportado pelo sistema ou ultrapassa o limite máximo permitido pelo servidor*/ echo "FILE_MAX";}	
		}else{ /*Nenhum arquivo selecionado*/ echo "FILE_NO"; }		
}
?>