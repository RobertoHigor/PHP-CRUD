<?php
include "Banco.php";
class Livro{
    private $ISBN;
    private $nome;
    private $idioma;
    private $preco;

    private $editora_CNPJ;
    private $autor_codAutor;
    private $classificacao_CDD;

    public function __construct(){
        $this->con = new Banco();
    }

    public function inserir(Livro $l){
        $stmt = $this->con->prepare("INSERT INTO Livro (ISBN, nome, idioma, preco, editora_CNPJ, autor_codAutor, classificacao_CDD) VALUES (?, ?, ?, ?, ?, ?, ?)");    
        $l = $this->isNull($l);  
        $stmt->bind_param('ssi', $l->ISBN, $l->nome, $l->idioma, $l->preco, $l->editora_CNPJ, $l->autor_codAutor, $l->classificacao_CDD);       
        if($stmt->execute()){
            echo "Livro cadastrado";
        }else {
            echo "Erro no cadastro: ". $stmt->error;
        }         
    }

    public function listar(){
        $stmt = $this->con->prepare("SELECT ISBN, nome, idioma, preco, editora_CNPJ, autor_codAutor, classificacao_CDD FROM Livro");
        if(!$stmt->execute()){         
            echo "Erro na atualização: ". $stmt->error;
        }  
        return $stmt->get_result();
    }

    public function listarPorId(Livro $l){
        $stmt = $this->con->prepare("SELECT nome, idioma, preco, editora_CNPJ, autor_codAutor, classificacao_CDD FROM Autor WHERE ISBN = ?");
        $stmt->bind_param('i', $l->ISBN);
        $stmt->execute();
        $stmt->bind_result($nome, $idioma, $preco, $editora_CNPJ, $autor_codAutor, $classificacao_CDD);
        while ($stmt->fetch()) {    
            $this->nome = $nome;
            $this->idioma = $idioma;
            $this->preco = $preco;
            $this->editora_CNPJ = $editora_CNPJ;
            $this->autor_codAutor = $autor_codAutor;
            $this->classificacao_CDD = $classificacao_CDD;
        }
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
        return $this->autor_codAutor;
    }    

    public function getNome(){
        return $this->nome;
    }

    public function getISBN(){
        return $this->ISBN;
    }

    public function getIdioma(){
        return $this->idioma;
    }

    public function getPreco(){
        return $this->preco;
    }

    public function getCNPJ(){
        return $this->editora_CNPJ;
    }

    public function getCDD(){
        return $this->classificacao_CDD;
    }
    
    public function setNome($vnome){
        $this->nome = $vnome;
    }

}

?>