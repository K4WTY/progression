<?php
    session_start();
    if (!isset($_SESSION["data"])) {
        header("Location: ../default/");
        return;
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../assets/bootstrap/icons/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../../../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../assets/css/reset.css">
    <link rel="stylesheet" href="../../../assets/css/main.css">
    <title>Home</title>
</head>
<body>
    <div class="container-fluid p-0">
        <div class="container">
            <h2 class="mt-5 text-white">Olá, <?= $_SESSION["data"]["name"]; ?>.</h2>
            <div class="mt-5 row row-cols-6">
                <div class="col d-flex flex-column align-items-center">
                    <a href="../workouts/" class="a-size bg-black d-flex flex-column align-items-center justify-content-center rounded-circle shadow">
                        <span class="bi bi-braces text-white icon-size"></span>
                    </a>
                    <h5 class="text-white mt-3">Treinos</h5>
                </div>
                <div class="col d-flex flex-column align-items-center">
                    <a href="../../php/logout.php" class="a-size bg-black d-flex flex-column align-items-center justify-content-center rounded-circle shadow">
                        <span class="bi bi-arrow-bar-left text-white icon-size"></span>
                    </a>
                    <h5 class="text-white mt-3">Sair</h5>
                </div>
            </div>
        </div>
    </div>
</body>
</html>