<?php
    include_once 'config/connection.php';

    $nameCompany = filter_input(INPUT_POST,'nameCompany');
    $type_license = filter_input(INPUT_POST,'type_license');
    $due_date = filter_input(INPUT_POST,'due_date');
    $activity = filter_input(INPUT_POST,'activity');
    // $organ = filter_input(INPUT_POST,'organ');
    

    if($type_license){
        $insertLicense = $connectionPDO->prepare("INSERT INTO license(id_company, type_license, due_date, activity) VALUE (:nameCompany, :type_license, :due_date, :activity)");
        $insertLicense->bindValue(':nameCompany',$nameCompany);
        $insertLicense->bindValue(':type_license',$type_license);
        $insertLicense->bindValue(':due_date',$due_date);
        $insertLicense->bindValue(':activity',$activity);
        // $insertLicense->bindValue(':organ',$organ);
       
        $insertLicense->execute();
        header("Location:index.php");
        exit();
    }else{
        header("Location:registerLicense.php");
    }
