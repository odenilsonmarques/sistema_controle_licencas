<?php
require_once 'config/connection.php';
//A FUNCAO FILTER_INPUT, VERIFICA O TIPO DE METODO USADO E SE O CAMPO(VARIAVEL) FOI DEFINIDO. POIS RETORNA NULL CASO NÃO DEFINIDO, E FALSE SE O FILTRO FALHAR, E TRUE CASO DE CERTO
$id = filter_input(INPUT_POST, 'id_license');
$type_license = filter_input(INPUT_POST,'type_license');
$expiration_date = filter_input(INPUT_POST,'expiration_date');
$activity = filter_input(INPUT_POST,'activity');
$organ = filter_input(INPUT_POST,'organ');

//APOS OBTER A VARIAVEL VERIFICO SE O VALOR FOI DEFINIDO(OU SEJA FOI RETORNADO TRUE)
if($type_license){
    $updateLicense = $connectionPDO->prepare("UPDATE license SET type_license = :type_license, expiration_date = :expiration_date, activity = :activity, organ = :organ WHERE id_license = :id_license");
    $updateLicense->bindValue(':type_license', $type_license);
    $updateLicense->bindValue(':expiration_date',$expiration_date);
    $updateLicense->bindValue(':activity',$activity);
    $updateLicense->bindValue(':organ',$organ);
    $updateLicense->bindValue(':id_license', $id);
    $updateLicense->execute();
    header("Location:listLicense.php");
    exit;
}else{
    header("Location:listLicense.php");
    exit;
}