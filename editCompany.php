<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Cadastro empresa</title>
</head>
<body>
    <?php include_once 'header.php'?>
    <section>
        <?php
            require_once 'config/connection.php';
            $datas = [];  //array para armazenar as informaçoes do usuario caso o id seja encontrado
            $id = filter_input(INPUT_GET, 'id_company');//recebendo o id_company, caso nada ou um valor diferente for recebido(ou seja passado na url)é exibio um form vazio
            if($id){
                $searchIdCompany = $connectionPDO->prepare("SELECT * FROM company WHERE id_company = :id_company");
                $searchIdCompany->bindValue(':id_company', $id);
                $searchIdCompany->execute();
                if($searchIdCompany->rowCount() > 0){
                    $datas = $searchIdCompany->fetch(PDO::FETCH_ASSOC);
                }else{
                    header("Location:listCompany.php");
                    exit();
                }
            }else{
            header("Location:listCompany.php");
            exit();
            }
        
        ?>
        <div class="container">
            <div class="row">
                <div class="col-12-lg">
                    <h3  class="mt-5">Editar Dados da Empresa</h3>
                    <form action="saveEditCompany.php" method="POST">
                        <div class="row mt-4 mb-4">
                            <div class="col-lg-6">
                                <label for="nameCompany" class="form-label mt-3">Nome da Empresa</label>
                                <input type="text" name="nameCompany" id="nameCompany" value="<?=$datas['nameCompany'];?>" class="form-control" maxlength="100"  required autofocus>  
                            </div>
                            <div class="col-lg-6">
                                <label for="nameRepresentative" class="form-label mt-3">Nome do Representante</label>
                                <input type="text" name="nameRepresentative" id="nameRepresentative" value="<?=$datas['nameRepresentative'];?>" class="form-control" maxlength="100"  required >  
                            </div>
                        </div>
                        </div class="row">
                            <div class="col-12-lg">
                                <a class="btn btn-danger mt-4" href="index.php">CANCELAR</a>
                                <input type="submit" value="SALVAR" class="btn btn-primary mt-4">
                                <!-- passando o id -->
                                <input type="hidden" name="id_company" value="<?=$datas['id_company'];?>">  
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <?php include_once 'footer.php'?>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>