<?php require_once "src/Usuario.php" ?>

<html>
    <!-- Menu !-->
    <?php include "header.php" ?>
    <!-- Fim do menu -->
    <!-- Conteúdo do site !-->
    <div class = "conteudo">  
    <?php 
       
        if ($_POST){
            //Salvar os dados na sessão usuarioEditora
            $_SESSION['usuarioEditora'] = $_POST;        
            //ECHO "email: ".$_SESSION['usuarioEditora']['email']; 
           // echo "Data antes: ". $_SESSION['usuarioEditora']['dataNascimento']. " ";
            
            $u = new Usuario();

            //Se clicou em cadastrar, entrar no IF.            
            if ($_SESSION['usuarioEditora']['opc'] == "Cadastrar") {  
                //Pegar os dados recebidos e inserir no banco             
               
                $u->setNomeFantasia($_SESSION['usuarioEditora']['nomeFantasia']);        
                $u->setEmail($_SESSION['usuarioEditora']['email']);
                $u->setSenha($_SESSION['usuarioEditora']['senha']);
                $u->setCNPJ($_SESSION['usuarioEditora']['CNPJ']);                    

                $u->inserirEditora($u);

            //Se está vindo pela página alterar ou clicou em Alterar
            }else if ($_SESSION['usuarioEditora']['opc'] == "alt" || $_SESSION['usuarioEditora']['opc']= "Alterar"){
             
                $u>setEmail($_SESSION['usuarioEditora']['email']);
                $u>listarPorId($u);

                //Se clicou em Alterar
                if ($_SESSION['usuarioEditora']['opc'] == "Alterar"){                              
                    $u->setNomeFantasia($_SESSION['usuarioEditora']['nomeFantasia']);             
                    $u->setEmail($_SESSION['usuarioEditora']['email']);
                    $u->setSenha($_SESSION['usuarioEditora']['senha']);
                    $u->setCNPJ($_SESSION['usuarioEditora']['CNPJ']);
            
                    $u->alterar($u);
            }
        }
    }
    ?>
        <form action = "UsuarioEditoraCadastro.php" method="post">    
            <fieldset>
            <legend> Usuario </legend>          
        
            
            <p class="linha">        
                <label for="email">Email: </label><input type="email" id ="email" name="email" value="<?php if($_POST && $_SESSION['usuarioEditora']['opc'] == "alt"){echo $u>getEmail();} ?>"></input>
            </p>
            <p class="linha">
                <label for="senha">Senha: </label><input type="password" id ="senha" name="senha" value="<?php if($_POST && $_SESSION['usuarioEditora']['opc'] == "alt"){echo $u>getSenha();} ?>"></input>
            </p>

            <!-- UsuarioCliente-->
            <p class="linha">
                <label for="nomeFantasia">Nome Fantasia: </label><input type="text" id ="nomeFantasia" name="nomeFantasia" value="<?php if($_POST && $_SESSION['usuarioEditora']['opc'] == "alt"){echo $u>getNomeFantasia();} ?>"></input>      
            </p>
          
            <p class="linha">
                <label for="CNPJ">CNPJ: </label><input type="number" id ="CNPJ" name="CNPJ" value="<?php if($_POST && $_SESSION['usuarioEditora']['opc'] == "alt"){echo $u>getCNPJ();} ?>"></input>
            </p>           
            
            <p class="linha">       
            
             <!-- Mostrar o botão de alterar caso esteja vindo pela página de alteração. Caso contrário, mostrar o de cadastro -->
                <?php if($_POST && $_SESSION['usuarioEditora']['opc'] == "alt"){
                    echo "<input type=\"submit\" name=\"opc\" value=\"Alterar\"></input>";
                    }else{
                        echo "<input type=\"submit\" name=\"opc\" value=\"Cadastrar\"></input>";
                    }?>
            </p>
            </fieldset>   
        </form>
    </div> <!-- fim div conteudo !-->

    <!--Rodapé-->
    <?php //include "footer.php" ?>
    <!--Fim do Rodapé-->
</html>