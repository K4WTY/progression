<?php

    if (isset($_POST["name"], $_POST["email"], $_POST["password"])) {
        require_once("./connection.php");
        $name = $_POST["name"];
        $email = $_POST["email"];
        $password = md5($_POST["password"]);

        $command = "SELECT * FROM users WHERE email = :email;";
        $prepare = $pdo->prepare($command);
        $prepare->bindParam(":email", $email);
        $prepare->execute();

        if ($prepare->rowCount() > 0) {
            // Algum ususario ja cadastrou esse email
            header("Location: ../pages/register/?register=emailerror");
            return;
        }

        $command = "INSERT INTO users (name, email, password) VALUE (:name, :email, :password);";
        $prepare = $pdo->prepare($command);
        $prepare->bindParam(":name", $name);
        $prepare->bindParam(":email", $email);
        $prepare->bindParam(":password", $password);
        $prepare->execute();

        if ($prepare->rowCount() > 0) {
            // Cadastrado com sucesso
            header("Location: ../pages/default/?register=success");
            return;
        }

        // Erro no cadastro
        header("Location: ../pages/register/?register=error");

        return;
    }

    header("Location: ../pages/register/");

?>