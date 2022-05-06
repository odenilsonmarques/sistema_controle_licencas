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
<header>
    <nav class="navbar navbar-expand-sm navbar-dark" style="background-color:#064635">
        <div class="container">
            <a class="navbar-brand" href="index.php">CTRL - LICENÇAS</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <nav class="collapse navbar-collapse justify-content-end" id="collapsibleNavbar">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">INÍCIO</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="listCompany.php">EMPRESAS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="listLicense.php">LICENÇAS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="registerCompany.php">NOVA EMPRESA</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="registerLicense.php">NOVA LICENÇA</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false"><?php echo 'Olá ' .$_SESSION['name'] ?></a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="logout.php" ><?php echo $_SESSION['email'] ?></a></li>
                            <li><a class="dropdown-item" href="logout.php" >SAIR</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </nav>
</header>
    
    