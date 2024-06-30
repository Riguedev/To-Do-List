<?php
    session_start();

    if(isset($_SESSION["User"]) !== true) {
        header("Location: ../login.php");
        die();
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./images/Task-logoV8.png">
    <link rel="stylesheet" href="./styles/home.css">
    <title><?= $_SESSION["User"]["name"]?>:Home</title>
</head>
<body>
    <nav class="menu">
        <img src="../icons/agregar.png" alt="icono para crear tarea" id="add" class="icon">
        <span class="logout" id="close">Cerrar Sesión</span>
    </nav>

    <div id="add_task_container" class="add_task_container">
        <form>
            <input type="text" name="task" id="add_task_text" class="add_task_text">
            <div class="add_buttons_container">
                <input type="submit" value="Cancelar" class="add_task_submit cancel" id="add_task_abort">
                <input type="submit" value="Crear" class="add_task_submit confirm" id="add_task_submit">
            </div>
        </form>
    </div>

    <h1 class="greeting">Tareas de <?=$_SESSION["User"]["name"] ?></h1>

    <div class="container">
        <ul class="task_list" id="task_list">
            <?php 
                if(empty($_SESSION["User"]["tasks"])) {
                    echo "<li class='no_task'>No hay Tareas</li>";
                } else {
                    foreach($_SESSION["User"]["tasks"] as $task) {
                        if($task["complete"] === 1) {
                            echo "<div class='task_container'>
                                    <li class='task complete' id={$task['task_id']}>{$task['task']}</li>
                                    <img src='../icons/borrar.png' alt='icono para borrar' class='icon delete'>
                                </div>";
                        } else {
                            echo "
                                <div class='task_container'>
                                    <li class='task uncomplete' id={$task['task_id']}>{$task['task']}</li>
                                    <img src='../icons/borrar.png' alt='icono para borrar' class='icon delete'>
                                </div>";
                        }
                    }
                }
            ?>
        </ul>
        
    </div>
    <script src="./script/script.js" type="module"></script>
</body>
</html>