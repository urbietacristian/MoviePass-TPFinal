<?php
require_once(VIEWS_PATH."navAdmin.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Función - Paso 2</title>
</head>
<body>
    <div align = 'center'>
        <?php
        if(isset($_SESSION['msg']))
        {
            echo '<script language="javascript">alert("'.$_SESSION['msg'].'");</script>';
            $_SESSION['msg'] = null;
        }
        ?>
        <h1>Agregar Función para <?php echo $movie?> </h1>
        <form action="<?php echo FRONT_ROOT ?>MovieShow/ShowAddFunctionCinema2/<?php echo $id_movie ?>" method='post' >
            <h1>Sala:</h1>
            <br>
            <select type="select" name="id_cinema" required>
                <?php
                foreach($roomList as $room){
                ?>
                <option value = "<?php echo $room->getId() ?>"><?php echo $room->getName()?></option>
                <?php
                }
                ?>
            </select>
            <br><br>
            <h1>Horario</h1>
            <br>
            <input type="time" name="time" min="09:00" max="23:00" required>
            <br><br><br>            

            <button type="submit">Aceptar</button>
        </form>
    </div>
    
</body>
</html>