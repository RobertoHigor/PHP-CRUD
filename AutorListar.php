<?php require_once "src/Autor.php" ?>

<html>
    <!-- Menu !-->
    <?php include "header.php" ?>
    <!-- Fim do menu -->

     <!-- Conteúdo do site !-->
    <?php
     
    $a = new Autor();
    //Somente entrar no bloco se tiver recebido algo
    if ($_POST){
        $_SESSION['autor'] = $_POST;

        //Caso tenha recebido o valor do botão de deletar, setar o codAutor no objeto e deletar ele.
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
        
        //Salvar a lista de autores na variável $res
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
            echo "<input type=\"hidden\" name=\"opc\" value=\"foo\"/>";
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