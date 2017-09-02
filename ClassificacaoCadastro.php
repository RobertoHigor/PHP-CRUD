<?php require_once "src/Classificacao.php" ?>

<html>
    <!-- Menu !-->
    <?php include "header.php" ?>
    <!-- Fim do menu -->
    <!-- Conteúdo do site !-->
    <div class = "conteudo">  
    <?php 
       
        if ($_POST){
            //Salvar os dados na sessão classificacao
            $_SESSION['classificacao'] = $_POST; 
            $c = new Classificacao();
         
            //Se clicou em cadastrar, entrar no IF.            
            if ($_SESSION['classificacao']['opc'] == "Cadastrar") {  
                //Pegar os dados recebidos e inserir no banco             
                $c->setCDD($_SESSION['classificacao']['CDD']);
                $c->setNome($_SESSION['classificacao']['nome']);                
                
                $c->inserir($c);

            //Se está vindo pela página alterar ou clicou em Alterar
            }else if ($_SESSION['classificacao']['opc'] == "alt" || $_SESSION['classificacao']['opc']= "Alterar"){
                
                $c->setCDD($_SESSION['classificacao']['CDD']);
              
                $c->listarPorId($c);

                //Se clicou em Alterar
                if ($_SESSION['classificacao']['opc'] == "Alterar"){                    

                    $c->setCDD($_SESSION['classificacao']['CDD']);
                    $c->setNome($_SESSION['classificacao']['nome']);
                                          
                    $c->alterar($c);
            }
        }
    }
    ?>
        <form action = "ClassificacaoCadastro.php" method="post">    
            <fieldset>
            <legend> Classificação </legend>          
        
            <p class="linha">               
                <label for="CDD">CDD: </label><input type="text" id ="CDD" name="CDD" <?php if($_POST && $_SESSION['classificacao']['opc'] == "alt"){
                    echo "readonly=\"readonly\"";
                    echo "value=".$c->getCDD(). "" ;} ?>></input>    
            </p>
          
            <p class="linha">
                 <label for="nome">Nome: </label><input type="text" id ="nome" name="nome" value="<?php if($_POST && $_SESSION['classificacao']['opc'] == "alt"){echo $c->getNome();} ?>"></input>  

                <!--<input type="hidden" name="CDD" "></input>-->

                <?php if($_POST && $_SESSION['classificacao']['opc'] == "alt"){
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