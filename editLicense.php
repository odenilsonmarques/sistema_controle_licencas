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
    <title>Editar Licença</title>
</head>
<body>
    <?php include_once 'header.php'?>
    <section>
        <?php
            $datas = [];  //array para armazenar as informaçoes do usuario caso o id seja encontrado
            $id = filter_input(INPUT_GET, 'id_license');//recebendo o id_license, caso nada ou um valor diferente for recebido(ou seja passado na url)é exibio um form vazio
            if($id){
                $searchIdLicense = $connectionPDO->prepare("SELECT * FROM license WHERE id_license = :id_license");
                $searchIdLicense->bindValue(':id_license', $id);
                $searchIdLicense->execute();
                if($searchIdLicense->rowCount() > 0){
                    $datas = $searchIdLicense->fetch(PDO::FETCH_ASSOC);
                }else{
                    header("Location:listLicense.php");
                    exit();
                }
            }else{
                header("Location:listLicense.php");
                exit();
            }
        ?>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="mt-5">Editar Dados da Licença</h3>
                    <form action="saveEditLicense.php" method="POST">
                        <div class="row mt-4 mb-3">
                            <div class="col-12-lg">
                                <label for="nameCompany" class="form-label mt-3">Empresa</label>
                                <select name="nameCompany" id="nameCompany" class="form-select" required autofocus>
                                    <?php
                                        $listCompanys = [];
                                        //selecionando apenas os nomes da empresa, dessa forma fica mas leve
                                        $searchCompanyNames = $connectionPDO->query("SELECT company.id_company, company.nameCompany, license.id_license, license.type_license, license.expiration_date, license.activity, license.organ FROM license, company  WHERE license.id_company = company.id_company and id_license = $id");
                                        if($searchCompanyNames->rowCount()>0){
                                            $listCompanys = $searchCompanyNames->fetchAll(PDO::FETCH_ASSOC);
                                            foreach($listCompanys as $listCompany){?>
                                                <option value="<?=$listCompany['id_company'];?>"><?=$listCompany['nameCompany'];?></option>
                                                <?
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-3">
                                <label for="nameRepresentative" class="form-label mt-4">Licença </label>
                                <select name="type_license" id="type_license" class="form-select" required>
                                    <option value="">SELECIONE</option>                                         
                                    <option value="AUTORIZAÇÃO PARA CORTE DE ARVORE">AUTORIZAÇÃO PARA CORTE DE ARVORE</option> 
                                    <option value="AUTORIZAÇÃO PARA PODA DE ÁRVORE">AUTORIZAÇÃO PARA PODA DE ÁRVORE</option> 
                                    <option value="AUTORIZAÇÃO DE LIMPEZA DE ÁREA">AUTORIZAÇÃO DE LIMPEZA DE ÁREA</option>                                                                                      
                                    <option value="LICENÇA CORPO DE BOMBEIRO">CORPO DE BOMBEIRO</option>
                                    <option value="LICENCA AMBIENTAL SIMPLIFICADA">L.A.S</option>
                                    <option value="LICENÇA DE INSTALAÇÃO">L.I</option>
                                    <option value="LICENÇA DE OPERAÇÃO">L.O</option>
                                    <option value="LICENÇA DE OPERAÇÃO CORRETIVA">L.O.C</option>
                                    <option value="LICENÇA DE PRÉVIA">L.P</option>                                                                                                                   
                                    <option value="RENOVAÇÃO DE LAS">R.L.A.S</option>
                                    <option value="RENOVAÇÃO DE LICENCA PRÉVIA">R.L.P</option>
                                    <option value="RENOVAÇÃO DE LICENÇA DE INSTALAÇÃO">R.L.I</option>
                                    <option value="RENOVAÇÃO DE LICENÇA DE OPERAÇÃO">R.L.O</option>
                                </select>
                            </div>
                            <div class="col-lg-3">
                                <label for="expiration_date" class="form-label mt-4">Data de Validade</label>
                                <input type="date" name="expiration_date" id="expiration_date" value="<?=$datas['expiration_date'];?>" class="form-control" required>  
                            </div>
                            <div class="col-lg-3">
                                <label for="activity" class="form-label mt-4">Atividade</label>
                                <input type="text" name="activity" id="activity" value="<?=$datas['activity'];?>" class="form-control" maxlength="100" required>  
                            </div>
                            <div class="col-lg-3">
                                <label for="organ" class="form-label mt-4">Secretaria / Orgão</label>
                                <input type="text" name="organ" id="organ" value="<?=$datas['organ'];?>" class="form-control" maxlength="20">  
                                 <!-- passando o id -->
                                 <input type="hidden" name="id_license" value="<?=$datas['id_license'];?>">
                            </div>
                        </div>
                        </div class="row">
                            <div class="col-12-lg">
                                <a class="btn btn-danger mt-4" href="listLicense.php">CANCELAR</a>
                                <input type="submit" value="SALVAR" class="btn btn-primary mt-4">
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