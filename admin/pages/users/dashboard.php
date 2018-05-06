<h4><?php 
$np_d1 =  date('G');
if($np_d1 > 0  and $np_d1 < 12){
	echo "Bom dia ";
}elseif($np_d1 >= 12 and $np_d1 < 18){
	echo "Boa tarde ";
}else{
	echo "Boa noite ";
}
np_print("<b>".NP_USER_FNAME."</b>"); 
?>!</h4>


<?php
if(np_admins()){
	include("nivel/admins.php");
}
elseif(np_author()){
	include("nivel/author.php");
}else{
	include("nivel/reader.php");
}
?>

