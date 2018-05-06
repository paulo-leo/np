<?php
session_start();
if(isset($_SESSION['user_pass']) and isset($_SESSION['user_email'])){
/****INICIO*****/	
  $read = new Read;
  $read->exeRead(NP."users", "WHERE ID = :user_id", "user_id={$_SESSION['user_id']}");
  if($read->getRowCount() == 1){
	foreach($read->getResult() as $lin){
		define('NP_USER_ID', $lin['ID']);
		define('NP_USER_EMAIL', $lin['user_email']);
		define('NP_USER_FNAME', $lin['first_name']);
		define('NP_USER_LNAME', $lin['last_name']);
		define('NP_USER_PASS', $lin['user_pass']);
		define('NP_USER_TYPE', $lin['user_type']);	
		define('NP_USER_IMG', $lin['user_img']);
		define('NP_USER_DISPLAY', $lin['user_display']);
		define('NP_USER_ABOUT', $lin['user_about']);
	 }
  }
/****FIM******/
}else{
	header("Location:login.php");
}
?>
