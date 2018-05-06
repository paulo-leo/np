<?php
the_header();
$x = the_posts_tags();
if($x){
	foreach($x as $id){
		echo "<div class='card canter padding' style='width:200px'>";
		the_title($id);
		echo "</div>";
	}
}else{
	echo "<h4>Nenhum post encontrado com a tag \"{$post_id}\"</4>";
}


?>
