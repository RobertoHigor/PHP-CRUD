<?php
Class Connection{
    function connectar(){
            $mysqli = mysqli_connect("localhost", "root", "26793653", "academico");
             if (mysqli_connect_errno($mysqli)) {
                  echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }
    }
}
$c = new Connection;
$c->connectar();
?>

