<?php
class Banco {
    private $ip;
    private $usuario;
    private $senha;
    private $banco;
    private $mysqli;

    public function __construct() {
        $this->conectar();
    }

    private function conectar(){
        $ip = 'localhost';
        $usuario = 'root';
        $senha = 'robeale12345';
        $banco = 'Livraria';

        $this->mysqli = new mysqli($ip, $usuario, $senha, $banco);
        
        if ($this->mysqli->connect_errno) {
            echo "Falha ao conectar com o MYSQL: " . $this->mysqli->connect_error;
        }   
        return $this->mysqli;
    }

    public function close(){
        return $this->mysqli->close();
    }
    public function error(){
        return $this->mysqli->connect_error;
    }
    public function query($query){               
        return $this->mysqli->query($query);
    }

    public function prepare($query){
        return $this->mysqli->prepare($query);       
    }

}



?>


