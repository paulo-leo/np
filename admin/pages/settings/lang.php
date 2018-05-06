<?php np_no_access(np_admin()); ?>
<h2><i class="material-icons">translate</i> Linguagem do sistema</h2>
<?php 
if(isset($_POST['lang'])){
	$lang = $_POST['lang'];
	if(np_file_alter_line("../core/conf.php", 18, "NP_LANG", $lang)){
		np_msg("Idioma do sistema alterado com sucesso!");
	}
}
?>
<h4>O idioma atual do sistema é: <b><?php np_print(NP_LANG); ?></b></h4>
<form method="post" class="card padding" style="max-width:400px">
<p>Selecione uma nova linguagem para o sistema:
<select name="lang" class="input border">
<?php
$dir    = '../content/languages';
$folders = scandir($dir);
$folders_count = count($folders);
for($i = 2; $i < $folders_count; $i++){
   echo "<option value='{$folders[$i]}'>"; np_print($folders[$i]); echo "</option>";
}
?>
</select>
</p>
<input class="btn border border-blue white" type="submit" value="Salvar"/> 
</form>
