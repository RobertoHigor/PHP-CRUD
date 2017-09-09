<?php require_once "src/Usuario.php"; ?>
<html>
        <!-- Menu !-->
        <?php include "header.php" ?>
        <!-- Fim do menu -->

       <!-- Conteúdo do site !-->
       <?php
        if ($_POST){
                $u = new Usuario();

                $u->setEmail($_POST['email']);
                $u->setSenha($_POST['senha']);
                //echo "Email no get " . $u->getEmail() ."   ";

                if ($_POST['opc'] == "Logar"){                      
                        if ($u->logar($u)){
                                $_SESSION['email'] = $_POST['email'];
                                header("location:LivroListar.php");
                        }
                }else{              
                         header("location:UsuarioCadastro.php");
                }
        }
        ?>
       <div class ="conteudo">
                <form action="#" method="post">
                        <fieldset>
                                <legend> Login </legend>
                                <p class="linha">
                                         <label for="email">Email:</label><input type="text" id="email" name="email"/> 
                                </p>
                                 <p class="linha">
                                         <label for="senha">Senha:</label><input type="password" name ="senha"/>     
                                </p>             
                                <input type="submit" name="opc" value="Logar" />  
                                <input type="submit" name"opc" value="Cadastrar"/>
                                <p class="linha">
                                        <a href="UsuarioEditoraCadastro.php">Clique aqui caso seja uma editora</a>
                                </p>
                        </fieldset>
                </form>         
                         
        </div> <!-- fim div conteudo !-->

        <!--Rodapé-->
        <?php include "footer.php" ?>
        <!--Fim do Rodapé-->
</html>