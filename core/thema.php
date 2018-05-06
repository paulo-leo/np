<?php
function the_blog($x=null){
	if($x == null or $x == "name" or $x == "title"){ echo NP_NAME; }
	elseif($x == "url" or $x == "url/site"){ echo NP_URL; }
	elseif($x == "a/url" or $x == "link/site"){ echo "<a title='Home' href='".NP_URL."'>".NP_NAME."</a>"; }
	elseif($x == "a/admin" or $x == "link/admin"){ echo "<a title='Login' href='".NP_URL."/admin'>Login</a>"; }
	elseif($x == "description"){ echo NP_DESCRIPTION; }
	elseif($x == "admin" or $x == "url/admin"){ echo NP_URL."/admin"; }
	elseif($x == "copyright" or $x == "©" or $x == "reserved"){ 
	if(NP_LANG == "pt-br" or NP_LANG == "pt"){ echo "©Copyright ".date("Y")." ".NP_NAME.". Todos os direitos reservados";}else{ echo "©Copyright ".date("Y")." ".NP_NAME.". All rights reserved"; }
	 }
}
//Funções para inclução de arquivos:
function the_header(){
	include("content/themes/".NP_THEMA."/header.php"); 
}
function the_footer(){
	include("content/themes/".NP_THEMA."/footer.php"); 
}
function the_sidebar($cd=null){
	if($cd==null){ include("content/themes/".NP_THEMA."/sidebar.php"); }
	else{ include("content/themes/".NP_THEMA."/{$cd}"); }	 
}
function the_include($file){
	$f = explode(".", $file);
	include("content/themes/".NP_THEMA."/{$f[0]}.php"); 
}
//Função para extrair o titulo do post ou pagina
function the_title($id=null){
if(!is_array($id)){
global $post_id;
global $postQueryObject;
if(isset($_GET['url'])){
	$url = $_GET['url'];
}else{
	$url = NP_NAME;
}
////////////////
if($url == "post" or $url == "page"){
	echo $postQueryObject->post_title;
}elseif($url == "category"){
	the_category_name();
}elseif($url == "app"){
	np_aux_title_app();
}elseif($url == "author"){
	the_author_name();
}elseif($url == "404"){
	echo "404 - Página não encontrada.";
}else{
	echo $url;
}}else{
	  echo $id['post_title'];
   }
}
//Função para extrair a descrição do post ou da pagina
function the_description($id=null){
if(!is_array($id)){
global $post_id;
global $postQueryObject;
if(isset($_GET['url'])){
	$url = $_GET['url'];
}else{
	$url = NP_DESCRIPTION;
}
////////////////
if($url == "post" or $url == "page"){
	echo $postQueryObject->post_description;
}elseif($url == "category"){
	the_category_name();
}elseif($url == "app"){
	np_aux_title_app();
}elseif($url == "author"){
	the_author_name();
}else{
	echo $url;
}}else{
	  echo $id['post_description'];
   }
}
//Função para extrair as palavras chaves do post ou da pagina
function the_keywords($id=null){
if(!is_array($id)){
global $post_id;
global $postQueryObject;
if(isset($_GET['url'])){
	$url = $_GET['url'];
}else{
	$url = NP_KEYWORDS;
}
////////////////
if($url == "post" or $url == "page"){
	echo $postQueryObject->post_keys;
}elseif($url == "category"){
	the_category_name();
}elseif($url == "app"){
	np_aux_title_app();
}elseif($url == "author"){
	the_author_name();
}else{
	echo $url;
}}else{
	  echo $id['post_keys'];
   }
}

//Função para extrair o conteúdo do post ou pagina
function the_content($id=null, $max=100, $more="..."){
if(!is_array($id)){
global $post_id;
global $postQueryObject;
echo $postQueryObject->post_content; 
}else{   
echo substr(strip_tags($id['post_content']),0 , $max); 
 if(strlen($id['post_content']) > $max){ echo "<b>".$more."</b>"; }
  }}
//Função para extrair o nome do autor do post ou pagina
function the_author($id=null, $link=null, $class=null){
if(!is_array($id)){
if($id == null){
	global $postQueryObject;
	$post_id = $postQueryObject->post_author;
}else{
	$post_id = $id;
}
$author = np_obj_id("users", $post_id, "user_display");
if($link == null){
	echo $author;
}else{
  echo "<a class='{$class}' title='{$author}' href='".NP_URL."/author/{$post_id}'>{$author}</a>";
   }
}else{
	$author_id = $id["post_author"];
	$author = np_obj_id("users", $author_id, "user_display");
	if($link == null){
		echo $author;
	}else{
		echo "<a class='{$class}' title='{$author}' href='".NP_URL."/author/{$author_id}'>{$author}</a>";
	}	
}}

//Função para extrair o nome do autor do post ou pagina
function the_author_name($id=null){
if($id == null){
	global $post_id;
}else{
	$post_id = $id;
}
$autor = np_one(NP."users", "user_display", $post_id);
echo $autor;
}
function the_author_about($id=null){
if($id == null){
	global $post_id;
}else{
	$post_id = $id;
}
np_obj_id("users", $post_id, "user_about", true);
}
function the_author_img($id=null){
if($id == null){
	global $post_id;
}else{
	$post_id = $id;
}
$img = np_obj_id("users", $post_id, "user_img");
echo NP_URL."/uploads/".$img;
}
function the_author_posts($id=null, $class=null){
if($id == null){
	global $post_id;
}else{
	$post_id = $id;
}
$sql = "SELECT post_title, slung FROM ".NP."posts WHERE post_author = {$post_id} AND post_status IN(1, 2) AND post_type = 1";
$posts = np_query($sql);
if($posts){
    foreach($posts as $id){
		echo "<li><a class='{$class}' title='{$id['post_title']}' href='".NP_URL."/post/{$id['slung']}'>{$id['post_title']}</a></li>";	
	}
}else{
	 echo "<li>Este autor ainda não possui nenhuma publicação.</li>";
  }
}
function the_category_name(){
	global $post_id;
    if(np_count(NP."categories", "WHERE ID  = {$post_id}") > 0){
		np_obj_id("categories", $post_id, "category_name", true); }else{
		echo "<b class='text-red'>Essa categoria não existe.</b>";
	}
}
function the_category_description(){
	global $post_id;
	if(np_count(NP."categories", "WHERE ID  = {$post_id}") > 0){
	np_obj_id("categories", $post_id, "category_description", true); }
}
function the_category_count($id=null , $color="green"){
	if($id == null){
		global $post_id;
	}else{ $post_id = $id; }
	
	if(np_count(NP."categories", "WHERE ID  = {$post_id}") > 0){
	$num = np_count(NP."posts", "WHERE post_status IN(1, 2) AND post_type = 1 AND post_category = {$post_id}");
	if($num == 1){	$msg = "<span class='text-{$color}'>Um post ou página vinculado</span>"; }
	elseif($num > 1){$msg = "<b class='badge {$color}'>{$num}</b> páginas ou posts relacionados."; }
	else{$msg = "Nenhum post ou página.";}
	echo $msg;}else{
		echo "ID: ".$post_id;
	}
}
function the_posts_category($id=null, $class=null){
if($id==null){ 
if(isset($_GET['url']) and $_GET['url'] == "category"){
	global $post_id;
}else{
	global $postQueryObject; $post_id = $postQueryObject->post_category;
}
 }else{
	 $post_id = $id;
}
$sql = "SELECT post_title, slung FROM ".NP."posts WHERE post_category = {$post_id} AND post_status IN(1, 2) AND post_type = 1";
$posts =  np_query($sql);

if($posts){
	foreach($posts as $id){
		 echo "<li><a class='{$class}' title='{$id['post_title']}' href='".NP_URL."/post/{$id['slung']}'>{$id['post_title']}</a></li>";
	}
}else{
	echo "<li>No momento não existem nenhum post publicado nesta categoria.</li>";
  }
}

function the_category($id=null){
if(!is_array($id)){
if($id == null){ 
global $postQueryObject; 
$category_id = $postQueryObject->post_category;
np_obj_id("categories", $category_id, "category_name", true);
 }else{
$category_id = np_obj_id("posts", $id, "post_category");
np_obj_id("categories", $category_id, "category_name", true);
}}else{
$category_id = $id["post_category"];
np_obj_id("categories", $category_id, "category_name", true);
  }
}


function get_category($id=null, $input="category_name"){
if(!is_array($id)){
if($id == null){ 
global $postQueryObject; 
$category_id = $postQueryObject->post_category;
np_obj_id("categories", $category_id, $input);
 }else{
$category_id = np_obj_id("categories", $id, "post_category_name");
np_obj_id("categories", $category_id, $input);
}}else{
$category_id = $id["post_category"];
np_obj_id("categories", $category_id, $input);
  }
}

function the_category_link($id=null, $class=null){
if(!is_array($id)){
if($id == null){ 
global $postQueryObject; 
$category_id = $postQueryObject->post_category;
$a = np_obj_id("categories", $category_id, "category_name");
$s = np_obj_id("categories", $category_id, "slung");
echo "<a href='".NP_URL."/category/{$s}' title='{$a}' class='{$class}'>{$a}</a>";
 }else{
$category_id = np_obj_id("categories", $id, "post_category_name");
$a = np_obj_id("categories", $category_id, "category_name");
$s = np_obj_id("categories", $category_id, "slung");
echo "<a href='".NP_URL."/category/{$s}' title='{$a}' class='{$class}'>{$a}</a>";
}}else{
$category_id = $id["post_category"];
$a = np_obj_id("categories", $category_id, "category_name");
$s = np_obj_id("categories", $category_id, "slung");
echo "<a href='".NP_URL."/category/{$s}' title='{$a}' class='{$class}'>{$a}</a>";
  }
}
//Função para extrair uma determinada linha do banco de dados do post ou pagina
function the_row($row, $r=false){
global $post_id;
np_obj_id("posts", $post_id, $row, $r);
}
//Função para buscar o link 
function the_permalink($id=null, $class="", $text=null){
	if(!is_array($id)){
	
	}else{
		 if($text == null){ $text = $id['post_title']; }
		if($id['post_type'] == 1){ echo "<a class='{$class}' href='".NP_URL."/post/{$id['slung']}'>{$text}</a>"; }else{
			echo "<a class='{$class}' href='".NP_URL."/page/{$id['slung']}'>{$text}</a>";
		}
		
	}
	
}
//Função para inserir ID 
function the_ID($id=null, $text="post-"){
	if(!is_array($id)){
	
	}else{
		echo " id=\"{$text}".$id['ID']."\" ";
	}	
}
//Função para inserir CLASS 
function the_class($id=null, $text="post-"){
	if(!is_array($id)){
	
	}else{
		echo " class=\"{$text}".$id['ID']."\" ";
	}	
}
//Função para extrair o a data e hora do post ou pagina
function the_time($id=null, $out="time+", $entre=null){
if(!is_array($id)){
global $post_id;
global $postQueryObject;
echo np_time($postQueryObject->post_date, $out, $entre);
}else{
	   echo np_time($id['post_date'], $out, $entre);
}
}
//Funções de inclusão de links de posts
function the_post_links($atag=null, $dtag=null, $css=null, $limit=null){
$read = new Read;
if($limit != null){
$sql = "WHERE post_status in (1, 2)  and post_type = 1 ORDER BY ID DESC LIMIT {$limit}";
}else{ $sql = "WHERE post_status in (1, 2) and post_type = 1 ORDER BY ID DESC"; }
$read->exeRead(NP."posts", $sql);
if($read->getRowCount() >= 1){
	foreach($read->getResult() as $lin){
		echo  "{$atag}<a href='".NP_URL."/post/{$lin['slung']}' class='{$css}'>{$lin['post_title']}</a>{$dtag}";
	}
  }
}
//Funções de inclusão de links de páginas
function the_page_links($atag=null,$dtag=null, $css=null, $limit=null, $app=true){
$read = new Read;
if($limit != null){
$sql = "WHERE post_status in (1, 2)  and post_type = 2 ORDER BY post_order LIMIT {$limit}";
}else{ $sql = "WHERE post_status in (1, 2) and post_type = 2 ORDER BY post_order"; }
$read->exeRead(NP."posts", $sql);
if($read->getRowCount() >= 1){
	foreach($read->getResult() as $lin){
		echo  "{$atag}<a href='".NP_URL."/page/{$lin['slung']}' title='{$lin['post_title']}' class='{$css}'>{$lin['post_title']}</a>{$dtag}";
	}
  }
if($app == true and np_count_link_app() > 0){ np_loop_link_app($atag, $dtag);}  
}
function np_icons_status($s){
	if($s == 1){ return "<i class='material-icons' title='Publicado para todos'>language</i>"; }
	elseif($s == 2){ return "<i class='material-icons text-green' title='Publicado para usuários conectados'>lock_outline</i>"; }
	elseif($s == 3){ return "<i class='material-icons text-red' title='Privado ou pendente'>visibility_off</i>"; }
}
///Função para bsucar
function the_search_form($placeholder="Pesquisar...", $class="input border round"){
	echo "<form action='".NP_URL."/search' method='get'>
	         <input placeholder='{$placeholder}' type='text' name='q' class='{$class}'>
	      </form>";
}
//Função para contar os comentários
function the_comment_count($post_id=null, $color='badge green small'){
if(!is_array($post_id)){	
	if($post_id == null){
		global $post_id;
	}
	$comment = np_count(NP."comments", "WHERE post_id = {$post_id}");
	if($comment == 0){
		  echo " Nenhum comentário ";
	}elseif($comment == 1){
		echo " Um comentário ";
	}else{
		 echo " <span class='{$color}'>{$comment}</span> comentários ";
}}else{
	$id = $post_id["ID"];
	$comment = np_count(NP."comments", "WHERE post_id = {$id}");
	if($comment == 0){
		  echo " Nenhum comentário ";
	}elseif($comment == 1){
		echo " Um comentário ";
	}else{
		 echo " <span class='{$color}'>{$comment}</span> comentários ";
}
	
}
}
function the_view_count($id=null, $color='green'){
	if($id == null){
	  global $postQueryObject;
	  $comment = intval($postQueryObject->post_views);
	}else{
		$comment = intval($id["post_views"]);
	}
	if($comment == 0){
		  echo " Nenhuma visualização ";
	}elseif($comment == 1){
		echo " <span class='text-indigo'>Uma visualização</span> ";
	}else{
		 echo " <span class='badge small {$color}'>{$comment}</span> visualizações ";
	}
}


//Funções para incluir o style e o script do  NP:
function  the_style($r=false){
$style = "<meta charset='UTF-8'>
<meta name='viewport' content='width=device-width, initial-scale=1'>
<link rel='stylesheet' href='".NP_URL."/admin/front/css/style.css'>
<link rel='stylesheet' href='".NP_URL."/admin/front/icons/material.css'>";
if($r == true){ return $style; }else{
echo $style; }
}

//Funções para incluir o js do  NP:
function  the_script($r=false){
$js = "<script src='".NP_URL."/admin/front/js/jquery.js'></script>";
if($r == true){ echo "<script src='{$r}'></script>"; }else{
echo $js; }
}

//Função para lidar com os aplicativos criados atraves de módulos
function the_application(){
global $np_page_app;
 if(isset($_GET['id'])){
    $page = stripcslashes(htmlspecialchars($_GET['id']));
	if(isset($np_page_app[$page])){
	$file = "content/modules/".$np_page_app[$page];
	if(file_exists($file)){
		include_once($file);
	}else{ 
	np_msg("<b>ERRO</b>: O caminho do arquivo está incorreto ou o arquivo não existe no caminho especificado.", "red"); } }else{
		np_msg("<b>ERRO</b>: Aplicação inexistente ou com a identificação incorreta.", "red");
	}
    }}	
 
function the_posts($limit="10", $orderBy="id", $desc="DESC"){
	 
	 $sql = "SELECT * FROM ".NP."posts WHERE post_type = 1 AND post_status != 4 ORDER BY {$orderBy} {$desc} LIMIT {$limit}";
	return np_query($sql);
}
function the_have($x="post", $cond=null, $cont=true){
	if($x == "post"){
		$w = "SELECT * FROM ".NP."posts WHERE post_type = 1 AND post_status != 4 ";
	}else{
		$w = "SELECT * FROM ".NP."posts WHERE post_type = 2 AND post_status != 4 ";
	}
	if($cont == true){
		return count(np_query($w.$cond));
	}else{
		return np_query($w.$cond);
	}
	
}
//Lista os post por tags
function the_posts_tags($tag=null,$limit=10){
if($tag == null){
if(isset($_GET['url']) and ($_GET['url']) == "tag"){
	 global $post_id;
	 $tag = $post_id;
}else{
	global $postQueryObject;
	$tag = $postQueryObject->post_keys;
}}
$sql = "SELECT * FROM ".NP."posts WHERE post_keys LIKE '%{$tag}%' AND post_type = 1 AND post_status != 4 ORDER BY id DESC LIMIT {$limit}";
return np_query($sql);
}
//Obtem a listagem de tags do post
function the_tag_list($tags=null, $classLi="", $classLink=""){
	    if($tags == null){
			global $postQueryObject;
			$tags = $postQueryObject->post_keys;
		}
        $tags = explode(",", $tags);
	    krsort($tags);
	    foreach($tags as $tag){
		echo "<li class='{$classLi}'><a class='{$classLink}' href='".NP_URL."/tag/".trim($tag)."'>{$tag}</a></li>";
		}
}
function get_tags($tags=null){
    if(is_array($tags)){
		$tags = $tags["post_keys"];
	}else{
	    if($tags == null){
			global $postQueryObject;
			$tags = $postQueryObject->post_keys;
	}}
        return explode(",", $tags);	    
}
//Funções condicionais
//Verifica se a pagina atual é a home
function is_home(){
	if(!isset($_GET['url'])){ return true;}
	else{ return false; }
}
//Verifica se a pagina atual é a post
function is_post(){
	if(isset($_GET['url']) and $_GET['url'] == "post"){ return true;}
	else{ return false; }
}
//Verifica se a pagina atual é a page
function is_page(){
	if(isset($_GET['url']) and $_GET['url'] == "page"){ return true;}
	else{ return false; }
}
//Verifica se a pagina atual é a category
function is_category(){
	if(isset($_GET['url']) and $_GET['url'] == "category"){ return true;}
	else{ return false; }
}
//Verifica se a pagina atual é a tag
function is_tag(){
	if(isset($_GET['url']) and $_GET['url'] == "tag"){ return true;}
	else{ return false; }
}
//Verifica se a pagina atual é a app
function is_app(){
	if(isset($_GET['url']) and $_GET['url'] == "app"){ return true;}
	else{ return false; }
}
function is_api(){
	if(isset($_GET['url']) and $_GET['url'] == "api"){ return true;}
	else{ return false; }
}
//Verifica se a pagina atual é a page e o valor correspondente
function is_page_val($val){
	if(isset($_GET['url']) and $_GET['url'] == "page"){ 
	   if(isset($_GET['id']) and strtolower($_GET['id']) == strtolower($val)){
		   return true;
	   }else{
		   return false;
	   }
	}
	else{ return false; }
}
?>