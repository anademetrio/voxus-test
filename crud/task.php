<?php

require_once('../db.php');

$acao = isset($_GET['acao']) ? $_GET['acao'] : '';

if ($acao == 'add') {
    
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $arquivo = '';
    if ($_FILES['arquivo']['name'] != '') {
        if (move_uploaded_file($_FILES['arquivo']['tmp_name'], "arquivos/" . $_FILES['arquivo']['name'])) {
            $arquivo = $_FILES['arquivo']['name'];
        } else {
            echo "Falha ao fazer upload!";
            return;
        }
    } 
    if(isset($_POST['file_name']) && $_POST['file_name'] != '' && $_FILES['arquivo']['name'] == ''){
        $arquivo = $_POST['file_name'];
    }
    if(isset($_POST['id']) && $_POST['id'] != ''){
        $id = $_POST['id'];
        $query = "UPDATE `task` SET `nome`= '$nome',`descricao`= '$descricao',`arquivo`= '$arquivo' WHERE id = $id";
        $msg = "Tarefa atualizada com sucesso!";
    } else {
        $query = "INSERT INTO task (nome,descricao,arquivo,data) VALUES ('$nome','$descricao','$arquivo',NOW())";
        $msg = "Tarefa cadastrada com sucesso!";
    }
    $str = $conn->prepare($query);
    if ($str->execute()) {
        echo $msg;
    } else {
        echo 'Ocorreu um erro inexperado, por favor tente novamente mais tarde!';
    }
}
if ($acao == 'get') {
    if(isset($_GET['id'])){
       $id = $_GET['id'];
       $query = "SELECT * FROM task WHERE id = $id";
    } else {
       $query = "SELECT * FROM task";
    }
    $str = $conn->query($query);
    $data = $str->fetchAll();
    $array = array();
    
    foreach ($data as $row) {

        $array[] = array(
            'id' => $row['id'],
            'nome' => $row['nome'],
            'descricao' => $row['descricao'],
            'arquivo' => $row['arquivo'],
            'data' => datetoBR($row['data'])
        );
    }
    echo json_encode($array);
}
if ($acao == 'delete') {
    $id = $_POST['id'];

    $str = $conn->prepare("DELETE FROM `task` WHERE id = $id");
    if ($str->execute()) {
        echo '1';
    } else {
        echo 'Ocorreu um erro inexperado, por favor tente novamente mais tarde!';
    }
}

function datetoBR($data) {
    $old_dateAndTime = explode(' ', $data);
    $old_date = explode('-', $old_dateAndTime[0]);
    $new_date = $old_date[2] . '/' . $old_date[1] . '/' . $old_date[0] . ' ' . $old_dateAndTime[1];
    return $new_date;
}
