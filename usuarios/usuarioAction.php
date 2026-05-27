<?php

// Conexão
include "../conexao.php";

// Captura ação
$acao = $_REQUEST['acao'];


// =====================================================
// INSERIR USUÁRIO
// =====================================================

if ($acao == "inserir") {

    $nome = $_REQUEST['nome'];
    $email = $_REQUEST['email'];
    $telefone = $_REQUEST['telefone'];

    // Validações
    if ($nome == '') {

        echo json_encode(array(
            'retorno' => 'Nome obrigatório!'
        ));

        exit;
    }

    if ($email == '') {

        echo json_encode(array(
            'retorno' => 'Email obrigatório!'
        ));

        exit;
    }

    // SQL
    $sql = "INSERT INTO usuarios (
                nome,
                email,
                telefone
            )
            VALUES (
                '$nome',
                '$email',
                '$telefone'
            )";

    // Execução
    try {

        $db->query($sql);

        echo json_encode(array(
            'retorno' => 'Usuário cadastrado com sucesso!'
        ));

    } catch(PDOException $e) {

        echo json_encode(array(
            'retorno' => $e->getMessage()
        ));

    }

}


// =====================================================
// EXCLUIR USUÁRIO
// =====================================================

if ($acao == "excluir") {

    $id_usuario = $_REQUEST['id_usuario'];

    if ($id_usuario == '') {

        echo json_encode(array(
            'retorno' => 'ID obrigatório!'
        ));

        exit;
    }

    $sql = "DELETE FROM usuarios
            WHERE id_usuario = $id_usuario";

    try {

        $db->query($sql);

        echo json_encode(array(
            'retorno' => 'Usuário excluído com sucesso!'
        ));

    } catch(PDOException $e) {

        echo json_encode(array(
            'retorno' => $e->getMessage()
        ));

    }

}


// =====================================================
// EDITAR USUÁRIO
// =====================================================

if ($acao == "editar") {

    $id_usuario = $_REQUEST['id_usuario'];
    $nome = $_REQUEST['nome'];
    $email = $_REQUEST['email'];
    $telefone = $_REQUEST['telefone'];

    if ($id_usuario == '') {

        echo json_encode(array(
            'retorno' => 'ID obrigatório!'
        ));

        exit;
    }

    $sql = "UPDATE usuarios SET

                nome = '$nome',
                email = '$email',
                telefone = '$telefone'

            WHERE id_usuario = $id_usuario";

    try {

        $db->query($sql);

        echo json_encode(array(
            'retorno' => 'Usuário atualizado com sucesso!'
        ));

    } catch(PDOException $e) {

        echo json_encode(array(
            'retorno' => $e->getMessage()
        ));

    }

}


// =====================================================
// CONSULTAR USUÁRIOS
// =====================================================

if ($acao == "consultar") {

    $pagina = $_GET['page'];
    $linPorPag = $_GET['rows'];
    $campo = $_GET['sidx'];
    $ordem = $_GET['sord'];

    $where = " WHERE 1 = 1 ";

    if (isset($_REQUEST['pesquisar']) &&
        $_REQUEST['pesquisar'] != "") {

        $where .= " AND nome LIKE '%".$_REQUEST['pesquisar']."%' ";

    }

    // Total registros
    $sql = "SELECT COUNT(id_usuario) as totalReg
            FROM usuarios
            $where";

    $rsTotal = $db->query($sql)->fetch();

    $totalReg = $rsTotal['totalReg'];

    if ($totalReg > 0) {

        $totalPag = ceil($totalReg / $linPorPag);

    } else {

        $totalPag = 0;

    }

    if ($pagina > $totalPag) {

        $pagina = $totalPag;

    }

    $start = $linPorPag * $pagina - $linPorPag;

    // Consulta
    $sql = "SELECT
                id_usuario,
                nome,
                email,
                telefone
            FROM usuarios

            $where

            ORDER BY $campo $ordem

            LIMIT $start, $linPorPag";

    $response = new stdClass();

    $response->page = $pagina;
    $response->total = $totalPag;
    $response->records = $totalReg;

    $i = 0;

    foreach($db->query($sql) as $row) {

        $response->rows[$i]['id_usuario'] =
            $row['id_usuario'];

        $response->rows[$i]['nome'] =
            $row['nome'];

        $response->rows[$i]['email'] =
            $row['email'];

        $response->rows[$i]['telefone'] =
            $row['telefone'];

        $i++;

    }

    echo json_encode($response);

}

?>