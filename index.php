<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Leitura Fácil</title>
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
                <a href="#dashboard" class="active"><i class="bi bi-grid-1x2-fill"></i> Dashboard</a>
                <a href="#usuarios"><i class="bi bi-people-fill"></i> Usuários</a>
                <a href="#livros"><i class="bi bi-book-fill"></i> Livros</a>
                <a href="#emprestimos"><i class="bi bi-arrow-left-right"></i> Empréstimos</a>
                <a href="historico.php"><i class="bi bi-clock-history"></i> Histórico</a>
            </nav>

            <div class="sidebar-footer">© 2026 Leitura Fácil</div>
        </div>

        <div class="col-md-10 content">

            <div class="topbar">
                <button class="topbar-toggle" onclick="toggleSidebar()"><i class="bi bi-list"></i></button>
                <strong>Leitura Fácil</strong>
                <span></span>
            </div>

            <section id="dashboard">
                <h2 class="page-title">Dashboard</h2>
                <p class="page-subtitle">Gerencie usuários, livros e empréstimos da biblioteca.</p>

                <div class="row mb-4 g-3">
                    <div class="col-md-4">
                        <div class="card stat-card">
                            <div class="card-body d-flex align-items-center gap-3">
                                <div class="stat-icon"><i class="bi bi-people-fill"></i></div>
                                <div>
                                    <h6>Usuários cadastrados</h6>
                                    <h2 id="totalUsuarios">0</h2>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card stat-card stat-books">
                            <div class="card-body d-flex align-items-center gap-3">
                                <div class="stat-icon"><i class="bi bi-book-fill"></i></div>
                                <div>
                                    <h6>Livros cadastrados</h6>
                                    <h2 id="totalLivros">0</h2>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card stat-card stat-loans">
                            <div class="card-body d-flex align-items-center gap-3">
                                <div class="stat-icon"><i class="bi bi-arrow-left-right"></i></div>
                                <div>
                                    <h6>Empréstimos registrados</h6>
                                    <h2 id="totalEmprestimos">0</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section id="usuarios" class="card section-card">
                <div class="card-header header-usuarios text-white">
                    <i class="bi bi-person-plus-fill"></i> Cadastro de Usuários
                </div>
                <div class="card-body">
                    <div class="row g-2">
                        <div class="col-md-4 mb-2">
                            <div class="form-floating">
                                <input class="form-control" id="nomeUsuario" placeholder="Nome do usuário">
                                <label for="nomeUsuario">Nome do usuário</label>
                            </div>
                        </div>
                        <div class="col-md-4 mb-2">
                            <div class="form-floating">
                                <input class="form-control" id="emailUsuario" placeholder="Email">
                                <label for="emailUsuario">Email</label>
                            </div>
                        </div>
                        <div class="col-md-4 mb-2">
                            <div class="form-floating">
                                <input class="form-control" id="telefoneUsuario" placeholder="Telefone">
                                <label for="telefoneUsuario">Telefone</label>
                            </div>
                        </div>
                    </div>

                    <button class="btn btn-primary mb-3" onclick="cadastrarUsuario()">
                        <i class="bi bi-plus-lg"></i> Cadastrar Usuário
                    </button>

                </div>
            </section>

            <section id="livros" class="card section-card">
                <div class="card-header header-livros text-white">
                    <i class="bi bi-journal-plus"></i> Cadastro de Livros
                </div>
                <div class="card-body">
                    <div class="row g-2">
                        <div class="col-md-3 mb-2">
                            <div class="form-floating">
                                <input class="form-control" id="tituloLivro" placeholder="Título">
                                <label for="tituloLivro">Título</label>
                            </div>
                        </div>
                        <div class="col-md-3 mb-2">
                            <div class="form-floating">
                                <input class="form-control" id="autorLivro" placeholder="Autor">
                                <label for="autorLivro">Autor</label>
                            </div>
                        </div>
                        <div class="col-md-3 mb-2">
                            <div class="form-floating">
                                <input class="form-control" id="categoriaLivro" placeholder="Categoria">
                                <label for="categoriaLivro">Categoria</label>
                            </div>
                        </div>
                        <div class="col-md-3 mb-2">
                            <div class="form-floating">
                                <input class="form-control" id="quantidadeLivro" type="number" placeholder="Quantidade">
                                <label for="quantidadeLivro">Quantidade</label>
                            </div>
                        </div>
                    </div>

                    <button class="btn btn-success mb-3" onclick="cadastrarLivro()">
                        <i class="bi bi-plus-lg"></i> Cadastrar Livro
                    </button>

                </div>
            </section>

            <section id="emprestimos" class="card section-card">
                <div class="card-header header-emprestimos">
                    <i class="bi bi-arrow-left-right"></i> Registro de Empréstimos
                </div>
                <div class="card-body">
                    <div class="row g-2">
                        <div class="col-md-3 mb-2">
                            <div class="form-floating">
                                <input class="form-control" list="listaUsuarios" id="usuarioEmprestimo" placeholder="Pesquisar usuário">
                                <label for="usuarioEmprestimo">Usuário</label>
                                <datalist id="listaUsuarios"></datalist>
                            </div>
                        </div>
                        <div class="col-md-3 mb-2">
                            <div class="form-floating">
                                <input class="form-control" list="listaLivros" id="livroEmprestimo" placeholder="Pesquisar livro">
                                <label for="livroEmprestimo">Livro</label>
                                <datalist id="listaLivros"></datalist>
                            </div>
                        </div>
                        <div class="col-md-2 mb-2">
                            <div class="form-floating">
                                <input class="form-control" id="dataEmprestimo" type="date">
                                <label for="dataEmprestimo">Empréstimo</label>
                            </div>
                        </div>
                        <div class="col-md-2 mb-2">
                            <div class="form-floating">
                                <input class="form-control" id="dataDevolucao" type="date">
                                <label for="dataDevolucao">Devolução</label>
                            </div>
                        </div>
                        <div class="col-md-2 mb-2">
                            <div class="form-floating">
                                <select class="form-select" id="statusEmprestimo">
                                    <option value="Emprestado">Emprestado</option>
                                    <option value="Devolvido">Devolvido</option>
                                </select>
                                <label for="statusEmprestimo">Status</label>
                            </div>
                        </div>
                    </div>

                    <button class="btn btn-warning mb-3" onclick="cadastrarEmprestimo()">
                        <i class="bi bi-plus-lg"></i> Registrar Empréstimo
                    </button>

                </div>
            </section>

            <footer>
                © 2026 Leitura Fácil — Sistema de Biblioteca desenvolvido para fins acadêmicos.
            </footer>

        </div>
    </div>
</div>

<script>
function carregarUsuarios() {
    fetch("usuarios/usuarioAction.php?acao=consultar&page=1&rows=100&sidx=id_usuario&sord=asc")
        .then(res => res.json())
        .then(data => {
            let lista = document.getElementById("listaUsuarios");
            lista.innerHTML = "";

            document.getElementById("totalUsuarios").innerText = data.records;

            data.rows.forEach(usuario => {
                lista.innerHTML += `
                    <option value="${usuario.id_usuario} - ${usuario.nome}"></option>
                `;
            });
        });
}

function carregarLivros() {
    fetch("livros/livroAction.php?acao=consultar&page=1&rows=100&sidx=id_livro&sord=asc")
        .then(res => res.json())
        .then(data => {
            let lista = document.getElementById("listaLivros");
            lista.innerHTML = "";

            document.getElementById("totalLivros").innerText = data.records;

            data.rows.forEach(livro => {
                lista.innerHTML += `
                    <option value="${livro.id_livro} - ${livro.titulo}"></option>
                `;
            });
        });
}

function carregarEmprestimos() {
    fetch("emprestimos/emprestimoAction.php?acao=consultar&page=1&rows=100&sidx=id_emprestimo&sord=asc")
        .then(res => res.json())
        .then(data => {
            document.getElementById("totalEmprestimos").innerText = data.records;
        });
}
function cadastrarUsuario() {
    let nome = document.getElementById("nomeUsuario").value;
    let email = document.getElementById("emailUsuario").value;
    let telefone = document.getElementById("telefoneUsuario").value;

    fetch(`usuarios/usuarioAction.php?acao=inserir&nome=${encodeURIComponent(nome)}&email=${encodeURIComponent(email)}&telefone=${encodeURIComponent(telefone)}`)
        .then(res => res.json())
        .then(data => {
            alert(data.retorno);
            document.getElementById("nomeUsuario").value = "";
            document.getElementById("emailUsuario").value = "";
            document.getElementById("telefoneUsuario").value = "";
            carregarUsuarios();
        });
}

function cadastrarLivro() {
    let titulo = document.getElementById("tituloLivro").value;
    let autor = document.getElementById("autorLivro").value;
    let categoria = document.getElementById("categoriaLivro").value;
    let quantidade = document.getElementById("quantidadeLivro").value;

    fetch(`livros/livroAction.php?acao=inserir&titulo=${encodeURIComponent(titulo)}&autor=${encodeURIComponent(autor)}&categoria=${encodeURIComponent(categoria)}&quantidade=${quantidade}`)
        .then(res => res.json())
        .then(data => {
            alert(data.retorno);
            document.getElementById("tituloLivro").value = "";
            document.getElementById("autorLivro").value = "";
            document.getElementById("categoriaLivro").value = "";
            document.getElementById("quantidadeLivro").value = "";
            carregarLivros();
        });
}

function cadastrarEmprestimo() {
    let id_usuario = document.getElementById("usuarioEmprestimo").value.split(" - ")[0];
    let id_livro = document.getElementById("livroEmprestimo").value.split(" - ")[0];
    let data_emprestimo = document.getElementById("dataEmprestimo").value;
    let data_devolucao = document.getElementById("dataDevolucao").value;
    let status = document.getElementById("statusEmprestimo").value;

    fetch(`emprestimos/emprestimoAction.php?acao=inserir&id_usuario=${id_usuario}&id_livro=${id_livro}&data_emprestimo=${data_emprestimo}&data_devolucao=${data_devolucao}&status=${status}`)
        .then(res => res.json())
        .then(data => {
            alert(data.retorno);
            document.getElementById("dataEmprestimo").value = "";
            document.getElementById("dataDevolucao").value = "";
            carregarEmprestimos();
        });
}

carregarUsuarios();
carregarLivros();
carregarEmprestimos();

function toggleSidebar() {
    document.getElementById("sidebar").classList.toggle("open");
    document.getElementById("sidebarBackdrop").classList.toggle("show");
}
</script>

</body>
</html>