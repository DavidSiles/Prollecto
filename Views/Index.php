<?php
session_start();
$_SESSION["logged"] = false;
$_SESSION["error"] = "";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link href="CSS/Index.css" rel="stylesheet"/>  
    <link href="CSS/cookies.css" rel="stylesheet"/>  
</head>


<body >
    <div class="body1">
        <div id="titulo1">
            <h1>OBIFY</h1>
            <form action="Login.php" method="POST">
                <button type="submit" class="mi-boton" name="login">Entrar con usuario</button><br>
            </form>
            <form action="../Controller/UserController.php" method="POST">
                <button type="submit" class="mi-boton" name="goHome">Entrar sin usuario</button><br>
            </form>
            <form action="../Controller/UserController.php" method="POST">
                <div>
                    <h6>No tienes cuenta?<h6>
                </div>
                <button type="submit" class="el-boton" name="Register">Crear</button>
            </form>
            
            <h6 id="text2">Al registrarte, aceptas nuestros términos de<br> servivio, política de privacidad y<br>
                directrices de la comunidad. 
            </h6>
        
            </form>
            
        </div>
    </div>

    <div class="cookie-container">
        <p>Esta web utiliza cookies para asegurar una mejor experiencia de usuario. Para más información sobre 
            nuestra política de cookies y  <a href ="#">política de privacidad </a>    
        </p>
        <button class="cookie-btn">Aceptar</button>
        <button class="cookie-btn1">No ceptar</button>

    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="JS/cookies.js"></script>
    

</body>
</html>
