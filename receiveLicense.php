<?php
    include_once 'config/connection.php';

    $nameCompany = (strtoupper(filter_input(INPUT_POST,'nameCompany')));
    $type_license = (strtoupper(filter_input(INPUT_POST,'type_license')));
    $expiration_date = filter_input(INPUT_POST,'expiration_date');
    $activity = (strtoupper(filter_input(INPUT_POST,'activity')));
    $organ = (strtoupper(filter_input(INPUT_POST,'organ')));
    
    if($type_license && $expiration_date && $activity){
        $insertLicense = $connectionPDO->prepare("INSERT INTO license(id_company, type_license, expiration_date, activity, organ)VALUES(:nameCompany, :type_license, :expiration_date, :activity, :organ)");
        $insertLicense->bindValue(':nameCompany',$nameCompany);
        $insertLicense->bindValue(':type_license',$type_license);
        $insertLicense->bindValue(':expiration_date',$expiration_date);
        
        $insertLicense->bindValue(':activity',$activity);
        $insertLicense->bindValue(':organ',$organ);
        $insertLicense->execute();
        header("Location:index.php");
        exit();
    }else{
        header("Location:registerLicense.php");
        exit();
    }
   

