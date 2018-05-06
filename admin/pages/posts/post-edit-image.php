<?php 
np_no_access(np_adminss()); 
$ID = np_iget("id");

?>
<h2><i class="material-icons">edit</i> Editar imagem destacada</h2>
<p>Torne a sua publicação mais atraente ao incluir uma imagem destacada que aparecerá nos principais mecanismos de busca, além da imagem ser incluída no compartilhamento nas redes sociais entre outros. </p>
<a href="?page=post-edit&id=<?php echo $ID; ?>" class="btn white"><i class="material-icons">call_missed</i> Voltar para edição</a>
<a href="#" class="text-green btn white btn-modal-upload"><i class="material-icons">edit</i> Editar imagem</a>
<a href="#" class="text-red btn white btn-remove-image-destacada"><i class="material-icons">delete</i> Remover imagem</a>
<div style="max-width:560px; height:400px">
<div class="msg-remove-image-destacada"></div>
<div class="local-image-destacada"></div></div>
<!----------Inclusão de formulário para upload de arquivos----------->
<?php include("midia/upload-imagem-destacada.php"); ?>

