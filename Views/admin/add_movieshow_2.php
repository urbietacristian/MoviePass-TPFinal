<?php
require_once(VIEWS_PATH . "navAdmin.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Función - Paso 2</title>
</head>

<body>
    <div align='center'>
        <h1>Agregar Función para "<?php echo $movie->getName(); ?>" en <?php echo $cinema->getName(); ?> </h1>
        <form action="<?php echo FRONT_ROOT ?>MovieShow/ShowAddFunctionCinemaEnd/<?php echo $id_movie; ?>" method='post'>
            <h1>Sala:</h1>
            <br>
            <select type="select" name="id_room" required>
                <?php
                foreach ($roomList as $room) {
                ?>
                    <option value="<?php echo $room->getId(); ?>"><?php echo $room->getName(); ?></option>
                <?php
                }
                ?>
            </select>
            <br><br>
            <h1>Horario</h1>
            <br>
            <input type="time" name="time" value="12:00:00" min="09:00:00" max="23:00:00" required>
            <br><br><br>
            <input type="hidden" name='id_cinema' value="<?php echo $id_cinema ?>">
            <input type="hidden" name='date' value="<?php echo $date ?>">
            <input type="hidden" name='id_movie' value="<?php echo $id_movie ?>">

            <button type="submit">Aceptar</button>
        </form>
    </div>

</body>

</html>