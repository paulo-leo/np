<?php the_header(); ?>
<div class="padding">
     <div class="row-padding padding-32" style="margin:0 -16px">
<?php if(the_have()): foreach(the_posts() as $post): ?>
        <div class="third margin-bottom">
          <?php the_image($post, null, "img-destaque hover-opacity"); ?>
          <div class="container white">
            <p><b><?php the_title($post); ?></b></p>
            <p class="opacity"><?php the_time($post); ?></p>
            <p><?php the_content($post, 100); ?></p>
            <?php the_permalink($post, "btn blue", "Visualizar"); ?>
          </div>
        </div>
<?php endforeach; endif; ?> 
</div>
<ul class="ul">
<?php the_post_links("<li>","</li>", "btn", 10); ?>
</ul>


</div>
<?php the_footer(); ?>