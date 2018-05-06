<?php np_no_access(np_admin()); ?>
<h2><i class="material-icons">settings_input_component</i> Módulos</h2>
<?php
$dir    = '../content/modules';
$folders = scandir($dir);
$folders_count = count($folders);

///Ativação do módulo
if(np_is('np_action', 'np_mod_atv')){
	$name = np_ipost('mod_name');
	include("../content/modules/{$name}/start.php");
	/*/A seguinte função deve ser criada pelo usuário no arquivo start.php sem nehuma passagem de parametros. 
	Exemplo:
	<?php
	function np_mod_atv(){
		...
	}
	?>
	Essa função será executada toda vez que o moulo for ativado pelo painel do admin
	/*/
	
	if(np_count(NP."mods", "WHERE mod_id = '{$name}'") == 1){
		np_msg("Não é possível ativar este modulo!  Pois existe um outro modulo com o mesmo nome de identificação. Altere o nome da pasta do modulo e tente novamente.", "red");
	}else{
	$np_mod_var_sql = "INSERT INTO ".NP."mods(mod_id, mod_name, mod_description) VALUES ('{$name}', '{$np_mod_info['name']}', '{$np_mod_info['description']}')";
	
	if(np_exec($np_mod_var_sql)){
		np_msg("Modulo:<b> {$np_mod_info['name']}</b> foi ativado com sucesso!", "green");
		np_mod_atv();
	   }else{ np_msg("Erro ao ativar módulo no banco de dados", "red");  }
	}
}
///Desativação do módulo
if(np_is('np_action', 'np_mod_dst')){
	$name = np_ipost('mod_name');
	include("../content/modules/{$name}/start.php");
	/*/A seguinte função deve ser criada pelo usuário no arquivo start.php sem nehuma passagem de parametros. 
	Exemplo:
	<?php
	function np_mod_dst(){
		...
	}
	?>
	Essa função será executada toda vez que o modulo for desativado pelo painel do admin
	/*/
	if(!np_count(NP."mods", "WHERE mod_id = '{$name}'")){
		np_msg("Esse módulo já está atualmente desativado.");
	}else{
	if(np_delete(NP."mods", "WHERE mod_id = '{$name}'")){
		np_msg("Modulo:<b> {$np_mod_info['name']}</b> foi desativado.", "red");
		np_mod_dst();
	   }else{ np_msg("Erro ao ativar módulo no banco de dados", "red");  }
	}
}



echo "<table class='table' style=''>";
for($i = 2; $i < $folders_count; $i++){
	include("../content/modules/{$folders[$i]}");
	echo "<tr class='card margin-top'><td>
	<p class='left'><i class='material-icons'>settings_input_hdmi</i>ID: ";
	$modx = np_count(NP."mods", "WHERE mod_id = '{$folders[$i]}'");
	echo "{$folders[$i]} ";
	if($modx >= 1){  echo "<br><span class='text-green'> (Ativado)</span>"; }else{ 
	   echo "<br><span class='text-red'> (Desativado)</span>";
	}
	echo "</p></td><td>
	<span class='right'>
	<form method='post'>"; 
	if(np_count(NP."mods", "WHERE mod_id = '{$folders[$i]}'") == 1){
		echo np_act('np_action', 'np_mod_dst').np_act(mod_name, $folders[$i])."<input type='submit' class='btn border white border-red small' value='Desativar'>";
	}else{
		echo np_act('np_action', 'np_mod_atv').np_act(mod_name, $folders[$i])."<input type='submit' class='btn border white border-green small' value='Ativar'>";
	}
	
	echo "</form>
	</span>
	</td></tr>";
}
 echo "</table>";  

?> 