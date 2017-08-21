<?php
include "Banco.php";

class Editora{
    private $CNPJ;
    private $nomeFantasia;
    private $email;
    private $telefone;
    private $endereco;
    private $con = null;

    public function __construct(){
        $this->con = new Banco();
    }

    public function setCNPJ($vcnpj){
        $this->CNPJ = $vcnpj;
    }

    public function setNomeFantasia($vnomefantasia){
        $this->nomeFantasia = $vnomefantasia;
    }

    public function setEmail($vemail){
        $this->email = $vemail;
    }

    public function setTelefone($vtelefone){
        $this->telefone = $vtelefone;
    }

    public function setEndereco($vendereco){
        $this->endereco = $vendereco;
    }

    private function isNull(Editora $e){
        if (!$e->CNPJ){
            $e->CNPJ = NULL;
        }

        if (!$e->nomeFantasia){
            $e->nomeFantasia = NULL;
        }

        if (!$e->email){
            $e->email = NULL;
        }

        if (!$e->telefone){
            $e->telefone = NULL;
        }

        if (!$e->endereco){
            $e->endereco = NULL;
        }
        return $e;
    }

    public function inserir(Editora $e){
        $stmt = $this->con->prepare("INSERT INTO Editora (CNPJ, nomeFantasia, email, telefone, endereco) VALUES (?, ?, ?, ?, ?)");    
        $e = $this->isNull($e);  
        $stmt->bind_param('issis', $e->CNPJ, $e->nomeFantasia, $e->email, $e->telefone, $e->endereco);       
        if($stmt->execute()){
            echo "Editora cadastrado";
        }else {
            echo "Erro no cadastro: ". $stmt->error;
        }         
    }
}
?>