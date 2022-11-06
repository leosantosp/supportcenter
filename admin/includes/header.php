<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CENTRAL DE SUPORTE | Cadastro de Colaboradores</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>
<body>
<h1>Bem vindo, <?php echo $dados['username']; ?>!</h1>

<nav class="admin-nav">
    <ul class="admin-nav-list">
        <li class="admin-nav-item"><a href="users-list.php">Usuários</a></li>
        <li class="admin-nav-item"><a href="colab-list.php">Colaboradores</a></li>
        <li class="admin-nav-item"><a href="catend-list.php">Catálogo de Endereços</a></li>
        <li class="admin-nav-item"><a href="#">Reserva de Salas</a></li>
        <li class="admin-nav-item"><a href="#">Unidades</a></li>
        <li class="admin-nav-item"><a href="#">Tutoriais</a></li>
        <li class="admin-nav-item"><a href="#">Erros do Sintra</a></li>
        <li class="admin-nav-item"><a href="#">Ouvidoria</a></li>
        <li class="admin-nav-item">
            <a href="../logout.php">
                <button class="btn btn-secondary">LOGOUT</button>
            </a>
        </li>
    </ul>
</nav>