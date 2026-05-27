<?php

// Conexão
include "../conexao.php";

// Captura ação
$acao = $_REQUEST['acao'];


// =====================================================
// INSERIR LIVRO
// =====================================================

if ($acao == "inserir") {

    $titulo = $_REQUEST['titulo'];
    $autor = $_REQUEST['autor'];
    $categoria = $_REQUEST['categoria'];
    $quantidade = $_REQUEST['quantidade'];

    // Validações
    if ($titulo == '') {

        echo json_encode(array(
            'retorno' => 'Título obrigatório!'
        ));

        exit;
    }

    if ($autor == '') {

        echo json_encode(array(
            'retorno' => 'Autor obrigatório!'
        ));

        exit;
    }

    // SQL
    $sql = "INSERT INTO livros (
                titulo,
                autor,
                categoria,
                quantidade
            )
            VALUES (
                '$titulo',
                '$autor',
                '$categoria',
                $quantidade
            )";

    // Execução
    try {

        $db->query($sql);

        echo json_encode(array(
            'retorno' => 'Livro cadastrado com sucesso!'
        ));

    } catch(PDOException $e) {

        echo json_encode(array(
            'retorno' => $e->getMessage()
        ));

    }

}


// =====================================================
// EXCLUIR LIVRO
// =====================================================

if ($acao == "excluir") {

    $id_livro = $_REQUEST['id_livro'];

    if ($id_livro == '') {

        echo json_encode(array(
            'retorno' => 'ID obrigatório!'
        ));

        exit;
    }

    $sql = "DELETE FROM livros
            WHERE id_livro = $id_livro";

    try {

        $db->query($sql);

        echo json_encode(array(
            'retorno' => 'Livro excluído com sucesso!'
        ));

    } catch(PDOException $e) {

        echo json_encode(array(
            'retorno' => $e->getMessage()
        ));

    }

}


// =====================================================
// EDITAR LIVRO
// =====================================================

if ($acao == "editar") {

    $id_livro = $_REQUEST['id_livro'];
    $titulo = $_REQUEST['titulo'];
    $autor = $_REQUEST['autor'];
    $categoria = $_REQUEST['categoria'];
    $quantidade = $_REQUEST['quantidade'];

    if ($id_livro == '') {

        echo json_encode(array(
            'retorno' => 'ID obrigatório!'
        ));

        exit;
    }

    $sql = "UPDATE livros SET

                titulo = '$titulo',
                autor = '$autor',
                categoria = '$categoria',
                quantidade = $quantidade

            WHERE id_livro = $id_livro";

    try {

        $db->query($sql);

        echo json_encode(array(
            'retorno' => 'Livro atualizado com sucesso!'
        ));

    } catch(PDOException $e) {

        echo json_encode(array(
            'retorno' => $e->getMessage()
        ));

    }

}

if ($acao == "alterarQuantidade") {

    $id_livro = $_REQUEST['id_livro'];
    $quantidade = $_REQUEST['quantidade'];

    if ($quantidade < 0) {
        echo json_encode(array(
            'retorno' => 'A quantidade não pode ser menor que zero!'
        ));
        exit;
    }

    $sql = "UPDATE livros SET quantidade = $quantidade WHERE id_livro = $id_livro";

    try {
        $db->query($sql);

        echo json_encode(array(
            'retorno' => 'Quantidade atualizada com sucesso!'
        ));

    } catch(PDOException $e) {
        echo json_encode(array(
            'retorno' => $e->getMessage()
        ));
    }
}

// =====================================================
// CONSULTAR LIVROS
// =====================================================

if ($acao == "consultar") {

    $pagina = $_GET['page'];
    $linPorPag = $_GET['rows'];
    $campo = $_GET['sidx'];
    $ordem = $_GET['sord'];

    $where = " WHERE 1 = 1 ";

    if (isset($_REQUEST['pesquisar']) &&
        $_REQUEST['pesquisar'] != "") {

        $where .= " AND titulo LIKE '%".$_REQUEST['pesquisar']."%' ";

    }

    // Total registros
    $sql = "SELECT COUNT(id_livro) as totalReg
            FROM livros
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
                id_livro,
                titulo,
                autor,
                categoria,
                quantidade
            FROM livros

            $where

            ORDER BY $campo $ordem

            LIMIT $start, $linPorPag";

    $response = new stdClass();

    $response->page = $pagina;
    $response->total = $totalPag;
    $response->records = $totalReg;

    $i = 0;

    foreach($db->query($sql) as $row) {

        $response->rows[$i]['id_livro'] =
            $row['id_livro'];

        $response->rows[$i]['titulo'] =
            $row['titulo'];

        $response->rows[$i]['autor'] =
            $row['autor'];

        $response->rows[$i]['categoria'] =
            $row['categoria'];

        $response->rows[$i]['quantidade'] =
            $row['quantidade'];

        $i++;

    }

    echo json_encode($response);

}

?>