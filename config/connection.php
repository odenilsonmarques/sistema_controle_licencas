<?php
//esse host refere-se ao host disponivel para o docker no linux(para ver digitar o comando ifconfig)
 $dsn = "mysql:host=172.17.0.1; dbname=db_sistema_controle_licencas";
 $dbuser = "root";
 $dbpass = "o1w2o3o4p5rt";
try{
    $connectionPDO = new PDO($dsn, $dbuser, $dbpass);
    // echo "conectado com sucesso"; //as vezes qunaod essa linha fica sem ser comentada pode dar um erro ao tentar relizar um cadastro (Warning: Cannot modify header information - headers already sent by (output started at /var/www/html/config/connection.php:8) in /var/www/html/receiveCompany.php on line 12)
}catch(PDOException $e){
    echo "Error".$e->getMessage();
}