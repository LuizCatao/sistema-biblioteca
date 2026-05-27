<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Histórico - Leitura Fácil</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>

        body {
            background: #f4f6f9;
        }

        .sidebar {
            min-height: 100vh;
            background: #0f172a;
            color: white;
            padding: 20px;
        }

        .sidebar img {
            width: 250px;
            margin-bottom: 1px;
        }

        .sidebar a {
            color: #cbd5e1;
            text-decoration: none;
            display: block;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 5px;
        }

        .sidebar a:hover {
            background: #1e293b;
            color: white;
        }

        .content {
            padding: 25px;
        }

        .section-card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            margin-bottom: 25px;
        }

        footer {
            margin-top: 40px;
            text-align: center;
            color: #64748b;
            font-size: 14px;
        }

    </style>

</head>

<body>

<div class="container-fluid">

    <div class="row">

        <div class="col-md-2 sidebar">

            <div class="text-center mb-4">
                <img src="img/logo.png" alt="Logo">
                <h4>Leitura Fácil</h4>
                <small>Sistema de Biblioteca</small>
            </div>

            <a href="index.php">Dashboard</a>
            <a href="index.php#usuarios">Usuários</a>
            <a href="index.php#livros">Livros</a>
            <a href="index.php#emprestimos">Empréstimos</a>
            <a href="historico.php">Histórico</a>

        </div>

        <div class="col-md-10 content">

            <h2 class="mb-4">Histórico de Registros</h2>

            <!-- USUÁRIOS -->

            <section class="card section-card">

                <div class="card-header bg-primary text-white">
                    Usuários Cadastrados
                </div>

                <div class="card-body">

                    <table class="table table-striped table-hover">

                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>Telefone</th>
                                <th>Ações</th>
                            </tr>
                        </thead>

                        <tbody id="tabelaUsuarios"></tbody>

                    </table>

                </div>

            </section>


            <!-- LIVROS -->

            <section class="card section-card">

                <div class="card-header bg-success text-white">
                    Livros Cadastrados
                </div>

                <div class="card-body">

                    <table class="table table-striped table-hover">

                        <thead class="table-dark">
                           <tr>
                                <th>ID</th>
                                <th>Título</th>
                                <th>Autor</th>
                                <th>Categoria</th>
                                <th>Quantidade</th>
                                <th>Ações</th>
                            </tr>
                        </thead>

                        <tbody id="tabelaLivros"></tbody>

                    </table>

                </div>

            </section>


            <!-- EMPRÉSTIMOS -->

            <section class="card section-card">

                <div class="card-header bg-warning">
                    Empréstimos Registrados
                </div>

                <div class="card-body">

                    <table class="table table-striped table-hover">

                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Usuário</th>
                                <th>Livro</th>
                                <th>Data Empréstimo</th>
                                <th>Data Devolução</th>
                                <th>Status</th>
                                <th>Ações</th>
                            </tr>
                        </thead>

                        <tbody id="tabelaEmprestimos"></tbody>

                    </table>

                </div>

            </section>

            <footer>
                © 2026 Leitura Fácil — Sistema de Biblioteca
            </footer>

        </div>

    </div>

</div>

<script>

function carregarUsuarios() {

    fetch("usuarios/usuarioAction.php?acao=consultar&page=1&rows=100&sidx=id_usuario&sord=asc")

        .then(res => res.json())

        .then(data => {

            let tabela = document.getElementById("tabelaUsuarios");

            tabela.innerHTML = "";

            data.rows.forEach(usuario => {

                tabela.innerHTML += `

                    <tr>
                        <td>${usuario.id_usuario}</td>
                        <td>${usuario.nome}</td>
                        <td>${usuario.email}</td>
                        <td>${usuario.telefone}</td>

                        <td>
                            <button class="btn btn-danger btn-sm"
                                onclick="excluirUsuario(${usuario.id_usuario})">
                                Excluir
                            </button>
                        </td>
                    </tr>

                `;

            });

        });

}


function carregarLivros() {

    fetch("livros/livroAction.php?acao=consultar&page=1&rows=100&sidx=id_livro&sord=asc")

        .then(res => res.json())

        .then(data => {

            let tabela = document.getElementById("tabelaLivros");

            tabela.innerHTML = "";

            data.rows.forEach(livro => {

                tabela.innerHTML += `

                    <tr>
                        <td>${livro.id_livro}</td>
                        <td>${livro.titulo}</td>
                        <td>${livro.autor}</td>
                        <td>${livro.categoria}</td>
                        <td>${livro.quantidade}</td>
                        <td>

                            <button class="btn btn-danger btn-sm"
                                onclick="alterarQuantidade(${livro.id_livro}, ${livro.quantidade - 1})">
                                -
                            </button>

                            <button class="btn btn-success btn-sm"
                                onclick="alterarQuantidade(${livro.id_livro}, ${livro.quantidade + 1})">
                                +
                            </button>

                            <button class="btn btn-dark btn-sm"
                                onclick="excluirLivro(${livro.id_livro})">
                                Excluir
                            </button>

                        </td>
                    </tr>

                `;

            });

        });

}


function carregarEmprestimos() {

    fetch("emprestimos/emprestimoAction.php?acao=consultar&page=1&rows=100&sidx=id_emprestimo&sord=asc")

        .then(res => res.json())

        .then(data => {

            let tabela = document.getElementById("tabelaEmprestimos");

            tabela.innerHTML = "";

            data.rows.forEach(emp => {

                let novoStatus = emp.status == "Emprestado"
                    ? "Devolvido"
                    : "Emprestado";

                let textoBotao = emp.status == "Emprestado"
                    ? "Marcar como Devolvido"
                    : "Marcar como Emprestado";

                let corBotao = emp.status == "Emprestado"
                    ? "btn-success"
                    : "btn-warning";

                tabela.innerHTML += `

                    <tr>
                        <td>${emp.id_emprestimo}</td>
                        <td>${emp.nome}</td>
                        <td>${emp.titulo}</td>
                        <td>${emp.data_emprestimo}</td>
                        <td>${emp.data_devolucao}</td>
                        <td>${emp.status}</td>

                        <td>
                            <button class="btn ${corBotao} btn-sm"
                                onclick="alterarStatusEmprestimo(${emp.id_emprestimo}, '${novoStatus}')">

                                ${textoBotao}

                            </button>
                        </td>
                    </tr>

                `;

            });

        });

}

carregarUsuarios();
carregarLivros();
carregarEmprestimos();

function excluirUsuario(id) {

    if(confirm("Deseja excluir este usuário?")) {

        fetch(`usuarios/usuarioAction.php?acao=excluir&id_usuario=${id}`)

            .then(res => res.json())

            .then(data => {

                alert(data.retorno);

                carregarUsuarios();

            });

    }

}

function alterarQuantidade(id_livro, novaQuantidade) {

    if (novaQuantidade < 0) {
        alert("A quantidade não pode ser menor que zero!");
        return;
    }

    fetch(`livros/livroAction.php?acao=alterarQuantidade&id_livro=${id_livro}&quantidade=${novaQuantidade}`)
        .then(res => res.json())
        .then(data => {
            carregarLivros();
        });
}

function excluirLivro(id) {

    if(confirm("Deseja excluir este livro?")) {

        fetch(`livros/livroAction.php?acao=excluir&id_livro=${id}`)

            .then(res => res.json())

            .then(data => {

                alert(data.retorno);

                carregarLivros();

            });

    }

}

function alterarStatusEmprestimo(id, status) {

    fetch(`emprestimos/emprestimoAction.php?acao=alterarStatus&id_emprestimo=${id}&status=${status}`)
        .then(res => res.json())
        .then(data => {
            alert(data.retorno);
            carregarEmprestimos();
        });
}

</script>

</body>
</html>