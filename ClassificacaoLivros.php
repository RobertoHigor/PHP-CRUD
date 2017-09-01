<?php require_once "src/Classificacao.php"?>

<html>
    <!-- Menu !-->
    <?php include "header.php" ?>
    <!-- Fim do menu -->

     <!-- Conteúdo do site !-->
    <div class = "conteudo">  

    <?php 
       
        $c = new Classificacao(); 

        if ($_POST) {     
            $c->setCDD($_POST['CDDID']);
        }
        $resLivro = $c->listarLivros($c);        
        $resAutor = $c->listar();         
        $c->listarPorId($c);     
        
        ?>


    <form action="ClassificacaoLivros.php" method="POST">
        <select name="CDDID">        

            <?php             
            while ($row = $resAutor->fetch_assoc()){
                echo "<option value=\"".$row['CDD']."\">" .$row['nome'] . "</option>";                              
            }
            ?>
            
        </select>
        <input type="submit" value="Pesquisar"></input>
    </form> 

    <h1><?php echo $c->getNome(); ?></h1>
        <br>
    <table>
        <tr>
            <th>Nome do Livro</th>
            <th>Idioma</th>
            <th>Preço</th>
        </tr>
          
  
        
       
        <?php while ($row = $resLivro->fetch_assoc()) {
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