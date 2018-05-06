<?php
include("../core/conn.php");
np_libs("../core/libs/");
np_the("../core/the/");
np_timezone();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Login</title>
<link rel="stylesheet" href="front/css/style.css">
<link rel="stylesheet" href="front/icons/material.css">
<script src="front/js/jquery.js"></script>
<script>
$(document).ready(function(){
	$(".btn-recu-pass").click(function(){
		$(".resp-recu-pass").hide();
		$(".modal-recu-pass").toggle("fast");
	});
	$(".loading-recu-pass, .resp-recu-pass").hide();
	$(".form-recu-pass").submit(function(){
		$.ajax({
	    url:"recu-pass.php",
		type:"POST",
		data: $(this).serialize(),
		beforeSend: function(){ 
		$(".loading-recu-pass").show();
		 $(".resp-recu-pass").hide("fast");
		},
		success: function(data){ 
		    $(".resp-recu-pass").show("fast");
			$(".resp-recu-pass").html(data);
			$(".loading-recu-pass").hide();
		} 
		
		});
		
		return false;
	});
	
});
</script>
</head>
<body style="background-color:#f1f1f1">
<form method="post" class="content card white" style="max-width:400px">
<header class="green"><h3 class="center">
<a class="" href='<?php echo NP_URL; ?>'>
<img src="../content/uploads/system/logo_np.png" width="150px"/>
</a></h3></header>
<?php
if(np_isset("user_login")){
	$email = filter_var(np_ipost("user_email"), FILTER_SANITIZE_STRING);
	$pass =  md5(np_ipost("user_pass"));
	if($email){
	//realiza a consulta na tabela users
    $login_sql = "SELECT * FROM ".NP."users WHERE user_email = '{$email}' OR user_name = '{$email}' AND user_pass = '{$pass}' AND user_status IN (1, 2)";
	$login = np_obj($login_sql);
	var_dump($login);
    if($login != false){
		session_start();
		$_SESSION['user_id'] = $login->ID;
		$_SESSION['user_pass'] = $login->user_pass;
		$_SESSION['user_email'] = $login->user_email;
		
		if(isset($_SESSION['user_pass']) and isset($_SESSION['user_email'])):
		
		$id = intval($login->ID);
		$acess_count = intval($login->user_access_count) + 1;
		$status = ["user_status"=>1, 
		"user_date_login"=>date('Y-m-d H:i:s'), 
		"user_access_count"=>$acess_count];
		
		np_upd(NP."users", $status, $id);
		
		header("Location:index.php?page=dashboard");
		
	    endif;
   }else{ header("Location:login.php?error_login"); }
	}else{
		header("Location:login.php?error_email");
	}
}
//Encerrando a sessão
if(isset($_GET['logout'])){
	session_start();
	$_SESSION = array();
	    ///Muda o status para desconecatado
	    $id = intval($_GET['logout']);
		$status = ["user_status"=>2];
		np_upd(NP."users", $status, $id);
	
	session_destroy();	
} 
	if(isset($_GET['logout'])){
		np_msg("Sua sessão foi encerrada com sucesso.", "yellow");
	}
	if(isset($_GET['error_email'])){
		np_msg("E-mail ou nome de usuário informado é invalido.", "red");
	}
	if(isset($_GET['error_login'])){
		np_msg("E-mail, nome de usuário ou senha inválidos! Tente novamente.", "red");
	}
?>
<?php np_action("user_login"); ?>
<div class="padding">
<p>
<input placeholder="Nome de usuário ou e-mail. " type="text"  class="input" name="user_email"/></p>
<p>
<input placeholder="Senha" type="password" riquered class="input" name="user_pass"/></p>
<input type="submit" class="btn white block border border-green" value="Entrar"/>
<a href="#" class="center margin-top btn white border btn-recu-pass">Perdeu a senha?</a>
</div>
</form>
<div class="modal modal-recu-pass">
    <div class="modal-content center" style="max-width:400px">
	<header><h2>Recuperar senha</h2>
	<a href="#" class="btn red display-topright btn-recu-pass">X</a>
	</header>
	<form class="form-recu-pass padding">
	<input type="text" riquered  class="input margin-bottom" placeholder="Digite aqui o seu e-mail" name="emailrecu">
	<input type="submit"  class="btn white block border border border-green" value="Obter nova senha"/>
	</form>
	<div class="loading-recu-pass">
	<div class="progress light-gray">
      <div class="indeterminate green"></div>
   </div>
	<p class="animate-fading">Por favor, aguarde! Estamos realizando a solicitação ao servidor.</p>
	</div>
	<div class="resp-recu-pass"></div>
	</div>
</div>
</body>
</html>
