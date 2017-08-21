<?php require "src/Autor.php" ?>

<html>
    <!-- Menu !-->
    <?php include "header.php" ?>
    <!-- Fim do menu -->
    <!-- Conteúdo do site !-->
    <div class = "conteudo">  
    <?php 
        if ($_POST){
            $a = new Autor();
            $a->setNome ($_POST['nome']);
            $a->setEmail ($_POST['email']);
            $a->setTelefone($_POST['telefone']);

            $a->inserir($a);
        }
    ?>
        <form action = "AutorCadastro.php" method="post">    
            <fieldset>
            <legend> Autor </legend>          
        
            <p class="linha">
                <label for="nome">Nome: </label><input type="text" id ="nome" name="nome"></input>      
            </p>
            <p class="linha">        
                <label for="email">Email: </label><input type="email" id ="email" name="email"></input>
            </p>
            <p class="linha">
                <label for="telefone">Telefone: </label><input type="number" id ="telefone" name="telefone"></input>
                <input type="submit" value="Cadastrar"></input>
            </p>
            </fieldset>   
        </form>
    </div> <!-- fim div conteudo !-->

    <!--Rodapé-->
    <?php include "footer.php" ?>
    <!--Fim do Rodapé-->
</html>