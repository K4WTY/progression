<?php

    if (isset($_POST["workout"])) {
        session_start();
        require_once("./connection.php");
        $name = $_POST["workout"];
        $data = date("d/m/Y");
        
        $command = "SELECT * FROM workouts WHERE idUser = :idUser AND name = :name AND date = :date;";
        $prepare = $pdo->prepare($command);
        $prepare->bindParam(":idUser", $_SESSION["data"]["id"]);
        $prepare->bindParam(":name", $name);
        $prepare->bindParam(":date", $data);
        $prepare->execute();

        if ($prepare->rowCount() > 0) {
            header("Location: ../pages/workouts/?warn=workoutex");
            return;
        }

        $command = "INSERT INTO workouts (idUser, name, date) VALUE (:idUser, :name, :date);";
        $prepare = $pdo->prepare($command);
        $prepare->bindParam(":idUser", $_SESSION["data"]["id"]);
        $prepare->bindParam(":name", $name);
        $prepare->bindParam(":date", $data);
        $prepare->execute();

        if ($prepare->rowCount() > 0) {
            header("Location: ../pages/workouts/?warn=success");
            return;
        }

        header("Location: ../pages/workouts/?warn=error");

        return;
    }

    header("Location: ../pages/workouts/");

?>