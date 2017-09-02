<?php
require_once "Banco.php";

class Usuario{
    private $email;
    private $senha;

    public function __construct(){
        $this->con = new Banco();
    }

    public function setEmail($vEmail){
        $this->email = $vEmail;
    }

    public function setSenha($vSenha){
        $this->senha = $vSenha;
    }

    public function getEmail(){
        return $this->email;
    }

    public function getSenha(){
        return $this->senha;
    }

//Comandos SQL
    public function logar(Usuario $u){
        $stmt = $this->con->prepare("SELECT email, senha FROM Usuario WHERE email = ? AND senha = ?");
        $stmt->bind_param('ss', $u->email, $u->senha);

        if (!$stmt->execute()){
            echo "Erro ". $stmt->error;
        }

        $stmt->bind_result($email, $senha);

        $temEmail = false;
        $temSenha = false;
        $temRegistro = false;

        while ($stmt->fetch()){
            if ($this->email = $email){
                $temEmail = true;
            }
            if($this->senha = $senha){
                $temSenha = true;
            }
        }

        if ($temEmail && $temSenha){
            $temRegistro = true;
        }else {
            echo "Usuario ou senha inválido";
        }

        return $temRegistro;
    }


    public function listarLivros(Usuario $u){
        $stmt = $this->con->prepare("SELECT usuario_email, livro_ISBN, Livro.nome, idioma, preco, data, hora FROM Pedido, Livro, Usuario WHERE usuario_email = email AND email = ? AND livro_ISBN = ISBN");
        $stmt->bind_param('s', $u->email);
        $stmt->execute();
        
        return $stmt->get_result();
    }

    public function listarPorId(Usuario $u){
        $stmt = $this->con->prepare("SELECT email, senha FROM Usuario WHERE email = ?");
        $stmt->bind_param('s', $u->email);

        $stmt->execute();
        $stmt->bind_result($email, $senha);

        while($stmt->fetch()){
            $this->email = $email;
            $this->senha = $senha;
        }
    }

    




}
?>