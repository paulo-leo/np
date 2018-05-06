<?php np_no_access(np_admin()); ?>
<h2><i class="material-icons">http</i> Servidor</h2>
<p class="panel pale-red leftbar border-red padding">As informações do servidor estão com a edição de forma gráfica desabilitada.</td>
</p>
<table class="table bordered striped hoverable border">
<tbody>
<td><i class="material-icons">http</i> Endereço do servidor</td>
<td><?php np_print(HOST);?></td>
</tr>
<tr>
<td><i class="material-icons">perm_identity</i> Nome do usuário</td>
<td><?php np_print(USER);?></td>
</tr>
<tr>
<td><i class="material-icons">vpn_key</i> Senha de acesso</td>
<td>******************</td>
</tr>
<tr>
<td><i class="material-icons">explicit</i> Prefixo das tabelas</td>
<td><?php np_print(NP);?></td>
</tr>
<tr>
<td><i class="material-icons">code</i> Versão do PHP</td>
<td><?php echo PHP_VERSION;?></td>
</tr>
<tr>
<td><i class="material-icons">info</i> Versão do NP</td>
<td><?php np_print(NP_VERSION); ?></td>
</tr>
<tr>
<td><i class="material-icons">av_timer</i> Timezone definido</td>
<td><?php np_print(NP_TIMEZONE); ?></td>
</tr>
</tbody>
</table> 
