<?php
//Funções para verificar condições de acesso do usuário:
//np_type() deve ser utilizada somente na area administrativa
function np_access($x){
	$x = explode(",", $x);
	if(in_array(NP_USER_TYPE, $x)){ return true;
	}else{ return false; }	
}
function np_admin(){
	if(NP_USER_TYPE == 1){ return true;
	}else{ return false; }	
}
function np_admins(){
	if(NP_USER_TYPE == 1 or NP_USER_TYPE == 2){ return true;
	}else{ return false; }	
}
function np_adminss(){
	if(NP_USER_TYPE == 1 or NP_USER_TYPE == 2 or NP_USER_TYPE == 3){ return true;
	}else{ return false; }	
}
function np_author(){
	if(NP_USER_TYPE == 3){ return true;
	}else{ return false; }	
}
function np_editor(){
	if(NP_USER_TYPE == 2){ return true;
	}else{ return false; }	
}
function np_reader(){
	if(NP_USER_TYPE == 4){ return true;
	}else{ return false; }	
}
function np_type_info(){
$x = array(1=>"1 = admin", 2=>"2 = editor", 3=>"3 = author", 4=>"4 = reader");
echo "<table class='border'>";
foreach($x as $id){
echo "<tr><td class='border'>{$id}</td></tr>";
}echo "</table>";}
//Notificações
//Cria uma notificação
function np_notification($user_id, $message, $link){
$dados = ["user_id"=>$user_id,
"datetime" => date('Y-m-d H:i:s'),
"message" => substr($message, 0, 150), 
"link"=> $link,
"status"=>1];
np_insert(NP."notifications", $dados);
}
function np_notification_count($id=null){
	if($id == null){
		$id = NP_USER_ID;
	}
	return np_count(NP."notifications", "WHERE user_id = {$id} AND status = 1");
}
function np_ds(){
define('NP_ISESSION', np_isession());
//Cria uma variavel para identificar o tipo de usuário
if(NP_ISESSION){
	$np_user_type = np_return_id(NP."users", "user_type", "WHERE ID = {$_SESSION['user_id']}");
	define('NP_USER_TYPE2', $np_user_type);
	global $np_user_type;
}else{ 
$np_user_type = 0;
define('NP_USER_TYPE2', 0);
global $np_user_type;} }
?>