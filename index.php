<?php require_once "src/Usuario.php"; ?>
<html>
        <!-- Menu !-->
        <?php include "header.php" ?>
        <!-- Fim do menu -->

       <!-- Conteúdo do site !-->
       <?php
        if ($_POST){
                $u = new Usuario();
                echo $_POST['senha'];
                echo $_POST['email'];

                $u->setEmail($_POST['email']);
                $u->setSenha($_POST['senha']);
                echo "Email no get " . $u->getEmail() ."   ";
                if ($u->logar($u)){
                        $_SESSION['email'] = $_POST['email'];
                        header("location:LivroListar.php");
                }
        }
        ?>
       <div class ="conteudo">
                <form action="#" method="post">
                        <fieldset>
                                <legend> Login </legend>
                                <p class="linha">
                                         <label for="email">Email:</label><input type="text" id="email" name="email" autocomplete="off"/> 
                                </p>
                                 <p class="linha">
                                         <label for="senha">Senha:</label><input type="password" name ="senha" required autocomplete="off"/>     
                                </p>             
                                <input type="submit" name="login" value="Logar" />  
                        </fieldset>
                </form>                      
        </div> <!-- fim div conteudo !-->

        <!--Rodapé-->
        <?php include "footer.php" ?>
        <!--Fim do Rodapé-->
</html>