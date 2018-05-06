<?php np_no_access(np_admin()); ?>
<h2><i class="material-icons">invert_colors</i> Tema do site</h2>
<?php 
if(isset($_POST['thema'])){
	$thema = $_POST['thema'];
	if(np_file_alter_line("../core/conf.php", 20, "NP_THEMA", $thema)){
		np_msg("Tema do site alterado com sucesso");
	}
}
?>
<h3>O tema atual é: <b><?php np_print(NP_THEMA); ?></b></h3>
<form method="post" class="padding" style="max-width:400px">
<p>Selecione um novo tema nas opções abaixo:
<select name="thema" class="input border">
<?php
$dir    = '../content/themes';
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
