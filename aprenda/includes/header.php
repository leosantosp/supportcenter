<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Aprenda</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.ckeditor.com/4.20.0/standard/ckeditor.js"></script>
</head>
<body id="home-admin-panel">
    <input type="checkbox" id="check">
    <header>
        <div class="icon-menu">
            <label for="check">
                <ion-icon name="grid-outline" id="sidebar-btn"></ion-icon>
            </label>
        </div>
    </header>
    <div class="sidebar">
        <div class="center">
            <img class="image" src="../../assets/images/logo.svg" alt="">
            <h4><?php echo $infosessao['username'] ?></h4>
        </div>
        <a href="../home.php"><ion-icon name="desktop-outline"></ion-icon><span>Home</span></a> <!-- Home -->
        <a href="../logout.php"><ion-icon name="log-out-outline"></ion-icon> <span>Sair</span>    </a> <!-- Sair -->


    </div>

    <div class="content">