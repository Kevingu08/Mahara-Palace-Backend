<?php
require_once '../database.php';
$dishes = $database->select("tb_dishes", "*");

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
                    <ul class="sidebar-ul">
                        <li class="sidebar-li"><a href="./add-dishes.php" class="sidebar-text">Add Dish</a></li>
                        <li class="sidebar-li"><a href="#" class="sidebar-text">Dish list</a></li>
                        <li class="sidebar-li"><a href="#" class="sidebar-text">User list</a></li>
                        <li class="sidebar-li"><a href="#" class="sidebar-text">Add User</a></li>
                    </ul>
                </nav>
            </sidebar>
            <!--SideBar-->

            <section class="section-container">
                <h2 class="section-title">Dishes list</h2>
                <div class="underscore"></div>
                <div class="admin-container">
                    <div class="table-container">
                        <table>
                            <thead>
                                <tr>
                                    <td class= "list-title-text">Dish Name</td>
                                    <td class= "list-title-text">Dish description</td>
                                    <td class= "list-title-text">Price</td>
                                    <td class= "list-title-text">Actions</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($dishes as $dish) {
                                    echo "<td class='list-text'>".$dish["dish_name"] . "</td>";
                                    echo "<td class='list-text'>".$dish["featured_dish"]."</td>";
                                    echo "<td class='list-text'>".$dish["id_category_dish"]."</td>";
                                    echo "<td class='list-text'>".$dish["dish_price"]."</td>";
                                    echo "<td class='list-text'>".$dish["id_dish_quantity"]."</td>";
                                    echo "<td><a href='edit-dish.php?id_dishes=" . $dish["id_dishes"] . "'>Edit</a>  <a href='delete-dish.php?id=" . $dish["id_dishes"] . "''>Delete</a></td>";
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>
    </main>
    <!-- main -->
</body>

</html>