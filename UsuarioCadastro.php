<?php require_once "src/Usuario.php" ?>

<html>
    <!-- Menu !-->
    <?php include "header.php" ?>
    <!-- Fim do menu -->
    <!-- Conteúdo do site !-->
    <div class = "conteudo">  
    <?php 
       
        if ($_POST){
            //Salvar os dados na sessão usuario
            $_SESSION['usuario'] = $_POST;        
            //ECHO "email: ".$_SESSION['usuario']['email']; 
           // echo "Data antes: ". $_SESSION['usuario']['dataNascimento']. " ";
            
            $u = new Usuario();

            //Se clicou em cadastrar, entrar no IF.            
            if ($_SESSION['usuario']['opc'] == "Cadastrar") {  
                //Pegar os dados recebidos e inserir no banco             
               
                $u->setNome($_SESSION['usuario']['nome']);
                $u->setSobrenome($_SESSION['usuario']['sobrenome']);
                $u->setEmail($_SESSION['usuario']['email']);
                $u->setSenha($_SESSION['usuario']['senha']);
                $u->setCPF($_SESSION['usuario']['CPF']);

                $nascimento = date("Y-m-d", strtotime(str_replace("/", "-", $_SESSION['usuario']['dataNascimento'])));
               // echo "Data depois: ". $nascimento;
                $u->setDataNasc($nascimento);

                

                $u->inserirCliente($u);

            //Se está vindo pela página alterar ou clicou em Alterar
            }else if ($_SESSION['usuario']['opc'] == "alt" || $_SESSION['usuario']['opc']= "Alterar"){
             
                $u>setEmail($_SESSION['usuario']['email']);
                $u>listarPorId($u);

                //Se clicou em Alterar
                if ($_SESSION['usuario']['opc'] == "Alterar"){                               
                    $u->setNome($_SESSION['usuario']['nome']);
                    $u->setSobrenome($_SESSION['usuario']['sobrenome']);
                    $u->setEmail($_SESSION['usuario']['email']);
                    $u->setSenha($_SESSION['usuario']['senha']);
                    $u->setCPF($_SESSION['usuario']['CPF']);

                    $nascimento = date("Y-m-d", strtotime($_SESSION['usuario']['dataNascimento']));                  
                    $u->setDataNasc($nascimento);     
                    $u->alterar($u);
            }
        }
    }
    ?>
        <form action = "UsuarioCadastro.php" method="post">    
            <fieldset>
            <legend> Usuario </legend>          
        
            
            <p class="linha">        
                <label for="email">Email: </label><input type="email" id ="email" name="email" value="<?php if($_POST && $_SESSION['usuario']['opc'] == "alt"){echo $u>getEmail();} ?>"></input>
            </p>
            <p class="linha">
                <label for="senha">Senha: </label><input type="password" id ="senha" name="senha" value="<?php if($_POST && $_SESSION['usuario']['opc'] == "alt"){echo $u>getSenha();} ?>"></input>
            </p>

            <!-- Usuario-->
            <p class="linha">
                <label for="nome">Nome: </label><input type="text" id ="nome" name="nome" value="<?php if($_POST && $_SESSION['usuario']['opc'] == "alt"){echo $u>getNome();} ?>"></input>      
            </p>
          
            <p class="linha">
                <label for="CPF">CPF: </label><input type="number" id ="CPF" name="CPF" value="<?php if($_POST && $_SESSION['usuario']['opc'] == "alt"){echo $u>getCPF();} ?>"></input>
            </p>
            <p class="linha">
                <label for="sobrenome">Sobrenome: </label><input type="text" id ="sobrenome" name="sobrenome" value="<?php if($_POST && $_SESSION['usuario']['opc'] == "alt"){echo $u>getSobrenome();} ?>"></input>
            </p>
            <p class="linha">
                <label for="dataNascimento">Data de Nascimento: </label><input type=date id ="dataNascimento" name="dataNascimento" placeholder="dd/mm/aaaa"value="<?php if($_POST && $_SESSION['usuario']['opc'] == "alt"){echo $u>getDataNascimento();} ?>"></input>
            </p>

            <p class="linha">       

                <?php if($_POST && $_SESSION['usuario']['opc'] == "alt"){
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