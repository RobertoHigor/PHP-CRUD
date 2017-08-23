<?php require "src/Autor.php" ?>

<html>
    <!-- Menu !-->
    <?php include "header.php" ?>
    <!-- Fim do menu -->

     <!-- Conteúdo do site !-->
    <div class = "conteudo">  
    <table>
        <tr>
            <th>Nome</th>
            <th>Email</th>
            <th>Telefone</th>
        </tr>
          
    <?php 
    //CONTINUAR SESSAO
    session_start();
    echo "CNPJ DA EDITORA TEM QUE SER 44455566: " . $_SESSION['nome'];
        $a = new Autor();
        $res = $a->listar();
       
        while ($row = $res->fetch_assoc()) {
            echo "<tr>". 
                    "<td>" . $row['nome'] . "</td>".
                    "<td>" . $row['email'] ."</td>". 
                    "<td>" . $row['telefone']. "</td>";   
            echo "<td>
                <form method=\"post\" action=\"AutorEditar.php\">";
            echo "<input type=\"hidden\" name=\"codAutor\" value=\"".$row['codAutor']."\"</input>";
            echo "<input type=\"submit\" value=\"Editar\"></input>";
            echo "<input type=\"submit\" value=\"Deletar\"></input>";
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