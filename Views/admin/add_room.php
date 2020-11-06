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
    <?php
        if(isset($_SESSION['msg']))
        {
            echo '<script language="javascript">alert("'.$_SESSION['msg'].'");</script>';
            $_SESSION['msg'] = null;
        }
    ?>
        <h1>Agregar Sala</h1>
        <form action="<?php echo FRONT_ROOT ?>Room/register"   method='post'>
            <input type="hidden" value="<?php echo $id_cinema; ?>" name="id_cinema"><br>
            <h1>Sala:</h1>
            <input name='name' type="text"><br>
            <h1>Capacidad</h1>
            <input name='capacity'type="number"><br>
            <h1>Precio</h1>
            <input type="number" name="price">
            <br>
            <button type="submit">Aceptar</button>
        </form>
    </div>
        
</body>
</html>