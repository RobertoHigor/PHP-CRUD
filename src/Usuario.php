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

//Sets
    public function setEmail($vEmail){
        $this->email = $vEmail;
    }
    public function setSenha($vSenha){
        $this->senha = $vSenha;
    }

    public function setNome($vNome){
        $this->nome = $vNome;
    }

    public function setNomeFantasia($vNomeFantasia){
        $this->nomeFantasia = $vNomeFantasia;
    }

    public function setCNPJ($vCNPJ){
        $this->CNPJ = $vCNPJ;
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

//Gets
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

    public function getNomeFantasia(){
        return $this->nomeFantasia;
    }

    public function getCNPJ(){
        return $this->CNPJ;
    }

//Comandos SQL
    //Comando para checar se o login e senha digitados existe
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
            echo "<p class=\"erro\">Usuario ou senha inválido</p>";
        }
        //Retorna true se existe e false caso não exista. O valor é tratado no site.
        return $temRegistro;
    }

    //Testar se algum campo está vazio
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

//Listagens
    //Utilizar o stored procedure para listar os livros comprados pelo usuário (associado ao email)
    public function listarLivros(Usuario $u){
        $stmt = $this->con->prepare("call livrosUsuario(?)");
        $stmt->bind_param('s', $u->email);
        $stmt->execute();

        return $stmt->get_result();
    }

    //Cadastrar um usuário do tipo cliente.
    public function inserirCliente(Usuario $u){
        $stmt = $this->con->prepare("INSERT INTO usuarioCliente (email, CPF, nome, sobrenome, dataNascimento) VALUES (?, ?, ?, ?, ?)");
        $u = $this->isNull($u);

        $stmt->bind_param('sssss', $u->email, $u->CPF, $u->nome, $u->sobrenome, $u->dataNascimento);

        $stmt2 = $this->con->prepare("INSERT INTO Usuario (email, senha) VALUES (?, ?)");
        $stmt2->bind_param('ss', $u->email, $u->senha);   

        if (!$stmt2->execute()){
            echo "<p class=\"erro\"> Erro no Usuario". $stmt2->error. "</p>";
        }

        //Caso não consiga inserir os dados do cliente, deletar seu cadastro da tabela Usuario.
        if (!$stmt->execute()){
            echo "<p class=\"erro\">Erro no UsuarioCliente". $stmt->error. "</p>";
            $this->deletar($u);
        }
    }

    //Cadastrar um usuário do tipo Editora
    public function inserirEditora(Usuario $u){
        $stmt = $this->con->prepare("INSERT INTO usuarioEditora (email, CNPJ, nomeFantasia) VALUES (?, ?, ?)");
        $u = $this->isNull($u);

        $stmt->bind_param('sss', $u->email, $u->CNPJ, $u->nomeFantasia);

        $stmt2 = $this->con->prepare("INSERT INTO Usuario (email, senha) VALUES (?, ?)");
        $stmt2->bind_param('ss', $u->email, $u->senha);   

        if (!$stmt2->execute()){
            echo "<p class=\"erro\"> Erro no Usuario". $stmt2->error. "</p>";
        }

        //Caso não consiga inserir os dados do cliente, deletar seu cadastro da tabela Usuario.
        if (!$stmt->execute()){
            echo "<p class=\"erro\">Erro no UsuarioCliente". $stmt->error. "</p>";
            $this->deletar($u);
        }
    }

    //Deletar o usuário do email especificado
    public function deletar(Usuario $u){
        $stmt = $this->con->prepare("DELETE FROM Usuario WHERE email = ?");
        $stmt->bind_param('s', $u->email);
        $stmt->execute();
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