<?php 
session_start();
if(isset($_SESSION["User"]) === true) {
    header("Location: ./views/home.php");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./images/Task-logoV8.png">
    <link rel="stylesheet" href="./views/styles/style.css">
    <title>Task</title>
</head>
<body>
    <nav class="menu">
        <img src="./images/Task-logoV5.png" alt="logo de Task" width="36px" class="menu_logo">
        <a href="./signUp.php" class="menu_link sign">Resgistrate</a>
        <a href="./login.php" class="menu_link login">Iniciar Sesión</a>
    </nav>

    <section class="banner_container">
        <div class="banner_opaciti"></div>
        <img src="./images/banner.jpg" alt="banner de una persona escribiendo" class="banner_image">
        <picturec class="banner_task_logo_container">
            <img src="./images/Task-logoV3.png" alt="Logo de Task" class="banner_task_logo">
        </picture>
    </section>

    <section class="description_container">
        <h1 class="description_title">¡Transforma tu Productividad con Task!</h1>
        <p class="description_text">
            ¿Te sientes abrumado por tus tareas diarias? ¡No más! Task es la solución perfecta para organizar tu vida y alcanzar tus metas con facilidad. Nuestra aplicación de lista de tareas está diseñada para ayudarte a gestionar tu tiempo de manera eficiente, asegurando que nada se quede fuera de tu radar.
        </p>
    </section>
</body>
</html>