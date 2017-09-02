<?php require_once "src/Autor.php" ?>

<html>
    <!-- Menu !-->
    <?php include "header.php" ?>
    <!-- Fim do menu -->

     <!-- Conteúdo do site !-->
    <?php
     
    $a = new Autor();
    if ($_POST){
        $_SESSION['autor'] = $_POST;
        if ($_SESSION['autor']['opc'] == "del"){
            $a->setCodAutor($_SESSION['autor']['codAutor']);
            $a->deletarPorID($a);
        }
    }

    ?>
    <div class = "conteudo">  
    <table>
        <tr>
            <th>Nome</th>
            <th>Email</th>
            <th>Telefone</th>
            <th>Opções</th>
        </tr>
          
    <?php 
    //CONTINUAR SESSAO
        
        $res = $a->listar();
       
        while ($row = $res->fetch_assoc()) {
            echo "<tr>". 
                    "<td>" . $row['nome'] . "</td>".
                    "<td>" . $row['email'] ."</td>". 
                    "<td>" . $row['telefone']. "</td>";   
            echo "<td>
                <form method=\"post\" action=\"AutorCadastro.php\">";
            echo "<input type=\"hidden\" name=\"codAutor\" value=\"".$row['codAutor']."\"</input>";
            
            //botão de editar com variável OPC escondida "alt"
            echo "<input type=\"hidden\" name=\"opc\" value=\"alt\"</input>";
            echo "<input type=\"submit\" value=\"Editar\"></input>";
            echo "</form>";
            
            //Botão de deletar
            echo "<form method=\"post\" action=\"#\"><input type=\"submit\" value=\"Deletar\"></input>";
            echo "<input type=\"hidden\" name=\"codAutor\" value=\"".$row['codAutor']."\"</input>";
            echo "<input type=\"hidden\" name=\"opc\" value=\"del\"</input>";
            echo "</form>";
            
            //Botão de mostrar livros associados
            echo "<form method=\"post\" action=\"AutorLivros.php\">
            <input type=\"submit\" value=\"Ver Livros\"></input>";
            echo "<input type=\"hidden\" name=\"AutorID\" value=\"".$row['codAutor']."\"</input>
            </form>";
        

            echo "</td>";
            echo "</tr>";
               
        }
?>
    </table>
    </div> <!-- fim div conteudo !-->

    <!--Rodapé--> 
    <?php //include "footer.php" ?>
    <!--Fim do Rodapé-->
</html>