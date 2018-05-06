<?php 
if(!isset($_GET['page'])){ header("Location:?page=dashboard"); }

include("../core/conn.php");
///Inclusão do arquivo de funções do idioma///
include("../content/languages/".NP_LANG."/".NP_LANG.".php");
np_libs("../core/libs/");
np_the("../core/the/");
include("../core/create.php");
include("../core/read.php");
include("../core/update.php");
include("../core/delete.php");
include("session.php"); 
include("../core/thema.php");
include("pages/system/menu-sidebar.php"); 
include("pages/system/pages-sidebar.php"); 
np_timezone();
////////Fim da listagem de módulos/////////

///Inclusão do arquivo de funções do tema///
include("../content/themes/".NP_THEMA."/functions.php"); 
 ?>
<!DOCTYPE html>
<html>
<title><?php np_page_title(); ?></title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="front/css/style.css">
<link rel="stylesheet" href="front/icons/material.css">
<link rel="stylesheet" href="front/css/jquery-te.css">
<script src="front/js/jquery.js"></script>
<script src="front/js/jquery-te.js"></script>
<script src="front/js/jquery.form.js"></script>
<script src="front/js/jquery.mask.min.js"></script>
<!----Plugins jQuery---->
<script src="front/jquery-plugins/fancybox/jquery.fancybox.min.js"></script>
<link rel="stylesheet" href="front/jquery-plugins/fancybox/jquery.fancybox.min.css">
<script>
$(document).ready(function(){


$(".np-animate-submit").click(function(){
	$(".np-animate-submit-image").show();
});

var menuTexto = localStorage.getItem("menuTexto");

if(menuTexto == "hide"){ $("#mySidebar").addClass("mySidebarIcone"); 
$(".np-text-link").hide("fast"); $(".btn-text-hide").hide(); $(".btn-text-show").show(); 
$(".submenus").removeClass("submenus1");
$(".submenus").removeClass("submenusShow");
$(".content-page").addClass("content-50"); $(".content-page").removeClass("content-250"); }
else if(menuTexto == "show"){ 
$(".submenus").addClass("submenusShow");
$(".np-text-link").show(); 
$(".btn-text-show").hide(); $(".btn-text-hide").show();
$(".content-page").addClass("content-250"); $(".content-page").removeClass("content-50");
 }
$(".btn-text-hide").click(function(){
	 localStorage.setItem("menuTexto", "hide");
	$(".np-text-link, .btn-text-hide").hide();
	$(".btn-text-show").show();
	$("#mySidebar").addClass("mySidebarIcone");
	$(".content-page").removeClass("content-250");
	$(".content-page").addClass("content-50");
	$(".submenus").removeClass("submenusShow");
});
$(".btn-text-show").click(function(){
	 localStorage.setItem("menuTexto", "show");
	$(".np-text-link, .btn-text-hide").show();
	$(".btn-text-show").hide();
	$("#mySidebar").removeClass("mySidebarIcone");
	$(".content-page").removeClass("content-50");
	$(".content-page").addClass("content-250");
	$(".submenus").addClass("submenusShow");
});

$(".btn-modal-off").click(function(){
	$(".modal-off").toggle("fast");
});
$(".btn-menu-right").click(function(){
	$(".menu-right").toggle("fast");
});

$("#post_content").jqte();
$("#post_content2").jqte();
$("#post_content3").jqte();

$(".btn-view-float").click(function(){
		$(".div-view-float").toggle("fast");
	   $(".content-page").removeClass("content-250");
	   $(".content-page").removeClass("content-50");
	   $(".container-geral").toggleClass("center");
	
	});

});
</script>
<style>
.np-text-link{position:relative;top:-6px;left:8px}
.sidebar{left:-14px !important;}
.sidebar a {font-family: "Roboto", sans-serif; left:10px;}
.mySidebarIcone{width:43px !important;}
.mySidebarTexto{width:250px !important;}
.content-50{margin-left:28px;}
.content-250{margin-left:155px;}
.np-text-link, .np-animate-submit-image{display:none;}
.text-header{font-size:10px;}
.np-circle{width:60px; height:60px; text-align:center; padding:17px;}
.modal{z-index:50 !important;}
.post-links > a {text-decoration:none;}
.btn-nav{margin:3px; margin-top:25px;}
.np-btn{ border:none;display:inline-block;outline:0;padding:2px 6px; vertical-align:middle; overflow:hidden; font-size:16px; text-decoration:none;color:inherit;background-color:inherit;text-align:center;cursor:pointer;white-space:nowrap}
.np-btn:hover{box-shadow:0 8px 16px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19)}
.submenusShow{padding-left:30px !important; width:100%;}
.sidebar .bar-item{padding-top:2px !important; padding-bottom:0px !important; font-size: 13px;}
.menu-top-header > a > i{font-size:21px !important; position:relative !important; top:5px !important;}
.menu-top-header > a {padding:3px !important; margin:1px !important;}
.menu-top-header{position:relative !important; top:-34px !important; left:60px;}
</style>
<body class="white">
<!-- Menu cabeçalho -->
<div class="green div-view-float" style="height:30px; position:fixed; width:100%; z-index:5;">

<img src="../content/uploads/system/logo_np.png" height="30px" width="60px">
<div class="menu-top-header">
<a href="<?php echo NP_URL; ?>" target="_back" class="np-btn" ><i class="material-icons">web</i></a>
<a href="<?php echo NP_URL; ?>" target="_back" class="np-btn" ><i class="material-icons">chat_bubble_outline</i></a>
<a href="<?php echo NP_URL; ?>" target="_back" class="np-btn" ><i class="material-icons">info_outline</i></a>
</div>
<!--------->
<a href='#' class="display-topright btn-menu-right">
<?php echo "<img src='../content/uploads/".NP_USER_IMG."' style='height:30px; width:40px'/>"; ?></a>
</div>
<!-------Menu leteral da direita----------->
<div style="width:200px;min-height:300px; position:fixed; display:none; z-index:5" class="card white display-topright menu-right">
<header class="display-container" style="height:40px"><a href="?page=notifications&paging" class="btn display-topleft"><i class="material-icons">add_alert</i><span class="badge green tiny"><?php np_print(np_notification_count()); ?></span></a>
<a href="#" class="btn display-topright btn-modal-off"><i class="material-icons">power_settings_new</i></a></header>
<?php echo "<img src='../uploads/".NP_USER_IMG."' style='height:140px; width:100%'/>"; ?>
<p class="center wide"><a href="?page=profile&id=<?php echo NP_USER_ID; ?>"><i class='material-icons small'>settings</i><?php echo NP_USER_DISPLAY; ?></a></p>

<a href="#" class="btn block white border small btn-menu-right display-bottommiddle"><i class="material-icons">visibility_off</i></a>
</div>

<!-- Sidebar/menu -->
<nav class="sidebar bar-block green top div-view-float small" style="z-index:3;width:170px; margin-top:30px" id="mySidebar">

<?php
$class_bnt_dashboard = null;
if(np_is("page", "dashboard", "get")){ $class_bnt_dashboard = "lime"; }
echo "<a href='?page=dashboard' title='' class='bar-item button {$class_bnt_dashboard}'><i class='material-icons'>dashboard</i> <span class='np-text-link'>Painel</span></a>";
//O menu abaixo será exibido apenas para admins	   
if(np_admins()){  
np_print("<a href='?page=midia&type=image&paging' title='{$npLang['Media']}' class='bar-item button'><i class='material-icons'>perm_media</i> <span class='np-text-link'>{$npLang['Media']}</sapn></a>");
}
	 np_loop_link();
	 //O menu abaixo será exibido apenas para admins com nivel: 1
	 if(np_admin()):
	 ?>
	 
	 <?php endif; ?>
	 <a href="#" class="btn-text-hide button bar-item"><i class="material-icons">fast_rewind</i><span class="np-text-link">Recolher Menu</span></a>
    <a href="#" class="btn-text-show button bar-item"><i class="material-icons">fast_forward</i><span class="np-text-link"></span></a>
	 
</nav>
<!-- Conteudo do sistema -->
  <div class="container-geral text-grey animate-opacity content-50 content-page" style="min-height:600px; padding-top:20px;"> 
  <div class="progress light-gray np-animate-submit-image" style="position:relative; top:3px; height:7px; display:;">
<div class="indeterminate green"></div>
</div><div style="padding-left:8px; padding-top:10px; padding-right:8px;">
  <?php 
  np_hook("admin_bottom", null);
  np_hook("admin_top", null);
  
  np_hook_loop("admin_top");
  @np_include_page(); 
  np_hook_loop("admin_bottom");
  ?></div>
  <a href='#' class='button large circle xlarge blue white border btn-view-float' title='Ocultar barras' style='position:fixed; bottom:10px; right:10px'><i class='material-icons'>open_with</i></a>
  </div>
<script>
	$('#post_content').jqte();
    $('#post_content').jqte({"status" : true});
</script>

<div id="id01" class="modal modal-off">
<div class="modal-content padding round center" style="max-width:500px">
<header>
<h4><i class="material-icons">power_settings_new</i> Desconectar</h4>
</header>
<div>
<p><b><?php np_print(NP_USER_FNAME); ?></b>, você tem certeza que deseja desconectar da sua conta?</p>
<a href="login.php?logout=<?php echo NP_USER_ID; ?>" class="btn white border">Sim</a>
<a href="#" class="btn white border-blue border btn-modal-off">Não</a>
</div>
</div>
</div> 
</body>
</html>