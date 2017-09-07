<?php require_once "src/Editora.php";
      require_once "src/Pedido.php";?>

<html>
    <!-- Menu !-->
    <?php include "header.php" ?>
    <!-- Fim do menu -->

     <!-- Conteúdo do site !-->
    <div class = "conteudo">  

    <?php 
       //Criando objeto
        $e = new Editora(); 
        $p = new Pedido();
       
        //Se está recebendo algum valor de post, usar.
        if ($_POST){                
          if ($_POST['opc'] == "Comprar"){             
                $p->setUsuarioEmail($_SESSION['email']);
                $p->setLivroISBN($_POST['ISBN']);        
                $p->inserir($p);
          }
                $e->setCNPJ($_POST['CNPJID']);
            
        }

        //Guardar os livros relacionados ao ID do objeto
        $resLivro = $e->listarLivros($e);        
        //Listar todos os objetos
        $resEditora = $e->listar();
        
        //Listar apenas o objeto correspondente ao id
        $e->listarPorId($e);     
        
        ?>

    <!-- Formulário para enviar id -->
    <form action="EditoraLivros.php" method="POST">
        <select name="CNPJID">        

            <?php        
                 
            while ($row2 = $resEditora->fetch_assoc()){
                //imprimir no echo os objetos              
                echo "<option"; 
                if($_POST && $row2['CNPJ'] == $e->getCNPJ()){echo " selected";}
                echo " value=\"".$row2['CNPJ']."\">" .$row2['nomeFantasia'] . "</option>";                               
                }   
                echo "<input type=\"hidden\" name=\"opc\" value=\"foo\"></input>";  
            ?>
            
        </select>
        <input type="submit" value="Pesquisar"></input>
    </form> 

    <h1><?php echo $e->getNomeFantasia(); ?></h1>
        <br>
    <table>
        <tr>
            <th>Nome do Livro</th>
            <th>Idioma</th>
            <th>Preço</th>
        </tr>
          
  
        
       
        <?php while ($row = $resLivro->fetch_assoc()) {
            //imprimir os livros associados
            echo "<tr>". 
                    "<td>" . $row['nome'] . "</td>".
                    "<td>" . $row['idioma'] ."</td>". 
                    "<td>" . $row['preco']. "</td>";               
            echo "<td>";
            //Botão de Comprar
            echo "<form method=\"post\" action=\"#\">";
            echo "<input type=\"hidden\" name=\"ISBN\" value=\"".$row['ISBN']."\"</input>";            
            echo "<input type=\"hidden\" name=\"CNPJID\" value=\"".$row2['CNPJ']."\"</input>";              
            echo "<input type=\"submit\" name=\"opc\" value=\"Comprar\"></input>";
            echo "</form>";
            echo "</td></tr>";
               
        }
?>
    </table>
    </div> <!-- fim div conteudo !-->

    <!--Rodapé-->
    <?php //include "footer.php" ?>
    <!--Fim do Rodapé-->
</html>