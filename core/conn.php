<?php
include("conf.php");
class Conn{
private static $Host = HOST; 
private static $User = USER;
private static $Pass = PASS;
private static $Dbsa = DBSA;

//@var PDO
private static $Connect = null;

private static function Conectar(){
    try{
        if(self::$Connect == null):
        $dsn = 'mysql:host='.self::$Host.';dbname=' .self::$Dbsa;
        $options = [PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'];
            self::$Connect = new PDO($dsn, self::$User, self::$Pass, $options);
        endif;
    }catch(PDOExeption $e){
        PHPErro($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
          die;
    }
    self::$Connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return self::$Connect;
}    
    
public static function getConn(){
    return self::Conectar();
        }
    }
//Libs 
function np_libs($dir = "core/libs/"){
$libs = scandir($dir);
for($i=2; $i < count($libs); $i++){
	include($dir.$libs[$i]);
  }	
}
//Thema
function np_the($dir = "core/the/"){
$libs = scandir($dir);
for($i=2; $i < count($libs); $i++){
	include($dir.$libs[$i]);
  }	
}
?>