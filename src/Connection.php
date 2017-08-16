<?php
//Class Connection{   
    //public function __construct(){
    $mysqli = new mysqli("localhost", "root", "26793653", "academico");
    
    if ($mysqli->connect_errno) {
                  echo "Failed to connect to MySQL: " . $mysqli->connect_error();
    }
  
    if (!$mysqli->query("DROP TABLE IF EXISTS test") ||
        !$mysqli->query("CREATE TABLE test(id INT)") ||
        !$mysqli->query("INSERT INTO test(id) VALUES (1)")) {
            echo "Table creation failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }
    //}
//}

//Class Teste{
    
   //echo $mysqli->host_info . "\n";

    $res = $mysqli->query("SELECT * FROM ALUNO ORDER BY nome ASC");

    // ponteiro para 0 $res->data_seek(0);
    while ($row = $res->fetch_assoc()) {
        echo "Nome : " . $row['nome'] . "</br>";
    }
//}
?>

