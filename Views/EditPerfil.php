<?php
session_start();
if($_SESSION["logged"] === true){
    //$_SESSION['perfilimg'];
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>perfil</title>
        <link href="CSS/Perfil.css" rel="stylesheet"/>
    </head>
    <body>
        <header>
            <form action="Home.php" method="POST">
                <button type="submit" class="mi-boton" name="boton">Go Home</button><br>
            </form> 
        </header>
        <br>
        <br>
        <div>
        
        <?php 
        if($_SESSION['path_img'] != null){
            $image = $_SESSION['path_img'];
            echo("<img src='IMG\\$image' alt='profile image' id='profileimg'>");   
        } 
        ?>

        </div>
        <br>
        <div>
        <p id="datos">Datos personales </p>
        <div class="card">
            <div class="info">
            <form action="../Controller/UserController.php" method="POST"> 
                    <button type="submit" class="buttonToEdit" name="editNamePass">Edit User</button>
                
                <p>
                    <strong>Username:  </strong>            
                    <input type="text" name="newName" value="<?php echo $_SESSION["username"]; ?>" > 
                </p>
                <p>
                    <strong>Contraseña: </strong> 
                    <input type="password" name="newPass" value="" >
                </p>
                <p>
                    <strong>Admin: </strong>  <?php echo $_SESSION["user_admin"]?> 
                </p>  
                </form>    
            </div>
        </div>   

        <div class="container2">
            <div>
                <form action="Perfil.php" method="POST"> 
                    <button type="submit" class="un-boton" name="boton">Cancel</button>
                </form>
            </div>
            <br>
            <div>
                
            </div>
            <br>
            <div>
                <form action="../Controller/UserController.php" method="POST">
                    <button type="submit" class="un-boton2" name="editImg">Edit Image</button>
                    <input id="imagen" name="imagen" size="30" type="file">
                </form>
            </div>
            <div>
                <form action="../Controller/UserController.php" method="POST">
                    <button type="submit" class="un-boton2" name="deleteUser">Delete User</button>
                </form>
            </div>
        </div>
    </body>
</html>
<?php
}else{
    header("Location: ../Views/Home.php");
}
?>   