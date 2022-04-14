<?php
    include_once 'config/connection.php';
 
     //determina o numero de registros que serão mostrados na tela 
     $maximo = 20; //armazenamos o valor da pagina atual 
     $pagina = isset($_GET['pagina']) ? ($_GET['pagina']) : '1'; //subtraimos 1, porque os registros sempre começam do 0 (zero), como num array 
     $inicio = $pagina - 1; //multiplicamos a quantidade de registros da pagina pelo valor da pagina atual 
     $inicio = $maximo * $inicio;

     $strCount = $pdo->select("SELECT COUNT(*) AS 'licenca' FROM license"); 
     $total = 0; 
     if(count($strCount)){ 
         foreach ($strCount as $row) { //armazeno o total de registros da tabela para fazer a paginação $total = $row["total_municip"]; } } ?>

        }
    }

    $busca = $connectionPDO->query("SELECT * FROM license");
    if($busca->rowCount() > 0){
        $licenses = $busca->fetchAll(PDO::FETCH_ASSOC);
        foreach($licenses as $license){
            echo $license['type_license']."<br>";

        }

    }





    $limite = $connectionPDO->prepare("$busca LIMIT $inicio, $total_reg");
    $limite->execute();
    $todos = $connectionPDO->query("$busca");

    $tr = mysql_num_rows($todos); // verifica o número total de registros
    $tp = $tr / $total_reg; // verifica o número total de páginas

    // vamos criar a visualização
    while ($dados = mysql_fetch_array($limite)) {
    $nome = $dados["nome"];
    echo "Nome: $nome<br>";
    }

    // agora vamos criar os botões "Anterior e próximo"
    $anterior = $pc -1;
    $proximo = $pc +1;
    if ($pc>1) {
    echo " <a href='?pagina=$anterior'><- Anterior</a> ";
    }
    echo "|";
    if ($pc<$tp) {
    echo " <a href='?pagina=$proximo'>Próxima -></a>";
    }


?>

<h1>TESTE</h1>
