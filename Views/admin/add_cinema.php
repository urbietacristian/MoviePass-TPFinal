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
    <form action="<?php echo FRONT_ROOT ?>Cinema/register"   method='post'>
        <h1>Cine:</h1>
        <input name='name' type="text" name="cinemaName" placeholder="Nombre del Cine">
        <h1>Capacidad</h1>
        <input name='total_capacity'type="text" name="cinemaCapacity" placeholder="Capacidad del Cine">
        <h1>Direccion</h1>
        <input name='address' type="text" name="cinemaAdress" placeholder="Direccion del Cine">
        <h1>Valor de la Entrada</h1>
        <input name='ticket_price' type="text" name="cinemaValue" placeholder="Valor del Cine">

        <button type="submit">Aceptar</button>
    </form>
    
</body>
</html>