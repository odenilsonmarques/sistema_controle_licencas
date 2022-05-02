<?php
//A FUNCAO FILTER_INPUT, VERIFICA O TIPO DE METODO USADO E SE O CAMPO(VARIAVEL) FOI DEFINIDO. POIS RETORNA NULL CASO NÃO DEFINIDO, E FALSE SE O FILTRO FALHAR, E TRUE CASO DE CERTO
$nome = filter_input(INPUT_POST, 'nome');
$email1 = filter_input(INPUT_POST,'email1',FILTER_VALIDATE_EMAIL);
$email2 = filter_input(INPUT_POST,'email2',FILTER_VALIDATE_EMAIL);



    if($email1 == $email2){
        echo "email iguas";
    }else{
        echo "email diferentes";
    }
