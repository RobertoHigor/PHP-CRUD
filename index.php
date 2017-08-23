<?php include "src/calculadora.php" ?>

<html>
        <!-- Menu !-->
        <?php include "header.php" ?>
        <!-- Fim do menu -->

       <!-- Conteúdo do site !-->
       <div class = "conteudo">
                <form action="#" method="post">
                        <fieldset>
                                <legend> Campo </legend>
                                <p id="linha">
                                         <label for="n1">Numero 1</label><input type="number" id="n1" name="numero1" value=<?php echo $n1 ?> /> 
                                </p>
                                 <p id="linha">
                                         <label for="n2">Numero 2</label><input type="number"name ="numero2" value=<?php echo $n2 ?> />     
                                </p>             
                                <input type="submit" name="enviar" value="Calcular" />  
                        </fieldset>
                </form>
                Resultado <input type="number"name="resultado" value=<?php echo somar($n1, $n2) ?> />
                
                <?php
                include "src/Aluno.php";              
    $a = new Aluno();
    $a->matricula = "102016-02";
    $res = $a->listar();
    

    while ($row = $res->fetch_assoc()) {
        echo "Nome = " . $row['nome'] . " Matricula = " .$row['matricula'] . "\n</br>";
    }
?>
        </div> <!-- fim div conteudo !-->

        <!--Rodapé-->
        <?php include "footer.php" ?>
        <!--Fim do Rodapé-->
</html>