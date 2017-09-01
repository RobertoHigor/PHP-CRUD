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

    public function setISBN($vISB){
        $this->ISBN = $vISB;
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
        $this->autor_codAutor = $autor_codAutor;
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
        $stmt->bind_param('ssi', $l->ISBN, $l->nome, $l->idioma, $l->preco, $l->editora_CNPJ, $l->autor_codAutor, $l->classificacao_CDD);       
        if($stmt->execute()){
            echo "Livro cadastrado";
        }else {
            echo "Erro no cadastro: ". $stmt->error;
        }         
    }

    //Listagens
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

        if($l->preco){
            $l->preco = NULL;
        }

        if($l->editora_CNPJ){
            $l->editora_CNPJ = NULL;
        }

        if($l->autor_codAutor){
            $l->autor_codAutor = NULL;
        }

        if(!$l->classificacao_CDD){
            $l->classificacao_CDD = NULL;
        }
        return $l;
    }

    public function alterar(Livro $l){
        $stmt = $this->con->prepare("UPDATE Livro SET ISBN = ?, nome = ?, idioma = ?, preco = ? WHERE codAutor = ?"); 
        $a = $this->isNull($a);
        $stmt->bind_param('issf', $l->ISBN, $l->nome, $l->idioma, $l->preco);  
       
        if($stmt->execute()){
            echo "Livro atualizado" .$stmt->error;
        }else {
            echo "Erro na atualização: ". $stmt->error;
        }  
    }

}

?>