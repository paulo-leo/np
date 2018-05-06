<?php
include("../../../core/conn.php");
include("../../../core/create.php");
include("../../../functions.php");
np_timezone();
$message = stripcslashes(htmlspecialchars(np_ipost("message")));

$protocol = np_ipost("protocol");
$email = np_ipost("email");
$name = np_ipost("name");
$phone = np_ipost("phone");
$subject = np_ipost("subject");
$date = date("Y-m-d H:i:s");

if(strlen($message) >= 1 and  $message != " "){
$dados = ["message"=>$message, "email"=>$email, "name"=>$name, "phone"=>$phone, "subject"=>$subject, "datetime"=>$date, "protocol"=>$protocol];
np_insert(NP."contact_form", $dados);

echo 1;

}else{
   echo 2;
}


?>