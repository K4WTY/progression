<?php

    if (isset($_POST["exercicie"], $_GET["idWorkout"])) {
        require_once("./connection.php");
        $name = $_POST["exercicie"];
        $idWorkout = $_GET["idWorkout"];

        $command = "SELECT * FROM exercicies WHERE idWorkouts = :idWorkouts AND name = :name;";
        $prepare = $pdo->prepare($command);
        $prepare->bindParam(":idWorkouts", $idWorkout);
        $prepare->bindParam(":name", $name);
        $prepare->execute();

        if ($prepare->rowCount() > 0) {
            header("Location: ../pages/workouts/?warn=exercicieex");
            return;
        }

        $command = "INSERT INTO exercicies (idWorkouts, name) VALUE (:idWorkouts, :name);";
        $prepare = $pdo->prepare($command);
        $prepare->bindParam(":idWorkouts", $idWorkout);
        $prepare->bindParam(":name", $name);
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