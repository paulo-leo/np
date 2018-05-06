<?php
include("../../core/conn.php");
include("../../core/delete.php");
include("../../core/read.php");
include("../../functions.php");

$id = np_ipost('id'); 

$file_delete = np_return_id(NP."files", "file_name", "WHERE ID = {$id}");

@np_delete(NP."files", "WHERE ID = {$id}", "Arquivo deletado com sucesso");

unlink("../../uploads/".$file_delete);

echo '<div class="margin"><a href="#" onclick="document.getElementById(\'id01ww\').style.display=\'none\'" class="white border text-red btn block">Ok, fechar. </a></div>';
  


?>

