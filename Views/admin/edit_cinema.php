
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
    <?php  ?>
    <h1>Agregar Cine</h1>
    <form action="<?php echo FRONT_ROOT ?>Cinema/editCinema"   method='post'>
        <input type="hidden" name="id" value="<?php echo $Cinema->getId();?>" />
        <h1>Cine:</h1>
        <input name='name' value="<?php echo $Cinema->getName();?>" type="text" name="cinemaName" placeholder="Nombre del Cine" required>
        <h1>Capacidad</h1>
        <input min=0 name='total_capacity' value="<?php echo $Cinema->getTotalCapacity();?>" type="text" name="cinemaCapacity" placeholder="Direccion del Cine" required>
        <h1>Direccion</h1>
        <input name='address' value="<?php echo $Cinema->getAddress();?>" type="text" name="cinemaAdress" placeholder="Precio del Cine"required>

        <button type="submit">Aceptar</button>
    </form>
    
</body>
</html>