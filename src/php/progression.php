<?php

    if (isset($_POST["carga"], $_POST["reps"], $_GET["idExercicie"])) {
        require_once("./connection.php");
        $carga = $_POST["carga"];
        $reps = $_POST["reps"];
        $idExercicie = $_GET["idExercicie"];

        $command = "INSERT INTO progression (idExercicies, carga, reps) VALUE (:idExercicies, :carga, :reps);";
        $prepare = $pdo->prepare($command);
        $prepare->bindParam(":idExercicies", $idExercicie);
        $prepare->bindParam(":carga", $carga);
        $prepare->bindParam(":reps", $reps);
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