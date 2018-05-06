<?php
///Menu posts
$posts = array(
"url"=>"post",
"title"=>"Posts",
"icon"=>"edit",
"access"=>"author");

$pages = array(
"url"=>"page",
"title"=>"Páginas",
"icon"=>"library_books",
"access"=>"author");
///Post e page add
$post_add = array(
"page"=>"post",
"url"=>"post-form",
"title"=>"Adicionar novo");
$page_add = array(
"page"=>"page",
"url"=>"post-form",
"title"=>"Adicionar nova");

$posts_lixeira = array(
"page"=>"post",
"url"=>"lixeira",
"icon"=>"delete",
"title"=>"Lixeira");
$posts_lixeira2 = array(
"page"=>"page",
"url"=>"lixeira",
"icon"=>"delete",
"title"=>"Lixeira");

$cat = array(
"url"=>"category",
"icon"=>"view_list",
"title"=>"Categorias",
"access"=>"editor");
//Arquivos
$file = array(
"url"=>"file",
"icon"=>"view_quilt",
"title"=>"Galeria de arquivos",
"access"=>"editor");

$file_add = array(
"page"=>"file",
"url"=>"file-add",
"icon"=>"open_in_browser",
"text"=>"Enviar novo",
"title"=>"Enviar novo arquivo");

$file_folder = array(
"page"=>"file",
"url"=>"file-add",
"icon"=>"album",
"title"=>"Álbuns de arquivos",
"text"=>"Álbuns");

$file_folder_add = array(
"page"=>"file",
"url"=>"file-add",
"title"=>"Adicionar nova álbum de arquivos",
"text"=>"Adicionar álbum");


$cat_add = array(
"page"=>"category",
"url"=>"add-category",
"title"=>"Adicionar nova");

$posts_pages = array(
"page"=>"post",
"url"=>"post-form",
"icon"=>"list",
"title"=>"Páginas");

///Menu usuários
$users = array(
"url"=>"users",
"title"=>"Usuários",
"icon"=>"supervisor_account",
"access"=>"private");

$users_add = array(
"page"=>"users",
"url"=>"add-user",
"title"=>"Adicionar novo");

///Menu modulos
$mods = array(
"url"=>"mod",
"title"=>"Módulos",
"icon"=>"view_module",
"access"=>"private");
///Menu configurações
$settings = array(
"url"=>"settings",
"title"=>"Configurações",
"icon"=>"settings",
"access"=>"private");
//Sumenus
np_add_submenu($post_add);
np_add_submenu($page_add);
np_add_submenu($posts_lixeira);
np_add_submenu($cat_add);
np_add_submenu($posts_lixeira2);
np_add_submenu($users_add);
np_add_submenu($file_add);
np_add_submenu($file_folder);
np_add_submenu($file_folder_add);

//Menus 
np_add_menu($posts);
np_add_menu($pages);
np_add_menu($cat);
np_add_menu($file);
np_add_menu($users);
np_add_menu($settings);
np_add_menu($mods);
?>