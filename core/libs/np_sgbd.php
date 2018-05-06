<?php
//Funções do NP para lidar com o SGBD
//Execulta uma query sql 
function np_run_sql($sql){
	$npdb = Conn::getConn();
	if($npdb->exec($sql)){ return true; }else{ return false; }
}
//Função para montar e execultar uma query do tipo UPDATE
function np_upd($table, $values, $id=null, $callbackS=" ", $callbackE=" "){
	//Sepera os indices pela chave e valor
	foreach($values as $key => $value){ $t[] =  $key." = '".$value."'"; }
    $t = implode(", ", $t);
	//Monta a condição de atualização da tabela
    if($id == null){ $w = null; }
	elseif(is_numeric($id)){ $w = "WHERE ID = {$id}"; }
	else{ $w = " WHERE {$id}"; }
   //Monta a query
   $sql = "UPDATE {$table} SET {$t} {$w}";
   //Execulta o calback
   if(np_run_sql($sql)){ 
              if(is_callable($callbackS)){ call_user_func($callbackS); }
              else{ echo $callbackS; }
   }else{ 
        if(is_callable($callbackE)){ call_user_func($callbackE); }
        else{ echo $callbackE; }
   }
}
//Função para montar e execultar uma query do tipo DELETE
function np_del($table, $id=null, $callbackS="1", $callbackE=""){
	//Monta a condição de atualização da tabela
    if($id == null){ $w = null; }
	elseif(is_numeric($id)){ $w = "WHERE ID = {$id}"; }
	else{ $w = " WHERE {$id}"; }
   //Monta a query
   $sql = "DELETE FROM {$table} {$w}";
   //Execulta o calback
   if(np_run_sql($sql)){ 
              if(is_callable($callbackS)){ call_user_func($callbackS); }
              else{ echo $callbackS; }
   }else{ 
        if(is_callable($callbackE)){ call_user_func($callbackE); }
        else{ echo $callbackE; }
   }
}
//Função para montar e execultar uma query do tipo INSERT
function np_cre($table, $values, $callbackS="1", $callbackE="0"){
	//Sepera os indices pela chave e valor
	foreach($values as $key => $val){ 
	$k[] = $key;
    $v[] = "'".$val."'";
	}
    $k = implode(", ", $k);
	$v = implode(", ", $v);
   //Monta a query
   $sql = "INSERT INTO {$table} ({$k}) VALUES ({$v})";
   //Execulta o calback 
   if(np_run_sql($sql)){ 
              if(is_callable($callbackS)){ call_user_func($callbackS); }
              else{ echo $callbackS; }
   }else{ 
        if(is_callable($callbackE)){ call_user_func($callbackE); }
        else{ echo $callbackE; }
   }
}
//Função para montar e execultar uma query do tipo SELECT
function np_sel($table, $id="*"){
	//Monta a condição de seleção
    if($id == "*"){ $sql = "SELECT {$id} FROM {$table} ORDER BY id DESC"; }
	elseif(is_numeric($id)){ $sql = "SELECT * FROM {$table} WHERE id = {$id}"; }
	else{ $sql = "SELECT * FROM {$table} {$id}"; }
	
   //Monta a query
   $npd = Conn::getConn();
   $query = $npd->prepare($sql);
   $query->execute();
   $rows = $query->fetchAll(PDO::FETCH_ASSOC);
   return $rows; 
}
//Execulta uma query sql e retorna os dados em um array associativo
function np_query($sql){
   $npd = Conn::getConn();
   $query = $npd->prepare($sql);
   if($query->execute()){
   $rows = $query->fetchAll(PDO::FETCH_ASSOC);
   return $rows;
   }else{ return false; }  
}
//Obtem os dados pelo nome da coluna
function np_obj($sql){
   $npd = Conn::getConn();
   $query = $npd->prepare($sql);
   $query->execute();
   $row = $query->fetch(PDO::FETCH_OBJ);
   return $row; 
}
///Conta o numero de registros 
function np_cou($x="posts", $w=null){
	if($w != null){ $w = "WHERE ".$w; }
	$s = "SELECT * FROM ".NP."{$x}  {$w}";
	return count(np_query($s));
}
//Retorna um campo de acordo com o ID informado
function np_obj_id($tb, $id, $input, $print=false){
	$tb1 = explode(NP, $tb);
    if(in_array(NP, $tb1)){
		$sql = "SELECT {$input} FROM {$tb1[0]} WHERE ID = {$id}";
	}else{
		$sql = "SELECT {$input} FROM ".NP."{$tb} WHERE ID = {$id}";
	}
	$c = np_obj($sql); 
	if($print == false){ return $c->$input; }else{ echo $c->$input; }
}
//Retorna o prefixo da tabela
function np_p($tb){
    $np = NP."{$tb}";
	return $np;
}
//Função para contar o numero de registros
function np_count($table, $where=null){
$conn = Conn::getConn();
$sql = "SELECT COUNT(*) FROM {$table} {$where}";
$r = $conn->query($sql);
return $r->fetchColumn();   
}
//Função para consultas ao banco de dados
function np_exec($sql, $r=true){
	$npdb = Conn::getConn();
	$result = $npdb->exec($sql);
	if($r==true){
	if($result){ return 1; }else{ return 0; }}
}
function np_return_id($table, $row, $where){
	if(is_numeric($where)){
		$sql = "SELECT {$row} FROM {$table} WHERE ID = {$where}";
	}else{
		$sql = "SELECT {$row} FROM {$table} {$where}";
	}
	$r = np_obj($sql);
	if($r){ return $r->$row; }else{ return 0; }
}
?>