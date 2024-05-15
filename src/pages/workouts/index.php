<?php
    session_start();
    if (!isset($_SESSION["data"])) {
        header("Location: ../default/");
        return;
    }
    include_once("../../php/connection.php");

    $workouts = null;
    $command = "SELECT id, name, date FROM workouts WHERE idUser = :idUser;";
    $prepare = $pdo->prepare($command);
    $prepare->bindParam(":idUser", $_SESSION["data"]["id"]);
    $prepare->execute();

    if ($prepare->rowCount() > 0) {
        $workouts = $prepare->fetchAll(PDO::FETCH_ASSOC);
    }

    //print_r($workouts);

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
    <title>Workouts</title>
</head>
<body>
    <div class="container-fluid p-0">
        <div class="container">
            <div class="d-flex justify-content-end">
                <button data-bs-toggle="modal" data-bs-target="#workoutModal" class="mt-5 border-0 button-size bg-black d-flex flex-column align-items-center justify-content-center rounded-circle shadow">
                    <span class="bi bi-plus text-white icon-size"></span>
                </button>
                <a href="../home/" class="mt-5 ms-5 border-0 button-size bg-black d-flex flex-column align-items-center justify-content-center rounded-circle shadow">
                    <span class="bi bi-arrow-left text-white icon-size-2"></span>
                </a>
            </div>
            <div class="mt-5 row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xxl-4">
                <?php if ($workouts != null) { ?>
                    <?php foreach($workouts as $index) { ?>
                        <div class="col p-4">
                            <div class="card" style="width: 18rem;">
                                <div class="card-body d-flex justify-content-between">
                                    <h5 class="card-title"><?= $index["name"]; ?></h5>
                                    <div>
                                        <p class="card-text"><?= $index["date"]; ?></p>
                                    </div>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <?php 
                                        $exercices = null;
                                        $command = "SELECT * FROM exercicies WHERE idWorkouts = :idWorkouts;";
                                        $prepare = $pdo->prepare($command);
                                        $prepare->bindParam(":idWorkouts", $index["id"]);
                                        $prepare->execute();
                                        if ($prepare->rowCount() > 0) { $exercices = $prepare->fetchAll(PDO::FETCH_ASSOC); }
                                    ?>
                                    <?php if ($exercices != null) { ?>
                                        <?php foreach($exercices as $indexEx) { ?>
                                            <li class="list-group-item d-flex justify-content-between">
                                                <p><?= $indexEx["name"]; ?></p>
                                                <div>
                                                    <?php 
                                                        $progression = null;
                                                        $command = "SELECT * FROM progression WHERE idExercicies = :idExercicies;";
                                                        $prepare = $pdo->prepare($command);
                                                        $prepare->bindParam(":idExercicies", $indexEx["id"]);
                                                        $prepare->execute();
                                                        if ($prepare->rowCount() > 0) { $progression = $prepare->fetchAll(PDO::FETCH_ASSOC); }
                                                    ?>
                                                    <?php if ($progression != null) { ?>
                                                        <?php foreach($progression as $indexP) { ?>
                                                            <p><?= $indexP["carga"]; ?>kg - <?= $indexP["reps"]; ?> reps </p>
                                                        <?php } ?>
                                                    <?php } ?>
                                                    <div class="d-flex justify-content-end">
                                                        <button data-bs-toggle="modal" data-bs-target="#crModal" class="btn btn-primary shadow" id="buttonsForIdExercices" value="<?= $indexEx["id"]; ?>">
                                                            C - R
                                                        </button>
                                                    </div>
                                                </div>
                                            </li>
                                        <?php } ?>
                                    <?php } ?>
                                    <li class="list-group-item d-flex justify-content-center">
                                        <button data-bs-toggle="modal" data-bs-target="#exercicieModal" class="btn btn-primary shadow" id="buttonsForIdWorkouts" value="<?= $index["id"]; ?>">
                                            Adicionar exercicio
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    <?php } ?>
                <?php } ?>
            </div>
        
        </div>
    </div>
    
    <div class="accordion" id="accordionExample">
        <div class="accordion-item">
            <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                Treino - Data
            </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="workoutModal" tabindex="-1" aria-hidden="true">
        <form class="modal-dialog" method="POST" action="../../php/newWorkout.php">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Treinos</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input class="form-control" type="text" placeholder="Nome do treino" name="workout" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </div>
        </form>
    </div>
    <div class="modal fade" id="exercicieModal" tabindex="-1" aria-hidden="true">
        <form class="modal-dialog" id="exercicieModalForm" method="POST" action="../../php/newExercicie.php">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Exercicio</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input class="form-control" type="text" placeholder="Nome do exercicio" name="exercicie" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </div>
        </form>
    </div>
    <div class="modal fade" id="crModal" tabindex="-1" aria-hidden="true">
        <form class="modal-dialog" id="crModalForm" method="POST" action="../../php/progression.php">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">C - R</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input class="form-control" type="number" placeholder="Carga utilizada" name="carga" required>
                    <input class="form-control mt-2" type="number" placeholder="Repeticoes" name="reps" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </div>
        </form>
    </div>
    <script src="../../../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../../assets/js/workouts.js"></script>
</body>
</html>