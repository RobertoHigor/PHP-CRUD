<?php include "src/calculadora.php" ?>

<html>
        <!-- Menu !-->
        <?php include "header.php" ?>
        <!-- Fim do menu -->

       <!-- Conteúdo do site !-->
       <div class = "conteudo">                
<?php
    include "src/Aluno.php";              
    $a = new Aluno();
    $a->matricula = "102016-02";
    $res = $a->listar();
    
echo "<table>";
    while ($row = $res->fetch_assoc()) {
        echo "<ul>Nome = " . $row['nome'] . " Matricula = " .$row['matricula'] . "\n</ul>";
    }
echo "</table>";
?>
        </div> <!-- fim div conteudo !-->

        <!--Rodapé-->
        <?php include "footer.php" ?>
        <!--Fim do Rodapé-->
</html>