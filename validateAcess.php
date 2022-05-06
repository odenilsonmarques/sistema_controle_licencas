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

?>

<a href="logout.php">SAIR</a>