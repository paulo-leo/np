<?php np_no_access(np_admin());
$id = $_GET['id'];
$pg = $_GET['paging'];
$user = np_obj("SELECT user_display, user_type, user_img FROM ".NP."users WHERE ID = {$id}");
$type = $user->user_type;
echo "<h3>Excluir usuário</h3>";
echo "<h5><img src='../content/uploads/{$user->user_img}' width='150px' height='150px' class='circle' style='height:150px; width:150px;'/><br><b>{$user->user_display}</b></h5><p class='small'>"; 
if($type == 1){ echo "<i class='material-icons'>lock</i> Administrador";}
elseif($type == 2){ echo "<i class='material-icons'>edit</i> Editor";}
elseif($type == 3){ echo "<i class='material-icons'>class</i> Autor";}
else{ echo "<i class='material-icons'>turned_in</i> Leitor";}
echo "</p><p>Excluir este usuário definitivamente do sistema?</p>
<form method='post' action='?page=users&menu=users&paging={$pg}'>
<a href='?page=users&menu=users&paging={$pg}' class='np-btn border hover-border-blue hover-blue'>Cancelar exclusão</a>
<input type='hidden' name='delete' value='true'/>
<input type='hidden' name='img' value='{$user->user_img}'/>
<input type='hidden' name='id' value='{$id}'/>
<input type='hidden' name='user_type' value='{$type}'/>
<input type='submit' value='Confirmar exclusão' class='np-btn border text-red hover-border-red hover-red'/>
</form>";

 ?>
