<?php
if($days <= 10 && $listLicense['type_license'] == 'LICENÇA CORPO DE BOMBEIRO'){ ?>
    <td style="background-color:#dc3545;color:#FFF;text-align:center;font-size:13px"><strong>TESTE1</strong></td>
<?php }?>





if($days >= 30 && $listLicense['type_license'] == 'LICENÇA CORPO DE BOMBEIRO'){?>
                                            <td style="background-color:#198754;color:#FFF;text-align:center;font-size:13px"><strong>DENTRO DO PRAZO</strong></td>
                                            <?php }elseif($days < 30 && $days >=1  && $listLicense['type_license'] == 'LICENÇA CORPO DE BOMBEIRO'){?>
                                                <td style="background-color:#ffc107;color:#FFF;text-align:center;font-size:13px"><strong>ATENÇÃO PRAZO</strong></td>
                                            <?php }elseif($days < 30 && $listLicense['type_license'] == 'LICENÇA CORPO DE BOMBEIRO'){?>
                                                <td style="background-color:#dc3545;color:#FFF;text-align:center;font-size:13px"><strong>PRAZO VENCIDO</strong></td>
                                            <?php }elseif($days <= 120){ ?>
                                                <td style="background-color:#dc3545;color:#FFF;text-align:center;font-size:13px"><strong>PRAZO VENCIDO</strong></td>
                                            <?php }elseif($days > 120 && $days <= 140 ){?>
                                                <td style="background-color:#ffc107;color:#FFF;text-align:center;font-size:13px"><strong>ATENÇÃO PRAZO</strong></td>
                                            <?php } elseif($days > 140 ){?>
                                                <td style="background-color:#198754;color:#FFF;text-align:center;font-size:13px"><strong>DENTRO DO PRAZO</strong></td>
                                            <?php }?>



                                            <!-- <div class="col-lg-4 text-center">
                    <h3>Licenças</h3>
                        <?php
                        $listLicenses = [];
                        $searchLicensesCompanys = $connectionPDO->query("SELECT company.id_company, license.id_license, license.expiration_date FROM license, company WHERE license.id_company = company.id_company ");
                        if($searchLicensesCompanys->rowCount() > 0){
                            $listLicenses = $searchLicensesCompanys->fetchAll(PDO::FETCH_ASSOC);
                            foreach($listLicenses as $listLicense){
                                $expirationDate = strtotime($listLicense['expiration_date']);
                                $days=ceil(($expirationDate-time())/60/60/24);
                                $con = 0;
                                echo "<li>$days</li>"; 
                                if($days > 120){
                                echo  $tetet = $days + $con;
                                }
                            }
                        }
                        $seachLicenses = $connectionPDO->prepare("SELECT sum(expiration_date) as registers FROM license WHERE $days > 120");
                        $seachLicenses->execute();
                        
                        $rows = $seachLicenses->fetch(PDO::FETCH_ASSOC);
                        echo "etset".$rows['registers'];
                    ?>
                </div> -->


                <div class="row">
                <div class="col-lg-6">
                <div class="col-lg-12">
                </div>

            </div>