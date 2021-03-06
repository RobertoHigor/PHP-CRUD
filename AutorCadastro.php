<?php require_once "src/Autor.php" ?>

<html>
    <!-- Menu !-->
    <?php include "header.php" ?>
    <!-- Fim do menu -->
    <!-- Conteúdo do site !-->
    <div class = "conteudo">  
    <?php 
       
        if ($_POST){
            //Salvar os dados na sessão autor
            $_SESSION['autor'] = $_POST; 
            $a = new Autor();

            //Se clicou em cadastrar, entrar no IF.            
            if ($_SESSION['autor']['opc'] == "Cadastrar") {  
                //Pegar os dados recebidos e inserir no banco             
               
                $a->setNome($_SESSION['autor']['nome']);
                $a->setEmail($_SESSION['autor']['email']);
                $a->setTelefone($_SESSION['autor']['telefone']);

                $a->inserir($a);

            //Se está vindo pela página alterar ou clicou em Alterar
            }else if ($_SESSION['autor']['opc'] == "alt" || $_SESSION['autor']['opc']= "Alterar"){
             
                $a->setCodAutor($_SESSION['autor']['codAutor']);
                $a->listarPorId($a);

                //Se clicou em Alterar
                if ($_SESSION['autor']['opc'] == "Alterar"){                               
                    $a->setCodAutor($_SESSION['autor']['codAutor']);
                    $a->setNome($_SESSION['autor']['nome']);
                    $a->setEmail($_SESSION['autor']['email']);
                    $a->setTelefone($_SESSION['autor']['telefone']);        
                    $a->alterar($a);
            }
        }
    }
    ?>
        <form action = "AutorCadastro.php" method="post">    
            <fieldset>
            <legend> Autor </legend>          
        
            <p class="linha">
                <label for="nome">Nome: </label><input type="text" id ="nome" name="nome" value="<?php if($_POST && $_SESSION['autor']['opc'] == "alt"){echo $a->getNome();} ?>"></input>      
            </p>
            <p class="linha">        
                <label for="email">Email: </label><input type="text" placeholder="exemplo@exemplo.com" id ="email" name="email" value="<?php if($_POST && $_SESSION['autor']['opc'] == "alt"){echo $a->getEmail();} ?>"></input>
            </p>
            <p class="linha">
                <label for="telefone">Telefone: </label><input type="number" id ="telefone" name="telefone" max="99999999999" placeholder="DDD + Numero" value="<?php if($_POST && $_SESSION['autor']['opc'] == "alt"){echo $a->getTelefone();} ?>"></input>
                <input type="hidden" name="codAutor" value="<?php if($_POST && $_SESSION['autor']['opc'] == "alt"){echo $_SESSION['autor']['codAutor']  ;} ?>"></input>

                <!-- Mostrar o botão de alterar caso esteja vindo pela página de alteração. Caso contrário, mostrar o de cadastro -->
                <?php if($_POST && $_SESSION['autor']['opc'] == "alt"){
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