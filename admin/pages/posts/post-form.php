<?php np_no_access(np_adminss());
$menu = np_iget("menu");
 ?>
<style>
.div-card-option{display:none;}
</style>
<form class="" style="padding-left:10px; padding-top:10px" method="post" id="form-post-update">

<input type="hidden" name="post_author" value="<?php echo NP_USER_ID; ?>" />
<?php np_action("add_post"); ?>

<div class="col m8">
<h4><?php if($menu == "post"){ echo "<i class='material-icons'>edit</i> Adicionar novo post"; }
else{ echo "<i class='material-icons'>library_books</i> Adicionar nova página";} ?><p>
<input type="text" name="title" placeholder="Digite o título aqui" class="input border card" style="border-radius:2px"/>
</p><br>
<!-----Botão para adcionar arquivos----->
<a href="#" class="np-btn  small white border btn-modal-upload"><i class="material-icons">perm_media</i> <span style="position:relative; top:-5px">Adicionar arquivos</span></a><br><br>
<textarea name="content" id="post_content" style="min-height:300px !important;" class="input border"></textarea>
</div>
<div class="col m4">
<!----Permitir comentários--------->
<div id="card-post" class="display-container margin card-2 small">
<header class="light-gray">
<input type="submit" class="np-btn round small padding margin left blue np-animate-submit" value="Publicar"/>
<br><br><br>
<a href="#card-post" class="btn-show-post np-btn display-topright"><i class="material-icons">settings</i></a>
<div class="msg-post-sender"><br></div>
</header>
<div class="padding div-card-option">
<!------Configurações automaticas----------->
<?php
if($menu == "post"){
	echo "<input type='hidden' name='type' value='1' />";
}else{
    echo "<input type='hidden' name='type' value='2' />";
}

?>

<p>
<input type="checkbox" id="test55" name="comment_active" value="2"/>
<label for="test55" class="text-red small">Desabilitar comentários</label>
</p>
</div></div>

<!----Visibilidade do post--------->
<div id="card-view" class="div-category display-container margin card-2 small">
<header class="padding">
<a href="#card-view" class="np-btn small btn-show-view"><i class="material-icons" style="position:relative;top:5px;">visibility</i>Visibilidade</a>

</header>
<div class="border-top padding small div-card-option">
<input name="status" type="radio" id="view1" value="1"/>
<label for="view1" class="small">Visível para todos na internet</label><br>
<input name="status" type="radio" id="view2" value="2"/>
<label for="view2" class="small">Visível apenas para usuários conectados no site</label><br>
<input name="status" type="radio" id="view3" value="3"/>
<label for="view3" class="small">Visível apenas para os administradores do site. </label>
</div></div>
<!----Categoria do post--------->
<div id="card-category" class="display-container margin card-2 small">
<header class="padding">
<a href="#card-category" class="np-btn small btn-show-category"><i class="material-icons" style="position:relative;top:5px;">toc</i>Categoria</a>
</header>
<div class="border-top padding div-card-option"> 
<?php
//Lista as categorias cadastradas no sistema
$category_option = np_sel(NP."categories");
    foreach($category_option as $cat){
	 echo "<input name='category' type='radio' id='viewc{$cat['ID']}' value='{$cat['ID']}'/>
           <label class='small' for='viewc{$cat['ID']}'>{$cat['category_name']}</label><br>";
	
  }
?>
</div></div>
<!----Descriçoes do post--------->
<div id="card-seo" class="div-description display-container margin card-2 small">
<header class="padding">
<a href="#card-seo" class="np-btn small btn-show-seo"><i class="material-icons" style="position:relative;top:5px;">subject</i>Descrições</a>
</header>
<div class="border-top padding div-card-option">
<p class="tiny">Separe as palavras chaves com virgula (web, design, game).</p> 
<input type="text" placeholder="Palavras chaves" name="keys" class="input border" />
<textarea name="description"  placeholder="Descrição" class="input border margin-top"></textarea>
</div></div>
</form>
</div>
<script>
$(document).ready(function(){
	//Função para salvar edições no formulário
var msgPost = $(".msg-post-sender");
$("#form-post-update").submit(function(){
	$.ajax({
		   url:"pages/posts/functions.php",
		   data:$(this).serialize(),
		   type:"post",
		   beforeSend: function(){
				msgPost.html("<p class='animate-fading panel padding pale-blue'>Por favor, aguarde! Criando e salvando publicação...</p>");
				$(".np-animate-submit-image").show("fast");
		     },
		   success: function(data){
				msgPost.html(data);
				$(".np-animate-submit-image").hide("fast");
		      }
	      });
	
	return false;
  });
//Option
$(".div-card-option").hide();
//Card category
$(".btn-show-category").click(function(){
	$("#card-category > .div-card-option").slideToggle("fast");
});
//Card SEO
$(".btn-show-seo").click(function(){
	$("#card-seo > .div-card-option").slideToggle("fast");
});
//Card View
$(".btn-show-view").click(function(){
	$("#card-view > .div-card-option").slideToggle("fast");
});
//Card Comment e post/page
$(".btn-show-post").click(function(){
	$("#card-post > .div-card-option").slideToggle("fast");
});
});
</script>
<!----------Inclusão de formulário para upload de arquivos----------->
<?php include("midia/upload-post.php"); ?>