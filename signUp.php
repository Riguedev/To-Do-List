<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./images/Task-logoV8.png">
    <link rel="stylesheet" href="./views/styles/forms.css">
    <title>Registrate</title>
</head>
<body>
    <section class="form_container">
        <div class="form_title_container">
            <img src="./images/Task-logoV8.png" alt="logo de Task" width="32px">
            <h1 class="form_title">¡Resgistrate y disfruta de una gran experiencia!</h1>
        </div>
        <form action="./controllers/createUser.php" method="post">
            <input type="text" placeholder="Nombre" name="name" required>
            <input type="email" placeholder="Correo" name="email" required>
            <input type="password" placeholder="Contraseña" name="pass" required>
            <input type="password" placeholder="Verificar Contraseña" name="vpass" required>
            <button type="submit">Registrate</button>
        </form>
    </section>
</body>
</html>