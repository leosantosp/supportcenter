<?php 

    // Realizando conexão com o banco de dados
    include '../php_action/db_connect.php';

    session_start(); // Iniciando a sessão

    // Verificando se existe a sessão 'logado'
    if(!isset($_SESSION['logado'])):
        header('Location: index.php');
    endif;

    // Captura de Dados da sessão Logado

    $id = $_SESSION['id_usuario']; // Atribuindo o id da sessão id_usuario a variável id
    $sql = "SELECT * FROM usuarios WHERE id = '$id'"; // Montando a query SQL

    $resultado = mysqli_query($connect, $sql); // Executando a query
    $infosessao = mysqli_fetch_array($resultado);

    include_once '../includes/header.php';

    // Se for passado alguma id via URL, execute a função
    if(isset($_GET['id'])){

        $id = mysqli_escape_string($connect, $_GET['id']);
        $sql = "SELECT * FROM tutoriais WHERE id = '$id'";

        $resultado = mysqli_query($connect, $sql);
        $dados = mysqli_fetch_array($resultado);
    }

?>

<div class="row no-gutters mt-4">
        <div class="col-12 col-md-8 offset-md-2">
            <h3 class="text-center">Editar Tutorial</h3>
            <p>Os arquivos aqui inseridos serão sobrepostos aos que já foram subidos ao banco. Caso queira subir apenas um novo arquivo, recomendado que suba todos novamente.</p>
            <form action="../php_action/update-aprendizado.php" method="POST" enctype="multipart/form-data">
                <input name="id" type="hidden" value="<?php echo $dados['id'] ?>">
                <div class="form-group">
                    <label for="title">Nome</label>
                    <input class="form-control" type="text" name="title" id="title" value="<?php echo $dados['title'] ?>">
                </div>
                
                <div class="form-group">
                    <label for="description">Descrição</label>
                    <input class="form-control" type="text" name="description" id="description" value="<?php echo $dados['description'] ?>">
                </div>

                <div class="form-group" style="margin-top:16px">
    
                    <label for="class">Selecione para qual setor o seu procedimento será publicado</label>
        
                    <select class="form-control" type="text" name="class" id="class">
                        <option value="geral">Geral</option>
                        <option value="sac" <?php if($infosessao['profile'] !== 'sac'){ echo 'hidden'; } elseif($infosessao['profile'] == "sac"){ echo 'selected';} ?> > SAC </option>
                        <option value="adm" <?php if($infosessao['profile'] !== 'adm'){ echo 'hidden'; } elseif($infosessao['profile'] == "adm"){ echo 'selected'; } ?> > Administrativo </option>
                        <option value="con" <?php if($infosessao['profile'] !== 'ctrl'){ echo 'hidden'; } elseif($infosessao['profile'] == "ctrl"){ echo 'selected'; } ?> > Controladoria </option>
                        <option value="fin" <?php if($infosessao['profile'] !== 'fin'){ echo 'hidden'; } elseif($infosessao['profile'] == "fin"){ echo 'selected'; } ?> >Financeiro</option>
                        <option value="cob" <?php if($infosessao['profile'] !== 'cob'){ echo 'hidden'; } elseif($infosessao['profile'] == "cob"){ echo 'selected'; } ?> >Cobrança</option>
                        <option value="ope" <?php if($infosessao['profile'] !== 'ope'){ echo 'hidden'; } elseif($infosessao['profile'] == "ope"){ echo 'selected'; } ?> >Operacional</option>
                        <option value="ass" <?php if($infosessao['profile'] !== 'ass'){ echo 'hidden'; } elseif($infosessao['profile'] == "ass"){ echo 'selected'; } ?> >Assistência</option>
                        <option value="dp" <?php if($infosessao['profile'] !== 'dp'){ echo 'hidden'; } elseif($infosessao['profile'] == "dp"){ echo 'selected'; } ?> >Depto Pessoal</option>
                        <option value="rh" <?php if($infosessao['profile'] !== 'rh'){ echo 'hidden'; } elseif($infosessao['profile'] == "rh"){ echo 'selected'; } ?> >Recursos Humanos</option>
                        <option value="mnt" <?php if($infosessao['profile'] !== 'mnt'){ echo 'hidden'; } elseif($infosessao['profile'] == ""){ echo 'selected'; } ?> >Monitoria</option>
                        <option value="fro" <?php if($infosessao['profile'] !== 'fro'){ echo 'hidden'; } elseif($infosessao['profile'] == "fro"){ echo 'selected'; } ?> >Frota</option>
                        <option value="ti" <?php if($infosessao['profile'] !== 'ti'){ echo 'hidden'; } elseif($infosessao['profile'] == "ti"){ echo 'selected'; } ?> >T.I</option>
                    </select>
    
                </div>

                <div class="form-group">
                    <label for="files">Arquivos: <?php echo $dados['file'] ?></label>
                    <input type="file" multiple id="files" name="files[]" class="form-control">
                </div>

                <input type="hidden" name="permission" id="permission" class="form-control" hidden value="<?php echo $infosessao['permission'] ?>">

                <div class="form-group mt-3">
                    <button type="submit" name="btn-atualizar" class="btn btn-success">ATUALIZAR</button>
                    <a href="list-aprendizado.php" class="btn btn-primary">VOLTAR</a>
                </div>
            </form>

            <br>
        </div>
    </div>


<?php 
    include_once '../includes/footer.php';  
?>