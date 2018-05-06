<?php the_header(); ?>
<div class="row padding white">
  <div class="col m8 padding">
  <h1><?php the_title(); ?></h1>
  <i class="text-blue">
  <?php the_time(); echo " | "; the_category(); echo " | "; the_category_link(false, "btn border"); the_comment_count(false, "red tag"); the_view_count();  the_author(false, true, "btn border text-red"); ?></i>
  <p>
  <?php
  the_content(); ?></p>
  <?php //the_comment_list(); ?>
  </div>
  <div class="col m4 padding card">
  <?php the_sidebar(); ?>
  </div>
  </div>
  <div class="np-debug"></div>
<?php the_footer(); ?>