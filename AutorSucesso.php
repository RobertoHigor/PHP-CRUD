<?php require "src/Autor.php" ?>

<html>
    <!-- Menu !-->
    <?php include "header.php" ?>
    <!-- Fim do menu -->
    <!-- Conteúdo do site !-->
    <div class = "conteudo">  
    
    <?php 
        $a = new Autor();
        $a->setCodAutor($_POST['codAutor']);
        $a->setNome($_POST['nome']);
        $a->setEmail($_POST['email']);
        $a->setTelefone($_POST['telefone']);

        $a->alterar($a);
        if ($a->getError()){
            echo $a->getError() . "oi";
        }
    ?>

    </div> <!-- fim div conteudo !-->

    <!--Rodapé-->
    <?php include "footer.php" ?>
    <!--Fim do Rodapé-->
</html>