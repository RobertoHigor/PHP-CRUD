<?php require "src/Autor.php" ?>

<html>
    <!-- Menu !-->
    <?php include "header.php" ?>
    <!-- Fim do menu -->

<?php 
        $a = new Autor();
        //$_SESSION["codAutor"] = $_POST['codAutor'];
        $a->setCodAutor($_POST["codAutor"]);
        $a->listarPorId($a);
?>
     <!-- Conteúdo do site !-->
    <div class = "conteudo">  
        <form action = "AutorSucesso.php" method="post">    
            <fieldset>
            <legend> Autor </legend>          
            
            <p id="linha">
                <label for="nome">Nome: </label><input type="text" required id ="nome" name="nome" value=<?php echo $a->getNome()?>></input>      
            </p>
            <p id="linha">        
                <label for="email">Email: </label><input type="email" required id ="email" name="email" value=<?php echo $a->getEmail()?>></input>
            </p>
            <p id="linha">
                <label for="telefone">Telefone: </label><input type="number" id ="telefone" name="telefone" value=<?php echo $a->getTelefone()?>></input>
                <input type="hidden" name="codAutor" value="<?php echo $_SESSION['codAutor']?>"></input>
                <input type="submit" value="Alterar"></input>
            </p>
            </fieldset>   
        </form>
    </div> <!-- fim div conteudo !-->

    <!--Rodapé-->
    <?php include "footer.php" ?>
    <!--Fim do Rodapé-->
</html>