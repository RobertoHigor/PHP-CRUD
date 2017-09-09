<?php require_once "src/Livro.php";
      require_once "src/Autor.php";
      require_once "src/Editora.php";
      require_once "src/Classificacao.php"; ?>

<html>
    <!-- Menu !-->
    <?php include "header.php" ?>
    <!-- Fim do menu -->
    <!-- Conteúdo do site !-->
    <div class = "conteudo">  
    <?php 
       //Criar o objeto autor, editora e classificação
        $a = new Autor();
        $resAutor = $a->listar();

        $e = new Editora();
        $resEditora = $e->listar();

        $c = new Classificacao();
        $resClassificacao = $c->listar();

        if ($_POST){
            //Salvar os dados na sessão livro
            $_SESSION['livro'] = $_POST; 

            //Criar o objeto de livro caso tenha recebido algum valor via post
            $l = new Livro();

            //Se clicou em cadastrar, entrar no IF.            
            if ($_SESSION['livro']['opc'] == "Cadastrar") {  
                //Pegar os dados recebidos e inserir no banco             
                $l->setISBN($_SESSION['livro']['ISBN']);
                //echo "TESTE@@@@@@@@@@@: ".$_SESSION['livro']['ISBN'];
                $l->setNome($_SESSION['livro']['nome']);
                $l->setPreco(str_replace(",", ".", $_SESSION['livro']['preco']));
                $l->setidioma($_SESSION['livro']['idioma']);

                $l->setEditoraCNPJ($_SESSION['livro']['editora_CNPJ']);
                $l->setAutorCodAutor($_SESSION['livro']['autor_codAutor']);
                $l->setClassificacaoCDD($_SESSION['livro']['classificacao_CDD']);

                $l->inserir($l);

            //Se está vindo pela página alterar ou clicou em Alterar
            }else if ($_SESSION['livro']['opc'] == "alt" || $_SESSION['livro']['opc']= "Alterar"){
             
                $l->setISBN($_SESSION['livro']['ISBN']);
                $l->listarPorId($l);

                //Se clicou em Alterar
                if ($_SESSION['livro']['opc'] == "Alterar"){                               
                    $l->setISBN($_SESSION['livro']['ISBN']);
                    $l->setNome($_SESSION['livro']['nome']);
                    $l->setidioma($_SESSION['livro']['idioma']);
                    $l->setPreco(str_replace(",", ".", $_SESSION['livro']['preco'])); 
                    
                    $l->setEditoraCNPJ($_SESSION['livro']['editora_CNPJ']); 
                    $l->setAutorCodAutor($_SESSION['livro']['autor_codAutor']);
                    $l->setClassificacaoCDD($_SESSION['livro']['classificacao_CDD']);      
                    $l->alterar($l);
            }
        }
    }
    ?>
        <form action = "LivroCadastro.php" method="POST">    
            <fieldset>
            <legend> Livro </legend>    

            <p class="linha">        
                <label for="ISBN">ISBN: </label><input type="number" id="ISBN" name="ISBN"<?php if($_POST && $_SESSION['livro']['opc'] == "alt"){echo "readonly ";}?>value="<?php if($_POST && $_SESSION['livro']['opc'] == "alt"){echo $l->getISBN();} ?>"></input>
            </p>
            <p class="linha">
                <label for="nome">Nome: </label><input type="text" id ="nome" name="nome" value="<?php if($_POST && $_SESSION['livro']['opc'] == "alt"){echo $l->getNome();} ?>"></input>      
            </p> 
            <p class="linha">        
                <label for="preco">Preço: </label><input type="text" id ="preco" name="preco" placeholder="00.00" value="<?php if($_POST && $_SESSION['livro']['opc'] == "alt"){echo $l->getPreco();} ?>"></input>
            </p>           
            <p class="linha">
                <label for="idioma">idioma: </label><input type="text" id ="idioma" name="idioma" value="<?php if($_POST && $_SESSION['livro']['opc'] == "alt"){echo $l->getIdioma();} ?>"></input>
            </p>
            <p class="">
                <select name="autor_codAutor">        

                    <?php             
                    while ($row = $resAutor->fetch_assoc()){
                        //imprimir no echo os objetos autores do banco de dados
                        echo "<option"; 
                        if($_POST && $row['codAutor'] == $l->getCodAutor()){echo " selected";}
                        echo " value=\"".$row['codAutor']."\">" .$row['nome'] . "</option>";                              
                    }
                    ?>
                
                </select>
            </p>
            <p class="">
                <select name="editora_CNPJ">        

                    <?php             
                    while ($row = $resEditora->fetch_assoc()){
                        //imprimir no echo os objetos Editoras do banco de dados
                        echo "<option";
                        if($_POST && $row['CNPJ'] == $l->getCNPJ()){echo " selected";}
                         echo " value=\"".$row['CNPJ']."\">" .$row['nomeFantasia'] . "</option>";                              
                    }
                    ?>                    
                
                </select>
            </p>
            <p class="">
                <select name="classificacao_CDD">        

                    <?php             
                    while ($row = $resClassificacao->fetch_assoc()){
                        //imprimir no echo os objetos classificação do banco de dados
                        echo "<option";
                        if($_POST && $row['CDD'] == $l->getCDD()){echo " selected";}
                        echo " value=\"".$row['CDD']."\">" .$row['nome'] . "</option>";                              
                    }
                    ?>
                
                </select>
            </p>           

            <!-- Mostrar o botão de alterar caso esteja vindo pela página de alteração. Caso contrário, mostrar o de cadastro -->
                <?php if($_POST && $_SESSION['livro']['opc'] == "alt"){
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