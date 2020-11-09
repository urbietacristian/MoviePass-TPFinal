
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
    <form action="<?php echo FRONT_ROOT?>Room/ShowRoomsByCinemaView/<?php echo $room->getIdCinema();?>">
    <button type="submit">Volver</button>
    </form>
    <div align = 'center'>

    <?php
    if(isset($_SESSION['msg']))
    {
        echo '<script language="javascript">alert("'.$_SESSION['msg'].'");</script>';
        $_SESSION['msg'] = null;
    }
    ?>

    <br><br>
    <h1>Editar Sala</h1>
    <br><br>
    <form action="<?php echo FRONT_ROOT ?>Room/editRoom"   method='post'>
        <input type="hidden" name="idRoom" value="<?php echo $room->getId();?>" />
        <input type="hidden" name="idCinema" value="<?php echo $room->getIdCinema();?>" />

        <h1>Nombre de la sala:</h1>
        <input name="roomName" value="<?php echo $room->getName();?>" type="text"  placeholder="Nombre de la Sala" required>
        <br><br>
        <h1>Precio</h1>
        <input name="roomPrice" value="<?php echo $room->getPrice();?>" type="number" min='0'  placeholder="Precio de la Sala"required>
        <br><br>
        <h1>Capacidad</h1>
        <input name="roomCapacity" value="<?php echo $room->getCapacity();?>" type="number" min='0'  placeholder="Capacidad de la Sala"required>
        <br>

        <button type="submit">Aceptar</button>
    </form>
    </div>
    
</body>
</html>