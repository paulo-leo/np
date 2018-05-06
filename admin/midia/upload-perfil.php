<?php
include("../../core/conn.php");
include("../../core/read.php");
include("../../functions.php");

//print_r($_POST);
//print_r($_FILES);

if(isset($_POST['acao'])){
switch($_POST['acao']){
	case 'cadastro':
		//print_r($_POST);
		//print_r($_FILES);
		if(isset($_FILES['arquivo'])){
		$arquivo	= $_FILES['arquivo'];
		$user_id = np_ipost("user_id");
		$file_path = np_ipost("file_path");
		$pasta = '../../content/uploads/users/';
			
			if($arquivo['tmp_name']){
				$extencao = strchr($arquivo['name'],'.');
				$filename = md5(time()).$extencao;
				
				$imagem = array('.jpg','.jpeg','.png','.gif');
				
				if(move_uploaded_file($arquivo['tmp_name'],$pasta.$filename)){
					$imagem = "users/".$filename;				
					$qr  = "UPDATE ".NP."users SET user_img = '{$imagem}' WHERE ID = '{$user_id}'";
					if($file_path != "system/img-perfil.png"){
						$file_delete = np_return_id(NP."users", "user_img", "WHERE ID = {$user_id}");
						unlink("../../content/uploads/".$file_delete);
					}
					
					np_exec($qr);				
					echo 1;
				}else{
					echo "<p class='panel pale-red leftbar border-red padding'>Erro ao enviar arquivo!</p>";
				}			
			}else{
				echo "<p class='panel pale-red leftbar border-red padding'>Favor envie um arquivo!</p>";	
			}
		}else{ echo "<p class='panel pale-red leftbar border-red padding'>Nenhum arquivo selecionado</p>"; }		
	break;
		
	default:
		echo 'Arquivo muito grande ou não compativel!';	
}}

///Leitura da imagem de perfil
if(isset($_GET['imgperfil'])){
	$id = $_GET['imgperfil'];
	$img = np_return_id(NP."users", "user_img", "WHERE ID = '{$id}'");
	echo "<img src='../content/uploads/{$img}' class='animate-bottom circle' style='width:100%; height:100%; max-width:250px; max-height:250px' />";
	
}


?>