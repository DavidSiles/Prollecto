<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="CSS/Login.css" rel="stylesheet"/>
</head>
<body>
<div id="box1">
        <form id="formLog" action="../Controller/UserController.php" method="POST">
        <h3 class="error">
        <?php
            if(($_SESSION["logged"] === false)){
                echo $_SESSION["error"];
            }  
        ?>
        </h3>
        <div>
            <label for="username">Usuario</label><br>
            <input type="text" id="username" name="username"><br><br>
            <label for="password">Contraseña</label><br>
            <input type="password" id="password" name="password"><br><br>
            <div id="button1">
                <button name="login">Entrar</button>
            </div>
        </div>
        </form>
</div>
<div>
    <img src="IMG/Logos/Obify Logo final.png" alt="obify">
</div>
</body>
<script src="Packages/jquery-3.7.1.min.js"></script>
<script src="Packages/jquery-validation-1.19.5/dist/jquery.validate.js"></script>
<script src="JS/validatorLogin.js"></script>
<script src="JS/remuveError.js"></script>
</html>
