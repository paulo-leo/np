<?php the_header(); ?>

  <div class="content">
  <img class="" src="<?php the_author_img(); ?>" width="200">
  <h1 class=""> <?php the_author_name(); ?></h1>
  <p class=""><?php the_author_about(); ?></p>
  <ul class="ul"><?php the_author_posts(); ?></ul>
</div>
<?php the_footer(); ?>

