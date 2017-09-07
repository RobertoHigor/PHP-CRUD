<?php require_once "src/Classificacao.php" ?>

<html>
    <!-- Menu !-->
    <?php include "header.php" ?>
    <!-- Fim do menu -->

     <!-- Conteúdo do site !-->
    <?php
     //Criar objeto classificação
    $C = new Classificacao();

    //Se estiver vindo de um post, entrar no if
    if ($_POST){
        $_SESSION['classificacao'] = $_POST;

        //Se o usuário clicou em deletar, deletar a classificação com o CDD enviado.
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
   
        //Salvar o resultado do listar na variável $res
        $res = $C->listar();
       
        while ($row = $res->fetch_assoc()) {
            echo "<tr>". 
                    "<td>" . $row['CDD'] . "</td>".
                    "<td>" . $row['nome'] ."</td>";   
                    
            //Alterar
            echo "<td>
                <form method=\"post\" action=\"ClassificacaoCadastro.php\">";
            echo "<input type=\"hidden\" name=\"CDD\" value=\"".$row['CDD']."\"</input>";
            echo "<input type=\"hidden\" name=\"opc\" value=\"alt\"</input>";
            echo "<input type=\"submit\" value=\"Editar\"></input></form>";

            //Deletar
            echo "<form method=\"post\" action\"#\"><input type=\"submit\" value=\"Deletar\"></input>";
            echo "<input type=\"hidden\" name=\"CDD\" value=\"".$row['CDD']."\"</input>";
            echo "<input type=\"hidden\" name=\"opc\" value=\"del\"</input>";
            echo "</form>";

            //Ver livros com o CDD escolhido
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