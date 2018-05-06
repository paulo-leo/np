<?php
//Classe para validar dados do tipo, email, telfone, datas entre outros. 
class  Check{
	private static $Data;
    private static $Format;
    
public static function Email($Email){
       self::$Data = (string) $Email;
        self::$Format = '/[a-z0-9_\.\-]+@[a-z0-9_\.\-]*[a-z0-9_\.\-]+\.[a-z]{2,4}$/';
        
        if(preg_match(self::$Format, self::$Data)):
                  return true;
         else:
                return false;
        endif;
    }
public static function Name($Name){
     self::$Format = array();
     self::$Format['a'] = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]/?;:.,\\\'<>°ºª';
     self::$Format['b'] = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr                                 ';
    self::$Data = strtr(utf8_decode($Name), utf8_decode(self::$Format['a']), self::$Format['b']);
    self::$Data = strip_tags(trim(self::$Data));
    self::$Data = str_replace(' ', '-', self::$Data);
    self::$Data = str_replace(array('-----', '----', '---', '--'), '-', self::$Data);
    return strtolower(utf8_encode(self::$Data));
    }
}

?>