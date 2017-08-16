<?php

$n1 = 0;
$n2 = 0;
if ($_POST){
        $n1 = $_POST['numero1'];
        $n2 = $_POST['numero2'];
}

function somar($n1, $n2){               
           return $n1 + $n2;

        }
?>