<?php
include "Banco.php";
class Autor{
    private $codAutor;
    private $nome;
    private $email;
    private $telefone;
    private $con = null;


    public function __construct(){
        $this->con = new Banco();
    }

    public function inserir(Autor $a){
        $stmt = $this->con->prepare("INSERT INTO Autor (nome, email, telefone) VALUES (?, ?, ?)");    
        $a = $this->isNull($a);  
        $stmt->bind_param('ssi', $a->nome, $a->email, $a->telefone);       
        if($stmt->execute()){
            echo "Autor cadastrado";
        }else {
            echo "Erro no cadastro: ". $stmt->error;
        }         
    }

    public function listar(){
        $stmt = $this->con->prepare("SELECT codAutor, nome, email, telefone FROM Autor");
        if(!$stmt->execute()){         
            echo "Erro na atualização: ". $stmt->error;
        }  
        return $stmt->get_result();
    }

    public function listarPorId(Autor $a){
        $stmt = $this->con->prepare("SELECT nome, email, telefone FROM Autor WHERE codAutor = ?");
        $stmt->bind_param('i', $a->codAutor);
        $stmt->execute();
        $stmt->bind_result($nome, $email, $telefone);
        while ($stmt->fetch()) {    
            $this->nome = $nome;
            $this->email = $email;
            $this->telefone = $telefone;
        }
    }

    public function deletarPorID(Autor $a){
        $stmt = $this->con->prepare("DELETE FROM Autor WHERE codAutor = ?");
        $stmt->bind_param('i', $a->codAutor);
        $stmt->execute();  
    }

    public function isNull(Autor $a){
        if (!$a->nome){
            $a->nome = NULL;
        }

        if (!$a->codAutor){
            $a->codAutor = NULL;
        }

        if (!$a->email){
            $a->email = NULL;
        }
        return $a;
    }

    public function alterar(Autor $a){
        $stmt = $this->con->prepare("UPDATE Autor SET nome = ?, email = ?, telefone = ? WHERE codAutor = ?"); 
        $a = $this->isNull($a);
        $stmt->bind_param('ssii', $a->nome, $a->email, $a->telefone, $a->codAutor);  
       
        if($stmt->execute()){
            echo "Autor atualizado" .$stmt->error;
        }else {
            echo "Erro na atualização: ". $stmt->error;
        }  
    }

    public function getCodAutor(){
        return $this->codAutor;
    }

    public function setNome($vnome){
        $this->nome = $vnome;
    }

    public function getNome(){
        return $this->nome;
    }

    public function getEmail(){
        return $this->email;
    }

    public function getTelefone(){
        return $this->telefone;
    }

    public function setEmail($vemail){
        $this->email = $vemail;
    }

    public function setTelefone($vtelefone){
        $this->telefone = $vtelefone;
    }

    public function setCodAutor($codAUtor){
        $this->codAutor = $codAUtor;
    }

}


?>