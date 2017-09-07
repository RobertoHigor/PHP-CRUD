<?php require_once "src/Usuario.php";
      require_once "src/Pedido.php";?>

<html>
    <!-- Menu !-->
    <?php include "header.php" ?>
    <!-- Fim do menu -->

     <!-- Conteúdo do site !-->
    <div class = "conteudo">  

    <?php 
       //Criando objeto
        $u = new Usuario(); 
        $p = new Pedido();

        //Se está recebendo algum valor de post, usar.          
        $u->setEmail($_SESSION['email']);    
        
        if ($_POST){
            if ($_POST['opc'] == "del"){

                $p->setLivroISBN($_POST['livro_ISBN']);
                $p->setUsuarioEmail($_SESSION['email']);

                $p->deletarPorId($p);
            }
     }
     
    //Guardar os livros relacionados ao ID do objeto
    $resLivro = $u->listarLivros($u);        
    
    //Listar apenas o objeto correspondente ao id
    //$u->listarPorId($u); 
    ?>

    <h1>Usuário: <?php echo $u->getEmail(); ?></h1>   
    </br>     
    <table>
        <tr>
            <th>Nome do Livro</th>
            <th>Idioma</th>
            <th>Preço</th>
            <th>Data</th>
            <th>Hora</th>
            <th>Opções</th>
        </tr>
          
  
        
       
        <?php while ($row = $resLivro->fetch_assoc()) {
            //imprimir os livros associados
            echo "<tr>". 
                    "<td>" . $row['nome'] . "</td>".
                    "<td>" . $row['idioma'] ."</td>". 
                    "<td>" . $row['preco']. "</td>" .  
                    //Formatar a data em Ano, Mês e Dia
                    //E transforma as tring do banco em um timestamp unix  
                    "<td>" . date('Y-m-d', strtotime($row['data'])). "</td>" .     
                    "<td>" . date('H:i:s', strtotime($row['hora'])). "</td>";   
            echo "<td>";
             //Botão de deletar
             echo "<form method=\"post\" action=\"#\"><input type=\"submit\" value=\"Deletar\"></input>";
             echo "<input type=\"hidden\" name=\"livro_ISBN\" value=\"".$row['livro_ISBN']."\"</input>";
             echo "<input type=\"hidden\" name=\"opc\" value=\"del\"</input>";
             echo "</form></td></tr>";
               
        }
?>
    </table>
    </div> <!-- fim div conteudo !-->

    <!--Rodapé-->
    <?php //include "footer.php" ?>
    <!--Fim do Rodapé-->
</html>