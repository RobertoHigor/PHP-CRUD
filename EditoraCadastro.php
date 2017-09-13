<?php require_once "src/Editora.php" ?>

<html>
    <!-- Menu !-->
    <?php include "header.php" ?>
    <!-- Fim do menu -->
    <!-- Conteúdo do site !-->
    <div class = "conteudo">  
    <?php 
    //CRIAR SESSAO E GUARDAR O CNPJ NA VARIAVEL NOME
     
        if ($_POST){
            $_SESSION['editora'] = $_POST;
            //Criar o objeto Editora
            $e = new Editora();  
            
            //Entrar se o usuário tiver clicado no botão Cadastrar
            if ($_SESSION['editora']['opc'] == "Cadastrar") {  
                          
                $e->setCNPJ($_SESSION['editora']['CNPJ']);
                $e->setNomeFantasia($_SESSION['editora']['nomeFantasia']);
                $e->setEmail($_SESSION['editora']['email']);
                $e->setTelefone($_SESSION['editora']['telefone']);
                $e->setEndereco($_SESSION['editora']['endereco']);

                $e->inserir($e);
            
            //Entrar se o usuário tiver entrado na página via um link de alterar ou tiver clicado no botão de alterar
            }else if ($_SESSION['editora']['opc'] == "alt" || $_SESSION['editora']['opc']= "Alterar"){
                        
                    $e->setCNPJ($_SESSION['editora']['CNPJ']);
                    $e->listarPorId($e);
                    
            //Se o usuário tiver clicado em alterar, setar os valores do objeto e utilizar o método de alterar
                if ($_SESSION['editora']['opc'] == "Alterar"){ 

                    $e->setCNPJ($_SESSION['editora']['CNPJ']);
                    $e->setNomeFantasia($_SESSION['editora']['nomeFantasia']);
                    $e->setEmail($_SESSION['editora']['email']);
                    $e->setTelefone($_SESSION['editora']['telefone']);
                    $e->setEndereco($_SESSION['editora']['endereco']);
                    $e->alterar($e);
                }
            }
        }
    ?>
        <form action = "EditoraCadastro.php" method="post">    
            <fieldset>
            <legend> Editora </legend>          
            <p class="linha">
                <label for="CNPJ">CNPJ: </label><input placeholder="Somente números" type="number" max="99999999999999" id="CNPJ" name="CNPJ" 
                <?php 
                if ($_POST && $_SESSION['editora']['opc'] == "alt"){
                    echo "readonly=\"readonly\"";
                    echo "value=".$e->getCNPJ()."";
                } 
                    ?>
                    ></input>
            </p>
            <p class="linha">
                <label for="nomeFantasia">Nome Fantasia: </label><input type="text" id ="nomeFantasia" maxlength="50" name="nomeFantasia" value="<?php  if ($_POST && $_SESSION['editora']['opc'] == "alt"){echo $e->getNomeFantasia();} ?>"></input>
            </p>            
            <p class="linha">        
                <label for="email">Email: </label><input type="text" id ="email" name="email" maxlength="70"placeholder="exemplo@exemplo.com" value="<?php  if ($_POST && $_SESSION['editora']['opc'] == "alt"){echo $e->getEmail();} ?>"></input>
            </p>
            <p class="linha">
                <label for="telefone">Telefone: </label><input type="number" max="99999999999" id ="telefone" name="telefone" placeholder="DDD + Número" value="<?php  if ($_POST && $_SESSION['editora']['opc'] == "alt"){echo $e->getTelefone();} ?>"></input>
                            </p>
            <p class="linha">
                <label for="endereco">Endereço: </label><input type="text" id ="endereco" name="endereco" maxlength="150" placeholder="Rua, nº, Bairro, Estado" value="<?php  if ($_POST && $_SESSION['editora']['opc'] == "alt"){echo $e->getEndereco();} ?>"></input>   

                <!-- Mostrar o botão de alterar caso esteja vindo pela página de alteração. Caso contrário, mostrar o de cadastro -->
                <?php if($_POST && $_SESSION['editora']['opc'] == "alt"){
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