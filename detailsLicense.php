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
    <title>Document</title>
</head>
<body>
    <?php include_once 'header.php'?>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <?php
                        $listLicenses = [];
                        $id = filter_input(INPUT_GET, 'id_license');//recebendo o id_license, caso nada ou um valor diferente for recebido(ou seja passado na url)é exibio uma pagina vazia
                        $searchLicensesCompanys = $connectionPDO->query("SELECT company.id_company, company.nameCompany, company.nameRepresentative ,license.id_license, license.type_license, license.expiration_date, license.insert_date ,license.activity, license.organ FROM license, company  WHERE license.id_company = company.id_company AND id_license = $id");
                        if($searchLicensesCompanys->rowCount() > 0){
                            $listLicenses = $searchLicensesCompanys->fetch(PDO::FETCH_ASSOC);?>
                            <div class="row format-text">
                                <h2 class="text-left mt-5 mb-4">DADOS DA LICENÇA</h2>
                                <div class="col-lg-4">
                                    <p><strong>PESSOA JURÍDICA / FÍSICA</strong><br><?=$listLicenses['nameCompany'];?></p>
                                    <p><strong>NOME DO REPRESENTANTE</strong><br><?=$listLicenses['nameRepresentative'];?></p>
                                    <p><strong>DESCRIÇÃO DA ATIVIDADE</strong><br><?=$listLicenses['activity'];?></p>
                                </div>
                                
                                <div class="col-lg-4">
                                    <p><strong>TIPO DE LICENÇA</strong><br><?=$listLicenses['type_license'];?></p>
                                    <p><strong>DATA DE VALIDADE</strong><br><?=date('d/m/Y', strtotime($listLicenses['expiration_date']));?></p>
                                    
                                    <p><strong>DATA DO CADASTRO</strong><br><?=date('d/m/Y', strtotime($listLicenses['insert_date']));?></p>
                                    
                                </div>

                                <div class="col-lg-4">
                                    <p><strong>ORGÃO</strong><br><?=($listLicenses['organ']);?></p>
                                    <p><strong>STATUS DA LICENÇA</strong><br>
                                        <?php

                                            //capturando os dias de validade das licenças                                          
                                            $expirationDate = strtotime($listLicenses['expiration_date']);
                                            $typeLicense = $listLicenses['type_license'];
                                            $days=ceil(($expirationDate-time())/60/60/24);
                                            
                                            if($days >= 30 && $listLicenses['type_license'] == 'LICENÇA CORPO DE BOMBEIRO'){?>
                                               <span class="status-licenca-dentro-do-prazo">DENTRO DO PRAZO</span> 
                                            <?php }elseif($days > 1 && $days <= 30  && $listLicenses['type_license'] == 'LICENÇA CORPO DE BOMBEIRO'){?>
                                                <span class="status-licenca-atencao-prazo">ATENÇÃO PRAZO</span> 
                                            <?php }elseif($days < 1 && $listLicenses['type_license'] == 'LICENÇA CORPO DE BOMBEIRO'){?>
                                                <span class="status-licenca-prazo-vencido">VENCIDA</span> 
                                            <?php }elseif($days <= 120){ ?>
                                                <span class="status-licenca-prazo-vencido">VENCIDA</span> 
                                            <?php }elseif($days > 120 && $days <= 140 ){?>
                                                <span class="status-licenca-atencao-prazo">ATENÇÃO PRAZO</span> 
                                            <?php } elseif($days > 140 ){?>
                                                <span class="status-licenca-dentro-do-prazo">DENTRO DO PRAZO</span> 
                                            <?php }
                                        ?>
                                    </p>
                                </div>
                            </div>   
                     <?php }           
                    ?>   
                </div>
            </div>
        </div>
    </section>
    <?php include_once 'footer.php'?>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>