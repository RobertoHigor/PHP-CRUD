<?php require "src/Editora.php" ?>

<html>
    <!-- Menu !-->
    <?php include "header.php" ?>
    <!-- Fim do menu -->
    <!-- Conteúdo do site !-->
    <div class = "conteudo">  
    <?php 
        if ($_POST){
            $e = new Editora();
            $e->setCNPJ($_POST['CNPJ']);
            $e->setNomeFantasia($_POST['nomeFantasia']);
            $e->setEmail ($_POST['email']);
            $e->setTelefone($_POST['telefone']);
            $e->setEndereco($_POST['endereco']);

            $e->inserir($e);
        }
    ?>
        <form action = "EditoraCadastro.php" method="post">    
            <fieldset>
            <legend> Autor </legend>          
            <p class="linha">
                <label for="CNPJ">CNPJ: </label><input type="number" id ="CNPJ" name="CNPJ"></imput>
            </p>
            <p class="linha">
                <label for="nomeFantasia">Nome Fantasia: </label><input type="text" id ="nomeFantasia" name="nomeFantasia"></imput>
            </p>            
            <p class="linha">        
                <label for="email">Email: </label><input type="email" id ="email" name="email"></input>
            </p>
            <p class="linha">
                <label for="telefone">Telefone: </label><input type="number" id ="telefone" name="telefone"></input>
                            </p>
            <p class="linha">
                <label for="endereco">Endereço: </label><input type="text" id ="endereco" name="endereco"></input>   
                <input type="submit" value="Cadastrar"></input>   
            </p>
            </fieldset>   
        </form>
    </div> <!-- fim div conteudo !-->

    <!--Rodapé-->
    <?php include "footer.php" ?>
    <!--Fim do Rodapé-->
</html>