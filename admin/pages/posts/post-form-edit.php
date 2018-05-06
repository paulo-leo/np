<?php np_no_access(np_adminss());

if(isset($_GET['page']) and $_GET['page'] == "post-edit"){
	$id = intval($_GET['id']);	
    $sql1 = "SELECT * FROM ".NP."posts WHERE ID = {$id}";
    $post = np_obj($sql1); 
}
 ?>
<style>
.div-card-option{display:none;}
</style>
<form class="padding animate-right" style="" method="post" id="form-post-update">
<input type="hidden" name="post_id" value="<?php echo $post->ID; ?>" />
<input type="hidden" name="comment_this" value="<?php echo $post->comment_activate; ?>" />
<?php np_action("update_post"); ?>
<input type="hidden" name="visi1" value="<?php echo $post->post_status; ?>"/>
<input type="hidden" name="cat1" value="<?php echo $post->post_category; ?>"/>
<div class="col m8">
<h4><i class="material-icons">edit</i> Editar <?php if($post->post_type == 1){ echo "post"; }else{ echo "página"; } ?></h4>
<p>
<input type="text" name="title" value="<?php echo $post->post_title; ?>" placeholder="Digite o título aqui" class="input border card" style="border-radius:2px"/>
</p><br>
<!-----Botão para adcionar arquivos----->
<a href="#" style="padding:4px 5px !important" class="np-btn  small white btn-modal-upload"><i class="material-icons">perm_media</i> <span style="position:relative; top:-5px">Adicionar arquivos</span></a> 
<span class="margin-left  padding" >
<?php   
if($post->comment_activate == 1){
	echo "<input type='checkbox' id='test55' name='comment_activate' value='2'/>
       <label for='test55' class='text-red small'>Desabilitar comentários</label>";
}else{
	echo "<input type='checkbox' id='test55' name='comment_activate' value='2'/>
       <label for='test55' class='text-green small'>Habilitar comentários</label>";
}
?>
</span><br><br>
<textarea name="content" id="post_content" style="min-height:300px !important;" class="input border"><?php echo $post->post_content; ?></textarea>
</div>
<div class="col m4">
<!----Permitir comentários--------->
<div id="card-post" class="display-container margin card-2 small">
<header class="light-gray">
<input type="submit" class="np-btn round small padding margin left blue np-animate-submit" value="Atualizar"/>
<br><br><br>
<a href="#card-post" class="btn-show-post np-btn display-topright"><i class="material-icons">info_outline</i></a>
<div class="msg-post-sender"><br></div>
</header>
<div class="padding div-card-option">
<div class="post-info-geral"></div>
<p><i class='material-icons'>today</i>Criado no dia <?php echo np_time($post->post_date); ?> por <b><?php the_author($post->post_author); ?></b></p>
<p><i class='material-icons'>visibility</i>  <?php the_view_count($post->ID, "red tag"); ?></p>
<p><i class='material-icons'>textsms</i>  <?php the_comment_count($post->ID, "red tag"); ?></p>
<?php if($post->post_date_update != null): ?>
<p class="text-gray animate-top"><i class='material-icons text-red'>restore</i>Última atualização em <?php echo np_time($post->post_date_update, "time+", " às "); ?></p>
<?php endif; ?>
</div></div>

<!----Visibilidade do post--------->
<div id="card-view" class="div-category display-container margin card-2 small">
<header class="padding">
<a href="#card-view" class="np-btn small btn-show-view"><span class="info-visibility"></span></a>

</header>
<div class="border-top padding small div-card-option">
<p>
<input name="status" type="radio" id="view1" value="1"/>
<label for="view1" class="small"><b>Publico</b> para todos na internet</label></p>
<p>
<input name="status" type="radio" id="view2" value="2"/>
<label for="view2" class="small"><b>Restrito</b> para usuários não conectados</label></p>
<p>
<input name="status" type="radio" id="view3" value="3"/>
<label for="view3" class="small"><b>Pendente</b> e visível apenas para os administradores. </label></p>
</div></div>
<!----Categoria do post--------->
<div id="card-category" class="display-container margin card-2 small">
<header class="padding">
<a href="#card-category" class="np-btn small btn-show-category"><i class="material-icons" style="position:relative;top:5px;">toc</i>Categoria (<span class="info-category"></span>)</a>
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
<input type="text" placeholder="Palavras chaves" value="<?php echo $post->post_keys; ?>" name="keys" class="input border" />
<textarea name="description" <?php echo $post->post_description; ?> placeholder="Descrição" class="input border margin-top"></textarea>
</div></div>

<?php if($post->post_type == 2): ?>
<!----Ordem da página--------->
<div id="card-order" class="div-description display-container margin card-2 small">
<header class="padding">
<a href="#card-order" class="np-btn small btn-show-order"><i class="material-icons" style="position:relative;top:5px;">view_week</i>Ordem da página</a>
</header>
<div class="border-top padding div-card-option">
<p class="tiny">Está opção serve para organizar a ordem de exibição da página no menu do site.</p>
<input type="text" style="max-width:70px" value="<?php echo $post->post_order; ?>" name="order" class="input border" />
</div></div>
<?php endif; ?>
<!-----Imagem destacada------->
<div id="card-image" class="div-description display-container margin card-2 small">
<header class="padding">
<a href="#card-image" class="np-btn small btn-show-image"><i class="material-icons" style="position:relative;top:5px;">picture_in_picture</i>Imagem destacada</a>
</header>
<div class="border-top padding div-card-option">
<p>Está opção serve para organizar a ordem de exibição da página no menu do site.
<input type="text" style="max-width:70px" value="<?php echo $post->post_order; ?>" name="order" class="input border" /></p>
</div></div>
</form>
<div class="sss"></div>
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
				msgPost.html("<p class='animate-fading panel padding pale-blue'>Por favor, aguarde! Atualizando conteúdo....</p>");
				$(".np-animate-submit-image").show("fast");
		     },
		   success: function(data){
				msgPost.html(data);
				$(".np-animate-submit-image").hide("fast");
				postInfo(".info-category", "category");
                postInfo(".info-visibility", "visibility");
		      }
	      });
	
	return false;
  });

//Ira carregar informações sobre o post 
postInfo(".info-category", "category");
postInfo(".info-visibility", "visibility");
postInfo(".post-info-geral", "post-info-geral");



function postInfo(x, y){
	$(x).load("pages/posts/infos.php?info="+y+"&id=<?php echo $post->ID; ?>");
}
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
//Card order page
$(".btn-show-order").click(function(){
	$("#card-order > .div-card-option").slideToggle("fast");
});
//Card imagem destacada
$(".btn-show-image").click(function(){
	$("#card-image > .div-card-option").slideToggle("fast");
});
});
</script>
<!----------Inclusão de formulário para upload de arquivos----------->
<?php include("midia/upload-post.php"); ?>