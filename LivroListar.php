<!-- Importando a classe livro -->
<?php require_once "src/Livro.php";
      require_once "src/Pedido.php" ?>

<html>
    <!-- Menu !-->
    <?php include "header.php" ?>
    <!-- Fim do menu -->

     <!-- Conteúdo do site !-->
    <?php
    //echo $_SESSION['email'];

    //Criar o objeto de livro e pedido
    $l = new Livro();
    $p = new Pedido();

    if($_POST){
        $_SESSION['livro'] = $_POST;

        //entrar no if caso o usuário tenha clicado no botão deletar
        if ($_SESSION['livro']['opc'] == 'del'){
            $l->setISBN($_SESSION['livro']['ISBN']);
            $l->deletarPorId($l);
        }

        //entrar no botão buy caso o usuário tenha clicado no botão comprar.
        if ($_SESSION['livro']['opc'] == 'buy'){
            $p->setUsuarioEmail($_SESSION['email']);
            $p->setLivroISBN($_SESSION['livro']['ISBN']);        
            $p->inserir($p);
        }
    }

    if (isset($_GET['busca'])){
        //echo $_GET['busca'];
        $res = $l->listarPorString($_GET['busca']);
    }else {
        $res = $l->listar();
    }
    ?>

    <form action="#" method="GET">
        Buscar Livro:
        <input type="search" name="busca"/>
        <input type="submit"/>
    </form>

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

            //Botão de Comprar
            echo "<form method=\"post\" action=\"#\"><input type=\"submit\" value=\"Comprar\"></input>";
            echo "<input type=\"hidden\" name=\"ISBN\" value=\"".$row['ISBN']."\"</input>";
            echo "<input type=\"hidden\" name=\"opc\" value=\"buy\"></input>";
            echo "</form>";

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