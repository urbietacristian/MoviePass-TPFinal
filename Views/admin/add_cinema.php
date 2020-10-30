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
    <div align = 'center'>
        <?php
        if(isset($_SESSION['msg']))
        {
            echo '<script language="javascript">alert("'.$_SESSION['msg'].'");</script>';
            $_SESSION['msg'] = null;
        }
        ?>
        <h1>Agregar Cine</h1>
        <form action="<?php echo FRONT_ROOT ?>Cinema/register"   method='post' >
            <h1>Cine:</h1>
            <br>
            <input name='name' type="text" name="cinemaName" placeholder="Nombre del Cine" required>
            <br><br>
            <h1>Direccion</h1>
            <br>
            <input name='address' type="text" name="cinemaAdress" placeholder="Direccion del Cine" required>
            <br><br><br>
            

            <button type="submit">Aceptar</button>
        </form>
    </div>
    
</body>
</html>