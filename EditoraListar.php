<?php require_once "src/Editora.php" ?>

<html>
    <!-- Menu !-->
    <?php include "header.php" ?>
    <!-- Fim do menu -->

     <!-- Conteúdo do site !-->
    <?php
     //Criar o objeto editora
    $e = new Editora();

    //Entrar no IF se estiver recebendo algo
    if ($_POST){
        $_SESSION['editora'] = $_POST;

        //Entrar no if se o usuário tiver clicado no botão deletar
        if ($_SESSION['editora']['opc'] == "del"){
            $e->setCNPJ($_SESSION['editora']['CNPJ']);
            $e->deletarPorID($e);
        }
    }

    ?>
    <div class = "conteudo">  
    <table>
        <tr>
            <th>CNPJ</th>
            <th>Nome Fantasia</th>
            <th>Email</th>
            <th>Telefone</th>
            <th>Endereço</th>
            <th>Opções</th>
        </tr>
          
    <?php 
   
        //Salvar os livros da editora na variavel $res
        $res = $e->listar();
       
        while ($row = $res->fetch_assoc()) {
            echo "<tr>". 
                    "<td>" . $row['CNPJ'] . "</td>".
                    "<td>" . $row['nomeFantasia'] ."</td>". 
                    "<td>" . $row['email'] ."</td>".                     
                    "<td>" . $row['telefone']. "</td>".
                    "<td>" . $row['endereco'] ."</td>"; 

            //Alterar
            echo "<td>
                <form method=\"post\" action=\"EditoraCadastro.php\">";
            echo "<input type=\"hidden\" name=\"CNPJ\" value=\"".$row['CNPJ']."\"</input>";
            echo "<input type=\"hidden\" name=\"opc\" value=\"alt\"</input>";
            echo "<input type=\"submit\" value=\"Editar\"></input></form>";

            //Deletar
            echo "<form method=\"post\" action\"#\"><input type=\"submit\" value=\"Deletar\"></input>";
            echo "<input type=\"hidden\" name=\"CNPJ\" value=\"".$row['CNPJ']."\"</input>";
            echo "<input type=\"hidden\" name=\"opc\" value=\"del\"</input></form>";

            //Ver livros associados
            echo "<form method=\"post\" action=\"EditoraLivros.php\">
            <input type=\"submit\" value=\"Ver Livros\"></input>";
            echo "<input type=\"hidden\" name=\"opc\" value=\"foo\"</input>";
            echo "<input type=\"hidden\" name=\"CNPJID\" value=\"".$row['CNPJ']."\"</input>
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