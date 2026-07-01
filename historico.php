<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Histórico - Leitura Fácil</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">

</head>

<body>

<div class="sidebar-backdrop" id="sidebarBackdrop" onclick="toggleSidebar()"></div>

<div class="container-fluid">

    <div class="row">

        <div class="col-md-2 sidebar" id="sidebar">

            <div class="sidebar-brand">
                <img src="img/logo.png" alt="Logo">
                <small>Sistema de Biblioteca</small>
            </div>

            <nav class="sidebar-nav">
                <a href="index.php"><i class="bi bi-grid-1x2-fill"></i> Dashboard</a>
                <a href="index.php#usuarios"><i class="bi bi-people-fill"></i> Usuários</a>
                <a href="index.php#livros"><i class="bi bi-book-fill"></i> Livros</a>
                <a href="index.php#emprestimos"><i class="bi bi-arrow-left-right"></i> Empréstimos</a>
                <a href="historico.php" class="active"><i class="bi bi-clock-history"></i> Histórico</a>
            </nav>

            <div class="sidebar-footer">© 2026 Leitura Fácil</div>

        </div>

        <div class="col-md-10 content">

            <div class="topbar">
                <button class="topbar-toggle" onclick="toggleSidebar()"><i class="bi bi-list"></i></button>
                <strong>Histórico</strong>
                <span></span>
            </div>

            <h2 class="page-title">Histórico de Registros</h2>
            <p class="page-subtitle">Consulte e gerencie tudo que já foi cadastrado.</p>

            <!-- USUÁRIOS -->

            <section class="card section-card">

                <div class="card-header header-usuarios text-white">
                    <i class="bi bi-people-fill"></i> Usuários Cadastrados
                </div>

                <div class="card-body p-0">

                    <table class="table table-striped table-hover mb-0">

                        <thead>
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

                <div class="card-header header-livros text-white">
                    <i class="bi bi-book-fill"></i> Livros Cadastrados
                </div>

                <div class="card-body p-0">

                    <table class="table table-striped table-hover mb-0">

                        <thead>
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

                <div class="card-header header-emprestimos">
                    <i class="bi bi-arrow-left-right"></i> Empréstimos Registrados
                </div>

                <div class="card-body p-0">

                    <table class="table table-striped table-hover mb-0">

                        <thead>
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

            if (data.rows.length === 0) {
                tabela.innerHTML = `
                    <tr><td colspan="5">
                        <div class="empty-state">
                            <i class="bi bi-people"></i>
                            Nenhum usuário cadastrado ainda.
                        </div>
                    </td></tr>
                `;
                return;
            }

            data.rows.forEach(usuario => {

                let inicial = usuario.nome ? usuario.nome.trim().charAt(0).toUpperCase() : "?";

                tabela.innerHTML += `

                    <tr>
                        <td>${usuario.id_usuario}</td>
                        <td><span class="avatar-circle">${inicial}</span>${usuario.nome}</td>
                        <td>${usuario.email}</td>
                        <td>${usuario.telefone}</td>

                        <td>
                            <button class="btn btn-danger btn-sm"
                                onclick="excluirUsuario(${usuario.id_usuario})">
                                <i class="bi bi-trash3"></i> Excluir
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

            if (data.rows.length === 0) {
                tabela.innerHTML = `
                    <tr><td colspan="6">
                        <div class="empty-state">
                            <i class="bi bi-book"></i>
                            Nenhum livro cadastrado ainda.
                        </div>
                    </td></tr>
                `;
                return;
            }

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
                                <i class="bi bi-dash"></i>
                            </button>

                            <button class="btn btn-success btn-sm"
                                onclick="alterarQuantidade(${livro.id_livro}, ${livro.quantidade + 1})">
                                <i class="bi bi-plus"></i>
                            </button>

                            <button class="btn btn-dark btn-sm"
                                onclick="excluirLivro(${livro.id_livro})">
                                <i class="bi bi-trash3"></i> Excluir
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

            if (data.rows.length === 0) {
                tabela.innerHTML = `
                    <tr><td colspan="7">
                        <div class="empty-state">
                            <i class="bi bi-arrow-left-right"></i>
                            Nenhum empréstimo registrado ainda.
                        </div>
                    </td></tr>
                `;
                return;
            }

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

                let badgeClasse = emp.status == "Emprestado"
                    ? "badge-emprestado"
                    : "badge-devolvido";

                let badgeIcone = emp.status == "Emprestado"
                    ? "bi-hourglass-split"
                    : "bi-check-circle-fill";

                tabela.innerHTML += `

                    <tr>
                        <td>${emp.id_emprestimo}</td>
                        <td>${emp.nome}</td>
                        <td>${emp.titulo}</td>
                        <td>${emp.data_emprestimo}</td>
                        <td>${emp.data_devolucao}</td>
                        <td><span class="badge-status ${badgeClasse}"><i class="bi ${badgeIcone}"></i> ${emp.status}</span></td>

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

function toggleSidebar() {
    document.getElementById("sidebar").classList.toggle("open");
    document.getElementById("sidebarBackdrop").classList.toggle("show");
}

</script>

</body>
</html>