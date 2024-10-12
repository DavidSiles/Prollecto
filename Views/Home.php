<?php 
session_start();
$_SESSION["logged"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="CSS/Home.css" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="Packages/slick/slick.css">
    <link rel="stylesheet" type="text/css" href="Packages/slick/slick-theme.css">
</head>
<body>
    <header>
        <form class="menu" action="" method="POST">
            <button><img src="IMG/menu/CATALOGO.png" alt="CATALOGO"></button>
        </form>
        <form class="menu" action="" method="POST">
            <button><img src="IMG/menu/LISTAS.png" alt="LISTAS"></button>
        </form>
        <form class="menu" action="" method="POST">
            <button><img src="IMG/menu/FORO.png" alt="FORO"></button>
        </form>
        <form class="menu" action="Perfil.php" method="POST">
            <button><img src="IMG/menu/USER.webp" alt="USER"></button>
        </form>
        <?php 
            if($_SESSION["logged"] == false){ ?>
                <form id="form_index" action="Index.php">
                    <button id="index">Index</button>
                </form>
        <?php }?>
    </header>

    <div id="filmImg1"> 
        <form class="populares" action="Film.php" method="POST">
            <button><img src="IMG/la-sociedad-de-la-nieve.jpeg" alt="la-sociedad-de-la-nieve"></button>
        </form>
        <form class="populares" action="Film.php" method="POST">
            <button><img src="IMG/la-sociedad-de-la-nieve.jpeg" alt="la-sociedad-de-la-nieve"></button>
        </form>
        <form class="populares" action="Film.php" method="POST">
            <button><img src="IMG/la-sociedad-de-la-nieve.jpeg" alt="la-sociedad-de-la-nieve"></button>
        </form>
        <form class="populares" action="Film.php" method="POST">
            <button><img src="IMG/la-sociedad-de-la-nieve.jpeg" alt="la-sociedad-de-la-nieve"></button>
        </form>
    </div>
    <h3>Populares</h3>
    <div id="filmImg2">
        <div class="slider">
            <form class="recomentImg" action="Film.php" method="POST">
                <button><img src="IMG/titanic.jpeg" alt="titanic"></button>
            </form>
        </div>
        <div class="slider">
            <form class="recomentImg" action="Film.php" method="POST">
                <button><img src="IMG/alien.jpeg" alt="alien"></button>
            </form>
        </div>
        <div class="slider">
            <form class="recomentImg" action="Film.php" method="POST">
                <button><img name="" src="IMG/iron-man.jpeg" alt="iron-man"></button>
            </form>
        </div>
        <div class="slider">
            <form class="recomentImg" action="Film.php" method="POST">
                <button><img src="IMG/mad-max.jpeg" alt="mad-max"></button>
            </form>  
        </div>


        <div class="slider">
            <form class="recomentImg" action="Film.php" method="POST">
                <button><img src="IMG/titanic.jpeg" alt="titanic"></button>
            </form>
        </div>
        <div class="slider">
            <form class="recomentImg" action="Film.php" method="POST">
                <button><img src="IMG/alien.jpeg" alt="alien"></button>
            </form>
        </div>
        <div class="slider">
            <form class="recomentImg" action="Film.php" method="POST">
                <button><img src="IMG/iron-man.jpeg" alt="iron-man"></button>
            </form>
        </div>
        <div class="slider">
            <form class="recomentImg" action="Film.php" method="POST">
                <button><img src="IMG/mad-max.jpeg" alt="mad-max"></button>
            </form>  
        </div>


    </div>

    <div id="filmImg3">
        <div class="slider">
            <form class="recomentImg" action="Film.php" method="POST">
                <button><img src="IMG/titanic.jpeg" alt="titanic"></button>
            </form>
        </div>
        <div class="slider">
            <form class="recomentImg" action="Film.php" method="POST">
                <button><img src="IMG/alien.jpeg" alt="alien"></button>
            </form>
        </div>
        <div class="slider">
            <form class="recomentImg" action="Film.php" method="POST">
                <button><img src="IMG/iron-man.jpeg" alt="iron-man"></button>
            </form>
        </div>
        <div class="slider">
            <form class="recomentImg" action="Film.php" method="POST">
                <button><img src="IMG/mad-max.jpeg" alt="mad-max"></button>
            </form>  
        </div>
    </div>
</body>
    <script src="Packages/jquery-3.7.1.min.js"></script>
    <script src="Packages/slick/slick.js"></script>
    <script src="Packages/slick/slick.min.js"></script>
    <script src="JS/sliderHome.js"></script>
</html>