<?php require_once "src/Autor.php";
      require_once "src/Pedido.php";?>

<html>
    <!-- Menu !-->
    <?php include "header.php" ?>
    <!-- Fim do menu -->

     <!-- Conteúdo do site !-->
    <div class = "conteudo">  

    <?php 
       //Criando objeto Autor e Pedido
        $a = new Autor(); 
        $p = new Pedido();

        //Se está recebendo algum valor de post, usar.
        if ($_POST) {     
            //Se o usuário clicou no botão de comprar, entrar no if
            if ($_POST['opc'] == "Comprar"){
                $p->setUsuarioEmail($_SESSION['email']);
                $p->setLivroISBN($_POST['ISBN']);  
                //Inserir o livro comprado no pedido associado ao email do usuário logado      
                $p->inserir($p);
            }
            //Setar o codAutor de acordo com o codAutor recebido do option select
            $a->setCodAutor($_POST['AutorID']);
        }

        //Guardar os livros relacionados ao ID do objeto
        $resLivro = $a->listarLivros($a);        
        //Listar todos os objetos
        $resAutor = $a->listar();
        
        //Listar apenas o objeto correspondente ao id
        $a->listarPorId($a);     
        
        ?>

    <!-- Formulário para enviar id -->
    <form action="AutorLivros.php" method="POST">
        <select name="AutorID">        

            <?php             
            while ($row2 = $resAutor->fetch_assoc()){
                //imprimir no echo os objetos e selecionar o ultimo autor enviado              
                echo "<option"; 
                if($_POST && $row2['codAutor'] == $a->getCodAutor()){echo " selected";}
                echo " value=\"".$row2['codAutor']."\">" .$row2['nome'] . "</option>";                           
            }
            echo "<input type=\"hidden\" name=\"opc\" value=\"foo\"></input>";
            ?>
            
        </select>
        <input type="submit" value="Pesquisar"></input>
    </form> 

    <h1><?php echo $a->getNome(); ?></h1>
        <br>
    <table>
        <tr>
            <th>Nome do Livro</th>
            <th>Idioma</th>
            <th>Preço</th>
        </tr>
          
  
        
       
        <?php while ($row = $resLivro->fetch_assoc()) {
            //imprimir os livros associados
            echo "<tr>". 
                    "<td>" . $row['nome'] . "</td>".
                    "<td>" . $row['idioma'] ."</td>". 
                    "<td>" . $row['preco']. "</td>";               
            echo "<td>";
              //Botão de Comprar
              echo "<form method=\"post\" action=\"#\">";
              echo "<input type=\"hidden\" name=\"ISBN\" value=\"".$row['ISBN']."\"</input>";            
              echo "<input type=\"hidden\" name=\"AutorID\" value=\"".$row2['codAutor']."\"</input>";              
              echo "<input type=\"submit\" name=\"opc\" value=\"Comprar\"></input>";
              echo "</form>";
              echo "</td></tr>";
               
        }
?>
    </table>
    </div> <!-- fim div conteudo !-->

    <!--Rodapé-->
    <?php //include "footer.php" ?>
    <!--Fim do Rodapé-->
</html>