<head>
    <title> Livraria </title>
    <link rel="stylesheet" type="text/css" href="css\estilo.css">
</head>

<body class="body">
<!-- Menu !-->
<nav class="head-nav">
                <ul>
                        <li><a href="index.php">Início</a></li>
                        <li class="menu"><a href="LivroListar.php">Livros</a>
                            <div class="submenu">
                                <a href="LivroListar.php">Listar</a>
                                <a href="LivroCadastro.php">Cadastrar</a>
                            </div>
                        </li>                     
                        <li class="menu"><a href="EditoraListar.php">Editora</a>
                            <div class="submenu">
                                <a href="EditoraListar.php">Listar</a>
                                <a href="EditoraCadastro.php">Cadastrar</a>
                            </div>
                        </li>
                        <li class="menu"><a href="AutorListar.php">Autor</a>
                            <div class="submenu">
                                <a href="AutorListar.php">Listar</a>
                                <a href="AutorCadastro.php">Cadastrar</a>
                            </div>
                        </li>
                        <li class="menu"><a href="ClassificacaoListar.php">Classificação</a>
                            <div class="submenu">
                                <a href="ClassificacaoListar.php">Listar</a>
                                <a href="ClassificacaoCadastro.php">Cadastrar</a>
                                </div>
                        </li>
                        <li><a href="Biblioteca.php">Biblioteca</a></li>
                        <li><form id="sair" action="#" method="post"><input id="sair" type="submit" name="sair" value="sair"/></form></li>
                </ul>
 </nav>
 <?php
 session_start();
 if (basename($_SERVER['PHP_SELF']) != 'index.php' && basename($_SERVER['PHP_SELF']) != 'UsuarioCadastro.php' && basename($_SERVER['PHP_SELF']) != "UsuarioEditoraCadastro.php"){
     //echo "Dentro do !=".$_SERVER['PHP_SELF'];
     if (!isset($_SESSION['email'])) {
        //echo "Dentro do location";
        header("location:index.php");
        die();
    }
 }

    //Destruir sessão se tiver clicado em sair
     if (isset($_POST['sair']) && $_POST['sair'] = 'sair') {         
         header("location:index.php");
         session_destroy();          
     }

 ?>
<!-- Fim do menu -->