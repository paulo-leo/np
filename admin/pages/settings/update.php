<?php np_no_access(np_admin()); ?>
<h2><i class="material-icons">loop</i> Atualização</h2>
<form method="post">
<h4>Verifique se existi uma nova atualização do NP!</h4>
<p>Versão atual: <b><?php  echo NP_VERSION; ?></b>
<input type="hidden" name="version" value="<?php  echo NP_VERSION; ?>"/></p>
<input type="submit" value="Verificar" class="btn white border-green border"/>
</form>
