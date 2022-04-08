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
    <title>Document</title>
</head>
<body>
    <?php include_once 'header.php'?>
    <section>
        <div class="container">
            <div class="row mt-5">
                <div class="col-lg-6 text-center">
                    <div class="card text-white bg-dark mb-3">
                    
                        <div class="card-body">
                            <h5 class="card-title">Empresas</h5>
                            <?php
                                $seachCompanys = $connectionPDO->prepare("SELECT COUNT(id_company) as registers FROM company");
                                $seachCompanys->execute();
                                $rows = $seachCompanys->fetch(PDO::FETCH_ASSOC); 
                            ?>
                                <p style="font-size:30px"><?php echo $rows['registers']; ?></p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 text-center">
                    <div class="card text-white bg-dark mb-3" >
                        
                        <div class="card-body">
                            <h5 class="card-title">Licenças</h5>
                            <?php
                                $seachCompanys = $connectionPDO->prepare("SELECT COUNT(id_license) as registers FROM license");
                                $seachCompanys->execute();
                                $rows = $seachCompanys->fetch(PDO::FETCH_ASSOC); 
                            ?>
                                <p style="font-size:30px"><?php echo $rows['registers']; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php include_once 'footer.php'?>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>





