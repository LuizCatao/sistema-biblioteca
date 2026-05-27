<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Leitura Fácil</title>
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

        .card-dashboard {
            border: none;
            border-radius: 16px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
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

            <a href="#dashboard">Dashboard</a>
            <a href="#usuarios">Usuários</a>
            <a href="#livros">Livros</a>
            <a href="#emprestimos">Empréstimos</a>
            <a href="historico.php">Histórico</a>
        </div>

        <div class="col-md-10 content">

            <section id="dashboard">
                <h2 class="mb-1">Dashboard</h2>
                <p class="text-muted">Gerencie usuários, livros e empréstimos da biblioteca.</p>

                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="card card-dashboard">
                            <div class="card-body">
                                <h6 class="text-muted">Usuários cadastrados</h6>
                                <h2 id="totalUsuarios">0</h2>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card card-dashboard">
                            <div class="card-body">
                                <h6 class="text-muted">Livros cadastrados</h6>
                                <h2 id="totalLivros">0</h2>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card card-dashboard">
                            <div class="card-body">
                                <h6 class="text-muted">Empréstimos registrados</h6>
                                <h2 id="totalEmprestimos">0</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section id="usuarios" class="card section-card">
                <div class="card-header bg-primary text-white">
                    Cadastro de Usuários
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 mb-2">
                            <input class="form-control" id="nomeUsuario" placeholder="Nome do usuário">
                        </div>
                        <div class="col-md-4 mb-2">
                            <input class="form-control" id="emailUsuario" placeholder="Email">
                        </div>
                        <div class="col-md-4 mb-2">
                            <input class="form-control" id="telefoneUsuario" placeholder="Telefone">
                        </div>
                    </div>

                    <button class="btn btn-primary mb-3" onclick="cadastrarUsuario()">Cadastrar Usuário</button>

                </div>
            </section>

            <section id="livros" class="card section-card">
                <div class="card-header bg-success text-white">
                    Cadastro de Livros
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 mb-2">
                            <input class="form-control" id="tituloLivro" placeholder="Título">
                        </div>
                        <div class="col-md-3 mb-2">
                            <input class="form-control" id="autorLivro" placeholder="Autor">
                        </div>
                        <div class="col-md-3 mb-2">
                            <input class="form-control" id="categoriaLivro" placeholder="Categoria">
                        </div>
                        <div class="col-md-3 mb-2">
                            <input class="form-control" id="quantidadeLivro" type="number" placeholder="Quantidade">
                        </div>
                    </div>

                    <button class="btn btn-success mb-3" onclick="cadastrarLivro()">Cadastrar Livro</button>

                </div>
            </section>

            <section id="emprestimos" class="card section-card">
                <div class="card-header bg-warning">
                    Registro de Empréstimos
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 mb-2">
                            <input class="form-control" list="listaUsuarios" id="usuarioEmprestimo" placeholder="Pesquisar usuário">
                            <datalist id="listaUsuarios"></datalist>
                        </div>
                        <div class="col-md-3 mb-2">
                            <input class="form-control" list="listaLivros" id="livroEmprestimo" placeholder="Pesquisar livro">
                            <datalist id="listaLivros"></datalist>
                        </div>
                        <div class="col-md-2 mb-2">
                            <input class="form-control" id="dataEmprestimo" type="date">
                        </div>
                        <div class="col-md-2 mb-2">
                            <input class="form-control" id="dataDevolucao" type="date">
                        </div>
                        <div class="col-md-2 mb-2">
                            <select class="form-control" id="statusEmprestimo">
                                <option value="Emprestado">Emprestado</option>
                                <option value="Devolvido">Devolvido</option>
                            </select>
                        </div>
                    </div>

                    <button class="btn btn-warning mb-3" onclick="cadastrarEmprestimo()">Registrar Empréstimo</button>

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
</script>

</body>
</html>