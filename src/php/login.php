<?php

    if (isset($_POST["email"], $_POST["password"])) {
        require_once("./connection.php");
        $email = $_POST["email"];
        $password = md5($_POST["password"]);

        $command = "SELECT * FROM users WHERE email = :email;";
        $prepare = $pdo->prepare($command);
        $prepare->bindParam(":email", $email);
        $prepare->execute();

        if ($prepare->rowCount() > 0) {
            // Encontrou algum usuario
            $data = $prepare->fetch(PDO::FETCH_ASSOC);
            if ($data["email"] == $email && $data["password"] == $password) {
                session_start();
                $_SESSION["data"] = $data;
                header("Location: ../pages/home/");
                return;
            }
            header("Location: ../pages/default/?login=wrongdata");
            return;
        }

        // Erro no login
        header("Location: ../pages/default/?login=error");

        return;
    }

    header("Location: ../pages/default/");

?>