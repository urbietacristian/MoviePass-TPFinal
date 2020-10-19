


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php  ?>
    <h1>Agregar Cine</h1>
    <form action="<?php echo FRONT_ROOT ?>Cinema/editCinema"   method='post'>
        <h1>Id:</h1>
        <input name='id' value="<?php echo $Cinema->getId();?>" type="text" name="cinemaName" readonly="readonly"placeholder="Id">
        <h1>Cine:</h1>
        <input name='name' value="<?php echo $Cinema->getName();?>" type="text" name="cinemaName" placeholder="Nombre del Cine">
        <h1>Capacidad</h1>
        <input name='total_capacity' value="<?php echo $Cinema->getTotalCapacity();?>" type="text" name="cinemaCapacity" placeholder="Direccion del Cine">
        <h1>Direccion</h1>
        <input name='address' value="<?php echo $Cinema->getAddress();?>" type="text" name="cinemaAdress" placeholder="Precio del Cine">
        <h1>Valor de la Entrada</h1>
        <input name='ticket_price' value="<?php echo $Cinema->getTicketPrice();?>" type="text" name="cinemaValue" placeholder="Capacidad">

        <button type="submit">Aceptar</button>
    </form>
    
</body>
</html>