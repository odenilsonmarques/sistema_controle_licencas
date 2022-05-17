<?php
    session_start();
    include_once 'config/connection.php';
   
    if(isset($_POST['email']) && empty($_POST['email']) == false){
        if(isset($_POST['password']) && empty($_POST['password']) == false){
            $email = addslashes($_POST['email']);
            $password = md5(addslashes($_POST['password']));
    
            $searchUser = $connectionPDO->query("SELECT * FROM user WHERE email = '$email' AND password = '$password'");
            $searchUser->execute();
            if($searchUser->rowCount() > 0){
                //se vier algum dado, este vai ser pego e salvo na sessão
                $salveUser = $searchUser->fetch();//pegando o primeiro resultado, através da função fetch (nesse caso a variavel $saveUser ta vindo como um array com todos os dados do usuario encontrado)
                // print_r($salveUser);debugando o retorno do array 

                //salvando o ID do usuario na sessao
                $_SESSION['id_user'] = $salveUser['id_user'];
                $_SESSION['name'] = $salveUser['name'];
                $_SESSION['email'] = $salveUser['email'];
                $_SESSION['password'] = $salveUser['password'];
                header("Location:index.php");
                exit();
            }else{
                $_SESSION['msg'] = "<div class='alert alert-danger' role='alert' style='color:#111'>E-MAIL E / OU SENHA INCORRETOS !</div>";
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
<body>
    <section>
        <div class="container">
            <div class="row login mt-5 text-center">
                <div class="col-md-4 offset-md-4">
                    <?php
                        if (isset($_SESSION['msg'])) {
                            echo ($_SESSION['msg']);
                            unset($_SESSION['msg']);
                        }
                    ?>
                </div>
            </div>
            <div class="row justify-content-center login mt-5">
                <div class="col-lg-4 mt-5">
                    <form action="" method="POST">
                        <div class="form-floating mb-3">
                            <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com" required>
                            <label for="floatingInput">Email</label>
                        </div>
                        <div class="form-floating">
                            <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password" required>
                            <label for="floatingPassword">Senha</label>
                        </div>
                        <input type="submit" value="Entrar" class="btn btn-light mt-4">
                    </form>
                </div>
                <div class="col-lg-4 mt-5 text">
                    <h3 class="textLogoStory mt-4">TGC</h3>
                    <p class="textDetails">Controle Ambiental</p> 
                    <p class="textDetails2 mt-5">Engenharia e Consultoria</p>
                </div>
            </div>
        </div>
    </section>
    <?php include_once 'footer.php'?>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>





