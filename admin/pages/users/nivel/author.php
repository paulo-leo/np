<div class="row">
<h5 class='col m12 center card border border-blue padding'><i class="material-icons">edit</i>Abaixo estão as publicações criadas por você.  </h5>
<div class="col m6 card padding">
<table class="table">
  <tbody>
     <tr>
      <td colspan="3" class="large center"><a href="?page=page&paging" class="btn white">Páginas (<?php echo np_count(NP."posts", "WHERE post_type = 2 AND post_author = ".NP_USER_ID." AND post_status != 4"); ?>)</a></td>
    </tr>
    <tr>
      <td>Publicos</td>
      <td>Usuários</td>
      <td>Privados</td>
    </tr>
    <tr>
      <td><?php echo np_count(NP."posts", "WHERE post_type = 2 AND post_author = ".NP_USER_ID." AND post_status = 1"); ?></td>
      <td><?php echo np_count(NP."posts", "WHERE post_type = 2 AND post_author = ".NP_USER_ID." AND post_status = 2"); ?></td>
      <td><?php echo np_count(NP."posts", "WHERE post_type = 2 AND post_author = ".NP_USER_ID." AND post_status = 3"); ?></td>
	  </tr>
  </tbody>
</table>
</div>
<div class="col m6 card padding">
<table class="table">
  <tbody>
     <tr>
      <td colspan="3" class="large center"><a href="?page=post&paging" class="btn white">Posts (<?php echo np_count(NP."posts", "WHERE post_type = 1 AND post_author = ".NP_USER_ID." AND post_status != 4"); ?>)</a></td>
    </tr>
    <tr>
      <td>Publicos</td>
      <td>Usuários</td>
      <td>Privados</td>
    </tr>
    <tr>
      <td><?php echo np_count(NP."posts", "WHERE post_type = 1 AND post_author = ".NP_USER_ID." AND post_status = 1"); ?></td>
      <td><?php echo np_count(NP."posts", "WHERE post_type = 1 AND post_author = ".NP_USER_ID." AND post_status = 2"); ?></td>
      <td><?php echo np_count(NP."posts", "WHERE post_type = 1 AND post_author = ".NP_USER_ID." AND post_status = 3"); ?></td>
	  </tr>
  </tbody>
</table>
</div>
</div>

