<?php
//declarando a funcao session para capturar so dados do usuario que tentar acessar essa pagina e verificar se tem akgum dado salvo que corresponde a esse usuario
session_start();
if(isset($_SESSION['email']) && empty($_SESSION['email']) == false){
    if(isset($_SESSION['password']) && empty($_SESSION['password'])== false){
    }
}else{
    //caso o usuario não esteja logado(ou seja, caso não tenha uma sessão ativa) este usuario deverá ser direcionado para pagina de login
    header("Location: login.php");
}
include_once 'config/connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Document</title>
</head>
<body>
    <?php include_once 'header.php'?>
    <section>
        <div class="container">
            <div class="row mt-5">
                <div class="col-lg-5">
                    <form action="" method="POST">
                        <div class="input-group mb-3">
                            <input type="text" name="search" class="form-control" placeholder="Digite o nome da empresa">
                            <button class="btn btn-primary" type="submit">BUSCAR</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover mt-4">
                            <thead class="success">
                                <tr>
                                    <th>EMPRESA</th>
                                    <th>REPRESENTANTE</th>
                                    <th>AÇÃO</th>
                                </tr>
                            </thead>
                            <?php
                                //verifica a página atual caso seja informada na URL, senão atribui como 1ª página 
                                $page = (isset($_GET['page'])) ? $_GET['page'] : 1;

                                //selecionando o total de registro
                                $searchRegister = $connectionPDO->prepare("SELECT COUNT(id_company) as registers FROM company");
                                $searchRegister->execute();
                                $qtdRows = $searchRegister->fetch(PDO::FETCH_ASSOC); 
                                $guardRows = $qtdRows['registers'];

                                //definindo a quantidade de itens por página, neste caso
                                $items = 5;

                                //calcula o número de páginas arredondando o resultado para cima        
                                $numberPages = ceil($guardRows / $items);

                                //variavel para calcular o início da visualização com base na página atual 
                                $startVisualization = ($items * $page) - $items;


                                $listCompanys = [];
                                if(!isset($_POST['search'])){
                                    $searchCompanys = $connectionPDO->query("SELECT id_company, nameCompany, nameRepresentative FROM company WHERE nameCompany = nameCompany ORDER BY nameCompany ASC LIMIT $startVisualization, $items");
                                    if($searchCompanys->rowCount() > 0){
                                        $listCompanys = $searchCompanys->fetchAll(PDO::FETCH_ASSOC);
                                        foreach($listCompanys as $listCompany){?>
                                            <tr>
                                                <td><?=$listCompany['nameCompany'];?></td>
                                                <td><?=$listCompany['nameRepresentative'];?></td>
                                                <td>
                                                    <a href="editCompany.php?id_company=<?=$listCompany['id_company'];?>"  class="btn btn-primary btn-sm">Editar</a>
                                                </td>
                                            </tr>
                                            <?php 
                                        }
                                    }

                                }else if(isset($_POST['search'])){
                                    //buscando todas as palavras que iniciam com a letra passado na busca. Também foi utilizado a função trim para retirar todos os espeços no inicio e no fim da string
                                    $nameCompany = trim($_POST['search'])."%";
                                    $searchCompanys = $connectionPDO->prepare("SELECT id_company, nameCompany, nameRepresentative FROM company WHERE (nameCompany LIKE '$nameCompany')");
                                    $searchCompanys->bindParam(':type_license', $type_license, PDO::PARAM_STR);
                                    $searchCompanys->execute();
                                    if($searchCompanys->rowCount()>0){
                                        $listCompanys = $searchCompanys->fetchAll(PDO::FETCH_ASSOC);
                                        foreach($listCompanys as $listCompany){?>
                                            <tr>
                                                <td><?=$listCompany['nameCompany'];?></td>
                                                <td><?=$listCompany['nameRepresentative'];?></td>
                                                <td>
                                                <a href="editCompany.php?id_company=<?=$listCompany['id_company'];?>"  class="btn btn-primary btn-sm">Editar</a>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }else{ ?>
                                            <div class="alert alert-danger text-center" role="alert">
                                                Nenhum Resultado Encontrado !
                                            </div>
                                    <?php  }
                                    }
                            ?>   
                        </table>
                        <!--paginação-->
                        <nav aria-label="Page navigation" class="mt-3">
                            <ul class="pagination justify-content-center">
                                <li class="page-item">
                                    <a class="page-link" href="listCompany.php?page=1" tabindex="-1" aria-disabled="true">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                                <?php  for ($i = 1; $i < $numberPages + 1; $i++) {?>
                                    <li class="page-item"><a class="page-link" href="listCompany.php?page=<?php echo $i; ?>"><?php echo $i;?></a></li>
                                    <?php } ?>
                                <li class="page-item">
                                    <a class="page-link" href="listCompany.php?page=<?php echo $numberPages ;?>">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php include_once 'footer.php'?>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>