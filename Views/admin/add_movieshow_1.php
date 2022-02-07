<?php
require_once(VIEWS_PATH . "navAdmin.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Función - Paso 1</title>
</head>

<body>
    <div align='center'>
        <h1>Agregar función para "<?php echo $movie->getName() ?>"</h1>
        <form action="<?php echo FRONT_ROOT ?>MovieShow/ShowAddFunctionCinema2/<?php echo $id_movie ?>" method='post'>
            <h1>Cine:</h1>
            <br>
            <select type="select" name="id_cinema" required>
                <?php
                foreach ($cinemaList as $cinema) {
                ?>
                    <option value="<?php echo $cinema->getId() ?>"><?php echo $cinema->getName() ?></option>
                <?php
                }
                ?>
            </select>
            <br><br>
            <h1>Fecha</h1>
            <br>
            <input type="date" name="date" value=<?php echo date('Y-m-d'); ?> min=<?php echo date('Y-m-d', strtotime('+1days')); ?> required />
            <input type="hidden" name="id_movie" value='<?php echo $id_movie ?>' />
            <br><br><br>

            <button type="submit">Aceptar</button>
        </form>
    </div>

</body>

</html>