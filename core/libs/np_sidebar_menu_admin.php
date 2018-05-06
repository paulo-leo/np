<?php
//função para adicionar links no sidebar da administração:
function np_add_menu($link){
     global $np_link_admin;
	 global $np_link_admin_submenu;
   	 if(!isset($link['icon'])){ $link['icon'] = "link"; }
     if(!isset($link['class'])){ $link['class'] = null; }
	 if(!isset($link['style'])){ $link['style'] = null; }
	 if(!isset($link['id'])){ $link['id'] = null; }
	 if(!isset($link['title'])){ $link['title'] = $link['text']; }
	 if(!isset($link['text'])){ $link['text'] = $link['title']; }
	 if(!isset($link['click_class'])){ $link['click_class'] = "white"; }
	 if(!isset($link['click_class_submenu'])){ $link['click_class_submenu'] = "lime"; }
	 if(!isset($link['access'])){ $link['access'] = "all"; }
	 $l = $link['url'];
	 $aaa = "&menu=".$l;
	 if(isset($_GET['menu']) and $_GET['menu'] == $l){
		 $c = $link['click_class'];
		 $c2 = $link['click_class_submenu'];
	 }else{ $c = null; $c2 = null; }
	 
	 $r = "<a id='{$link['id']}' href='?page={$l}{$aaa}&paging' title='{$link['title']}' class='{$link['class']} {$c} bar-item button'><i class='material-icons'>{$link['icon']}</i> <span class='np-text-link'>{$link['text']}</sapn></a>";

	 if(isset($np_link_admin_submenu[$l]) and count($np_link_admin_submenu[$l]) > 0){
     for($i=0; $i < count($np_link_admin_submenu[$l]); $i++){
	 $a[] = $np_link_admin_submenu[$l][$i];
         }
		$x = "<div class='bar-block {$c2} animate-left'>".implode($a)."</div>";
     }else{ $x = null; }
	 
	 
	 if(isset($_GET['menu']) and $_GET['menu'] == $link['url']){
		 $show = $r.$x;
	 }
	 else{ $show = $r; }
	 //Verifica o nivel do usuário 
	 $as = $link['access'];
	 if($as == "admin" or $as == 1 or $as == "private"){
	    if(np_admin()){  $np_link_admin[$l] = $show; } }
	  elseif($as == "editor" or $as == 2 or $as == "protected"){
	     if(np_admins()){  $np_link_admin[$l] = $show; } 
	  }elseif($as == "author" or $as == 3){
		  if(np_adminss()){  $np_link_admin[$l] = $show; } 
	  }elseif($as == "login" or $as == 4 or "reader"){
		  if(np_adminss()){  $np_link_admin[$l] = $show; } 
	  }else{  $np_link_admin[$l] = $show; }
}
function np_add_submenu($link){
	 global $np_link_admin_submenu;
     if(!isset($link['icon'])){ $link['icon'] = "playlist_add"; }
     if(!isset($link['class'])){ $link['class'] = "hover-green"; }
	 if(!isset($link['style'])){ $link['style'] = null; }
	 if(!isset($link['id'])){ $link['id'] = null; }
	 if(!isset($link['text'])){ $link['text'] = $link['title']; }
	 if(!isset($link['title'])){ $link['title'] = $link['text']; }
	 
	 $page = $link['page'];

$submenu = "<a href='?page={$link['url']}&menu={$page}&paging' id='{$link['id']}' style='{$link['style']}' title='{$link['title']}' class='bar-item btn {$link['class']} submenus'><i class='material-icons'>{$link['icon']}</i><span class='np-text-link'>{$link['text']}</span></a>";
$np_link_admin_submenu[$page][] = $submenu;    
}

function np_loop_link(){  
global $np_link_admin;
global $np_link_admin_sub;
if($np_link_admin):
foreach($np_link_admin as $url=>$link):
       echo $link;     
endforeach;
  endif;
}
?>