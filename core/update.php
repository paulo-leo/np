<?php
/* Autor:Paulo Leonardo da Silva Cassimiro
Classe para criar rotas através da interceptação da URL */
class Update extends Conn{
	private $select;
    private $Places;
    private $result;
    private $dados;
    private $termos;
    private $update;
    private $conn;
  
    public function exeUpdate($tabela, array $dados, $termos, $parseString){
      $this->tabela = (string) $tabela;
        $this->dados = $dados;
        $this->termos = (string) $termos;
        parse_str($parseString, $this->Places);
          $this->getSyntax();
          $this->Execute();
          
    }

    public function getResult(){
             return $this->result;
    }
    
    
    public function getRowCount(){
              return $this->update->rowCount();
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
                $this->getSyntax();
                $this->Execute();
    }
    
    private function getSyntax(){
       foreach($this->dados as $key => $value):
                      $Places[] = $key . ' = :' . $key;
            endforeach;
         $Places = implode(',', $Places);
                   $this->update = "UPDATE {$this->tabela} SET {$Places} {$this->termos}";
    }
    private function Execute(){
       $this->Connect();
        try{
            
               $this->update->execute(array_merge($this->dados, $this->Places));
                $this->result = true;
            
        }catch(PDOException $e){
             $this->result = null;
            WSErro("<b>Erro ao atualizar tabela: </b> {$e->getMessage()}", $e->getCode());
          }
    }
    
private function Connect(){
      $this->conn = parent::getConn();
        $this->update = $this->conn->prepare($this->update);
    }	
}
?>