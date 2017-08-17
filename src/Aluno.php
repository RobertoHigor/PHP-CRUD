<?php 
include "Banco.php";
class Aluno {
    public $matricula;
    private $nome; 
    private $endereco;
    private $dataNasc;
    private $email;
    private $curso_codCUrso;
    private $con = null;

    public function __construct(){
        $this->con = new Banco();
    }

    public function listarPorMatricula(Aluno $a){
        
        $res = $con->query("Select nome, matricula from Aluno WHERE matricula = '$a->matricula'");        
        return $res;
    }

    public function listar(){
        //$con = new Banco();
        $res = $this->con->query("Select nome, matricula from Aluno");           
        return $res;
    }

 /*   public function listarTeste(Aluno $a){
        $con = new Banco();
        $stmt = $con->prepare("SELECT nome FROM Aluno WHERE matricula=?");
        $stmt->bind_param("s", $a->matricula);
        $stmt->execute();        
        return $stmt;
    }*/
}

?>