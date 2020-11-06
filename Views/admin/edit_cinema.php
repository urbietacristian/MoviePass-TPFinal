
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
    <br><br>
    <h1>Editar Cine</h1>
    <br><br>
    <form action="<?php echo FRONT_ROOT ?>Cinema/editCinema"   method='post'>
        <input type="hidden" name="id" value="<?php echo $Cinema->getId();?>" />
        <h1>Cine:</h1>
        <input name='name' value="<?php echo $Cinema->getName();?>" type="text" name="cinemaName" placeholder="Nombre del Cine" required>
        <br><br>
        <h1>Direccion</h1>
        <input name='address' value="<?php echo $Cinema->getAddress();?>" type="text" name="cinemaAdress" placeholder="Precio del Cine"required>
        <br>

        <button type="submit">Aceptar</button>
    </form>
    </div>
    
</body>
</html>