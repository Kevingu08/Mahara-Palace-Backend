<?php

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/main.css">
    <title>Administration</title>
</head>

<body>
    <!-- header -->
    <header class="hero-container">
        <!-- Barra de navegacion -->
        <nav class="top-nav" id="top-navigation">
            <a href="./index.html"><img class="logo-maharaja" src="../imgs/Maharaja-palace-logo.png"
                    alt="Maharaja palace logo"></a>

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
                <li><a class="nav-list-link" href="menu.php">Menu</a></li>
                <li><a class="nav-list-link" href="#footer">About Us</a></li>
                <li><a class="nav-list-link" href="#footer">Contact</a></li>
            </ul>
            <a href="#" class="btn-login">Log In / Sing In</a>
        </nav>
        <!-- Barra de navegacion -->
    </header>
    <!-- header -->



    <!-- main -->
    <main class="admin">
        <div class="main-container">
            <!--SideBar-->
            <sidebar class="sidebar">
                <nav class="sidebar-list">
                    <ul class= "sidebar-ul">
                        <li class="sidebar-li"><a href="#" class="sidebar-text">Add Dish</a></li>
                        <li class="sidebar-li"><a href="#" class="sidebar-text">Dish list</a></li>
                        <li class="sidebar-li"><a href="#" class="sidebar-text">User list</a></li>
                        <li class="sidebar-li"><a href="#" class="sidebar-text">Add User</a></li>
                    </ul>
                </nav>
            </sidebar>
            <!--SideBar-->

            <section class="table-container">
                <h2 class="section-title">Administration</h2>
                <div class="underscore"></div>
                <div class="admin-container">
                    <div class="table-container">

                        <div class="admin-text">
                            <label for="destination_lname">Dish name:</label>
                            <input id="destination_lname" class="input-admin" name="destination_lname" type="text">
                        </div>

                        <div class="admin-text">
                            <label for="destination_description">Dish description:</label>
                            <input id="destination_description" class="input-admin" name="destination_description"
                                type="text">
                        </div>

                        <div class="admin-text">
                            <label for="destination_price">Dish category:</label>
                            <input id="destination_price" class="input-admin" name="destination_price" type="text">
                        </div>

                        <div class="admin-text">
                            <label for="destination_price">Dish price:</label>
                            <input id="destination_price" class="input-admin" name="destination_price" type="text">
                        </div>

                        <div class="admin-text">
                            <label for="destination_price">People quantity:</label>
                            <input id="destination_price" class="input-admin" name="destination_price" type="text">
                        </div>

                        <div class="admin-text admin-forms">
                            <label for="**" class="admin-text">Dish Image</label>
                            <img id="preview" src="./imgs/destination-placeholder.webp" alt="Preview">
                            <input id="destination_image" type="file" name="dish_image" onchange="readURL(this)">
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
    <!-- main -->
</body>

</html>