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
    <h1>Agregar Cine</h1>
    <form action="<?php echo FRONT_ROOT ?>Room/register"   method='post'>
        <h1>Cine:</h1>
        <input name='name' type="text" name="roomName" placeholder="Nombre Sala">
        <h1>Capacidad</h1>
        <input name='roomCapacity'type="number" name="roomCapacity" placeholder="Capacidad de la Sala">
        <h1>Direccion</h1>
        <input name='precio' type="number" name="price" placeholder="Precio de entrada">
        

        <button type="submit">Aceptar</button>
    </form>
    
</body>
</html>