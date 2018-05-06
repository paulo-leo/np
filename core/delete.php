<?php
/* Autor:Paulo Leonardo da Silva Cassimiro
Classe para criar rotas através da interceptação da URL */
class Delete extends Conn{
    private $Places;
    private $result;
     private $termos;
    private $delete;
    private $conn;
  
    public function exeDelete($tabela, $termos, $parseString){
      $this->tabela = (string) $tabela;
        $this->termos = (string) $termos;
        parse_str($parseString, $this->Places);
          $this->getSyntax();
          $this->Execute();     
    }

    public function getResult(){
             return $this->result;
    }
    
    public function getRowCount(){
              return $this->delete->rowCount();
    }
    
    private function getSyntax(){
       $this->delete = "DELETE FROM {$this->tabela} {$this->termos}";
    }
    private function Execute(){
       $this->Connect();
           try{ 
                  $this->delete->execute($this->Places);
                  $this->result = true;
               }catch(PDOException $e){
                     $this->result = null;
                      WSErro("<b>Erro ao deletar: </b> {$e->getMessage()}", $e->getCode());
          }
    }
    
private function Connect(){
      $this->conn = parent::getConn();
        $this->delete = $this->conn->prepare($this->delete);
    }	
}
?>