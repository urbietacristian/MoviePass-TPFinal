<?php
require_once(VIEWS_PATH."navAdmin.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="<?php echo FRONT_ROOT?>Room/ShowRoomsByCinemaView/<?php echo $id_cinema?>">
        <button type="submit">Volver</button>
    </form>
    <div align = 'center'>
        <h1>Agregar Sala</h1>
        <form action="<?php echo FRONT_ROOT ?>Room/register"   method='post'>
            <input type="hidden" value="<?php echo $id_cinema; ?>" name="id_cinema"><br>
            <h1>Sala:</h1>
            <input name='name' type="text"><br>
            <h1>Capacidad</h1>
            <input name='capacity' min='0' type="number"><br>
            <h1>Precio</h1>
            <input type="number" min='0' name="price">
            <br>
            <button type="submit">Aceptar</button>
        </form>
    </div>        
</body>
</html>