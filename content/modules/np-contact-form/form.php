<?php 
$formproto = mt_rand(100, 999).date('isH'); 
the_script(); ?>
<script>
$(document).ready(function(){
	$(".form-loading, .form-error, .form-success").hide();
	$("#npcontactform").submit(function(){
		var dados = $(this).serialize();
		$.ajax({
			url:"content/modules/np-contact-form/form-send.php",
			type:"POST",
			data:dados,
			beforeSend:function(data){
				$(".form-loading").show();
				$(".form-error, .form-success").hide();
			}, success:function(data){
				if(data == 1){
				$(".form-success").show();
				}else{
					$(".form-error").show();
					$(".res").html();
				}
			}, complete:function(){
				$(".form-loading").hide();
			}
		});
		return false;
	});
});
</script>
<div class='content'>
<div class="row padding">
<h2><i class="material-icons">chat</i>Fale conosco!</h2>
<div class="col m6 padding">
<p class="panel pale-red leftbar border-red padding">Todos os campos são obrigatórios!</p>
<p>Não esqueça de anotar o número de protocolo que será gerado assim que a sua mensagem for enviada. </p>
<p class="small">Caso deseje conversar diretamente com a administração do site será necessário fazer login em sua conta ou abrir uma conta caso não tenha cadastro conosco. </p>
<div class="res"></div>
</div>
<div class="col m6">
<form class="" style="max-width:700px" id="npcontactform" method="post" action="content/modules/np-contact-form/form-send.php">
<input type="hidden" name="protocol" value="<?php echo $formproto; ?>" />
<p>Selecione um assunto:
<select class="select" name="subject">
<option value="Serviços">Serviços</option>
<option value="Sugestões">Sugestões</option>
<option value="Elogios">Elogios</option>
<option value="Reclamações">Reclamações</option>
<option value="Outros">Outros</option>
</select></p>
<p>Nome (Completo):
<input type="text" name="name" class="input border"/></p>
<p>E-mail:
<input type="email" name="email" class="input border"/></p>
<p>Telefone (celular):
<input type="text" name="phone" class="input border"/></p>
<p>Mensagem:
<textarea name="message" class="input border"></textarea></p>
<div class="form-success center panel pale-green leftbar border-green padding"><b>
Sua mensagem foi enviada com sucesso!</b> Anote o seguinte número de protocolo:<b class=''><?php
echo $formproto;
?></b>
</div> 

<div class="panel pale-red leftbar border-red padding form-error">
<b>Erro ao enviar mensagem.</b> Verifique se todos os campos estão preenchidos adequadamente e tente novamente!
</div> 

<div class="panel pale-blue padding form-loading">
<div class="progress light-gray"><div class="indeterminate blue"></div></div>
Por favor, aguarde! Enviando a sua mensagem...
</div> 
<input type="submit" class="btn border margin-top border-green" value="Enviar mensagem "/>
</form>
</div>
</div></div>