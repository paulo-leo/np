<?php
$host = $_SERVER['SERVER_NAME'];
$dir = $_SERVER['PHP_SELF'];
$dir2 = $host.$dir;

function np_str_replace($str, $seach, $new_str){
$string = $str;
$pattern = '/'.$seach.'/i';
$replacement = $new_str;
return  preg_replace($pattern, $replacement, $string);
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Instalação</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="admin/front/css/style.css">
<link rel="stylesheet" href="admin/front/icons/material.css">
</head>

<body class="row">
<div class="card content" style="max-width:700px">
<form class="margin padding">
<header class="center">
<h1>
<span class="badge ">1</span>
<span class="badge blue">2</span>
<span class="badge ">3</span>
 Instalação</h1>
<h3>Configurações do banco de dados</h3>
</header>
<p>
<input type="text" class="input " value="<?php echo np_str_replace($dir2, "install.php", "");?>" /></p>
<p><i class="material-icons">http</i> Nome do Servidor
<input type="text" class="input" name=""/></p>
<p><i class="material-icons">dns</i> Nome do banco de dados
<input type="text" class="input" name=""/></p>
<p><i class="material-icons">perm_identity</i> Nome do usuário
<input type="text" class="input" name=""/></p>
<p><i class="material-icons">vpn_key</i> Senha do usuário
<input type="text" class="input" name=""/></p>
<p><i class="material-icons">explicit</i> Prefixo da tabela
<input type="text" class="input" value="np_" name=""/></p>
<input type="submit" class="btn blue" value="Salvar"/>
</form>
</div>



<div class="card content" style="max-width:700px">
<form class="margin padding">
<header class="center">
<h1>
<span class="badge blue">1</span>
<span class="badge">2</span>
<span class="badge ">3</span>
 Instalação</h1>
<h3>Selecione o idioma do sistema</h3>
</header>
<p><i class="material-icons">translate</i> Idioma do sistema</p>
<select class="select">
<option>Português do Brasil</option>
<option>Inglês EUA</option>
</select>
<input type="submit" class="btn blue" value="Salvar"/>
</form>
</div>

</body>
</html>


