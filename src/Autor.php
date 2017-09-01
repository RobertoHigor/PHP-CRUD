<?php
require_once "Banco.php";

class Autor{
    private $codAutor;
    private $nome;
    private $email;
    private $telefone;
    private $con = null;

    //Construtor criando conexão com o banco e armazenando na
    // variável $con que começa como nulo.
    public function __construct(){
        $this->con = new Banco();
    }


//GETS
    public function getCodAutor(){
        return $this->codAutor;
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

//SETS

    public function setNome($vnome){
        $this->nome = $vnome;
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

//Checagem de NULL 
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

//Comandos SQL
    //Delete
    public function deletarPorID(Autor $a){
        $stmt = $this->con->prepare("DELETE FROM Autor WHERE codAutor = ?");
        $stmt->bind_param('i', $a->codAutor);
        $stmt->execute();  
    }

    //Alterar    
    public function alterar(Autor $a){
        $stmt = $this->con->prepare("UPDATE Autor SET nome = ?, email = ?, telefone = ? WHERE codAutor = ?"); 

        //Checar se não foi colocado um valor nulo
        $a = $this->isNull($a);
        //Substituindo os "?" pelo valor do objeto.
        $stmt->bind_param('ssii', $a->nome, $a->email, $a->telefone, $a->codAutor);  
       
        //Tentar executar o SQL
        if($stmt->execute()){
            echo "Autor atualizado";
        }else {
            echo "Erro na atualização: ". $stmt->error;
        }  
    }

    //Inserir
    public function inserir(Autor $a){
        $stmt = $this->con->prepare("INSERT INTO Autor (nome, email, telefone) VALUES (?, ?, ?)");
        
        //Checar se não foi colocado um valor nulo
        $a = $this->isNull($a);  
        //Substituir os "?" pelo valor do objeto
        $stmt->bind_param('ssi', $a->nome, $a->email, $a->telefone);   
        
        //Tentar executar o SQL
        if($stmt->execute()){
            echo "Autor cadastrado";
        }else {
            echo "Erro no cadastro: ". $stmt->error;
        }         
    }

    //Listagens
    public function listar(){
        $stmt = $this->con->prepare("SELECT codAutor, nome, email, telefone FROM Autor");
        $stmt->execute();         
        return $stmt->get_result();
    }

    public function listarPorId(Autor $a){
        $stmt = $this->con->prepare("SELECT nome, email, telefone FROM Autor WHERE codAutor = ?");
        $stmt->bind_param('i', $a->codAutor);

        //Executar o SQL
        $stmt->execute();
        //Guardar as colunas nas variáveis
        $stmt->bind_result($nome, $email, $telefone);
        //Colocar no objeto o valor retornado pelo SQL
        while ($stmt->fetch()) {    
            $this->nome = $nome;
            $this->email = $email;
            $this->telefone = $telefone;
        }
    }

    //Listar livros associado ao autor
    public function listarLivros(Autor $a){
        $stmt = $this->con->prepare("SELECT nome, idioma, preco FROM Livro 
                                            WHERE autor_codAutor IN (SELECT codAutor FROM Autor WHERE codAutor = ?)");
        $stmt->bind_param('i', $a->codAutor);
        $stmt->execute();
        return $stmt->get_result();
    }
}
?>