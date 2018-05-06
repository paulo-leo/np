<?php
class Read extends Conn{
    private $select;
    private $Places;
    private $result;
    private $read;
    private $conn;
  
    public function exeRead($tabela, $termos = null, $parseString = null){
         if(!empty($parseString)):
             $this->Places = $parseString;
              parse_str($parseString, $this->Places);
         endif;
          $this->select = "SELECT * FROM {$tabela} {$termos}";
         $this->Execute();
    }

    public function getResult(){
        return $this->result;
    }
    public function getRowCount(){
        return $this->read->rowCount();
    }
    public function FullRead($Query, $parseString = null){
        $this->select = (string) $Query;
         if(!empty($parseString)):
              parse_str($parseString, $this->Places);
         endif;
        $this->Execute();
    }
    public function setPlaces($parseString){
         parse_str($parseString, $this->Places);
         $this->Execute();
    }
    
    private function getSyntax(){
        if($this->Places):
             foreach($this->Places as $vinculo => $valor):
                     if($vinculo == 'limit' || $vinculo == 'offset'):
                              $valor = (int) $valor;
                     endif;
            $this->read->bindValue(":{$vinculo}", $valor, (is_int($valor) ? PDO::PARAM_INT : PDO::PARAM_STR));
               endforeach;
        endif;
    }
    private function Execute(){
        $this->Connect();
        try{
               $this->getSyntax();
               $this->read->execute();
               $this->result = $this->read->fetchAll();
               
        }catch(PDOException $e){
            $this->result = null;
            WSErro("<b>Erro ao cadastrar</b> {$e->getMessage()}", $e->getCode());
          }
    }
    
private function Connect(){
        $this->conn = parent::getConn();
        $this->read = $this->conn->prepare($this->select);
        $this->read->setFetchMode(PDO::FETCH_ASSOC);
          }   
}
?>