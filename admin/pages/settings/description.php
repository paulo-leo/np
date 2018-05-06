<?php np_no_access(np_admin()); ?>
<h2><i class="material-icons">description</i> Descrições do site</h2>
<?php 
if(isset($_POST['name']) and isset($_POST['description'])){
 $name = $_POST['name']; $description = $_POST['description'];
 if($name == " " or strlen($name) < 2){ np_msg("O campo nome não pode ser vazio!", "red");}else{
 np_file_alter_line("../core/conf.php", 14, "NP_NAME", $name);
 np_file_alter_line("../core/conf.php", 16, "NP_DESCRIPTION", $description);
 np_msg("Descrições do site alterada com sucesso");}
}
?>
<form method="post" style="max-width:600px">
<p>Título do site
<input type="text" name="name" class="input card border" value="<?php echo NP_NAME; ?>"/></p>
<p>Descrição do site
<textarea type="text" name="description" class="input card border"><?php echo NP_DESCRIPTION; ?></textarea></p>
<input class="btn border border-blue white" type="submit" value="Salvar"/> 
</form>
