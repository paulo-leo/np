<?php
include("core/conn.php");
include("core/read.php");
include("core/update.php");
include("functions.php");
the_style();
echo "<h2 class=''><a class='btn white' href='".NP_URL."'><i class='material-icons'>phonelink_lock</i>".NP_NAME."</a></h2>";
if(isset($_GET['token'])){
      $token = stripcslashes(htmlspecialchars($_GET['token']));
      //Vai retornar os dados do token
	  if(np_count(NP."users", "WHERE user_token = '{$token}'") == 1){
		  $token_date = np_return_id(NP."users", "user_token_date", "WHERE user_token = '{$token}'");
		  
		  $user_id = np_return_id(NP."users", "ID", "WHERE user_token = '{$token}'");
		  
		 //Verifica se o token está válido
		 if($token_date == date('dmY')){
			
			echo "<div class='card padding margin' style='max-width:500px'>
			       <form method='post'>
				   <p>Recuperação de senha via token de segurança. </p>
				   <input type='hidden' name='alterPass' value='{$token}' />
				    <input type='hidden' name='np_user_id' value='{$user_id}' />
				      <p>Nova senha:
				      <input class='input' name='pass1' type='password'/></p>
					  <p>Digite novamente a sua nova senha:
				      <input class='input' name='pass2' type='password'/></p>
					  <input type='submit' class='btn green' value='Salvar senha'/>
				   </form>";
//Altera a senha e apaga o token para que não tenha reuso
if(isset($_POST['alterPass']) and $_POST['alterPass'] == $token){
	$pass1 = $_POST['pass1']; $pass2 = $_POST['pass2'];
	if($pass1 == $pass2 and strlen($pass1) >= 6){
		
		//Iniciando a operação para alteração da senha
		$update = new Update;
        //Campo e valor a ser atualizado
        $new_password = ["user_pass" => md5($pass1), "user_token"=>" ", "user_token_date"=>" "];
	    $new_pass_id = np_ipost("np_user_id");
        //Execultar query
        $update->exeUpdate(NP."users",  $new_password, "WHERE ID = :id", "id=$new_pass_id");
        np_msg("Sua senha foi alterada com sucesso!<br><a href='admin/login.php' title='Acessar sua conta'>Clique aqui</a> para acessar a sua conta com a sua nova senha. ","green");
		
		
	}else{
		np_msg("Erro: Senhas não conferem ou o número de caracteres digitados foi menor do que 6. ", "red");
	}
}
				   
				   
			      echo "<p class='text-red tiny padding'>Ambiente seguro e autenticado via token que é validado via link enviado para o  endereço de e-mail do usuário cadastrado. <br>Este ambiente pertence ao seguinte domínio:<b>".NP_URL."</b>. Antes de inserir qualquer dado, sempre confira o HTTPS do site que você está acessando </p></div>"; 
			 
		 }else{
			 np_msg("Este token está inspirado.", "red"); 
		 }
		  
		  
	  }else{
		  np_msg("Token inválido.", "red");
		  echo "<p class='padding'>Para gerar um novo token de recuperação de senha é necessário acessar a <a title='Página de login' href='admin/login.php'>página de login</a> e clicar no botão \"Perdeu a senha?\".</p>";
	  }
}




?>