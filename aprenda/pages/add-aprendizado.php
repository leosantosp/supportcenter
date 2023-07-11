<?php 

    /**
     * Realizando o require_once com o arquivo para acesso ao banco de dados
     */
    require_once '../php_action/db_connect.php';

    /**
     * Iniciando a sessão
     */
    session_start();

    /**
     * Verificação
     */

    if(!isset($_SESSION['logado'])):
        header('Location: index.php');    
    endif;

    /**
     * Captura de dados da sessão
     */

    $id = $_SESSION['id_usuario'];
    $sql = "SELECT * FROM usuarios WHERE id = '$id'";

    $resultado = mysqli_query($connect, $sql);

    $dados = mysqli_fetch_array($resultado);
    /**
     * Fez uma consulta, apresentou os dados, feche a conexão
     */ 

?>

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
            <h4><?php echo $dados['username'] ?></h4>
        </div>
        <a href="../home.php"><ion-icon name="desktop-outline"></ion-icon><span>Home</span></a> <!-- Home -->
        <a href="list-aprendizado.php"><ion-icon name="file-tray-full-outline"></ion-icon><span>Editar aprendizados</span></a> <!-- Aprenda -->
        <a href="../logout.php"><ion-icon name="log-out-outline"></ion-icon> <span>Sair</span>    </a> <!-- Sair -->


    </div>

    <div class="content">
        <h3>Bem vindo, <strong> <?php echo $dados['username']; ?></strong></h3>
        <p>Este é o Aprenda da Central de Suporte</p>
        <p>Utilize o painel na lateral esquerda para verificar as opções que você tem liberado.</p> 



        <?php 
            if(isset($_SESSION['mensagem'])){
                echo $_SESSION['mensagem'];
                unset($_SESSION['mensagem']);
            }

        ?>


       <div class="container">
        <div class="row">
        <h4 class="title-learning">NOVO APRENDIZADO</h4>

        <form action="../php_action/create-aprendizado.php" method="POST" enctype="multipart/form-data">
            
            <div class="form-group" style="margin-top:16px">
                <label for="title">Título</label>
                <input class="form-control" type="text" name="title" id="title">
            </div>
    
            <div class="form-group" style="margin-top:16px">
                <label for="description">Descreva sobre o que seu procedimento se trata</label>
                <input class="form-control" type="text" name="description" id="description">
            </div>
                
            <div class="form-group" style="margin-top:16px">
    
                <label for="class">Selecione para qual setor o seu procedimento será publicado</label>
    
                <select class="form-control" type="text" name="class" id="class">
                    <option value="geral">Geral</option>
                    <option value="com"<?php if($dados['profile'] == 'com' || $dados['profile'] == 'ti'){ echo ''; } else { echo 'hidden'; } ?>>Comercial</option>
                    <option value="sac" <?php if($dados['profile'] == 'sac' || $dados['profile'] == 'ti'){ echo ''; } else { echo 'hidden'; } ?> > SAC </option>
                    <option value="adm" <?php if($dados['profile'] == 'adm' || $dados['profile'] == 'ti'){ echo ''; } else {echo 'hidden';} ?> > Administrativo </option>
                    <option value="ctrl" <?php if($dados['profile'] == 'ctrl' || $dados['profile'] == 'ti'){ echo ''; } else {echo 'hidden';} ?> > Controladoria </option>
                    <option value="fin" <?php if($dados['profile'] == 'fin' || $dados['profile'] == 'ti'){ echo ''; } else {echo 'hidden';} ?> >Financeiro</option>
                    <option value="cob" <?php if($dados['profile'] == 'cob' || $dados['profile'] == 'ti'){ echo ''; } else {echo 'hidden';} ?> >Cobrança</option>
                    <option value="ope" <?php if($dados['profile'] == 'ope' || $dados['profile'] == 'ti'){ echo ''; } else {echo 'hidden';} ?> >Operacional</option>
                    <option value="ass" <?php if($dados['profile'] == 'ass' || $dados['profile'] == 'ti'){ echo ''; } else {echo 'hidden';} ?> >Assistência</option>
                    <option value="dp" <?php if($dados['profile'] == 'dp' || $dados['profile'] == 'ti'){ echo ''; } else {echo 'hidden';} ?> >Depto Pessoal</option>
                    <option value="rh" <?php if($dados['profile'] == 'rh' || $dados['profile'] == 'ti'){ echo ''; } else {echo 'hidden';} ?> >Recursos Humanos</option>
                    <option value="mnt" <?php if($dados['profile'] == 'mnt' || $dados['profile'] == 'ti'){ echo ''; } else {echo 'hidden';} ?> >Monitoria</option>
                    <option value="fro" <?php if($dados['profile'] == 'fro' || $dados['profile'] == 'ti'){ echo ''; } else {echo 'hidden';} ?> >Frota</option>
                    <option value="ti" <?php if($dados['profile'] !== 'ti'){ echo 'hidden'; } ?> >T.I</option>
                </select>
    
            </div>
    
            <div class="form-group" style="margin-top:16px">
                <label for="files">Extensões permitidas (.pdf, .docx, .xlsx, .csv, .xlsb, .xls, .txt, .rtf, .doc, .docm, .mp4)</label>
                <input class="form-control" type="file" name="files[]" id="files" multiple>
    
            </div>
                
            <input type="hidden" name="permission" id="permission" value="<?php echo $dados['permission']; ?>">
                
    
            <div class="form-group" style="margin-top:16px">
                <button class="btn-create" name="submit-form" type="submit">ENVIAR</button>
            </div>
    
            </form>
        </div>
       </div>


    </div>




    

    

<script src="assets/js/main.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>