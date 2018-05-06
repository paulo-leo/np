<?php
include("../../core/conn.php");
include("../../functions.php");


//print_r($_POST);
//print_r($_FILES);

if(isset($_POST['acao'])){
switch($_POST['acao']){
	case 'cadastro':
		//print_r($_POST);
		//print_r($_FILES);
		if(isset($_FILES['arquivo'])){
		$pasta_id 	= $_POST['pasta_id'];
		$titulo 	= $_POST['titulo'];
		$descricao 	= $_POST['descricao'];
		$arquivo	= $_FILES['arquivo'];

		if(!$pasta_id){ $pasta_id = 1;}
		if(!$titulo){ $titulo = $arquivo['name']; }
		if(!$descricao){$descricao = "Arquivo sem descrição definida.";}
		
			$pasta = '../../uploads/';
			if(!file_exists($pasta)) mkdir($pasta,0755);
			
			if($arquivo['tmp_name']){
				$extencao = strchr($arquivo['name'],'.');
				$filename = md5(time()).$extencao;
				
				$imagem = array('.jpg','.jpeg','.png','.gif');
				$video  = array('.mp4','.wmv','.avi');
				$som  =   array('.mp3');
				
				if(in_array($extencao,$imagem)){
					$pasta 	= $pasta.'images/';
					$tipo	= 'image';
				}elseif(in_array($extencao,$video)){
					$pasta 	= $pasta.'videos/';
					$tipo	= 'video';
				}elseif(in_array($extencao,$som)){
					$pasta 	= $pasta.'sons/';
					$tipo	= 'som';
				}else{$pasta 	= $pasta.'files/';
					$tipo	= 'file';}
				if(!file_exists($pasta)) mkdir($pasta,0755);
				if(move_uploaded_file($arquivo['tmp_name'],$pasta.$filename)){
					$imagem = $tipo.'s/'.$filename;
					$data = date('Y-m-d H:i:s');				
					$qr  = "INSERT INTO ".NP."files (file_name, file_title, file_description, file_type, file_datetime, folder_id) ";
					$qr .= "VALUES ('$imagem', '$titulo', '$descricao', '$tipo', '$data', '$pasta_id')";
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
	
	case 'ler':
		$tipo = mysql_real_escape_string($_POST['tipo']);
		$tipo = ($tipo == 'arquivos' ? 'arquivo' : 
				($tipo == 'imagens' ? 'image' :
				($tipo == 'videos' ? 'video' : '')));
		
		if($tipo): $where = "WHERE tipo = '$tipo'"; endif;
		
		$qr = "SELECT * FROM mod7_imagens {$where} ORDER BY cadastro DESC";
		$ex = mysql_query($qr) or die (mysql_error());
		
		while($res = mysql_fetch_assoc($ex)):
			$conta++;
			$imagem = ($res['tipo'] == 'image' ? 'tim.php?src=uploads/'.$res['imagem'].'&w=273&h=120&a=t' : 
					  ($res['tipo'] == 'arquivo' ? 'img/filethumb.jpg' : 'img/videothumb.jpg'));
			
			echo '<li class="file j_'.$res['id']; if($conta%3==0) echo ' right'; echo '">';
				echo '<img src="'.$imagem.'" alt="Baixar arquivo" title="Baixar Arquivo" width="273" height="120" />';
				echo '<h2>'.$res['titulo'].'</h2>';
				echo '<p class="desc">'.$res['descricao'].'</p>';
				echo '<p class="data">Enviado em: '.date('d/m/Y',strtotime($res['cadastro'])).' às '.date('H:i',strtotime($res['cadastro'])).'h</p>';

				echo '<a href="uploads/'.$res['imagem'].'"';
					if($res['tipo'] == 'image') echo 'rel="shadowbox"';
					if($res['tipo'] == 'video') echo 'rel="shadowbox;width=853;height=480"';
				echo '>Veja isto!</a>';

				echo '<div class="manage">';
					echo '<a class="actionedit" href="'.$res['id'].'"><img src="img/edit.png" alt="" title="" /></a>';
					echo '<a class="actiondelete" href="'.$res['id'].'"><img src="img/delete.png" alt="" title="" /></a>';
				echo '</div>';
			echo '</li>';
		endwhile;
		
	break;
	
	case 'deletar':
		$delid = $_POST['delid'];
		$qr = "SELECT * FROM mod7_imagens WHERE id = '$delid'";
		$ex = mysql_query($qr) or die (mysql_error());
		$st = mysql_fetch_assoc($ex);
		
		$basepatch = '../uploads/';
		if(file_exists($basepatch.$st['imagem']) && !is_dir($basepatch.$st['imagem'])):
			unlink($basepatch.$st['imagem']);
		endif;
		
		$qr = "DELETE FROM mod7_imagens WHERE id = '$delid'";
		$ex = mysql_query($qr) or die (mysql_error());		
	break;
		
	default:
		echo 'Arquivo muito grande ou não compativel!';	
}}else{
	echo "<p class='panel pale-red leftbar border-red padding'>Ops! Arquivo grande demais! Configure o seu servidor para receber arquivos maiores.</p>";
}

?>