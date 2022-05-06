<?php
    include_once 'config/connection.php';

    $name = (strtoupper(filter_input(INPUT_POST,'name')));
    $email = (filter_input(INPUT_POST,'email'));
    $password = (md5(filter_input(INPUT_POST,'password')));
    
    if($name){
        $insertUser = $connectionPDO->prepare("INSERT INTO user (name, email, password) VALUES (:name, :email, :password)");
        $insertUser->bindValue(':name',$name);
        $insertUser->bindValue(':email',$email);
        $insertUser->bindValue(':password',$password);
        $insertUser->execute();
        header("Location:index.php");
        exit();
    }else{
        header("Location:registerUser.php");
    }
