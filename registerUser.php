<?php
//declarando a funcao session para capturar so dados do usuario que tentar acessar essa pagina e verificar se tem akgum dado salvo que corresponde a esse usuario
session_start();
if(isset($_SESSION['email']) && empty($_SESSION['email']) == false){
    if(isset($_SESSION['password']) && empty($_SESSION['password'])== false){
    }
}else{
    //caso o usuario não esteja logado(ou seja, caso não tenha uma sessão ativa) este usuario deverá ser direcionado para pagina de login
    header("Location: login.php");
}
include_once 'config/connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Cadastro de Usuário</title>
</head>
<body>
    <?php include_once 'header.php'?>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-12-lg">
                    <h3  class="mt-5">Cadastro de Usuário</h3>
                    <form action="receiveUser.php" method="POST">
                        <div class="row mt-4 mb-4">
                            <div class="col-lg-4">
                                <label for="name" class="form-label">Nome</label>
                                <input type="text" name="name" id="name" class="form-control" maxlength="100"  required autofocus>  
                            </div>
                            <div class="col-lg-4">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" maxlength="100"  required>  
                            </div>
                            <div class="col-lg-4">
                                <label for="password" class="form-label">Senha</label>
                                <input type="password" name="password" class="form-control" maxlength="100"  required>  
                            </div>
                        </div>
                        </div class="row">
                            <div class="col-12-lg">
                                <a class="btn btn-danger mt-4" href="index.php">CANCELAR</a>
                                <input type="submit" value="CADASTRAR" class="btn btn-primary mt-4">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <?php include_once 'footer.php'?>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>