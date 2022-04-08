<?php include_once 'config/connection.php'?>
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
        <div class="container">
            <div class="row">
                <h3 class="mt-5">Licencas</h3>
                <div class="col-lg-12">
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>EMPRESA</th>
                                <th>LICENÇA</th>
                                <th>DATA DE VALIDADE</th>
                                <th>ATIVIDADE</th>
                                <th>STATUS</th>
                                <th>DIAS</th>
                               
                                
                            </tr>
                        </thead>
                        <?php
                            $listLicenses = [];
                            $searchLicensesCompanys = $connectionPDO->query("SELECT company.id_company, company.nameCompany, license.id_license, license.type_license, license.expiration_date, license.activity, license.organ FROM license, company WHERE license.id_company = company.id_company");
                             if($searchLicensesCompanys->rowCount() > 0){
                                 $listLicenses = $searchLicensesCompanys->fetchAll(PDO::FETCH_ASSOC);
                                 foreach($listLicenses as $listLicense){?>
                                    <tr>
                                        <td><?=$listLicense['nameCompany'];?></td>
                                        <td><?=$listLicense['type_license'];?></td>
                                        <td><?=date('d/m/Y', strtotime($listLicense['expiration_date']));?></td>
                                        
                                        <td><?=$listLicense['activity'];?></td>
                                       
                                        
                                        <?php
                                            //capturando os dias de validade das licenças                                          
                                            $expirationDate= strtotime($listLicense['expiration_date']);
                                            $typeLicense = $listLicense['type_license'];
                                            echo $days=ceil(($expirationDate-time())/60/60/24);
                                            

                                            if($days >= 30 && $listLicense['type_license'] == 'LICENÇA CORPO DE BOMBEIRO'){?>
                                            <td style="background-color:#198754;color:#FFF;text-align:center;font-size:13px"><strong>DENTRO DO PRAZO</strong></td>
                                            <?php }elseif($days > 1 && $days <= 30  && $listLicense['type_license'] == 'LICENÇA CORPO DE BOMBEIRO'){?>
                                                <td style="background-color:#ffc107;color:#FFF;text-align:center;font-size:13px"><strong>ATENÇÃO PRAZO</strong></td>
                                            <?php }elseif($days < 1 && $listLicense['type_license'] == 'LICENÇA CORPO DE BOMBEIRO'){?>
                                                <td style="background-color:#dc3545;color:#FFF;text-align:center;font-size:13px"><strong>PRAZO VENCIDO</strong></td>
                                            <?php }elseif($days <= 120){ ?>
                                                <td style="background-color:#dc3545;color:#FFF;text-align:center;font-size:13px"><strong>PRAZO VENCIDO</strong></td>
                                            <?php }elseif($days > 120 && $days <= 140 ){?>
                                                <td style="background-color:#ffc107;color:#FFF;text-align:center;font-size:13px"><strong>ATENÇÃO PRAZO</strong></td>
                                            <?php } elseif($days > 140 ){?>
                                                <td style="background-color:#198754;color:#FFF;text-align:center;font-size:13px"><strong>DENTRO DO PRAZO</strong></td>
                                            <?php }?>

                                            <td style="background-color:#212529;color:#FFF;text-align:center;font-size:13px" class="dark"><?= $days?></td> 
                                    </tr>
                                 <?php
                                 }
                             }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    <?php include_once 'footer.php'?>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>