<?php require_once "src/Editora.php"?>

<html>
    <!-- Menu !-->
    <?php include "header.php" ?>
    <!-- Fim do menu -->

     <!-- Conteúdo do site !-->
    <div class = "conteudo">  

    <?php 
       //Criando objeto
        $e = new Editora(); 

        //Se está recebendo algum valor de post, usar.
        if ($_POST) {     
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
            while ($row = $resEditora->fetch_assoc()){
                //imprimir no echo os objetos
                echo "<option value=\"".$row['CNPJ']."\">" .$row['nomeFantasia'] . "</option>";                              
            }
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
            echo "</tr>";
               
        }
?>
    </table>
    </div> <!-- fim div conteudo !-->

    <!--Rodapé-->
    <?php //include "footer.php" ?>
    <!--Fim do Rodapé-->
</html>