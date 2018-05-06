<?php
//Funções gerais do sistema
/*Mensagens*/
function np_msg($msg, $type=null){
if($type == "success" or $type == "green"){ echo "<div class='panel np-msg small pale-green animate-right padding leftbar border-green'>$msg</div>";}
elseif($type == "error" or $type == "red"){ echo "<div class='panel small pale-red animate-right padding np-msg leftbar border-red'>$msg</div>";}
elseif($type == "alert" or $type == "yellow"){ echo "<div class='panel small pale-yellow animate-right np-msg padding leftbar border-yellow'>$msg</div>";}
else{ echo "<div class='panel np-msg animate-right pale-blue small padding leftbar border-blue'>$msg</div>";}
}
//Imprime algo em tela
function np_print($msg){ echo $msg; }
//Imprime ou retorna o nome ou numero do nivel do usuário
function np_nivel_user($x, $p=false){
	 $ar = [1=>"Admistrador", 2=>"Editor", 3=>"Autor", 4=>"Leitor"];
	 if($p == true){ return $ar[$x]; }else{
		 echo $ar[$x];
	 }
}
//Bloqueia o script
function np_no_access($x){
if($x == false){ exit("<div class='row'><h2 class='text-red'><i class='material-icons'>visibility_off</i> Acesso negado</h2>
<p>Desculpe! Você não tem permissão para acessar a este conteúdo.</p>
</div>"); } }
//Retorna cores aleatorias
function np_rand_color($p=false){
$x = mt_rand(0, 8); 
$a = array("blue", "red", "pink", "green", "orange", "indigo", "purple", "lime", "teal");
if($p == true){ echo $a[$x]; }else{ return $a[$x]; }	
}
?>