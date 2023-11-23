<?php
require_once '../database.php';

$dishes = $database->select("tb_dishes", "*");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>list-dishes</title>
    <link rel="stylesheet" href="../css/main.css">
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
            <?php
            include "../parts/sidebar.php";
            ?>
            <!--SideBar-->

            <div class="tabular-wrapper">
                <h3 class="admin-title">Dishes list</h3>
                <div class="underscore-admin"></div>
                <div class="table-container">
                    <table class="table">
                        <thead class="table-head">
                            <tr class>
                                <th class="table-th">Dish name</th>
                                <th class="table-th">Featured</th>
                                <th class="table-th">Category</th>
                                <th class="table-th">Price </th>
                                <th class="table-th">Quantity</th>
                                <th class="table-th">Actions</th>
                            </tr>
                        <tbody class="table-body">
                            <?php
                            foreach ($dishes as $dish) {
                                echo "<tr class='table-tr'>";
                                echo "<td class='table-td'>" . $dish["dish_name"] . "</td>";
                                echo "<td class='table-td'>" . $dish["featured_dish"] . "</td>";
                                echo "<td class='table-td'>" . $dish["id_dish_category"] . "</td>";
                                echo "<td class='table-td'>" . $dish["dish_price"] . "</td>";
                                echo "<td class='table-td'>" . $dish["id_dish_quantity"] . "</td>";
                                echo "<td><a href='edit-dishes.php?id_dishes=" . $dish["id_dishes"] . "'><img src='../imgs/edit.svg' alt='edit icon'></a>  <a href='delete-dish.php?id=" . $dish["id_dishes"] . "''><img src='../imgs/delete-icon.svg' alt='edit icon'></a></td>";
                            }
                            ?>
                            </tr>
                        </tbody>
                        </thead>
                    </table>
                </div>
            </div>
    </main>
</body>

</html>