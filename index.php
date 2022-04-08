<?php
    include_once 'config/connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <title>Document</title>
</head>
<body>
    <?php include_once 'header.php'?>
    <section>
        <div class="container">
            <div class="row mt-5">
                <div class="col-lg-4 text-center">
                    <h3>Empresas</h3>
                    <?php
                         $seachCompanys = $connectionPDO->prepare("SELECT COUNT(id_company) as registers FROM company");
                         $seachCompanys->execute();
                         $rows = $seachCompanys->fetch(PDO::FETCH_ASSOC);
                         echo $rows['registers'];
                    ?>
                </div>
                <div class="col-lg-4 text-center">
                    <h3>Licenças</h3>
                    <?php
                        $seachLicenses = $connectionPDO->prepare("SELECT COUNT(id_license) as registers FROM license");
                        $seachLicenses->execute();
                        $rows = $seachLicenses->fetch(PDO::FETCH_ASSOC);
                        echo $rows['registers'];
                    ?>
                </div>
                <div class="col-lg-4 text-center">
                    <h3>Licenças</h3>
                    <?php


                    $listLicenses = [];
                    $searchLicensesCompanys = $connectionPDO->query("SELECT company.id_company, company.nameCompany, license.id_license, license.type_license, license.expiration_date, license.activity, license.organ FROM license, company WHERE license.id_company = company.id_company");
                    if($searchLicensesCompanys->rowCount() > 0){
                    $listLicenses = $searchLicensesCompanys->fetchAll(PDO::FETCH_ASSOC);
                    
                    foreach($listLicenses as $listLicense){
                        // echo $listLicense['nameCompany'];
                        // echo $listLicense =  strtotime(['expiration_date']);
                        $expirationDate = date('d/m/Y', strtotime($listLicense['expiration_date']));
                        // echo "<li id=' $expirationDate'> $expirationDate</li>";

                        $expirationDate= strtotime($listLicense['expiration_date']);

                         $days=ceil(($expirationDate-time())/60/60/24);
                        echo "<li>$days</li>";

                    }

                    }
            
                    //capturando os dias de validade das licenças                                          
                    $expirationDate = strtotime($listLicense['expiration_date']);

                    // $typeLicense = $['type_license'];
                    // echo $days=ceil(($expirationDate-time())/60/60/24);
                    // echo "<li id='$days'>$days</li>";
                    $dataAtual = date('d/m/Y');
                



                        $seachLicenses = $connectionPDO->prepare("SELECT COUNT(id_license) as registers FROM license WHERE $days < 0 ");
                        $seachLicenses->execute();
                        $rows = $seachLicenses->fetch(PDO::FETCH_ASSOC);
                        echo $rows['registers'];
                    ?>
                </div>
            </div>
        </div>
        
    </section>

    


    <?php include_once 'footer.php'?>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>





