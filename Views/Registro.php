<?php
session_start();
$_SESSION["registerToAdmin"] = false;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link href="CSS/Registro.css" rel="stylesheet"/>
</head>
<body>
    <form id="formReg" action="../Controller/UserController.php" method="POST"> 
    <h3 class="error">
        <?php   
            if($_SESSION["logged"] === false){
                echo $_SESSION["error"];
            }
        ?>
    </h3>
        <h1>Solo te llevará un minuto</h1>

        <label for="mail">Correo</label>
        <input type="text" id="mail" name="mail" required><br><br>
        <label for="username">Username</label>
        <input type="text" maxlength="10" id="username" name="username" required><br><br>
        <div></div>
        <label for="password1">Contraseña</label>
        <input type="password" id="password1" name="password1" required><br><br>
        <label for="password2">Repetir Contraseña</label>
        <input type="password" id="password2" name="password2" required><br><br>
        <button type="submit" id="buttonRegister" name="register">Crear cuenta</button> 
    </form>
    <form id="changeRegister" action="Registro_admin.php" method="POST"> 
        <button id="buttonChangeRegister" type="submit" name="register_admin">Hacer cuenta Admin</button> 
    </form>

</body>
<script src="Packages/jquery-3.7.1.min.js"></script>
<script src="Packages/jquery-validation-1.19.5/dist/jquery.validate.js"></script>
<script src="JS/validatorRegister.js"></script>
<script src="JS/remuveError.js"></script>
</html>
