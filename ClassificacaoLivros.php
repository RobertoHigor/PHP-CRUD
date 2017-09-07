<?php require_once "src/Classificacao.php";
      require_once "src/Pedido.php";?>

<html>
    <!-- Menu !-->
    <?php include "header.php" ?>
    <!-- Fim do menu -->

     <!-- Conteúdo do site !-->
    <div class = "conteudo">  

    <?php 
       
        $c = new Classificacao(); 
        $p = new Pedido();

        if ($_POST) {     
            if ($_POST['opc'] == "Comprar"){
                $p->setUsuarioEmail($_SESSION['email']);
                $p->setLivroISBN($_POST['ISBN']);        
                $p->inserir($p);
            }
            $c->setCDD($_POST['CDDID']);
        }
        $resLivro = $c->listarLivros($c);        
        $resCDD = $c->listar();         
        $c->listarPorId($c);     
        
        ?>


    <form action="ClassificacaoLivros.php" method="POST">
        <select name="CDDID">        

            <?php             
            while ($row2 = $resCDD->fetch_assoc()){                    
                echo "<option"; 
                if($_POST && $row2['CDD'] == $c->getCDD()){echo " selected";}
                echo " value=\"".$row2['CDD']."\">" .$row2['nome'] . "</option>";                         
            }
            echo "<input type=\"hidden\" name=\"opc\" value=\"foo\"></input>";
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
            echo "</td>
                  <td>";
            //Botão de Comprar
            
            echo "<form method=\"post\" action=\"#\">";
            echo "<input type=\"hidden\" name=\"ISBN\" value=\"".$row['ISBN']."\"</input>";            
            echo "<input type=\"hidden\" name=\"CDDID\" value=\"".$row2['CDD']."\"</input>";              
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