<!DOCTYPE html>
<html>
<head>
<?php the_style(); ?>
<title> <?php the_title(); ?> </title>
<meta name="description" content="<?php the_description(); ?>" />
<meta name="keywords" content="<?php  the_keywords(); ?>" />
<style>
.bar-item > a { text-decoration:none; }
.img-destaque{width:100%; height:200px}
</style>
</head>
<body>
<header class="" style="position:relative;top:-11px; margin-bottom:none;">
<h2 class="wide center"><a href="<?php  the_blog('url'); ?>"><?php  the_blog(); ?></a></h2>
<div class="bar card blue">
<?php the_page_links("<div class='hover-indigo bar-item'>", "</div>"); ?>
</div>
<?php

if(is_home()){
	echo "Você está na página inicial";
}

if(is_page_val("vVv")){
	echo "Você está na página VVV";
}
?>
</header>
