<?php
require_once "Banco.php";

class Livro{
    private $ISBN;
    private $nome;
    private $idioma;
    private $preco;

    private $editora_CNPJ;
    private $autor_codAutor;
    private $classificacao_CDD;
    private $con = NULL;

    public function __construct(){
        $this->con = new Banco();
    }

//GETS
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
    
//SETS
    public function setNome($vnome){
        $this->nome = $vnome;
    }

    public function setISBN($vISBN){
        $this->ISBN = $vISBN;
    }

    public function setIdioma($vIdioma){
        $this->idioma = $vIdioma;
    }

    public function setPreco($vPreco){
        $this->preco = $vPreco;
    }

    public function setEditoraCNPJ($vEditoraCNPJ){
        $this->editora_CNPJ = $vEditoraCNPJ;
    }

    public function setAutorCodAutor($vAutorCodAutor){
        $this->autor_codAutor = $vAutorCodAutor;
    }

    public function setClassificacaoCDD($vClassificacaoCDD){
        $this->classificacao_CDD = $vClassificacaoCDD;
    }

//Comandos SQL
    //Delete

    public function deletarPorID(Livro $l){
        $stmt = $this->con->prepare("DELETE FROM Livro WHERE ISBN = ?");
        $stmt->bind_param('i', $l->ISBN);
        $stmt->execute();
    }
    //Inserir
    public function inserir(Livro $l){
        $stmt = $this->con->prepare("INSERT INTO Livro (ISBN, nome, idioma, preco, editora_CNPJ, autor_codAutor, classificacao_CDD) VALUES (?, ?, ?, ?, ?, ?, ?)");    
        $l = $this->isNull($l);  
        $stmt->bind_param('issdiis', $l->ISBN, $l->nome, $l->idioma, $l->preco, $l->editora_CNPJ, $l->autor_codAutor, $l->classificacao_CDD);       
        if($stmt->execute()){
            echo "<p class=\"sucess\">Livro cadastrado</p>";
        }else {
            echo "<p class=\"erro\">Erro no cadastro: ". $stmt->error."</p>";
        }         
    }

    //Listagens
    public function listar(){
        $stmt = $this->con->prepare("SELECT ISBN, nome, idioma, preco, editora_CNPJ, autor_codAutor, classificacao_CDD FROM Livro ORDER BY nome ASC");
        if(!$stmt->execute()){         
            echo "<p class=\"erro\">Erro na listagem: ". $stmt->error."</p>";
        }  
        return $stmt->get_result();
    }

    public function listarPorId(Livro $l){
        $stmt = $this->con->prepare("SELECT ISBN, nome, idioma, preco, editora_CNPJ, autor_codAutor, classificacao_CDD FROM Livro WHERE ISBN = ?");
        $stmt->bind_param('i', $l->ISBN);
        $stmt->execute();

        $stmt->bind_result($ISBN, $nome, $idioma, $preco, $editora_CNPJ, $autor_codAutor, $classificacao_CDD);
        while ($stmt->fetch()) { 
            $this->ISBN = $ISBN;
            $this->nome = $nome;
            $this->idioma = $idioma;
            $this->preco = $preco;
            $this->editora_CNPJ = $editora_CNPJ;
            $this->autor_codAutor = $autor_codAutor;
            $this->classificacao_CDD = $classificacao_CDD;
        }
    }

    //Checar se tem valor nulo
    public function isNull(Livro $l){
        if (!$l->ISBN){
            $l->ISBN = NULL;
        }

        if(!$l->nome){
            $l->nome = NULL;
        }

        if(!$l->idioma){
            $l->idioma = NULL;
        }

        if(!$l->preco){
            $l->preco = NULL;
        }

        if(!$l->editora_CNPJ){
            $l->editora_CNPJ = NULL;
        }

        if(!$l->autor_codAutor){
            $l->autor_codAutor = NULL;
        }

        if(!$l->classificacao_CDD){
            $l->classificacao_CDD = NULL;
        }
        return $l;
    }

    public function alterar(Livro $l){
        $stmt = $this->con->prepare("UPDATE Livro SET nome = ?, idioma = ?, preco = ?, editora_CNPJ = ?, autor_codAutor = ?, classificacao_CDD = ? WHERE ISBN = ?"); 
        $l = $this->isNull($l);
        $stmt->bind_param('ssdiisi', $l->nome, $l->idioma, $l->preco, $l->editora_CNPJ, $l->autor_codAutor, $l->classificacao_CDD, $l->ISBN);  
       
        if($stmt->execute()){
            echo "<p class=\"sucess\">Livro atualizado</p>" .$stmt->error;
        }else {
            echo "<p class=\"erro\">Erro na atualização: ". $stmt->error."</p>";
        }  
    }

}

?>