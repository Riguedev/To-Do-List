<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error</title>
</head>
<body>
    <h1>Oops Ocurrio un prolema</h1>
    <div>
        <?php
            foreach($validationList as $item) {
                echo "<h2>$item</h2>";
            }
        ?>
    </div>
    <?php echo "<a href='$link'>Volver a Intentar</a>" ?>
</body>
</html>



