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
    <title>Inicio</title>
</head>
<body>
    <?php include_once 'header.php'?>
    <section>
        <div class="container">
            <div class="row mt-5">
                <div class="col-lg-4 text-center">
                    <div class="card text-white mb-3">
                        <div class="card-header"><strong>TOTAL DE EMPRESAS</strong></div>
                        <div class="card-body">
                            <?php
                                $seachCompanys = $connectionPDO->prepare("SELECT COUNT(id_company) as registers FROM company");
                                $seachCompanys->execute();
                                $rows = $seachCompanys->fetch(PDO::FETCH_ASSOC); 
                            ?>
                                <p><?php echo $rows['registers'];?></p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 text-center">
                    <div class="card text-white mb-3">
                        <div class="card-header"><strong>TOTAL DE LICENÇAS</strong></div>
                        <div class="card-body">
                            <?php
                                $seachCompanys = $connectionPDO->prepare("SELECT COUNT(id_license) as registers FROM license");
                                $seachCompanys->execute();
                                $rows = $seachCompanys->fetch(PDO::FETCH_ASSOC); 
                            ?>
                                <p><?php echo $rows['registers'];?></p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 text-center">
                    <div class="card text-white mb-3">
                        <div class="card-header"><strong>LICENCAS VENCENDO HOJE</strong></div>
                        <div class="card-body">
                            <?php
                                $listLicenses = [];
                                $searchLicensesCompanys = $connectionPDO->query("SELECT * FROM license WHERE CURRENT_DATE() = expiration_date");
                                if($searchLicensesCompanys->rowCount() > 0){
                                    $listLicenses = $searchLicensesCompanys->fetchAll(PDO::FETCH_ASSOC);
                                ?>
                                    <p><?= count($listLicenses)?></p>
                              <?php  }                                
                            ?> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php include_once 'footer.php'?>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>





