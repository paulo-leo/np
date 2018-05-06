<?php
if(isset($_GET['id']) and $_GET['id'] == NP_USER_ID OR NP_USER_TYPE == 1):
$id = intval($_GET['id']);
global $user;
$user = np_obj("SELECT * FROM ".NP."users WHERE ID = {$id }");
//Criar uma senha de confirmação
if(NP_USER_TYPE == 1){
	$pass_confirm = NP_USER_PASS;
}else{
	$pass_confirm = $user->user_pass;
}
switch($user->user_type){
	case 1 : $var_type = "Administrador"; break;
	case 2 : $var_type = "Editor"; break;
	case 3 : $var_type = "Autor"; break;
	default : $var_type = "Padrão";
}
 ?>
<style>
.div-card-option{display:none;}
</style>
<form class="" method="post" id="form-post-update">
<?php np_action("update-user"); 
np_hidden(array("user_type_default"=>$user->user_type,
 "pass_default"=>$user->user_pass, "pass_confirm1"=>$pass_confirm, "user_id"=>$user->ID, "user_show"=>$user->user_display)); ?>
<h4><?php if($user->ID == NP_USER_ID){ 
echo "<i class='material-icons'>settings</i>Editar meu perfil"; }
else{ 
echo "<i class='material-icons'>supervisor_account</i>Editar usuário"; } 
 ?></h4>
<div class="col m4 padding">
<p>E-mail
<input type="text" name="email" value="<?php echo $user->user_email; ?>" class="input  card"/></p>
<p>Nome de usuário
<input type="text" name="user_name" value="<?php echo $user->user_name; ?>" class="input card"/></p>
<p>Primeiro nome
<input type="text" name="first_name" value="<?php echo $user->first_name; ?>" class="input card"/></p>
<p>Segundo nome
<input type="text" name="last_name" value="<?php echo $user->last_name; ?>" class="input card"/></p>
<p>Data de nascimento
<input type="text" id="data_nasc" name="data_nasc" placeholder="dia, mês e ano" value="<?php echo np_time($user->user_date); ?>" class="input card"/></p>
</div><div class="col m4 padding">
<p>Minibiografia.
<textarea id="" name="user_about" placeholder="Escreva aqui a minibiografia." class="input card"><?php echo $user->user_about; ?></textarea></p>
<p>Nova senha
<input type="password" name="password" placeholder="Digite uma nova senha aqui" class="input card"/></p>
</p>
</div>
<div class="col m4">
<!----Permitir comentários--------->
<div id="card-post" class="display-container margin card-2 small">
<header class="padding margin-bottom">
<p class="text-gray">Digite sua senha atual para confirmar e atualizar.
<input type="password" name="pass_confirm2" placeholder="Senha" class="input border"/></p>
<input type="submit" class="np-btn round small padding left blue np-animate-submit" value="Confirmar edição"/><br>
</header>
<div class="msg-post-sender"><br></div>
</div>

<!----nome de exibição--------->
<div id="card-user-display" class="display-container margin card-2 small">
<header class="padding">
<a href="#card-user-display" class="np-btn small btn-show-user-display"><i class="material-icons" style="position:relative;top:5px;">perm_identity</i>Nome de exibição</span></a>
</header>
<div class="border-top padding div-card-option">
<?php 
$option1 = $user->first_name;
$option2 = $user->last_name;
$option3  = $option1." ".$option2;
$option4  = $option2." ".$option1;
echo "<input name='user_display' type='radio' id='ne1' value='{$option1}'/>
      <label class='small' for='ne1'>{$option1}</label><br>
	  <input name='user_display' type='radio' id='ne2' value='{$option2}'/>
      <label class='small' for='ne2'>{$option2}</label><br>
	  <input name='user_display' type='radio' id='ne3' value='{$option3}'/>
      <label class='small' for='ne3'>{$option3}</label><br>
	  <input name='user_display' type='radio' id='ne4' value='{$option4}'/>
      <label class='small' for='ne4'>{$option4}</label>";

?> 


</div></div>
<!----nivel de acesso--------->
<?php if(NP_USER_TYPE == 1 AND NP_USER_ID != $user->ID): ?>
<div id="card-nivel-access" class="display-container margin card-2 small">
<header class="padding">
<a href="#card-nivel-access" class="np-btn small btn-show-nivel-access"><i class="material-icons" style="position:relative;top:5px;">lock_open</i>Nível de acesso | <span class="show-nive-span"><?php echo $var_type; ?></span></a>
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
<?php endif; ?>
</form>
<!----imagem do perfil--------->
<div id="card-user-img" class="display-container margin card-2 small">
<header class="padding">
<!--------Form imagem---------->
<form name="enviardados" action="" method="post" enctype="multipart/form-data" class="form">
<a href="#card-user-display" class="btn-show-user-display">
<div class="img-perfil" style="height:120px; width:120px"></div></a>
<label class="display-topright">
     <input type="file" name="arquivo"/>
        <span class="filebar"></span>
		<a class="btn selectfile" style="cursor:pointer">Alterar imagem</a> 
    </label>
</header>
<div class="border-top div-card-option">


<header>
<div class="carregando center padding text-blue">
	<div class="progress1">0%</div>
</div>
</header>
	<input type="hidden" name="acao" value="cadastro"/>
	<input type="hidden" name="file_path" value="<?php echo $user->user_img; ?>"/>
	<input type="hidden" name="user_id" value="<?php echo $user->ID; ?>"/>
	<div class="resposta"></div>
	<p class="tiny margin">Não é necessário realizar a confirmação da senha para alterar a sua imagem de perfil. </p>
	<a href="#" class="np-btn  border small close-img margin">Fechar</a>
    <input type="submit" value="Enviar" class="np-btn small border border-green margin" />	
</form>
<!-----Fim form imagem-------->
</div></div>
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
				$("#card-user-img > .div-card-option").hide("fast");
		      }
	      });
	
	return false;
  });
//Option
$(".div-card-option").hide();
//Card nivel de acesso
$(".btn-show-nivel-access").click(function(){
	$("#card-nivel-access > .div-card-option").slideToggle("fast");
});
//User display
$(".btn-show-user-display").click(function(){
	$("#card-user-display > .div-card-option").slideToggle("fast");
});
//User display
$(".selectfile").click(function(){
	$("#card-user-img > .div-card-option").show("fast");
});
$(".close-img").click(function(){
	$("#card-user-img > .div-card-option").hide("fast");
});
//Nivel de acesso span
$("#t4").click(function(){ $(".show-nive-span").text("Administrador"); });
$("#t3").click(function(){ $(".show-nive-span").text("Editor"); });
$("#t2").click(function(){ $(".show-nive-span").text("Autor"); });
$("#t1").click(function(){ $(".show-nive-span").text("Padrão"); });

//Aplicando mascara
<?php if(NP_EXIT_TIME == 'pt' or NP_EXIT_TIME == "pt-br"){
	echo "jQuery('#data_nasc').mask('99/99/9999');";
}else{ echo "jQuery('#data_nasc').mask('9999-99-99');"; } ?> 
});
</script>
<!-------Inico da função para alterar imagem do perfil--->
<!----Modal imagem perfil------->
<div id="" class="modal modal-upload">
</div> 
<!---Arquivo JS para controlar o upload de imagem---->
<script>
$(document).ready(function(){
	$(".btn-modal-upload").click(function(){
		$(".modal-upload").toggle("fast");
	});var sender = $('form[name="enviardados"]');
	var loader = $('.resposta');
	
	var imagefile = $('.selectfile');
	var imputfile = $('input:file');
	var campofile = $('.filebar');
	
	imputfile.css("display","none");
	
	imagefile.click(function(){
		imputfile.one('click',function(){
			$(this).click();	
		})
		.change(function(){
			campofile.text($(this).val());	
		});
	});
	
	var bar = $('.carregando');
	var per = $('.progress1');
	
	bar.css("display","none");
	
	sender.submit(function(){
		$(this).ajaxSubmit({
			url:'pages/users/img-perfil/upload-perfil.php',
			data: {acao: "cadastro"},
			beforeSubmit: function(){
				loader.empty().html("<div class='progress' style='height:10px'><div class='indeterminate red'></div></div>");
			},
			error: function(){ loader.empty().text('Desculpe, erro ao enviar requisição!') },
			//resetForm: true,
			
			uploadProgress: function(evento, posicao, total, completo){
				//loader.empty().text(evento + " - " + posicao + " - " + total + " - " + completo);
				bar.fadeIn("fast");
				var porcetagem = "Carregando arquivo:" + completo + "%";
				per.width(porcetagem).text(porcetagem);
			},
			
			success: function(resposta){
				per.width('100%').text('100%');
				if(resposta == 1 || resposta == true){
					loader.empty().html("<p class='panel pale-green leftbar border-green padding'>Imagem do perfil alterada com sucesso.</p>").css("background","green");
					sender.find("input:text, textarea").val('');
					imputfile.val('');
					campofile.empty();						
				}else{
					loader.empty().html(resposta);
				}				
				//loader.empty().text('Enviado com sucesso!');
				
			},
			complete: function(){
				onImgPerfil();
				window.setTimeout( function(){
					bar.fadeOut("fast",function(){
						per.width('0%').text('0%');	
					});	
				}, 1000);
			}
			
		});
		return false;
	});
	onImgPerfil();
	function onImgPerfil(){ 
	$(".img-perfil").load("pages/users/img-perfil/upload-perfil.php?imgperfil=<?php echo $user->ID;?>");
    }
	
});
</script>
<!------Fim da aráe reservada para upload de imagem de perfil--------->
<?php endif; ?>


