<?php 
    require_once './database.php';

    $loginMessage = "";
    $signinMessage = "";    
    // Reference: https://medoo.in/api/select
    // Reference: https://medoo.in/api/insert
    if($_POST){
        //apartado de login
        if(isset($_POST["login"])){
            $user = $database->select("tb_users","*",[
                "usr"=>$_POST["username"]
            ]);

            if(count($user) > 0){
                if(password_verify($_POST["password"], $user[0]["password"])){
                    session_start();
                    $_SESSION["isLoggedIn"] = true;
                    $_SESSION["id"] = $user[0]["id_user"];
                    $_SESSION["fullname"] = $user[0]["fullname"];
                    if($user[0]['is_admin']=='y'){
                        header("location: ./admin/list-dishes.php");
                    }else{
                        header("location: index.php");
                    }
                }
                else{
                    $loginMessage = "wrong username or password";
                }
            }
            else{
                $loginMessage = "wrong username or password";
            }
        }
        //apartado de registro
        if(isset($_POST["signin"])){
            $validateUsername = $database->select("tb_users","*",[
                "usr"=>$_POST["username"]
            ]);

            if(count($validateUsername) > 0){
                $signinMessage = "¡This username is already registered!";
            }
            else{
                $pass = password_hash($_POST["password"], PASSWORD_DEFAULT, ['cost' => 10]);
                $database->insert("tb_users",[
                    "fullname"=>$_POST["fullname"],
                    "usr"=>$_POST["username"],
                    "email"=>$_POST["email"],
                    "password"=>$pass
                    ]);
            } 
        }       
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/main.css">
    <title>Login/sign in</title>
</head>
<body>
    <?php 
        include "./parts/nav.php";
    ?>
    <section class="login-section">
        <div class="container">
            <div class="login-container" id="login-container">
                
                <img src="./imgs/user-alt-1-svgrepo-com.svg" alt="">
                <h2>Login</h2>

                <form class="form-container" method="post" action="login.php">
                    <input class="form-input" id="login-username" type="text" placeholder="Username" name="username">
                    <input class="form-input" id="login-password" type="password" placeholder="Password" name="password">
                    <input class="btn-login-main" id="login-btn" type="submit" value="Log In">
                    <p><?php echo $loginMessage?></p>
                    <input type="hidden" name="login" value="1">
                </form>

                <a id="link-password" class="link-password" href="reset-password.php">Forgot password?</a>
            </div>
            <div class="signin-container" id="signin-container">
                <img src="./imgs/user-plus-alt-1-svgrepo-com.svg" alt="">
                <h2>Sign In</h2>
                <form class="form-container" method="post" action="login.php">
                    <input class="form-input" id="signin-fullname" type="text" placeholder="Fullname" name="fullname"> 
                    <input class="form-input" id="signin-username" type="text" placeholder="Username" name="username"> 
                    <input class="form-input" id="signin-email" type="text" placeholder="Email" name="email">
                    <input class="form-input" id="signin-password" type="password" placeholder="Password" name="password">
                    <input class="btn-login-main" id="signin-btn" type="submit" value="Sign in">
                    <p><?php echo $signinMessage?></p>
                    <input type="hidden" name="signin" value="1">
                 </form>
            </div>
        </div>
    </section>
    <?php 
        include "./parts/footer.php";
    ?>
    <script src="./js/login.js"></script>
</body>
</html>