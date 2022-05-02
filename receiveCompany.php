<?php
    include_once 'config/connection.php';

    $nameCompany = (strtoupper(filter_input(INPUT_POST,'nameCompany')));
    $nameRepresentative = (strtoupper(filter_input(INPUT_POST,'nameRepresentative')));

    if($nameCompany){
        $insertCompany = $connectionPDO->prepare("INSERT INTO company (nameCompany, nameRepresentative) VALUES (:nameCompany, :nameRepresentative)");
        $insertCompany->bindValue(':nameCompany',$nameCompany);
        $insertCompany->bindValue(':nameRepresentative',$nameRepresentative);
        $insertCompany->execute();
        header("Location:index.php");
        exit();
    }else{
        header("Location:registerCompany.php");
    }
