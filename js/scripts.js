get_tasks();
function cadastrar() {
    if ($("input[name=senha]").val() == $("#csenha").val()) {
        var data = $("#fm-cadastro").serialize();
        $.ajax({
            type: 'POST',
            url: 'crud/user.php?acao=add',
            data: data,
        }).done(function (data) {
            if (data == 1) {
                window.location = "index.php";
            } else {
                alerta("warning", ".cadastro-body", data);
            }
        });
    } else {
        alerta("warning", ".cadastro-body", "As senhas não correspondem");
    }
    return false;
}
function logar() {
    var data = $("#fm-login").serialize();
    $.ajax({
        type: 'POST',
        url: 'crud/user.php?acao=logar',
        data: data,
    }).done(function (data) {
        if (data == 1) {
            window.location = "index.php";
        } else {
            alerta("warning", ".login-body", data);
        }
    });
}

function addTask() {
    dados = $('#form-task-add').serialize();
    var formdata = new FormData($("#form-task-add")[0]);

    $.ajax({
        type: 'POST',
        url: 'crud/task.php?acao=add',
        data: formdata,
        processData: false,
        contentType: false

    }).done(function (data) {
        $('#myModal').foundation('reveal', 'close');
        reset_form();
        alerta("success", ".tasks-body", data);
        get_tasks();
    });
}
function get_tasks() {
    $.ajax({
        type: 'get',
        url: 'crud/task.php?acao=get',
        dataType: "json",
        success: function (data) {
            var innerHtml = '';
            var total = data.length;
            for (i = 0; i < total; i++) {
                innerHtml += '<tr>';
                innerHtml += '<td>#' + data[i].id + '</td>';
                innerHtml += '<td>' + data[i].nome + '</td>';
                innerHtml += '<td>' + data[i].descricao + '</td>';
                if (data[i].arquivo != '') {
                    innerHtml += '<td class="text-center"><a href="crud/arquivos/' + data[i].arquivo + '" download title="' + data[i].arquivo + '" class="button tiny success round"><i class="fa fa-download"></i></a></td>';
                } else {
                    innerHtml += '<td class="text-center"><i class="fa fa-download button tiny round secondary disabled" title="Sem Anexo"></i></td>';
                }
                innerHtml += '<td>' + data[i].data + '</td>';
                innerHtml += '<td><ul class="button-group round"><li><a href="#" onclick="editar(' + data[i].id + ')" class="button tiny"><i class="fa fa-pencil"></i></a></li><li><a href="#" onclick="deletar(' + data[i].id + ')" class="button tiny alert"><i class="fa fa-trash"></i></a></li></ul></td>';
                innerHtml += '</tr>';
            }
            if(total == 0){
                var innerHtml = '<tr><td>Nenhuma tarefa encontrada.</td></tr>';
            }
            $("#task-list tbody").html(innerHtml);
        }
    });
}
function logout() {
    $.ajax({
        type: 'get',
        url: 'crud/user.php?acao=sair',
        success: function () {
            window.location = "login.php";
        }
    });
}
function deletar(id) {
    var r = confirm('Deseja mesmo excluir este item?');
    if (r == true) {
        $.ajax({
            type: 'POST',
            url: 'crud/task.php?acao=delete',
            data: {id: id},
        }).done(function (data) {
            if (data == 1) {
                get_tasks();
                alerta("success", ".tasks-body", "Item deletado com sucesso.");
            } else {
                alert(data);
            }
        });
    }
}
function alerta(type, body, message) {
    var html = '<div data-alert class="alert-box text-center ' + type + '">' + message + '<a href="#" class="close" onclick="$(this).parent().hide();">&times;</a></div>';
    $(body).prepend(html);

    setTimeout(function () {
        $('.alert-box').hide('slow');
    }, 3000);

    setTimeout(function () {
        $(body + ' .alert-box').remove();
    }, 4000);

    return false;
}
function editar(id) {
    $.ajax({
        type: 'get',
        url: 'crud/task.php?acao=get&id=' + id,
        dataType: "json",
        success: function (data) {
            $("#myModal input[name=id]").val(data[0].id);
            $("#myModal input[name=nome]").val(data[0].nome)
            $("#myModal input[name=file_name]").val(data[0].arquivo);
            $("#myModal textarea[name=descricao]").val(data[0].descricao);
            $("#myModal #file_name_txt").html('<p>Arquivo Anexado: ' + data[0].arquivo + '</p>');
            $('#myModal').foundation('reveal', 'open');
        }
    });
}
function reset_form() {
    $("#myModal input[name=id]").val('');
    $("#myModal input[name=nome]").val('')
    $("#myModal input[name=file_name]").val('');
    $("#myModal textarea[name=descricao]").val('');
    $("#myModal #file_name_txt").html('');
    $('#form-task-add')[0].reset();
}