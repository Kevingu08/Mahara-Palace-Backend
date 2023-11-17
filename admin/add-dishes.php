<?php
require_once '../database.php';

$categories = $database->select("tb_category_dishes", "*");
$quantities = $database->select("tb_quantity", "*");
$featured = $database->select("tb_dishes", "featured_dish", );
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
                        <li class="sidebar-li"><a href="#" class="sidebar-text">Add Dish</a></li>
                        <li class="sidebar-li"><a href="#" class="sidebar-text">Dish list</a></li>
                        <li class="sidebar-li"><a href="#" class="sidebar-text">User list</a></li>
                        <li class="sidebar-li"><a href="#" class="sidebar-text">Add User</a></li>
                    </ul>
                </nav>
            </sidebar>
            <!--SideBar-->


            <div class="tabular-wrapper-container">
                <form action="list-dishes.php" method="post" enctype="multipart/form-data">
                <h3 class="admin-title">Add Dishes</h3>
                <div class="underscore-admin"></div>
                <div class="admin-add-container">

                    <div class="add-container">

                        <div class="input-container">
                            <label class="input-text">Dish name:</label>
                            <input class="input-box" type="text" placeholder="Enter dish name">
                        </div>

                        <div class="input-container">
                            <label class="input-text">Dish description:</label>
                            <input class="input-box" type="text" placeholder="Enter dish description">
                        </div>

                        <div class="input-colunm">
                            <div class="input-container">
                                <label class="input-text">Dish category:</label>
                                <select class="input-box" name="dish_category" id="dish_category">
                                    <?php
                                    foreach ($categories as $category) {
                                        echo "<option value='" . $category["category_name"] . "'>" . $category["category_name"] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="input-container">
                                <label class="input-text">Dish price:</label>
                                <input class="input-box" type="text" placeholder="Enter dish price">
                            </div>
                        </div>

                        <div class="input-colunm">
                            <div class="input-container">
                                <label class="input-text">People quantity:</label>
                                <select class="input-box" name="people_quantity" id="dish_category">
                                    <?php
                                    foreach ($quantities as $quantity) {
                                        echo "<option value='" . $quantity["people_quantity"] . "'>" . $quantity["people_quantity"] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="input-container">
                                
                                <label class="input-text">Featured:</label>
                                <label class="switch">
                                    <input type="checkbox">
                                    <span class="slider round"></span>
                                </label>
                                    

                                <!-- <select class="input-box" name="featured_dish" id="featured_dish">
                                    <?php
                                    // foreach ($featured as $feature) {
                                    //     echo "<option value='".$feature          ["featured_dish"]. "'>".$feature["featured_dish"]."</option>";
                                    // }
                                    ?>
                                </select> -->
                            </div>

                            <div class="input-container">
                                <label class="input-text">Dish Image:</label>

                                <input type="file" id="file" name="dish_img" onchange="readURL(this)" hidden>
                                <label for="file">
                                    <img id="preview" class="upload-box" src="../imgs/upload.svg" alt="">
                                </label>               

                            </div>
                        </div>
                        <div class="div-button">
                            <button class="input-button">Submit</button>
                        </div>





                        <!-- <div class="admin-text">
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
                            </div> -->

                    </div>
                </div>
            </div>
            </form>
            </section>
        </div>
        
    </main>
    <!-- main -->
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                let reader = new FileReader();

                reader.onload = function (e) {
                    let preview = document.getElementById('preview').setAttribute('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

    </script>
</body>

</html>