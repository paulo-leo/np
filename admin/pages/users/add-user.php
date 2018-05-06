<?php np_no_access(np_admin()); ?>
<style>
.div-card-option{display:none;}
</style>
<form class="" style="padding-left:10px; padding-top:10px" method="post" id="form-post-update">
<?php np_action("add-user"); ?>

<div class="col m8">
<h4><i class='material-icons'>supervisor_account</i> Adicionar novo usuário</h4><p>
<input type="text" name="email" placeholder="E-mail" class="input  card margin-top"/>
<input type="text" name="first_name" placeholder="Nome" class="input border card margin-top"/>
<input type="text" name="last_name" placeholder="Sobrenome" class="input border card margin-top"/>
<input type="text" id="data_nasc" name="data_nasc" placeholder="Data de nascimento: dia, mês e ano" class="input border card margin-top"/>
<input type="password" name="password" placeholder="Escolha um senha" class="input border card margin-top"/>
</p>
</div>
<div class="col m4">
<!----Permitir comentários--------->
<div id="card-post" class="display-container margin card-2 small">
<header class="light-gray">
<input type="submit" class="np-btn round small padding margin left blue np-animate-submit" value="Adicionar usuário"/>
<br><br><br>
<div class="msg-post-sender"><br></div>
</header>
</div>

<!----Categoria do post--------->
<div id="card-category" class="display-container margin card-2 small">
<header class="padding">
<a href="#card-category" class="np-btn small btn-show-category"><i class="material-icons" style="position:relative;top:5px;">lock_open</i>Nível de acesso</a>
</header>
<div class="border-top padding div-card-option"> 
<input name='user_type' type='radio' id='t1' value='4'/>
<label class='small' for='t1'><b>Padrão</b> – somente leitura e edição do próprio perfil.</label><br>
<input name='user_type' type='radio' id='t2' value='3'/>
<label class='small' for='t2'><b>Autor</b> – acesso e permissão de escrita aos posts e páginas criadas pelo o próprio.</label><br>
<input name='user_type' type='radio' id='t3' value='2'/>
<label class='small' for='t3'><b>Editor</b> – acesso e permissão de escrita a todos os posts, páginas e categorias do site.</label><br>
<input name='user_type' type='radio' id='t4' value='1'/>
<label class='small' for='t4'><b>Administrador</b> -  acesso e permissão de escrita a todas as funcionalidades do sistema.</label><br>
</div></div>
</form>
</div>
<script>
$(document).ready(function(){
	//Função para salvar edições no formulário
var msgPost = $(".msg-post-sender");
$("#form-post-update").submit(function(){
	$.ajax({
		   url:"pages/users/functions.php",
		   data:$(this).serialize(),
		   type:"post",
		   beforeSend: function(){
				msgPost.html("<p class='animate-fading panel padding pale-blue'>Por favor, aguarde! Adicionando novo usuário no sistema...</p>");
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
//Aplicando mascara
<?php if(NP_EXIT_TIME == 'pt' or NP_EXIT_TIME == "pt-br"){
	echo "jQuery('#data_nasc').mask('99/99/9999');";
}else{ echo "jQuery('#data_nasc').mask('9999-99-99');"; }
?>
});
</script>