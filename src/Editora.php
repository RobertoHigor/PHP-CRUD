<?php
include "Banco.php";

class Editora{
    private $CNPJ;
    private $nomeFantasia;
    private $email;
    private $telefone;
    private $endereco;
    private $con = null;

//Construtor
    public function __construct(){
        $this->con = new Banco();
    }

//SETS
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

//GETS
    public function getCNPJ(){
        return $this->CNPJ;
    }

    public function getNomeFantasia(){
        return $this->nomeFantasia;
    }

    public function getEmail(){
        return $this->email;
    }

    public function getTelefone(){
        return $this->telefone;
    }

    public function getEndereco(){
        return $this->endereco;
    }

//Checagem de NULL
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

//Comandos SQL
    //Delete
    public function deletarPorId(Editora $e){
        $stmt = $this->con->prepare("DELETE FROM Editora WHERE CNPJ = ?");
        $stmt->bind_param('i', $e->CNPJ);
        $stmt->execute();
    }

    //Alterar
    public function alterar(Editora $e){
        $stmt = $this->con->prepare("UPDATE Editora SET nomeFantasia = ?, email = ?, telefone = ?, endereco = ? WHERE CNPJ = ?");
        $e = $this->isNull($e);
        $stmt->bind_param('ssisi', $e->nomeFantasia, $e->email, $e->telefone, $e->endereco,  $e->CNPJ);   

        if ($stmt->execute()){
            echo "Editora atualizado";
        }else{
            echo "Erro na atualização: " . $stmt->error;
        }
    }
   
    //Inserir
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

    //Listagens
    public function listarPorId(Editora $e){
        $stmt = $this->con->prepare("SELECT CNPJ, nomeFantasia, email, telefone, endereco FROM Editora WHERE CNPJ = ?");
        $stmt->bind_param('i', $e->CNPJ);
        $stmt->execute();

        $stmt->bind_result($CNPJ, $nomeFantasia, $email, $telefone, $endereco);
        while ($stmt->fetch()){
            $this->CNPJ = $CNPJ;
            $this->nomeFantasia = $nomeFantasia;
            $this->email = $email;
            $this->telefone = $telefone;
            $this->endereco = $endereco;
        }
    }

    public function listar(){
        $stmt = $this->con->prepare("SELECT CNPJ, nomeFantasia, email, telefone, endereco FROM Editora");
        $stmt->execute();
        return $stmt->get_result();
    }
}
?>