<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/main.css">
    <title>Document</title>
</head>
<body>
    <section class="login-section">
        <div class="container">
            <div class="login-container" id="login-container">
                
                <img src="./imgs/user-alt-1-svgrepo-com.svg" alt="">
                <h2>Login</h2>
                <form class="form-container" action="">
                    <input class="form-input" id="login-username" type="text" placeholder="Username">
                    <input class="form-input" id="login-password" type="password" placeholder="Password">
                    <input class="btn-login-main" id="login-btn" type="submit" value="Log In">
                </form>
                <a id="link-password" class="link-password" href="#">Forgot password?</a>
            </div>
            <div class="signin-container" id="signin-container">
                <img src="./imgs/user-plus-alt-1-svgrepo-com.svg" alt="">
                <h2>Sign In</h2>
                <form class="form-container" action="">
                    <input class="form-input" id="signin-username" type="text" placeholder="Username">
                    <input class="form-input" id="signin-email" type="text" placeholder="Email">
                    <input class="form-input" id="signin-password" type="password" placeholder="Password">
                    <input class="btn-login-main" id="signin-btn" type="submit" value="Sign in">
                 </form>
            </div>
        </div>
    </section>
    <script src="./js/login.js"></script>
</body>
</html>