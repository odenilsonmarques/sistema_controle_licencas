<?php
    session_start();
    include_once 'config/connection.php';
   
    if(isset($_POST['email']) && empty($_POST['email']) == false){
        if(isset($_POST['password']) && empty($_POST['password']) == false){
            $email = addslashes($_POST['email']);
            $password = addslashes($_POST['password']);
    
            $searchUser = $connectionPDO->query("SELECT * FROM user WHERE email = '$email' AND password = '$password'");
            $searchUser->execute();
            if($searchUser->rowCount() > 0){
                //se vier algum dado, este vai ser pego e salvo na sessão
                $salveUser = $searchUser->fetch();//pegando o primeiro resultado, através da função fetch (nesse caso a variavel $saveUser ta vindo como um array com todos os dados do usuario encontrado)
                // print_r($salveUser);debugando o retorno do array 

                //salvando o ID do usuario na sessao
                $_SESSION['id_user'] = $salveUser['id_user'];
                $_SESSION['email'] = $salveUser['email'];
                $_SESSION['password'] = $salveUser['password'];
                header("Location:validateAcess.php");
                exit();
            }
        }  
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Login</title>
</head>
<body class="corBackground">
    <section>
        <div class="container">
            <div class="row mt-5">
                

                <div class="col-lg-6 offset-md-3">
                    <form action="" method="POST">
                        <div class="form-floating mb-3">
                            <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                            <label for="floatingInput">Email address</label>
                        </div>
                        <div class="form-floating">
                            <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
                            <label for="floatingPassword">Password</label>
                        </div>

                        <input type="submit" value="Entrar" class="btn btn-primary mt-4">
                    </form>
                </div>
            </div>
        </div>
    </section>
    <?php include_once 'footer.php'?>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>





