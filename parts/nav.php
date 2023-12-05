<?php 
// session_start();
// session_destroy();
    $path = "login.php";
    $iconPath = "./imgs/add-user.svg";
    if($_SESSION){
        $iconPath = "./imgs/user-icon.svg";
        $path = "user-profile.php";
    }
?>

<nav class="top-nav" id="top-navigation">
    <a href="./index.php"><img class="logo-maharaja" src="./imgs/Maharaja-palace-logo.png" alt="Maharaja palace logo"></a>

    <!-- mobile nav -->
    <input class="mobile-check" type="checkbox" id="mobile-check">
    <label class="mobile-btn">
        <span class="line-menu firts-line-menu"></span>
        <span class="line-menu second-line-menu"></span>
        <span class="line-menu third-line-menu"></span>
    </label>
    <!-- mobile nav -->

    <ul class="nav-list" id="navigation-list">
        <li><a class="nav-list-link" href="index.php">Home</a></li>
        <li><a class="nav-list-link" href="#categories-container">Menu</a></li>
        <li><a class="nav-list-link" href="#footer">About Us</a></li>
        <li><a class="nav-list-link" href="#footer">Contact</a></li>
    </ul>

    <div class="icon-nav-container">
        <form method="get" action="results.php" class="search-container-form">
            <input id="search" class="search" type="text" name="keyword">
            <input type="submit" class="search-btn" value="">
        </form>
        <a href="<?php echo $path?>" class=""><img class="icon-nav" src="<?php echo $iconPath?>" alt=""></a>
        <a href="shopping-cart.php"><img class="icon-nav" src="./imgs/shopping-cart-svgrepo-com.svg" alt="shopping cart"></a>
    </div>
</nav>