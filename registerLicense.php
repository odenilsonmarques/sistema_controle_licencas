<?php
include_once 'config/connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <title>Cadastro empresa</title>
</head>
<body>
    <?php include_once 'header.php'?>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <form action="receiveCompany.php" method="POST">
                        <div class="row">
                            <div class="col-12">
                                <label for="nameCompany" class="form-label mt-3">NOME DA EMPRESA</label>
                                <select name="nameCompany" id="" class="form-select" >
                                    <option value="">SELECIONE</option>
                                    <?php
                                        $companys = [];
                                        $searchCompanys = $connectionPDO->query("SELECT * FROM company");
                                        if($searchCompanys->rowCount()>0){
                                            $companys = $searchCompanys->fetchAll(PDO::FETCH_ASSOC);
                                            foreach($companys as $compan){?>
                                                <option value="<?=$compan['id_company'];?>"><?=$compan['nameCompany'];?></option>
                                                <?
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <label for="nameRepresentative" class="form-label mt-4">LICENÇA</label>
                                <select name="type_licensa" id="" class="form-select" >
                                    <option value="">SELECIONE</option>                                         
                                    <option value="AUTORIZAÇÃO PARA CORTE DE ARVORE">AUTORIZAÇÃO PARA CORTE DE ARVORE</option> 
                                    <option value="AUTORIZAÇÃO PARA PODA DE ÁRVORE">AUTORIZAÇÃO PARA PODA DE ÁRVORE</option> 
                                    <option value="AUTORIZAÇÃO DE LIMPEZA DE ÁREA">AUTORIZAÇÃO DE LIMPEZA DE ÁREA</option>                                                   
                                    <option value="AUTORIZAÇÃO PARA SUPRESSÃO DE VEGETAÇÃO E LIMPEZA DE ÁREA">AUTORIZAÇÃO PARA SUPRESSÃO DE VEGETAÇÃO E LIMPEZA DE ÁREA</option>                                                  
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
                            <div class="col-4">
                                <label for="due_date" class="form-label mt-4">DATA DE VALIDADE</label>
                                <input type="date" name="due_date" id="due_date" class="form-control" required>  
                            </div>
                            <div class="col-4"></div>
                        </div>
                        </div class="row">
                            <div class="col-12">
                                <a class="btn btn-danger mt-4" href="index.php">CANCELAR</a>
                                <input type="submit" value="CADASTRAR" class="btn btn-primary mt-4">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php include_once 'footer.php'?>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>