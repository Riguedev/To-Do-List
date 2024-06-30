<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./images/Task-logoV8.png">
    <link rel="stylesheet" href="./views/styles/forms.css">
    <title>Iniciar sesión</title>
</head>
<body>
    <section class="form_container">
        <div class="form_title_container">
            <img src="./images/Task-logoV8.png" alt="logo de Task" width="32px">
            <h1 class="form_title">Continuemos con el trabajo</h1>
        </div>
        <form action="./controllers/loginUser.php" method="post">
            <input type="email" placeholder="Correo" name="email" required>
            <input type="password" placeholder="Contraseña" name="pass" required>
            <button type="submit">Iniciar Sesión</button>
        </form>
    </section>
</body>
</html>