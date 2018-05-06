<?php
//Funções do NP para lidar com arquivos
//Transforma texto em URL amigavel
function np_set_url($strTitulo){
	/* Remove pontos e underlines */
    $arrEncontrar = array(".", "_");
    $arrSubstituir = null;
    $strTitulo = str_replace($arrEncontrar, $arrSubstituir, $strTitulo );
    /* Caracteres minúsculos */
    $strTitulo = strtolower($strTitulo );
    /* Remove os acentos */
    $acentos = array("á", "Á", "ã", "Ã", "â", "Â", "à", "À", "é", "É", "ê", "Ê", "è", "È", "í", "Í", "ó", "Ó", "õ", "Õ", "ò", "Ò", "ô", "Ô", "ú", "Ú", "ù", "Ù", "û", "Û", "ç", "Ç", "º", "ª");
    $letras = array("a", "A", "a", "A", "a", "A", "a", "A", "e", "E", "e", "E", "e", "E", "i", "I", "o", "O", "o", "O", "o", "O", "o", "O", "u", "U", "u", "U", "u", "U", "c", "C", "o", "a");
    $strTitulo = str_replace($acentos, $letras, $strTitulo);
    $strTitulo = preg_replace( "/[^a-zA-Z0-9._$, ]/", "", $strTitulo);
    $strTitulo = iconv( "UTF-8", "UTF-8//TRANSLIT", $strTitulo);
    /* Remove espaços em branco*/
	$strTitulo = strip_tags(trim($strTitulo));
    $strTitulo = str_replace( " ", "-", $strTitulo );
	$strTitulo = str_replace(array("-----", "----", "---", "--"), "-", $strTitulo);
    return $strTitulo;
}
//Função auxiliadora para verificar a extenção do arquivo
function np_system_img($x){
	$ext = explode(".", $x);
	$img = array("pdf", "docx", "js", "html", "css");
	if(in_array($ext[1], $img)){
		return strtolower($ext[1]);
	}else{
		return "doc";
	}
}
//Função para alterar uma linha especifica do arquivo
function np_file_alter_line($file, $line, $variavel, $valor){
	if(file_exists($file)){
    // transforma o conteudo do arquivo em array
    $arquivo = file($file);
    // armazena o que contem a linha 11
    $conteudoLinha = $arquivo[$line];
    // seta o que vai conter na linha 11
    $arquivo[$line] =  "define('".$variavel."','".$valor."');". "\n";
    // recria o arquivo com a linha 11 alterada
    if(file_put_contents($file, implode("", $arquivo))){ return true; }
	}else{np_msg("<b>Erro</b>: o arquivo ($file) especificado no primeiro parâmetro da função <b>np_file_alter_line</b> é invalido.", "red");}
} 

?>