<!-- Importando a classe livro -->
<?php require "src/Livro.php" ?>

<html>
    <!-- Menu !-->
    <?php include "header.php" ?>
    <!-- Fim do menu -->

     <!-- Conteúdo do site !-->
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
        $l = new Livro();
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
                <form method=\"post\" action=\"AutorEditar.php\">";
            echo "<input type=\"hidden\" name=\"codAutor\" value=\"".$row['ISBN']."\"</input>";
            echo "<input type=\"submit\" value=\"Editar\"></input>";
            echo "</form>
                  </td>";
            echo "</tr>";
               
        }
?>
    </table>
    </div> <!-- fim div conteudo !-->

    <!--Rodapé-->
    <?php include "footer.php" ?>
    <!--Fim do Rodapé-->
</html>