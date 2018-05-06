<?php
//Funções do NP para com furmulários

function np_action($action_value, $action_name="np_action"){
	echo "<input type='hidden' name='{$action_name}' value='{$action_value}'/>";
}
function np_hidden($array, $value=null){
    if(is_array($array)){
	foreach($array as $name=>$value){
		echo "<input type='hidden' name='{$name}' value='{$value}'/> ";
	}}else{
	   echo "<input type='hidden' name='{$array}' value='{$value}'/>";	
	}
}
function np_act($action_name="np_action", $action_value="Indefinite"){
	return "<input type='hidden' name='{$action_name}' value='{$action_value}'/>";
}
function np_post($name, $value=1){
	if(!isset($_POST[$name])){
		return $_POST[$name] = $value;
	}else{ return  $_POST[$name]; }
}
function np_get($name, $value=1){
	if(!isset($_GET[$name])){
		return $_GET[$name] = $value;
	}else{ return  $_GET[$name]; }
}
function np_ipost($name){
	 return $_POST[$name];
}
function np_iget($name){
	 return $_GET[$name];
}

function np_isset($action){
if(isset($_POST['np_action']) and  $_POST['np_action'] == $action){
	return true;
  }else{ return false;}
}
//Verifica se existe uma veriavel do tipo post ou get
function np_is($action, $value=null, $method="post"){
if($method == "post"){
   if($value == null){
	   if(isset($_POST[$action])){ return true; }else{ return false;}
   }else{
	   if(isset($_POST[$action]) AND $_POST[$action] == $value){ return true; }else{ return false;}
   }  
}else{
	if($value == null){
	   if(isset($_GET[$action])){ return true; }else{ return false;}
   }else{
	   if(isset($_GET[$action]) AND $_GET[$action] == $value){ return true; }else{ return false;}
   } 
}}

function np_isset_get($action){
if(isset($_GET['np_action']) and  $_GET['np_action'] == $action){
	return true;
  }else{ return false;}
}
function np_bug_post(){
  var_dump($_POST);
}

?>