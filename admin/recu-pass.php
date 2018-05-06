<?php
include("../core/conn.php");
include("../core/read.php");
include("../core/update.php");
include("../functions.php");


$email = $_POST['emailrecu'];
if(filter_var($email, FILTER_VALIDATE_EMAIL)){

$msg = "<div style='max-width:500px; width:100%'>
<h2>Recuperação de senha</h2>
<p>Clique no link 1 para criar uma nova senha ou clique no link 2 para bloquear o link 1. 
Independente da opção escolhida, orientamos que você atualize a sua senha para sua maior segurança.</p></div>";

//Verifca se existe este email na base de dados:
if(np_count(NP."users", "WHERE user_email = '{$email}'")){
	$name = np_return_id(NP."users", "first_name", "WHERE user_email = '{$email}'");
   //Obtem o ID do usuário
	$user_id = np_return_id(NP."users", "ID", "WHERE user_email = '{$email}'");
	$token = md5(mt_rand(10, 99).date('dmYHis')).$user_id;
	$token_date = date('dmY');
	$dados = ["user_token"=>$token, "user_token_date"=>$token_date];
	@np_update(NP."users", $dados, "WHERE ID = '{$user_id}'");
	
	$link = NP_URL."/password-recovery.php?token={$token}";
	
	
	///Rotina para envio do e-mail com o token
	$to = $email;
       // subject
        $subject = NP_NAME." |Recuperação de senha";
       // message
     $message = "<html><head><title>Recuperação de senha</title> \n </head><body><h3>".NP_NAME." | Recuperação de senha</h3>\n<p>Olá {$name}! Para iniciar a recuperação de sua senha \n<a href='{$link}' target='_blank'>clique aqui!</a>\n</p></body></html>";
       $headers  = 'MIME-Version: 1.0' . "\r\n";
       $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
       // Mail it
       if(@mail($to, $subject, $message, $headers)){
		   
		    np_msg("Olá <b>{$name}</b>! Recebemos com sucesso a sua solicitação para recuperação da sua senha, e encaminhamos para o seu endereço de e-mail (o mesmo cadastrado no sistema) um link para o cadastramento de uma nova senha.<br> O link é valido por um período de 24 horas, após este prazo o link será inspirado automaticamente. ");
		   
	   }else{
		   np_msg("Erro: Uma falha de comunicação não permitiu o envio do token para o e-mail informado. Pedimos que tente novamente mais tarde. ", "yellow");
	   }
	

	
}else{
	np_msg("Desculpe! Não localizamos em nosso sistema nenhum cadastro vinculado ao endereço de e-mail informado.", "red");
}

}else{
	np_msg("O e-mail fornecido é invalido, pois não atende os parâmetros na formatação padronizada de um endereço e-mail. ", "red");
}



?>
