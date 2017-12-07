<?php
session_start();
if (isset($_SESSION['logado']) && $_SESSION['logado'] == 1) {
    
} else {
    header('Location: login.php');
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
            <section class="top-bar-section">
                <ul class="right">
                    <li class="active"><a href="#" onclick="logout();">Sair</a></li>
                </ul>
            </section>
        </nav>
        <div class="row">
            <div class="columns small-12 tasks-body">
                <div class="panel">
                    <h5 class="small-12 columns">Tarefas<a href="#" data-reveal-id="myModal" class="button right small">Nova Tarefa</a></h5>
                    <table id="task-list" width="100%">
                        <thead>
                            <tr>
                                <th width="20">Código</th>
                                <th width="30">Nome</th>
                                <th width="150">Descrição</th>
                                <th width="30" class="text-center">Arquivo</th>
                                <th width="30" class="text-center">Data</th>
                                <th width="100">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Carregando...</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- modal de adicionar e alterar tarefas -->
        <div id="myModal" class="reveal-modal" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">
            <h2 id="modalTitle">Tarefa</h2>
            <form enctype="multipart/form-data" onsubmit="addTask(); return false;" id="form-task-add">
                <div class="row">
                    <div class="large-12 columns">
                        <input type="hidden" name="id" value=""/>
                        <input type="hidden" name="file_name" value=""/>
                        <label>Nome
                            <input type="text" name="nome" required=""/>
                        </label>
                    </div>
                    <div class="large-12 columns">
                        <label>Descrição
                            <textarea name="descricao"></textarea>
                        </label>
                    </div>
                    <div class="large-12 columns">
                        <i id="file_name_txt"></i>
                        <label>Arquivo
                            <input type="file" name="arquivo"/>
                        </label>
                    </div>
                    <div class="large-12 columns">
                        <button class="button small right success" type="submit">Enviar</button>
                    </div>
                </div>
            </form>
            <a class="close-reveal-modal" aria-label="Close" onclick="reset_form();">&#215;</a>
        </div>

        <script src="js/vendor/jquery.js"></script>
        <script src="js/foundation.min.js"></script>
        <script src="js/scripts.js"></script>
        <script>
                $(document).foundation();
        </script>
    </body>
</html>