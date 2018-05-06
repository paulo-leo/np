<?php
$np_mod_info = array(
//Nome do módulo:
"name"=>"NP - Formulário de Contato",

//Descrição do módulo:
"description"=>"Pequeno e simples formulário de contato"
);

function np_mod_atv(){
  $sql_form = "CREATE TABLE ".NP."contact_form (
  ID bigint(20) NOT NULL AUTO_INCREMENT,
  subject varchar(100) NOT NULL,
  name varchar(150) NOT NULL,
  phone varchar(20) NOT NULL,
  email varchar(130) NOT NULL,
  message varchar(250) NOT NULL,
  datetime datetime NOT NULL,
  protocol varchar(70) NOT NULL,
  PRIMARY KEY (ID)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
np_exec($sql_form);
}

function np_mod_dst(){
	$sql_form = "DROP TABLE ".NP."contact_form";
	np_exec($sql_form);
}
?>
