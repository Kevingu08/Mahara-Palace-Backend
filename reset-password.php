<?php 
    require_once "./database.php";
    $message = "";

    if($_POST){
        $user = $database->select("tb_users","*",[
            "usr" => $_POST["username"]
        ]);

        if(count($user) > 0){
            if($_POST["password"] == $_POST["confirm_password"]){
                $passwordHash = password_hash($_POST["password"], PASSWORD_DEFAULT, ['cost' => 10]);

                $database->update("tb_users",[
                    "password" => $passwordHash,
                ],[
                    "usr" => $_POST["username"]
                ]);
                header("Location: login.php");
            }
            else{
                $message = "passwords do not match";
            }
        }
        else{
            $message = "wrong user";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/main.css">
    <title>Reset Password</title>
</head>
<body>

    <main>  
        <section class="reset-password-section">
            <div class="reset-password-container">
                <div class="container-image">
                    <img class="logo-maharaja" src="./imgs/Maharaja-palace-logo.png" alt="Maharaja palace logo">
                </div>
                <div class="container-content">
                    <h2>Reset your password</h2>
                    <form method="post" action="reset-password.php" class="form-container">
                        <input type="password" placeholder="username" class="form-item" name="username">
                        <input type="password" placeholder="new password" class="form-item" name="password">
                        <input type="password" placeholder="confirm password" class="form-item" name="confirm_password">
                        <?php 
                            echo $message;
                        ?>
                        <input type="submit" class="btn-main" value="reset password">
                    </form>
                </div>
            </div>
        </section>
    </main>

    <?php 
        include "./parts/footer.php";
    ?>
</body>
</html>