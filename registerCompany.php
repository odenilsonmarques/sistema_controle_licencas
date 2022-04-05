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
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3  class="mt-5">Cadastro de Empresa</h3>
                    <form action="receiveCompany.php" method="POST">
                        <div class="row mt-4 mb-4">
                            <div class="col-6">
                                <label for="nameCompany" class="form-label mt-3">Nome da Empresa</label>
                                <input type="text" name="nameCompany" id="nameCompany" class="form-control" maxlength="100"  required autofocus>  
                            </div>
                            <div class="col-6">
                                <label for="nameRepresentative" class="form-label mt-3">Nome do Representante</label>
                                <input type="text" name="nameRepresentative" id="nameRepresentative" class="form-control" maxlength="100"  required >  
                            </div>
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