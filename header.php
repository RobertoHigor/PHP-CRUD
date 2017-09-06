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
                </ul>
 </nav>
 <?php
 session_start();
 if (basename($_SERVER['PHP_SELF']) != 'index.php' || $_SERVER != 'AutorCadastro.php'){
     echo "Dentro do !=".$_SERVER['PHP_SELF'];
     if (!isset($_SESSION['email'])) {
        //echo "Dentro do location";
        header("location:index.php");
        die();
    }
 }

 ?>
<!-- Fim do menu -->