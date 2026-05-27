<?php

// Conexão com o banco
include "../conexao.php";

// Captura a ação
$acao = $_REQUEST['acao'];

// =====================================================
// INSERIR EMPRÉSTIMO
// =====================================================

if ($acao == "inserir") {

    // Captura dos dados
    $id_usuario      = $_REQUEST['id_usuario'];
    $id_livro        = $_REQUEST['id_livro'];
    $data_emprestimo = $_REQUEST['data_emprestimo'];
    $data_devolucao  = $_REQUEST['data_devolucao'];
    $status          = $_REQUEST['status'];

    // Validações
    if ($id_usuario == '') {

        echo json_encode(array(
            'retorno' => 'Usuário obrigatório!'
        ));

        exit;
    }

    if ($id_livro == '') {

        echo json_encode(array(
            'retorno' => 'Livro obrigatório!'
        ));

        exit;
    }

    if ($data_emprestimo == '') {

        echo json_encode(array(
            'retorno' => 'Data do empréstimo obrigatória!'
        ));

        exit;
    }

    if ($status == '') {

        echo json_encode(array(
            'retorno' => 'Status obrigatório!'
        ));

        exit;
    }

    // SQL
    $sql = "INSERT INTO emprestimos (
                id_usuario,
                id_livro,
                data_emprestimo,
                data_devolucao,
                status
            )
            VALUES (
                $id_usuario,
                $id_livro,
                '$data_emprestimo',
                '$data_devolucao',
                '$status'
            )";

    // Execução
    try {

        $db->query($sql);

        echo json_encode(array(
            'retorno' => 'Empréstimo cadastrado com sucesso!'
        ));

    } catch(PDOException $e) {

        echo json_encode(array(
            'retorno' => $e->getMessage()
        ));

    }

}

// =====================================================
// EXCLUIR EMPRÉSTIMO
// =====================================================

if ($acao == "excluir") {

    // Captura o ID
    $id_emprestimo = $_REQUEST['id_emprestimo'];

    // Validação
    if ($id_emprestimo == '') {

        echo json_encode(array(
            'retorno' => 'ID do empréstimo obrigatório!'
        ));

        exit;
    }

    // SQL
    $sql = "DELETE FROM emprestimos
            WHERE id_emprestimo = $id_emprestimo";

    // Execução
    try {

        $db->query($sql);

        echo json_encode(array(
            'retorno' => 'Empréstimo excluído com sucesso!'
        ));

    } catch(PDOException $e) {

        echo json_encode(array(
            'retorno' => $e->getMessage()
        ));

    }

}

// =====================================================
// EDITAR EMPRÉSTIMO
// =====================================================

if ($acao == "editar") {

    // Captura dos dados
    $id_emprestimo   = $_REQUEST['id_emprestimo'];
    $id_usuario      = $_REQUEST['id_usuario'];
    $id_livro        = $_REQUEST['id_livro'];
    $data_emprestimo = $_REQUEST['data_emprestimo'];
    $data_devolucao  = $_REQUEST['data_devolucao'];
    $status          = $_REQUEST['status'];

    // Validações
    if ($id_emprestimo == '') {

        echo json_encode(array(
            'retorno' => 'ID do empréstimo obrigatório!'
        ));

        exit;
    }

    if ($id_usuario == '') {

        echo json_encode(array(
            'retorno' => 'Usuário obrigatório!'
        ));

        exit;
    }

    if ($id_livro == '') {

        echo json_encode(array(
            'retorno' => 'Livro obrigatório!'
        ));

        exit;
    }

    // SQL
    $sql = "UPDATE emprestimos SET

                id_usuario = $id_usuario,
                id_livro = $id_livro,
                data_emprestimo = '$data_emprestimo',
                data_devolucao = '$data_devolucao',
                status = '$status'

            WHERE id_emprestimo = $id_emprestimo";

    // Execução
    try {

        $db->query($sql);

        echo json_encode(array(
            'retorno' => 'Empréstimo atualizado com sucesso!'
        ));

    } catch(PDOException $e) {

        echo json_encode(array(
            'retorno' => $e->getMessage()
        ));

    }

}

if ($acao == "alterarStatus") {

    $id_emprestimo = $_REQUEST['id_emprestimo'];
    $status = $_REQUEST['status'];

    $sql = "UPDATE emprestimos
            SET status = '$status'
            WHERE id_emprestimo = $id_emprestimo";

    try {
        $db->query($sql);

        echo json_encode(array(
            'retorno' => 'Status atualizado com sucesso!'
        ));

    } catch(PDOException $e) {
        echo json_encode(array(
            'retorno' => $e->getMessage()
        ));
    }
}

// =====================================================
// CONSULTAR EMPRÉSTIMOS
// =====================================================

if ($acao == "consultar") {

    // Parâmetros
    $pagina    = $_GET['page'];
    $linPorPag = $_GET['rows'];
    $campo     = $_GET['sidx'];
    $ordem     = $_GET['sord'];

    $where = " WHERE 1 = 1 ";

    // Filtro
    if (isset($_REQUEST['pesquisar']) && $_REQUEST['pesquisar'] != "") {

        $where .= " AND status LIKE '%".$_REQUEST['pesquisar']."%' ";

    }

    // Total de registros
    $sql = "SELECT COUNT(id_emprestimo) as totalReg
            FROM emprestimos
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

    // Consulta principal
    $sql = "SELECT
                emprestimos.id_emprestimo,
                usuarios.nome,
                livros.titulo,
                emprestimos.data_emprestimo,
                emprestimos.data_devolucao,
                emprestimos.status
            FROM emprestimos

            INNER JOIN usuarios
                ON emprestimos.id_usuario = usuarios.id_usuario

            INNER JOIN livros
                ON emprestimos.id_livro = livros.id_livro

            $where

            ORDER BY $campo $ordem

            LIMIT $start, $linPorPag";

    $response = new stdClass();

    $response->page = $pagina;
    $response->total = $totalPag;
    $response->records = $totalReg;

    $i = 0;

    foreach($db->query($sql) as $row) {

        $response->rows[$i]['id_emprestimo'] = $row['id_emprestimo'];
        $response->rows[$i]['nome'] = $row['nome'];
        $response->rows[$i]['titulo'] = $row['titulo'];
        $response->rows[$i]['data_emprestimo'] = $row['data_emprestimo'];
        $response->rows[$i]['data_devolucao'] = $row['data_devolucao'];
        $response->rows[$i]['status'] = $row['status'];

        $i++;

    }

    echo json_encode($response);

}

?>