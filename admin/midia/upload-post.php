<!----Formulario para envio de arquivos------->
<div class='modal modal-upload' id="modalup123">
<div class='modal-content row' style='max-width:790px;'>
<a href="#" title="Enviar um novo arquivo" class="btn blue btn-div-upload-new-file"><i class="material-icons selectfile">system_update_alt</i></a>
<span class="button display-topright red btn-modal-upload2"><i class="material-icons">visibility_off</i></span>
<div class="progress white border-bottom upload-add-midia-loading" style="position:relative; top:-10px; height:9px; display:none;">
     <div class="indeterminate blue"></div>
</div>
<!----Formulário para envio de novo arquivo------>
<div class="col m12 center">
  <header style="center"><h3>Anexar arquivos</h3></header>
</div>
 <!-----------Area para enviar um novo arquivo--------------->
   <div class="col m12 padding div-upload-new-file center" style="display:none;">
      <header>
<h4>Enviar um novo arquivo</h4>
<div class="carregando center padding text-blue">
	<div class="progress1">0%</div>
</div>
</header>

<div class="resposta"></div>



<form name="enviardados" action="" method="post" enctype="multipart/form-data" class="form">
	<label>
    	<span class="campo">Arquivo:</span>
        <input type="file" name="arquivo"/>
        
        <span class="filebar"></span>
		<a class="btn blue card">
		<i class="material-icons selectfile">open_in_browser</i></a>
        
    </label>
    <p>Pasta:
    	<select name="pasta_id" class="select">
		   <?php np_folder_list("option", "no-badge"); ?>
		</select>
    </p>
	<p>Titulo:
    	<input class="input" type="text"  name="titulo" />
    </p>
    
    <p>Descrição:
    	<textarea class="input" name="descricao" role="3"></textarea>
    </p>
    <input type="submit" value="Enviar arquivo" class="btn white border border-blue"/>
     <a href="#" class="btn white border border-red btn-div-upload-new-file">Cancelar</a>	
</form></div>
<!---------Fim da area para enviar um novo arquivo----------->
  <div class="area-de-upload">
  <div class="col m12">
  
  <form id="form-pasta" class="margin-left margin-right">
  <p>Filtrar arquivos por pasta<select class="input" name="folder_id">
      <?php np_folder_list("option", "no-badge"); ?></select>
	  <input type="submit" class="btn white border right" style="border-top:none !important;" value="Filtrar">
	  </p>
  </form>
   </div>
<div class="col m12 padding">
  <form id='form-add-midia-post'>
  <div style="overflow:auto" class="col m12 upload-list-files"></div>
  <input type='submit' value='Adicionar arquivos marcados' class='btn center border border-blue margin-top' style='text-decoration:none; font-size:12px'/></form>
  <p class="center padding text-red msg-midia-more" style="display:none">Não existem mais arquivos para serem carregados. </p>
  <a href='#' class='btn border right margin-top btn-midia-more'>Carregar mais</a>
</div>
     </div>
</div>
</div>
<script>
$(document).ready(function(){
	//Função para abrir a modal
	$('.btn-modal-upload').click(function(){
		$('.modal-upload').slideToggle('fast'); 
		localStorage.setItem("buacarMidiaPasta", "folder_id=1");
		upViewMidias(null, 0, 12);
		});
	$('.btn-modal-upload2').click(function(){
		$('.modal-upload').slideToggle('fast'); 
		$(".div-upload-new-file").hide(); $(".area-de-upload").show();
		localStorage.removetItem("buacarMidiaPasta");
		});
		
//Loading	
var upAddLoading = $(".upload-add-midia-loading");	
var btnMore = $(".btn-midia-more");
//Local para exibição dos arquivos
var upAddList = $(".upload-list-files");
//Função para visualizar as midias
function upViewMidias(where=null, offset=0, limit=12, addLocal="html"){
	$.ajax({
		   url:"midia/add-midia.php",
		   data:{offset:offset, limit:limit, where:where, action:"ler"},
		   type:"get",
		   beforeSend: function(){
			   upAddLoading.show("fast");
			   $(".msg-midia-more").hide("fast");
		   },
		   success: function(data){
			    upAddLoading.hide("fast");
				if(data == 100){
					  btnMore.hide();
					  $(".msg-midia-more").show("fast");
				}else{
					if(addLocal == "html"){
						upAddList.html(data);
					}else{
						upAddList.append(data);
					}
					
					btnMore.show();
				}
		   }
	});
}
//Rotina para exibir midias por pastas
$("#form-pasta").submit(function(){
	var idpasta = $(this).serialize();
	localStorage.setItem("buacarMidiaPasta", idpasta);
	upAddList.html(" ");
	upViewMidias("WHERE "+idpasta, 0, 12);
	return false;
});
//Rotina para carregar mais
var offset = 12;
btnMore.click(function(){
	    var folid = localStorage.getItem("buacarMidiaPasta");
		upViewMidias("WHERE "+folid, offset, 12, "append");
		offset += 12;
	});


//Rotina para inserir midias no post
$("#form-add-midia-post").submit(function(){
	var idpasta = $(this).serialize();
	if(idpasta == false){
		alert("Você deve selecionar pelo menos um arquivo para poder adicionar no post.")
	}else{
		
		$.ajax({
		   url:"midia/add-midia.php",
		   data:{action:"ler-add", ids:idpasta},
		   type:"post",
		   beforeSend: function(){
			   upAddLoading.show("fast");
			
		     },
		   success: function(data){
			    upAddLoading.hide("fast");
				$('.jqte_editor').append(data);
				$('.modal-upload').hide('fast');
		      }
	      });
		
	}
	return false;
});
////////Enviar um novo arquivo
$(".btn-div-upload-new-file").click(function(){
   $(".div-upload-new-file, .area-de-upload").slideToggle("slow");
});
var sender = $('form[name="enviardados"]');
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
			url:'midia/upload.php',
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
					loader.empty().html("<p class='panel pale-green leftbar border-green padding'>Arquivo enviado com sucesso!</p>").css("background","green");
					sender.find("input:text, textarea").val('');
					imputfile.val('');
					campofile.empty();						
				}else{
					loader.empty().html(resposta);
				}				
				//loader.empty().text('Enviado com sucesso!');
				
			},
			complete: function(){
				window.setTimeout( function(){
					bar.fadeOut("fast",function(){
						per.width('0%').text('0%');	
					});	
				}, 1000);
				$(".div-upload-new-file, .area-de-upload").slideToggle("slow");
				upViewMidias(null, 0, 12);
			}
			
		});
		return false;
	});
});
</script>