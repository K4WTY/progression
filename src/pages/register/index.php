<?php
    session_start();
    if (isset($_SESSION["data"])) {
        header("Location: ../home/");
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
    <link rel="stylesheet" href="../../../assets/css/default.css">
    <title>Register</title>
</head>
<body class="bg-secondary">
    <div class="vh-100 container d-flex align-items-center justify-content-center">
        <form class="form-edit rounded-4 shadow p-5" action="../../php/register.php" method="POST">
            <div class="container">
                <h3 class="text-white text-center">Cadastro</h3>
                <label class="text-white mt-2" for="name">Nome</label>
                <input required autocomplete="off" id="name" name="name" type="text" class="mt-2 form-control border-0 shadow-none input-edit">
                <label class="text-white mt-2" for="email">Email</label>
                <input required autocomplete="off" id="email" name="email" type="email" class="mt-2 form-control border-0 shadow-none input-edit">
                <label class="text-white mt-2" for="password">Senha</label>
                <input required autocomplete="off" id="password" name="password" type="password" class="mt-2 form-control border-0 shadow-none input-edit">
                <div class="mt-3 d-flex justify-content-center">
                    <button class="btn-edit border-0 rounded-3 text-white">Cadastrar</button>
                </div>
            </div>
            <hr class="mt-3 text-white">
            <p class="text-white">Já está cadastrado? <a href="../default/" class="a-edit">Entrar</a></p>
        </form>
    </div>
    <?php
        if (isset($_GET["register"])) {
            include_once("../../php/functions.php");
            $functions = new Functions;
            if ($_GET["register"] == "emailerror") {
                $functions->showNotification("Erro, email já cadastrado!");
                return;
            }

            $functions->showNotification("Erro ao realizar cadastro, tente novamente!");
        }
    ?>
</body>
</html>