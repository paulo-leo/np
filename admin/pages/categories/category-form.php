<?php np_no_access(np_admins()); ?>
<style>
.div-card-option{display:none;}
</style>
<form class="" style="padding-left:10px; padding-top:10px" method="post" id="form-post-update">

<input type="hidden" name="post_author" value="<?php echo NP_USER_ID; ?>" />
<?php np_action("createCategory"); ?>

<div class="col m8">
<h4><i class='material-icons'>view_list</i> Adicionar nova categoria</h4>
<p>
<input type="text" name="name" placeholder="Digite o nome aqui" class="input border card" style="border-radius:2px"/>
</p><br>
<textarea name="description"  placeholder="Digite a descrição da categoria aqui." style="min-height:200px !important;" class="input border card"></textarea><p class="small">
A descrição não está em destaque por padrão, no entanto alguns temas podem mostrá-la.
</p>
</div>
<div class="col m4">
<!----Permitir comentários--------->
<div id="card-post" class="display-container margin card-2 small">
<header class="light-gray">
<input type="submit" class="np-btn round small padding margin left blue np-animate-submit" value="Adicionar categoria"/>
<br><br><br>
<div class="msg-post-sender"><br></div>
</header>
</div>

<!----Categoria do post--------->
<div id="card-category" class="display-container margin card-2 small">
<header class="padding">
<a href="#card-category" class="np-btn small btn-show-category"><i class="material-icons" style="position:relative;top:5px;">view_list</i>Categoria mãe</a>
</header>
<div class="border-top padding div-card-option"> 
<?php
//Lista as categorias cadastradas no sistema
$category_option = np_sel(NP."categories");
    foreach($category_option as $cat){
	 echo "<input name='subcategoria' type='radio' id='viewc{$cat['ID']}' value='{$cat['ID']}'/>
           <label class='small' for='viewc{$cat['ID']}'>{$cat['category_name']}</label><br>";
	
  }
?>
</div></div>
</form>
</div>
<script>
$(document).ready(function(){
	//Função para salvar edições no formulário
var msgPost = $(".msg-post-sender");
$("#form-post-update").submit(function(){
	$.ajax({
		   url:"pages/categories/functions.php",
		   data:$(this).serialize(),
		   type:"post",
		   beforeSend: function(){
				msgPost.html("<p class='animate-fading panel padding pale-blue'>Por favor, aguarde! Adicionando nova categoria...</p>");
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
});
</script>