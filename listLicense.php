<?php include_once 'config/connection.php'?>
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
            <div class="row mt-5">
                <div class="col-lg-5">
                    <form action="" method="POST">
                        <div class="input-group mb-3">
                            <input type="text" name="search" class="form-control" placeholder="Digite o nome da empresa">
                            <button class="btn btn-primary" type="submit">BUSCAR</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover mt-4">
                            <thead class="success">
                                <tr>
                                    <th>EMPRESA</th>
                                    <th>LICENÇA</th>
                                    <th>VALIDADE</th>
                                    <th>ATIVIDADE</th>
                                    <th>STATUS</th>
                                    <th>DIAS</th>
                                    <th>AÇÃO</th>
                                </tr>
                            </thead>
                            <?php
                                //verifica a página atual caso seja informada na URL, senão atribui como 1ª página 
                                $page = (isset($_GET['page'])) ? $_GET['page'] : 1;

                                //selecionando o total de registro
                                $searchRegister = $connectionPDO->prepare("SELECT COUNT(id_license) as registers FROM license");
                                $searchRegister->execute();
                                $qtdRows = $searchRegister->fetch(PDO::FETCH_ASSOC); 
                                $guardRows = $qtdRows['registers'];
            
                                // echo $rows['registers'];

                                //definindo a quantidade de itens por página, neste caso
                                $items = 8;

                                //calcula o número de páginas arredondando o resultado para cima        
                                $numberPages = ceil($guardRows / $items);

                                //variavel para calcular o início da visualização com base na página atual 
                                $startVisualization = ($items * $page) - $items;

                                $listLicenses = [];
                                if(!isset($_POST['search'])){
                                    $searchLicensesCompanys = $connectionPDO->query("SELECT company.id_company, company.nameCompany, license.id_license, license.type_license, license.expiration_date, license.activity, license.organ FROM license, company  WHERE license.id_company = company.id_company ORDER BY expiration_date ASC LIMIT $startVisualization, $items");
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
                                                    $days=ceil(($expirationDate-time())/60/60/24);
                                                    
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
                                                    <td style="background-color:#E6E6E6;color:#111;text-align:center;font-size:13px" class="dark"><?= $days?></td> 
                                                    <td style="background-color:#0d6efd;color:#FFF;text-align:center;font-size:13px"><a href="editLicense.php?id_license=<?=$listLicense['id_license'];?>"  class="btn btn-sm btn-primary">Editar</a></td>
                                            </tr>
                                                <?php 
                                               
                                        }
                                    }

                                }else if(isset($_POST['search'])){
                                    //buscando todas as palavras que iniciam com a letra passado na busca. Também foi utilizado a função trim para retirar todos os espeços no inicio e no fim da string
                                    $nameCompany = trim($_POST['search'])."%";
                                    $searchLicensesCompanys = $connectionPDO->prepare("SELECT company.id_company, company.nameCompany, license.id_license, license.type_license, license.expiration_date, license.activity, license.organ FROM license, company WHERE (nameCompany LIKE '$nameCompany') AND license.id_company = company.id_company");
                                    $searchLicensesCompanys->bindParam(':type_license', $type_license, PDO::PARAM_STR);
                                    $searchLicensesCompanys->execute();
                                    if($searchLicensesCompanys->rowCount()>0){
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
                                                    $days=ceil(($expirationDate-time())/60/60/24);

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
                                                    <td style="background-color:#E6E6E6;color:#111;text-align:center;font-size:13px" class="dark"><?= $days?></td> 
                                                    <td style="background-color:#0d6efd;color:#FFF;text-align:center;font-size:13px"><a href="editLicense.php?id_license=<?=$listLicense['id_license'];?>"  class="btn btn-sm btn-primary">Editar</a></td>
                                            </tr>
                                                <?php
                                        }
                                         
                                    }else{ ?>
                                        <div class="alert alert-danger text-center" role="alert">
                                            Nenhum Resultado Encontrado !
                                        </div>
                                <?php  }
                                    
                                }
                            ?>   
                        </table>
                        <!--paginação-->
                        <nav aria-label="Page navigation" class="mt-3">
                            <ul class="pagination justify-content-center">
                                <li class="page-item">
                                    <a class="page-link" href="listLicense.php?page=1" tabindex="-1" aria-disabled="true">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                                <?php  for ($i = 1; $i < $numberPages + 1; $i++) {?>
                                    <li class="page-item"><a class="page-link" href="listLicense.php?page=<?php echo $i; ?>"><?php echo $i;?></a></li>
                                    <?php } ?>
                                <li class="page-item">
                                    <a class="page-link" href="listLicense.php?page=<?php echo $numberPages ;?>">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php include_once 'footer.php'?>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>