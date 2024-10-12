<?php
session_start();
if($_SESSION["logged"] === true){
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
            <p><strong>Username:  </strong> <?php echo $_SESSION["username"]; ?></p>
            <p><strong>Admin: </strong> <?php 
            if(($_SESSION["user_admin"] == true)||($_SESSION["user_admin"] == 1)){
                echo "Admin User";
            }else{
                echo "Normal User";
            }    
            ?></p>      
            </div>
        </div>   

        <div class="container2">
        <?php
        if($_SESSION["logged"] === true){
            if(($_SESSION["user_admin"] == true)||($_SESSION["user_admin"] == 1)){
        ?>
            <div>
                <form action="EditPerfil.php" method="POST"> 
                    <button type="submit" class="un-boton" name="boton">Editar perfil</button>
                </form>
            </div>
        <?php 
            }else{
        ?>
                <div>
                <form action="../Controller/UserController.php" method="POST">
                    <button type="submit" class="un-boton2" name="deleteUser">Delete User</button>
                </form>
                </div>
        <?php
            }
        ?>
            <br>
            <div>
                <form action="../Controller/UserController.php" method="POST">
                    <button type="submit" class="un-boton" name="logout">Log out</button>
                </form>
            </div>
        <?php
        } 
        ?>
        </div>
        <h3>
            <?php
                if($_SESSION["error"] != ""){
                    echo $_SESSION["error"];
                }
            ?>
        </h3>
        
    </body>
    <script src="Packages/jquery-3.7.1.min.js"></script>
    <script src="JS/remuveError.js"></script>
</html>
<?php
}else{
    header("Location: ../Views/Home.php");
}
?>   