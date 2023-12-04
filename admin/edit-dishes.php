<?php
require_once '../database.php';

$categories = $database->select("tb_category_dishes", "*");
$quantities = $database->select("tb_quantity", "*");
$items = $database->select("tb_dishes", "*");


if ($_GET) {

    $dish = $database->select("tb_dishes", "*", [
        "id_dishes" => $_GET["id_dishes"]
    ]);

    $related_products = $database->get("tb_related_products", ["id_related_product1", "id_related_product2", "id_related_product3"], [
        "id_related_dishes" => $_GET["id_dishes"]
    ]);
    var_dump($related_products);
}

if ($_POST) {

    $data = $database->select("tb_dishes", "*", [
        "id_dishes" => $_POST["id_edit"]
    ]);


    if (isset($_FILES['img']) && $_FILES['img']['name'] != "") {
        $errors = [];

        $file_name = $_FILES['img']['name'];
        $file_size = $_FILES['img']['size'];
        $file_tmp = $_FILES['img']['tmp_name'];
        $file_type = $_FILES['img']['type'];
        $file_ext_arr = explode(".", $_FILES['img']['name']);

        $file_ext = end($file_ext_arr);
        $img_ext = ["jpg", "jpeg", "png", "webp"];
        if (!in_array($file_ext, $img_ext)) {
            $errors[] = "File type is not supported";
            $message = "File type is not supported";
        }

        if (empty($errors)) {
            $filename = strtolower($_POST['name']);
            $filename = str_replace('.', '', $filename);
            $filename = str_replace('.', '', $filename);
            $filename = str_replace(' ', '-', $filename);
            $img = $filename . "." . $file_ext;
            echo "$img";
            move_uploaded_file($file_tmp, "../imgs/" . $img);
        }

    } else {

        $img = $data[0]["dish_img"];
    }

    $database->update("tb_dishes", [
        "id_dish_quantity" => $_POST["quantity"],
        "id_dish_category" => $_POST["category"],
        "dish_name" => $_POST["name"],
        "dish_name_trslt" => $_POST["name_trslt"],
        "dish_img" => $img,
        "featured_dish" => $_POST["value"],
        "dish_description" => $_POST["description"],
        "dish_description_trslt" => $_POST["description_trslt"],

        "dish_price" => $_POST["price"]
    ], [
        "id_dishes" => $_POST["id_edit"]
    ]);

    $database->update("tb_related_products", [
        "id_related_product1" => $_POST["related1"],
        "id_related_product2" => $_POST["related2"],
        "id_related_product3" => $_POST["related3"]
    ], [
        "id_related_dishes" => $_POST["id_edit"]
    ]);
    header("Location: list-dishes.php");
}


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
            <?php
            include "../parts/sidebar.php";
            ?>
            <!--SideBar-->


            <div class="tabular-wrapper-container">
                <form action="edit-dishes.php" method="post" enctype="multipart/form-data">
                    <h3 class="admin-title">Edit Dishes</h3>
                    <div class="underscore-admin"></div>
                    <div class="admin-add-container">

                        <div class="add-container">

                            <div class="input-container">
                                <label class="input-text">Dish name:</label>
                                <input class="input-box" name="name" type="text" placeholder="Enter dish name" value="<?php
                                echo $dish[0]["dish_name"];
                                ?>">
                            </div>

                            <div class="input-container">
                                <label class="input-text">Dish translate name:</label>
                                <input class="input-box" name="name_trslt" type="text"
                                    placeholder="Enter translated dish name" value="<?php
                                    echo $dish[0]["dish_name_trslt"];
                                    ?>">
                            </div>

                            <div class="input-container">
                                <label class="input-text">Dish description:</label>
                                <input class="input-box" name="description" type="text"
                                    placeholder="Enter dish description" value="<?php
                                    echo $dish[0]["dish_description"];
                                    ?>">
                            </div>

                            <div class="input-container">
                                <label class="input-text">Dish translate description:</label>
                                <input class="input-box" name="description_trslt" type="text"
                                    placeholder="Enter translated dish description" value="<?php
                                    echo $dish[0]["dish_description_trslt"];
                                    ?>">
                            </div>

                            <div class="input-colunm">
                                <div class="input-container">
                                    <label class="input-text">Dish category:</label>
                                    <select class="input-box" name="category" id="dish_category">
                                        <?php
                                        foreach ($categories as $category) {
                                            if ($category["id_category"] == $dish[0]["id_dish_category"]) {
                                                echo "<option value='" . $category["id_category"] . "'selected>" . $category["category_name"] . "</option>";
                                            } else {
                                                echo "<option value='" . $category["id_category"] . "'>" . $category["category_name"] . "</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="input-container">
                                    <label class="input-text">Dish price:</label>
                                    <input class="input-box" name="price" type="text" placeholder="Enter dish price"
                                        value="<?php
                                        echo $dish[0]["dish_price"];
                                        ?>">
                                </div>
                            </div>

                            <div class="input-container">
                                <div>
                                    <label class="input-text">Related dish 1:</label>
                                    <select class="input-box" name="related1" id="dish_category">
                                        <?php
                                        foreach ($items as $item) {
                                            $selected = ($item["id_dishes"] == $related_products["id_related_product1"]) ? "selected" : "";
                                            echo "<option value='" . $item["id_dishes"] . "' $selected >" . $item["dish_name"] . "</option>";
                                        }
                                        ?>
                                    </select>

                                    <div>
                                        <label class="input-text">Related dish 2:</label>
                                        <select class="input-box" name="related2" id="dish_category">
                                            <?php
                                            foreach ($items as $item) {
                                                $selected = ($item["id_dishes"] == $related_products["id_related_product2"]) ? "selected" : "";
                                                echo "<option value='" . $item["id_dishes"] . "' $selected >" . $item["dish_name"] . "</option>";
                                            }
                                            ?>
                                        </select>

                                        <div>
                                            <label class="input-text">Related dish 3:</label>
                                            <select class="input-box" name="related3" id="dish_category">
                                                <?php
                                                foreach ($items as $item) {
                                                    $selected = ($item["id_dishes"] == $related_products["id_related_product3"]) ? "selected" : "";
                                                    echo "<option value='" . $item["id_dishes"] . "' $selected >" . $item["dish_name"] . "</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>


                                        <div class="input-colunm">
                                            <div class="input-container">
                                                <label class="input-text">People quantity:</label>
                                                <select class="input-box" name="quantity" id="dish_category">
                                                    <?php
                                                    foreach ($quantities as $quantity) {
                                                        if ($quantity["id_quantity"] == $dish[0]["id_dish_quantity"]) {
                                                            echo "<option value='" . $quantity["id_quantity"] . "'selected>" . $quantity["people_quantity"] . "</option>";
                                                        } else {
                                                            echo "<option value='" . $quantity["id_quantity"] . "'>" . $quantity["people_quantity"] . "</option>";
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="input-container">
                                                <label class="input-text">Featured:</label>
                                                <label class="switch">
                                                    <?php
                                                    if ($dish[0]["featured_dish"] == "0") {
                                                        echo
                                                            "<input id='featured' name='featured' type='checkbox' onclick='checkValue()'>"
                                                            . "<span class='slider round'></span>"
                                                            . "</label>"
                                                            . "<input type='hidden' id='value' value='0' name='value'>";
                                                    } else {
                                                        echo
                                                            "<input id='featured' name='featured' type='checkbox' checked onclick='checkValue()'>"
                                                            . "<span class='slider round'></span>"
                                                            . "</label>"
                                                            . "<input type='hidden' id='value' value='1' name='value'>";
                                                    }
                                                    ?>
                                            </div>
                                            <div class="input-container">
                                                <label class="input-text">Dish Image:</label>
                                                <input type="file" id="file" name="img" onchange="readURL(this)" hidden>
                                                <label for="file">
                                                    <img id="preview" class="upload-box" src="../imgs/<?php
                                                    echo $dish[0]["dish_img"];
                                                    ?>" alt="preview">
                                                </label>
                                            </div>
                                        </div>
                                        <div class="div-button">
                                            <input class="input-button" type="Submit" value="Edit Dish">
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" id="id_edit" name="id_edit" value="<?php
                                echo $dish[0]["id_dishes"];
                                ?>">
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

        function checkValue() {
            var checkbox = document.getElementById("featured");
            var valueField = document.getElementById("value");
            if (checkbox.checked) {
                valueField.value = 1;
            } else {
                valueField.value = 0;
            }
        }

    </script>
</body>

</html>