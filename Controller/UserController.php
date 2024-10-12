<?php
session_start();

$user = new UserController();    

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST["login"])){
        echo "Enter Login";
        $user->login();

    }else if(isset($_POST["goHome"])){
        $_SESSION["logged"] = false;
        header("Location: ../Views/Home.php");

    }else if(isset($_POST["Register"])){
        $_SESSION["error"] = "";
        header("Location: ../Views/Registro.php");
    }else if(isset($_POST["register"])){
        echo "Enter Register";
        $user->register();

    }else if(isset($_POST["logout"])){
        echo "Enter logout";
        $user->logout();
    }else if(isset($_POST["editNamePass"])){
        echo "";
        $user->editPerfil();
    }else if(isset($_POST["deleteUser"])){
        $user->deleteMyUser();
    }
}

class UserController{

    private $conn;

    public function __construct(){
        
        $localhost = "localhost";
        $root = "root";
        $password = "";
        $obify = "obifyV2";

    /* Connection by sqli
        $this->conn = new mysqli($localhost,$root,$password,$obify);
        if($this->conn->connect_error){
            die("Connection failed: " . $this->conn->connect_error);
        }else{
            echo "Connected successfully";
        }
    */
        $connection = "mysql:hos=".$localhost.";dbname=".$obify.";charset=utf8";
        try {
            $this->conn = new PDO($connection, $root, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(Exception $e) {
            $this->conn = "Conection error";
            echo "ERROR: ".$e->getMessage();
        }

    }

    public function login(): void {
        $username = $_POST["username"];
        $password = $_POST["password"];
        /*
            $stmt = $this->conn->prepare("SELECT user_admin, path_img FROM usuario WHERE user_name=? and password_u=?");
            $stmt->bind_param("ss",$username,$password);
            */  
        // Consulta para seleccionar los datos del usuario basado en el username (case-sensitive)
        $sql_select = "SELECT password_u, user_admin, path_img FROM usuario WHERE BINARY user_name = :username";
        $stmt = $this->conn->prepare($sql_select);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
    
        // Obtener los datos del usuario
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($user && password_verify($password, $user['password_u'])) {
            // Si la contraseña es correcta, establecer las variables de sesión
            $_SESSION["user_admin"] = $user['user_admin'];
            $_SESSION['path_img'] = $user['path_img'];
            $_SESSION["logged"] = true;
            $_SESSION["username"] = $username;
            $_SESSION["password"] = $password;
            echo "Datos correctos";
            
            // Redirigir al perfil del usuario
            $_SESSION["error"] = "Wellcome: $username";
            header("Location: ../Views/Perfil.php");
            exit();
        } else {
            // Si la contraseña es incorrecta, establecer un mensaje de error
            $_SESSION["error"] = "Error, el nombre o la contraseña del usuario no son correctos";
            $_SESSION["logged"] = false;
            
            // Redirigir a la página de inicio de sesión
            header("Location: ../Views/Login.php");
            exit();
        }
    }
    
    public function logout(): void{
        unset($_SESSION["username"]);
        unset($_SESSION["password"]);
        $_SESSION["logged"] = false;
        header("Location: ../Views/Index.php");
    }

    public function register(): void{
        
        $mail = $_POST["mail"];
        $username = $_POST["username"];
        $password1 = $_POST["password1"];
        $password2 = $_POST["password2"];
        $nameImage = $_FILES['image']['name'];
        $typeImage = $_FILES['image']['type'];
        $sizeImage = $_FILES['image']['size'];

        if (!empty($nameImage) && ($sizeImage <= 2000000)) {
            //check format
            if (($typeImage == "image/jpeg")
                || ($typeImage == "image/jpg")
                || ($typeImage == "image/png")
            ) {
                // path to save images
                $target_dir = "../Views/IMG/fotoperfil";
                // define folder + name of file
                $target_file = $target_dir . basename($nameImage);
                // move image from temporal folder to image server folder
                if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                    echo "uploading";
                } else {
                    //in case any error moving to server
                    $_SESSION['error'] = "Error uploading";
                    $_SESSION['error'] = $target_file;
                    // redirect to register page
                    header("Location: ../view/Registro.php");
                }
                
            } else {
                //in case any error in format image
                $_SESSION['error'] = "Invalid image format";
                // redirect to register page
                header("Location: ../view/Registro.php");
            }
        } else {
            //in case error in size image
            if ($nameImage == !NULL) {
                $_SESSION['error'] = "Invalid image size";
                // redirect to register page
                header("Location: ../view/Registro.php");
                exit();
            }
        }
        // Comprobar el mail si es formato valido
        if(!filter_var($mail, FILTER_VALIDATE_EMAIL)){
            $_SESSION["error"] = "Invalid email format";
            $_SESSION["logged"] = false;
            header("Location: ../Views/Registro.php");
            exit();
        }

        // Comprobar que la password es igual
        if($password1 === $password2){
            $password = password_hash($password1, PASSWORD_DEFAULT);
        /*
            $stmt = $this->conn->prepare("SELECT mail, user_name FROM usuario WHERE mail LIKE ? OR user_name LIKE ?");
            $stmt->bind_param("ss",$mail,$username);
            $stmt->execute();
            $stmt->store_result(); 
        */
            $sql_select = "SELECT mail, user_name FROM usuario WHERE mail = :mail OR user_name = :username";
            $stmt_select = $this->conn->prepare($sql_select);
            $stmt_select->bindParam(':mail', $mail, PDO::PARAM_STR);
            $stmt_select->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt_select->execute();

            // Obtener resultados antes de verificar el número de filas
            $stmt_select->bindColumn('mail', $_SESSION['email']);
            $stmt_select->bindColumn('user_name', $_SESSION['name']);
            $stmt_select->fetch(); // Obtener los resultados

            if ($stmt_select->rowCount() > 0) {
                // Verificar si los valores de la sesión ya existen en la base de datos
            if ($mail === $_SESSION['email']) {
                $_SESSION["error"] = "This email has already been used: ".$_SESSION['email'];
            } else if ($_SESSION['name'] === $username) {
                $_SESSION["error"] = "This username already exists: ".$_SESSION['name'];   
            }
            $_SESSION["logged"] = false;
            header("Location: ../Views/Registro.php");
            exit();
            } else {
                
                if ($_SESSION["registerToAdmin"] == true) {
                    $userAdmin = true;
                    /*
                        $stmt = $this->conn->prepare("INSERT INTO usuario (mail,user_name,password_u,user_admin,path_img) VALUES (?,?,?,?,?)");
                        $stmt->bind_param("sssis", $mail, $username, $password, $userAdmin, $nameImage);
                    */
                    $sql_insert = "INSERT INTO usuario (mail,user_name,password_u,user_admin,path_img) VALUES (:mail,:username,:pass,:userAdmin,:nameImage)";
                    $stmt_inset = $this->conn->prepare($sql_insert);    
                        $stmt_inset->bindParam(":mail", $mail, PDO::PARAM_STR);
                        $stmt_inset->bindParam(":username",$username,PDO::PARAM_STR);
                        $stmt_inset->bindParam(":pass",$password,PDO::PARAM_STR);
                        $stmt_inset->bindParam(":userAdmin",$userAdmin,PDO::PARAM_BOOL);
                        $stmt_inset->bindParam(":nameImage",$nameImage,PDO::PARAM_STR);

                } else {
                    $userAdmin = false;
                    $nameImage = "default.png";
                    /*
                        $stmt = $this->conn->prepare("INSERT INTO usuario (mail,user_name,password_u) VALUES (?,?,?)");
                        $stmt->bind_param("sss", $mail, $username, $password);
                    */
                    $sql_insert = "INSERT INTO usuario (mail,user_name,password_u,user_admin,path_img) VALUES (:mail,:username,:pass,:userAdmin,:nameImage)";
                        $stmt_inset = $this->conn->prepare($sql_insert); 
                        $stmt_inset->bindParam(":mail", $mail, PDO::PARAM_STR);
                        $stmt_inset->bindParam(":username",$username,PDO::PARAM_STR);
                        $stmt_inset->bindParam(":pass",$password,PDO::PARAM_STR);
                        $stmt_inset->bindParam(":userAdmin",$userAdmin,PDO::PARAM_BOOL);
                        $stmt_inset->bindParam(":nameImage",$nameImage,PDO::PARAM_STR);
                }
                $stmt_inset->bindColumn('path_img', $_SESSION["path_img"]);
                if ($stmt_inset->execute()) {

                    $_SESSION["logged"] = true;
                    $_SESSION["username"] = $username;
                    $_SESSION["password"] = $password;
                    if ($userAdmin == true) {
                        $_SESSION["user_admin"] = true;
                        $_SESSION["nameImage"] = $nameImage;
                    }else{
                        $_SESSION["user_admin"] = false;
                        $_SESSION["nameImage"] = 'default.png';
                    }
                    $_SESSION["error"] = "Register was successful";
                    header("Location: ../Views/Perfil.php");
                    exit();
                }   
            }
        }else {
            $_SESSION["logged"] = false;
            $_SESSION["mail"] = $mail;
            $_SESSION["username"] = $username;
            $_SESSION["error"] = "The passwords are not equal";
            header("Location: ../Views/Registro.php");
            exit();
    }   
    }  

    public function editPerfil(): void{

        $newUsername = $_POST["newName"];
        $newPassword = $_POST["newPass"];
        $oldUsername = $_SESSION["username"];
        $oldPassword = $_SESSION["password"];
        
        $sql_select = ("SELECT user_id, password_u FROM usuario WHERE user_name = :username");
        $stmt = $this->conn->prepare($sql_select);
        $stmt->bindParam(':username',$oldUsername, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($user && password_verify($oldPassword, $user['password_u'])){
            $password = password_hash($newPassword, PASSWORD_DEFAULT);

            $sql_check = "SELECT user_id FROM usuario WHERE user_name = :newUsername AND user_id != :userId";
            $stmt_check = $this->conn->prepare($sql_check);
            $stmt_check->bindParam(':newUsername', $newUsername, PDO::PARAM_STR);
            $stmt_check->bindParam(':userId', $user['user_id'], PDO::PARAM_INT);
            $stmt_check->execute();
            
            if ($stmt_check->rowCount() > 0) {
                $_SESSION["error"] = "Error, el nombre ya existe";
            } else {
                // Actualizar el nombre de usuario y la contraseña
                $sql_update = "UPDATE usuario SET user_name = :username, password_u = :pass WHERE user_id = :id";
                $stmt_update = $this->conn->prepare($sql_update);
                $stmt_update->bindParam(':id', $user['user_id'], PDO::PARAM_INT);
                $stmt_update->bindParam(':username', $newUsername, PDO::PARAM_STR);
                $stmt_update->bindParam(':pass', $password, PDO::PARAM_STR);
                
                if ($stmt_update->execute()) {
                    $_SESSION["password"] = $newPassword;
                    $_SESSION["username"] = $newUsername;
                    $_SESSION["error"] = "El update ha sido correcto";
                    header("Location: ../Views/Perfil.php");
                    exit();
                } else {
                    $_SESSION["error"] = "El update ha fallado";
                }
            }
        } else {
            $_SESSION["error"] = "Error, no se encontro al usuario";
        }
        header("Location: ../Views/Perfil.php");
    }

    public function deleteMyUser(): void{
        $username = $_SESSION["username"];
        $password = $_SESSION["password"];

        $sql_select = ("SELECT user_id FROM usuario WHERE user_name = :username");
        $stmt = $this->conn->prepare($sql_select);
        $stmt->bindParam(':username',$username, PDO::PARAM_STR);
        $stmt->execute();
        $stmt->bindColumn('user_id',$_SESSION['user_id']);
        if($stmt->fetch()){
            
            $sql_delete = "DELETE FROM usuario WHERE user_id = :user_id";
            $stmt_delete = $this->conn->prepare($sql_delete);
            $stmt_delete->bindParam('user_id',$_SESSION['user_id'],PDO::PARAM_INT);
            $stmt_delete->execute();

            if ($stmt_delete->rowCount() > 0) {
                header("Location: ../Views/Index.php");
            } else {
                $_SESSION["error"] = "El delete ha fallado";
                header("Location: ../Views/Perfil.php");
            }
        }else{
            $_SESSION["error"] = "no se ha encontrado el usuario en la base de datos";
                header("Location: ../Views/Perfil.php");
        }
    }
}

?>