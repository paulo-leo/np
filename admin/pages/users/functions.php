<?php
include("../../../core/conn.php");
np_libs("../../../core/libs/");
np_timezone();

if(np_isset("add-user")){

if(np_check_date(np_ipost("data_nasc"))){
	$type = np_post("user_type", 4);
	$email = strtolower(np_ipost("email"));
	$fname = ucwords(np_ipost("first_name"));
	$lname = ucwords(np_ipost("last_name"));
	$pass = np_ipost("password");
	$registered = date("Y-m-d H:i:s");
	$img = "system/img-perfil.png";
	$display = $fname." ".$lname;
	$data_nasc = np_check_date(np_ipost("data_nasc"));
	//Verifica se o campo e-mail está vazio e se é um email valido
	if(filter_var($email, FILTER_VALIDATE_EMAIL)){
		$var_email_existe = np_count(NP."users", "WHERE user_email = '{$email}'");
		if($var_email_existe == 0){
		if(strlen($fname) < 2 OR strlen($lname) < 2){ np_msg("Nome ou sobrenome não podem ser vazios.", "red"); 
		}else{
     //Verifica se a senha foi preenchida
   	if(strlen($pass) < 4 OR $pass == " "){ 
	  np_msg("A senha não pode ser vazia ou menor que 4 caracteres.", "red");
	}else{  
	$password = md5($pass);
    $values = [
     "user_registered"=>$registered,
	 "user_email"=>$email,
     "first_name"=>$fname,
     "last_name"=>$lname,
	 "user_type"=>$type,
	 "user_display"=>ucwords($display),
	 "user_date"=>$data_nasc,
	 "user_img"=>$img,
	 "user_pass"=>$password,
     "user_status"=>2];
	np_cre(NP."users", $values, function(){
			np_msg("Usuário cadastrado com sucesso.", "blue");
			global $email;
			global $fname;
			$idn = np_obj("SELECT ID FROM ".NP."users WHERE user_email = '{$email}'");
			$user_name =  np_set_url(substr($fname, 0, 5).$idn->ID);
			np_upd(NP."users", array("user_name"=>$user_name), intval($idn->ID));
		}, "Erro interno no SGBD. Tente novamente mais tarde!");
	}
		} 
		   }else{
			 np_msg("Já existe um usuário utilizando o mesmo endereço de e-mail.", "red");
		}
		   }else{
	  np_msg("O e-mail fornecido é invalido.", "red");
	}
	/**/
  }else{
	  np_msg("Data de nascimento informada é invalida.", "red");
  }
}

///Atualizar usuário

if(np_isset("update-user")){
if(md5(np_ipost("pass_confirm2")) == np_ipost("pass_confirm1")){

if(np_check_date(np_ipost("data_nasc"))){
	$type = np_post("user_type", np_ipost("user_type_default"));
	$email = strtolower(np_ipost("email"));
	$user_id = np_ipost("user_id");
	$about = np_ipost("user_about");
	$fname = ucwords(np_ipost("first_name"));
	$lname = ucwords(np_ipost("last_name"));
    //Verifica a senha 
	$pass = np_ipost("password");
	if(strlen($pass) == 0){
		$pass = np_ipost("pass_default");
	    $password = $pass;
	}else{ 	$password = md5($pass); }
	
	$display = np_post("user_display", np_ipost("user_show"));
	$data_nasc = np_check_date(np_ipost("data_nasc"));
	//Verifica se o campo e-mail está vazio e se é um email valido
	if(filter_var($email, FILTER_VALIDATE_EMAIL)){
		$var_email_existe = np_count(NP."users", "WHERE user_email = '{$email}' AND ID != {$user_id}");
		if($var_email_existe == 0){
		$user_name = np_set_url(np_ipost("user_name"));
		
		$var_user_existe = np_count(NP."users", "WHERE user_name = '{$user_name}' AND ID != {$user_id}");
		if($var_user_existe == 0){
		if(strlen($fname) < 2 OR strlen($lname) < 2){ np_msg("Nome ou sobrenome não podem ser vazios.", "red"); 
		}else{
     //Verifica se a senha foi preenchida
   	if(strlen($pass) < 4 OR $pass == " "){ 
	  np_msg("A senha não pode ser vazia ou menor que 4 caracteres.", "red");
	}else{
	
    $values = [
	 "user_email"=>$email,
     "first_name"=>$fname,
     "last_name"=>$lname,
	 "user_type"=>$type,
	 "user_display"=>$display,
	 "user_about"=>$about,
	 "user_name"=>$user_name,
	 "user_date"=>$data_nasc,
	 "user_pass"=>$password];
	 //Inicio da atualização
	 np_upd(NP."users", $values, $user_id, 
	    function(){
		 np_msg("Perfil atualizado com sucesso.", "green");
	 }, function(){
		 np_msg("Nenhum campo foi atualizado, pois o sistema não identificou nenhuma alteração dos dados.", "yellow");
	 });
	 //fim da atualização
	 
	}
		} 
		}else{ 

         np_msg("O nome de usuário <b>\"{$user_name}\"</b> não está disponível para uso. Por este motivo você deve escolher outro nome de usuário. ", "yellow");
		}}else{
			 np_msg("Já existe um usuário utilizando o mesmo endereço de e-mail.", "red");
		}
		   }else{
	  np_msg("O e-mail fornecido é invalido.", "red");
	}
	/**/
  }else{
	  np_msg("Data de nascimento informada é invalida.", "red");
  }
}else{
	np_msg("Senha de confirmação não confere com sua senha atual.", "red");
}}
?>