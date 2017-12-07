<?php
session_start();
if (isset($_SESSION['logado']) && $_SESSION['logado'] == 1) {
    //echo 'Está logado!';
    header('Location: index.php');
} else {
    //header('Location: login.php');
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Gerenciador de Tarefas</title>
        <link rel="stylesheet" href="css/foundation.css" />
        <link rel="stylesheet" href="css/font-awesome.min.css" />
        <link rel="stylesheet" href="css/style.css" />
        <script src="js/vendor/modernizr.js"></script>
    </head>
    <body>
        <nav class="top-bar" data-topbar role="navigation">
            <ul class="title-area">
                <li class="name">
                    <h1><a href="#"><i class="fa fa-ticket"></i> Gerenciador de Tarefas</a></h1>
                </li>
            </ul>
        </nav>
        <div class="row">
            <div class="columns small-12 login-body">
                <div class="panel">
                    <h5 class="small-12 columns">Login<a href="cadastro.php" class="button right small">Cadastrar-se</a></h5>
                    <form onsubmit="logar(); return false;" method="post" id="fm-login">
                        <div class="row">
                            <div class="large-12 columns">
                                <label>E-mail
                                    <input type="email" required="" name="email" />
                                </label>
                            </div>
                            <div class="large-12 columns">
                                <label>Senha
                                    <input type="password" required="" name="senha"/>
                                </label>
                            </div>
                            <div class="large-12 columns">
                                <button class="button small right success" type="submit">Entrar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script src="js/vendor/jquery.js"></script>
        <script src="js/foundation.min.js"></script>
        <script src="js/scripts.js"></script>
        <script>
            $(document).foundation();
        </script>
    </body>
</html>