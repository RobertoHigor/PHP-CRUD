<?php require_once "src/Autor.php"?>

<html>
    <!-- Menu !-->
    <?php include "header.php" ?>
    <!-- Fim do menu -->

     <!-- Conteúdo do site !-->
    <div class = "conteudo">  

    <?php 
       //Criando objeto
        $a = new Autor(); 

        //Se está recebendo algum valor de post, usar.
        if ($_POST) {     
            $a->setCodAutor($_POST['AutorID']);
        }

        //Guardar os livros relacionados ao ID do objeto
        $resLivro = $a->listarLivros($a);        
        //Listar todos os objetos
        $resAutor = $a->listar();
        
        //Listar apenas o objeto correspondente ao id
        $a->listarPorId($a);     
        
        ?>

    <!-- Formulário para enviar id -->
    <form action="AutorLivros.php" method="POST">
        <select name="AutorID">        

            <?php             
            while ($row = $resAutor->fetch_assoc()){
                //imprimir no echo os objetos
                echo "<option value=\"".$row['codAutor']."\">" .$row['nome'] . "</option>";                              
            }
            ?>
            
        </select>
        <input type="submit" value="Pesquisar"></input>
    </form> 

    <h1><?php echo $a->getNome(); ?></h1>
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