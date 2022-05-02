<?php
require_once 'config/connection.php';
//A FUNCAO FILTER_INPUT, VERIFICA O TIPO DE METODO USADO E SE O CAMPO(VARIAVEL) FOI DEFINIDO. POIS RETORNA NULL CASO NÃO DEFINIDO, E FALSE SE O FILTRO FALHAR, E TRUE CASO DE CERTO
$id = filter_input(INPUT_POST, 'id_company');
$nameCompany = (strtoupper(filter_input(INPUT_POST,'nameCompany')));
$nameRepresentative = (strtoupper(filter_input(INPUT_POST,'nameRepresentative')));

//APOS OBTER A VARIAVEL VERIFICO SE O VALOR FOI DEFINIDO(OU SEJA FOI RETORNADO TRUE)
if($id && $nameCompany){
    $updateCompany = $connectionPDO->prepare("UPDATE company SET nameCompany = :nameCompany, nameRepresentative = :nameRepresentative WHERE id_company = :id_company");
    $updateCompany->bindValue(':nameCompany', $nameCompany);
    $updateCompany->bindValue(':nameRepresentative', $nameRepresentative);
    $updateCompany->bindValue(':id_company', $id);
    $updateCompany->execute();
    header("Location:listCompany.php");
    exit;
}else{
    header("Location:listCompany.php");
    exit;
}