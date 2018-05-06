<?php the_search_form("Procurar...");?>
<h3>Posts relacionados</h3>
<ul class="ul">
<?php the_posts_category(); ?>
</ul>
<h3>Tags</h3>
<ul class="ul">
<?php the_tag_list(); ?>
</ul><hr>
<?php
if(the_posts_tags()){
	foreach(the_posts_tags() as $id){
		echo "<p>";
		the_title($id);
		echo "</p>";
		the_image($id, "width:100px; height:90px", "card");
	}
}
?>