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