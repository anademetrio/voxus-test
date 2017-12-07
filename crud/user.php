<?php

require_once('../db.php');

$acao = isset($_GET['acao']) ? $_GET['acao'] : '';
session_start();

if ($acao == 'add') {

    $email = $_POST['email'];
    $senha = base64_encode($_POST['senha']);

    $str = $conn->query("SELECT * FROM users WHERE email = '$email'");
    if ($str->rowCount() == 0) {
        $str = $conn->prepare("INSERT INTO `users` (`email`, `senha`) VALUES ('$email','$senha')");
        if ($str->execute()) {
            $_SESSION['logado'] = 1;
            echo '1';
        } else {
            echo 'Ocorreu um erro inexperado, por favor tente novamente mais tarde!';
        }
    } else {
        echo 'E-mail já cadastrado';
    }
}
if ($acao == 'logar') {
    $email = $_POST['email'];
    $senha = base64_encode($_POST['senha']);

    $str = $conn->query("SELECT * FROM users WHERE email = '$email' AND senha = '$senha'");
    if ($str->rowCount() == 1) {
        $_SESSION['logado'] = 1;
        echo '1';
    } else {
        echo 'E-mail ou senha incorretos';
    }
}
if ($acao == 'sair') {
    unset($_SESSION['logado']);
}