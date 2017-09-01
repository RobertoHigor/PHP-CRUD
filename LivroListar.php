<!-- Importando a classe livro -->
<?php require "src/Livro.php" ?>

<html>
    <!-- Menu !-->
    <?php include "header.php" ?>
    <!-- Fim do menu -->

     <!-- Conteúdo do site !-->
    <?php
    session_start();
    $l = new Livro();
    if($_POST){
        $_SESSION['livro'] = $_POST;
        if ($_SESSION['livro']['opc'] == 'del'){
            $l->setISBN($_SESSION['livro']['ISBN']);
            $l->deletarPorId($l);
        }
    }
    ?>

    <div class = "conteudo">  
    <table>
        <tr>
            <th>ISBN</th>
            <th>Nome</th>
            <th>Idioma</th>
            <th>Preço</th>
            <th>Editora</th>
            <th>Autor</th>
            <th>Classificação</th>
        </tr>
          
    <?php 
        
        $res = $l->listar();
       
        while ($row = $res->fetch_assoc()) {
            echo "<tr>". 
                    "<td>" . $row['ISBN'] . "</td>".
                    "<td>" . $row['nome'] ."</td>". 
                    "<td>" . $row['idioma'] ."</td>".
                    "<td>" . $row['preco'] ."</td>".
                    "<td>" . $row['editora_CNPJ'] ."</td>".
                    "<td>" . $row['autor_codAutor'] ."</td>".
                    "<td>" . $row['classificacao_CDD']. "</td>";   
            echo "<td>
                <form method=\"post\" action=\"LivroCadastro.php\">";
            echo "<input type=\"hidden\" name=\"ISBN\" value=\"".$row['ISBN']."\"</input>";

            //botão de editar com variável OPC escondida "alt"
            echo "<input type=\"hidden\" name=\"opc\" value=\"alt\"</input>";
            echo "<input type=\"submit\" value=\"Editar\"></input>";
            echo "</form>";
            
            //Botão de deletar
            echo "<form method=\"post\" action=\"#\"><input type=\"submit\" value=\"Deletar\"></input>";
            echo "<input type=\"hidden\" name=\"ISBN\" value=\"".$row['ISBN']."\"</input>";
            echo "<input type=\"hidden\" name=\"opc\" value=\"del\"</input>";
            echo "</form>";

            echo "</td>";
            echo "</tr>";
               
        }
?>
    </table>
    </div> <!-- fim div conteudo !-->

    <!--Rodapé-->
    <?php include "footer.php" ?>
    <!--Fim do Rodapé-->
</html>