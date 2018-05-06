<?php the_header(); ?>
<div class="content card padding">
  <h2><?php the_category_name(); ?></h2>
  <p><?php the_category_description(); ?></p>
  <p><?php the_category_count(); ?></p>
  <ul class="ul"><?php the_posts_category(); ?>
  </ul>
</div>
<?php the_footer(); ?>