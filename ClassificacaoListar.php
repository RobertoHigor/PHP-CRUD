<?php require_once "src/Classificacao.php" ?>

<html>
    <!-- Menu !-->
    <?php include "header.php" ?>
    <!-- Fim do menu -->

     <!-- Conteúdo do site !-->
    <?php
     
    $C = new Classificacao();
    if ($_POST){
        $_SESSION['classificacao'] = $_POST;
        if ($_SESSION['classificacao']['opc'] == "del"){
            $C->setCDD($_SESSION['classificacao']['CDD']);
            $C->deletarPorID($C);
        }
    }

    ?>
    <div class = "conteudo">  
    <table>
        <tr>
            <th>CDD</th>
            <th>Nome</th>           
            <th>Opções</th>
        </tr>
          
    <?php 
    //CONTINUAR SESSAO
        
        $res = $C->listar();
       
        while ($row = $res->fetch_assoc()) {
            echo "<tr>". 
                    "<td>" . $row['CDD'] . "</td>".
                    "<td>" . $row['nome'] ."</td>";                     
            echo "<td>
                <form method=\"post\" action=\"ClassificacaoCadastro.php\">";
            echo "<input type=\"hidden\" name=\"CDD\" value=\"".$row['CDD']."\"</input>";
            echo "<input type=\"hidden\" name=\"opc\" value=\"alt\"</input>";
            echo "<input type=\"submit\" value=\"Editar\"></input></form>";
            echo "<form method=\"post\" action\"#\"><input type=\"submit\" value=\"Deletar\"></input>";
            echo "<input type=\"hidden\" name=\"CDD\" value=\"".$row['CDD']."\"</input>";
            echo "<input type=\"hidden\" name=\"opc\" value=\"del\"</input>";
            echo "</form>";

            echo "<form method=\"post\" action=\"ClassificacaoLivros.php\">
            <input type=\"submit\" value=\"Ver Livros\"></input>";
            echo "<input type=\"hidden\" name=\"opc\" value=\"foo\"</input>";
            echo "<input type=\"hidden\" name=\"CDDID\" value=\"".$row['CDD']."\"</input>";
            echo "</form>
                  </td>";
            echo "</tr>";
               
        }
?>
    </table>
    </div> <!-- fim div conteudo !-->

    <!--Rodapé--> 
    <?php //include "footer.php" ?>
    <!--Fim do Rodapé-->
</html>