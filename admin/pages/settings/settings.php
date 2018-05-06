<?php np_no_access(np_admin()); ?>

<div class="">
<div class="dropdown-hover" style="position:relative;left:-14px;">
<button class="button white  border card">Configurações do sistema</button>
<div class="dropdown-content bar-block card">
<a href="?page=settings&set-page=description" class="bar-item button"><i class="material-icons">description</i> Descrição</a>
<a href="?page=settings&set-page=users&paging" class="bar-item button"><i class="material-icons">supervisor_account</i> Usuários</a>
<a href="?page=settings&set-page=server" class="bar-item button"><i class="material-icons">info_outline</i> Informações</a>
<a href="?page=settings&set-page=thema" class="bar-item button"><i class="material-icons">settings_brightness</i> Tema</a>
<a href="?page=settings&set-page=lang" class="bar-item button"><i class="material-icons">translate</i> Idioma</a>
<a href="?page=settings&set-page=update" class="bar-item button"><i class="material-icons">loop</i> Atualização</a>
</div>
</div> 
<div class="setting-page">
<?php if(isset($_GET["set-page"])){
	$page = $_GET["set-page"];
	$settings = array(
	"thema" => "thema",
	"lang"=>"lang",
	"description"=>"description",
	"server"=>"server",
	"users"=>"users",
	"update"=>"update");
	
	include("pages/settings/{$settings[$page]}.php");
}else{
	include("pages/settings/description.php");
}
?>
</div>
</div>