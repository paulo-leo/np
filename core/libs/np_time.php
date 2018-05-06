<?php
//Funções do NP para lidar com datas
//Função sem argumento, configura a hora do servidor pelo sistema operaional
function np_timezone(){
	return date_default_timezone_set(NP_TIMEZONE);
}

//Função para formatar uma data e hora. 
function np_time($date, $out=null, $entre=null){
        $time1 = $date;	
        $time2 = substr($time1, 0, 10);	
        $time3 = substr($time1, 10, 20);
		$time = explode("-", $time2);
		switch($out){
			case null : 
			if(NP_EXIT_TIME == 'pt' or NP_EXIT_TIME == "pt-br"){
			return $time[2]."/".$time[1]."/".$time[0];
		    }else{ return $time2; }
			break;
			case "day" : 
			return $time[2];
			break;
			case "month" : 
			return $time[1];
			break;
			case "year" : 
			return $time[0];
			break;
			case "time" : 
			return $time3;
			break;
			case "time+" : 
			if(NP_EXIT_TIME == 'pt'){
			return $time[2]."/".$time[1]."/".$time[0].$entre.substr($time3, 0, 6);
		    }else{ return $time1; }
			break;
		}
}
//Função que retorna a quantidade de dias para uma determinada data
function np_date_day($data1, $data2){
$d1 = strtotime($data1);
$d2 = strtotime($data2);
$data_final = ($d2 - $d1) / 86400;
return  intval($data_final);
}

//Função que checa se uma data é valida
function np_check_date($data){
if($data != null and is_string($data) and strlen($data) == 10){
if(NP_EXIT_TIME == 'pt' or NP_EXIT_TIME == "pt-br"){
		$a = explode("/", $data);
		$dd = $a[0]; $dm = $a[1]; $dy = $a[2];
		$data = "{$dy}-{$dm}-{$dd}";
}else{
	    $a = explode("-", $data);
		$dd = $a[2]; $dm = $a[1]; $dy = $a[0];
		$data = "{$dy}-{$dm}-{$dd}";
}
if(checkdate($dm, $dd, $dy)){ return $data; }else{ return false; }
}else{ return false; } }
?>