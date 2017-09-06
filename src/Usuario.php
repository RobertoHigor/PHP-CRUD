<?php
require_once "Banco.php";

class Usuario{
    private $email;
    private $senha;
    //Cliente
    private $nome;
    private $sobrenome;
    private $dataNascimento;
    private $CPF;
    //Editora
    private $CNPJ;
    private $nomeFantasia;

    public function __construct(){
        $this->con = new Banco();
    }

    public function setEmail($vEmail){
        $this->email = $vEmail;
    }
    public function setSenha($vSenha){
        $this->senha = $vSenha;
    }

    public function setNome($vNome){
        $this->nome = $vNome;
    }

    public function setSobrenome($vSobrenome){
        $this->sobrenome = $vSobrenome;
    }

    public function setDataNasc($vDataNasc){
        $this->dataNascimento = $vDataNasc;
    }

    public function setCPF($vCPF){
        $this->CPF = $vCPF;
    }

    public function getEmail(){
        return $this->email;
    }

    public function getSenha(){
        return $this->senha;
    }

    public function getNome(){
        return $this->nome;
    }

    public function getSobrenome(){
        return $this->sobrenome;
    }

    public function getDataNasc(){
        return $this->dataNascimento;
    }

    public function getCPF(){
        return $this->CPF;
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

    public function isNull(Usuario $u){
        if (!$u->email){
            $u->email = NULL;
        }

        if (!$u->senha){
            $u->senha = NULL;
        }

        if (!$u->CPF){
            $u->CPF = NULL;
        }

        if (!$u->sobrenome){
            $u->sobrenome = NULL;
        }

        if (!$u->dataNascimento){
            $u->dataNascimento = NULL;
        }

        if (!$u->nomeFantasia){
            $u->nomeFantasia = NULL;
        }

        if (!$u->CNPJ){
            $u->CNPJ = NULL;
        }

        if (!$u->nome){
            $u->nome = NULL;
        }
        return $u;
    }

    public function listarLivros(Usuario $u){
        $stmt = $this->con->prepare("SELECT usuario_email, livro_ISBN, Livro.nome, idioma, preco, data, hora FROM Pedido, Livro, Usuario WHERE usuario_email = email AND email = ? AND livro_ISBN = ISBN");
        $stmt->bind_param('s', $u->email);
        $stmt->execute();
        
        return $stmt->get_result();
    }

    public function inserirCliente(Usuario $u){
        $stmt = $this->con->prepare("INSERT INTO usuarioCliente (email, CPF, nome, sobrenome, dataNascimento) VALUES (?, ?, ?, ?, ?)");
        $u = $this->isNull($u);

        $stmt->bind_param('sssss', $u->email, $u->CPF, $u->nome, $u->sobrenome, $u->dataNascimento);

        $stmt2 = $this->con->prepare("INSERT INTO Usuario (email, senha) VALUES (?, ?)");
        $stmt2->bind_param('ss', $u->email, $u->senha);   

        if (!$stmt->execute() && !$stmt2->execute()){
            echo "Erro ". $stmt->error . $stmt2->error;
        }else {
            
            echo "Usuario Cadastrado";
        }
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