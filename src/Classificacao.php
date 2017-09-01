<?php
require_once "Banco.php";

class Classificacao{
    private $CDD;
    private $nome;
    private $con = null;

//Construtor que cria a conexão 
    public function __construct(){
        $this->con = new Banco();
    }

//GETS
    public function getCDD(){
        return $this->CDD;
    }

    public function getNome(){
        return $this->nome;
    }

 //SETS
    public function setCDD($vCDD){
        $this->CDD = $vCDD;
    }

    public function setNome($vnome){
        $this->nome = $vnome;
    }

 //Checagem de null
    public function isNull(Classificacao $c){
        if (!$c->CDD){
            $c->CDD = NULL;
        }

        if (!$c->nome){
            $c->nome = NULL;
        }
        return $c;
    }

//COMANDOS SQL
    //DELETE
    public function deletarPorID(Classificacao $c){
        $stmt = $this->con->prepare("DELETE FROM Classificacao WHERE CDD = ?");
        $stmt->bind_param('s', $c->CDD);
        $stmt->execute();
    }

    //Alterar
    public function alterar(Classificacao $c){
        $stmt = $this->con->prepare("UPDATE Classificacao SET NOME = ? WHERE CDD = ?");
        $this->isNull($c);
        $stmt->bind_param('ss', $c->nome, $c->CDD);

        if ($stmt->execute()){
            echo "Classificação atualizada";
        }else {
            echo "Falha ao atualizar: " . $stmt->error;
        }
    }

    //Inserir
    public function inserir(Classificacao $c){
        $stmt = $this->con->prepare("INSERT INTO Classificacao (CDD, nome) VALUES (?, ?)");
       
        $c = $this->isNull($c);
        $stmt->bind_param('ss', $c->CDD, $c->nome);

        if ($stmt->execute()){
            echo "Classificação atualizada";
        }else {
            echo "Falha ao atualizar: " . $stmt->error;
        }
    }

    //Listagens
    public function listar(){
        $stmt = $this->con->prepare("SELECT CDD, nome FROM Classificacao");
        $stmt->execute();
        return $stmt->get_result();
    }

    public function listarPorId(Classificacao $c){
        $stmt = $this->con->prepare("SELECT CDD, nome FROM Classificacao WHERE CDD = ?");
        $stmt->bind_param('s', $c->CDD);
        $stmt->execute();
        $stmt->bind_result($CDD, $nome);

        while ($stmt->fetch()){
            $this->CDD = $CDD;
            $this->nome = $nome;
        }

    }

    public function listarLivros(Classificacao $c){
        $stmt = $this->con->prepare("SELECT nome, idioma, preco FROM Livro
                                     WHERE classificacao_CDD IN (SELECT CDD FROM Classificacao WHERE CDD = ?)");
        $stmt->bind_param('s', $c->CDD);
        $stmt->execute();
        return $stmt->get_result();
    }

}



?>