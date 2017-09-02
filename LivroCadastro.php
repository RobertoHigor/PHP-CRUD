<?php require_once "src/Livro.php";
      require_once "src/Autor.php";
      require_once "src/Editora.php";
      rsequire_once "src/Classificacao.php"; ?>

<html>
    <!-- Menu !-->
    <?php include "header.php" ?>
    <!-- Fim do menu -->
    <!-- Conteúdo do site !-->
    <div class = "conteudo">  
    <?php 
       
        $a = new Autor();
        $resAutor = $a->listar();

        $e = new Editora();
        $resEditora = $e->listar();

        $c = new Classificacao();
        $resClassificacao = $c->listar();

        if ($_POST){
            //Salvar os dados na sessão livro
            $_SESSION['livro'] = $_POST; 
            $l = new Livro();

            //Se clicou em cadastrar, entrar no IF.            
            if ($_SESSION['livro']['opc'] == "Cadastrar") {  
                //Pegar os dados recebidos e inserir no banco             
                $l->setISBN($_SESSION['livro']['ISBN']);
                $l->setNome($_SESSION['livro']['nome']);
                $l->setPreco($_SESSION['livro']['preco']);

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
                    $l->setIdioma($_SESSION['livro']['idioma']);
                    $l->setPreco($_SESSION['livro']['preco']); 
                    $l->setEditora_CNPJ($_SESSION['livro']['editora_CNPJ']); 
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
                <label for="ISBN">ISBN: </label><input type="text" id ="ISBN" name="ISBN" value="<?php if($_POST && $_SESSION['livro']['opc'] == "alt"){echo $l->getISBN();} ?>"></input>
            </p>
            <p class="linha">
                <label for="nome">Nome: </label><input type="text" id ="nome" name="nome" value="<?php if($_POST && $_SESSION['livro']['opc'] == "alt"){echo $l->getNome();} ?>"></input>      
            </p> 
            <p class="linha">        
                <label for="preco">Preço: </label><input type="text" id ="preco" name="preco" value="<?php if($_POST && $_SESSION['livro']['opc'] == "alt"){echo $l->getPreco();} ?>"></input>
            </p>           
            <p class="linha">
                <label for="telefone">Telefone: </label><input type="text" id ="telefone" name="telefone" value="<?php if($_POST && $_SESSION['livro']['opc'] == "alt"){echo $l->getTelefone();} ?>"></input>
            </p>
            <p class="">
                <select name="AutorID">        

                    <?php             
                    while ($row = $resAutor->fetch_assoc()){
                        //imprimir no echo os objetos
                        echo "<option value=\"".$row['codAutor']."\">" .$row['nome'] . "</option>";                              
                    }
                    ?>
                
                </select>
            </p>
            <p class="">
                <select name="CNPJID">        

                    <?php             
                    while ($row = $resEditora->fetch_assoc()){
                        //imprimir no echo os objetos
                        echo "<option value=\"".$row['CNPJ']."\">" .$row['nomeFantasia'] . "</option>";                              
                    }
                    ?>                    
                
                </select>
            </p>
            <p class="">
                <select name="CDDID">        

                    <?php             
                    while ($row = $resClassificacao->fetch_assoc()){
                        //imprimir no echo os objetos
                        echo "<option value=\"".$row['CDD']."\">" .$row['nome'] . "</option>";                              
                    }
                    ?>
                
                </select>
            </p>           

                <input type="hidden" name="ISBN" value="<?php if($_POST && $_SESSION['livro']['opc'] == "alt"){echo $_SESSION['livro']['ISBN']  ;} ?>"></input>

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