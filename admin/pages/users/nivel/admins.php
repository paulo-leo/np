<div class="row">
<div class="col m4 card padding">
<table class="table">
  <tbody>
     <tr>
      <td colspan="3" class="large center"><a href="?page=post&paging" class="btn white">Posts (<?php echo np_count(NP."posts", "WHERE post_type = 1 AND post_status != 4"); ?>)</a></td>
    </tr>
    <tr>
      <td>Publicos</td>
      <td>Usuários</td>
      <td>Privados</td>
    </tr>
    <tr>
      <td><?php echo np_count(NP."posts", "WHERE post_type = 1 AND post_status = 1"); ?></td>
      <td><?php echo np_count(NP."posts", "WHERE post_type = 1 AND post_status = 2"); ?></td>
      <td><?php echo np_count(NP."posts", "WHERE post_type = 1 AND post_status = 3"); ?></td>
	  </tr>
  </tbody>
</table>
</div>
<div class="col m4 padding card-4">
<table class="table">
  <tbody>
     <tr>
      <td colspan="3" class="large center"><a href="?page=page&paging" class="btn white">Páginas (<?php echo np_count(NP."posts", "WHERE post_type = 2 AND post_status != 4"); ?>)</a></td>
    </tr>
    <tr>
      <td>Publicos</td>
      <td>Usuários</td>
      <td>Privados</td>
    </tr>
    <tr>
      <td><?php echo np_count(NP."posts", "WHERE post_type = 2 AND post_status = 1"); ?></td>
      <td><?php echo np_count(NP."posts", "WHERE post_type = 2 AND post_status = 2"); ?></td>
      <td><?php echo np_count(NP."posts", "WHERE post_type = 2 AND post_status = 3"); ?></td>
	  </tr>
  </tbody>
</table>
</div>
<div class="col m4 card padding">
<table class="table center">
  <tbody>
     <tr>
      <td colspan="3" class="large center"><a href="?page=category&paging" class="btn white">Categorias (<?php echo np_count(NP."categories", ""); ?>)</a></td>
    </tr>
    <tr>
      <td class="center">Publicações sem categoria</td>
    </tr>
    <tr>
      <td class="center"><?php echo np_count(NP."posts", "WHERE post_status != 4 AND post_category = 1"); ?></td>
	  </tr>
  </tbody>
</table>
</div>
<!------Garficos de arquivos-------->
<?php  
$total =  np_count(NP."files", "");
$image =  np_count(NP."files", "WHERE file_type = 'image'"); 
$video =  np_count(NP."files", "WHERE file_type = 'video'"); 
$file =  np_count(NP."files", "WHERE file_type = 'file'"); 
$image = intval(($image / $total) * 100);
$video = intval(($video / $total) * 100);
$file = intval(($file / $total) * 100);
echo "<div class='col m6 card padding margin-top'>
<h4>{$total} Arquivo(s) carregado(s)</h4>
<div class='light-grey'>Imagens
<div class='container blue center' style='width:{$image}%'>{$image}%</div>
</div><br>
<div class='light-grey'>Vídeos
<div class='container red center' style='width:{$video}%'>{$video}%</div>
</div><br>
<div class='light-grey'>Documentos
<div class='container green center' style='width:{$file}%'>{$file}%</div>
</div><br></div>";

$total2 =  np_count(NP."users", "");
if(np_admin()){
echo "<div class='col m6 margin-top'>
<div class='margin card padding'>
<h4>{$total2} Usuário(s) cadastrado(s)</h4>
<p class='text-red'>".np_count(NP."users", "WHERE user_type = 1")." usuário(s) com nível admirativo</p>
<p class='text-pink'>".np_count(NP."users", "WHERE user_type = 2")." usuário(s) com nível de edição</p>
<p class='text-blue'>".np_count(NP."users", "WHERE user_type = 3")." usuário(s) com nível autoral</p>
<p class='text-green'>".np_count(NP."users", "WHERE user_type = 4")." usuário(s) com nível de leitura</p>
</div></div>";}
////Fim do painel para os adminis
?>
</div>
