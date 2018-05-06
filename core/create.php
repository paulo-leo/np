<?php
class Create extends Conn{
    private $tabela;
    private $dados;
    private $result;
    private $create;
    private $conn;
    
    public function exeCreate($tabela, array $dados){
        $this->tabela =  (string) $tabela;
        $this->dados = $dados;
        $this->getSyntax();
        $this->Execute();
    }
//Retorna o resultado de um cadastro
    public function getResult(){
        return $this->result;
    }
/***************************************************************
*************************METHODS PRIVATES***********************
***************************************************************/
    private function Connect(){
        $this->conn = parent::getConn();
        $this->create = $this->conn->prepare($this->create);
    }
    private function getSyntax(){
        $Fileds = implode(', ', array_keys($this->dados));
        $Places = ":".implode(',  :', array_keys($this->dados));
        $this->create = "INSERT INTO {$this->tabela} ({$Fileds}) VALUES({$Places})";
    }
    private function Execute(){
        $this->Connect();
        try{
            $this->create->execute($this->dados);
            $this->result = $this->conn->lastInsertId();
        }catch(PDOException $e){
            $this->result = null;
            WSErro("<b>Erro ao cadastrar</b> {$e->getMessage()}", $e->getCode());
          }
    }
    
}
?>