<?php

class Pedido{
    private $usuario_email;
    private $livro_ISBN;
    private $hora;
    private $data;
    private $con = NULL;

    public function __construct(){
        $this->con = new Banco();
    }

//GETS
    public function getUsuarioEmail(){
        return $this->usuario_email;
    }

    public function getLivroISBN(){
        return $this->livro_ISBN;
    }

    public function getHora(){
        return $this->hora;
    }

    public function getData(){
        return $this->data;
    }

//SETS
    public function setUsuarioEmail($vUsuarioEmail){
        $this->usuario_email = $vUsuarioEmail;
    }

    public function setLivroISBN($vLivroISBn){
        $this->livro_ISBN = $vLivroISBn;
    }

    public function setHora($vHora){
        $this->hora = $vHora;
    }

    public function setData($vData){
        $this->data = $vData;
    }

//Comandos SQL
    //Delete
    public function deletarPorID(Pedido $p){
        $stmt = $this->con->prepare("DELETE FROM Pedido WHERE usuario_email = ? AND livro_ISBN = ?");
        $stmt->bind_param('si', $p->usuario_email, $p->livro_ISBN);

        $stmt->execute();
    }

    //Inserir
    public function inserir(Pedido $p){
        $stmt = $this->con->prepare("INSERT INTO Pedido (usuario_email, livro_ISBN, data, hora) VALUES (?, ?, CURDATE(), CURTIME())");

        $p = $this->isNull($p);
        $stmt->bind_param('si', $p->usuario_email, $p->livro_ISBN);

        if($stmt->execute()){
            echo "Pedido concluido";
        }else {
            echo "Erro no cadastro: ". $stmt->error;
        }   
    }

    //Listagens
    public function listar(Usuario $u){
        $stmt = $this->con->prepare("SELECT usuario_email, livro_ISBN, Livro.nome, data, hora FROM Pedido, Livro, Usuario WHERE usuario_email = email AND email = ? AND livro_ISBN = ISBN");

        if(!$stmt->execute()){         
            echo "Erro na listagem: ". $stmt->error;
        }  
        return $stmt->get_result();
    }

    public function isNull(Pedido $p){
        if (!$p->usuario_email){
            $p->usuario_email = NULL;
        }

        if (!$p->livro_ISBN){
            $p->livro_ISBN = NULL;
        }
        return $p;
    }






}