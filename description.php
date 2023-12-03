<?php
require_once './database.php';
$link = "";
$url_params = "";
$lang = "";
$dish_list = [];
$dish_details = [];

if ($_GET) {
    if (isset($_GET["lang"]) && $_GET["lang"] == "tr") {

        $items = $database->select("tb_dishes", [
            "[>]tb_category_dishes" => ["id_dish_category" => "id_category"],
            "[>]tb_quantity" => ["id_dish_quantity" => "id_quantity"]
        ], [
            "tb_dishes.id_dishes",
            "tb_dishes.dish_name_trslt",
            "tb_dishes.dish_img",
            "tb_dishes.featured_dish",
            "tb_dishes.dish_description_trslt",
            "tb_dishes.dish_price",
            "tb_category_dishes.category_name",
            "tb_category_dishes.category_description",
            "tb_quantity.people_quantity",
            "tb_quantity.quantity_description"
        ], [
            "id_dishes" => $_GET["id"]
        ]);
        $items[0]["dish_name"] = $items[0]["dish_name_trslt"];
        $items[0]["dish_description"] = $items[0]["dish_description_trslt"];

        $url_params = "id=" . $items[0]["id_dishes"];
        $lang = "EN";
    } else {
        $items = $database->select("tb_dishes", [
            "[>]tb_category_dishes" => ["id_dish_category" => "id_category"],
            "[>]tb_quantity" => ["id_dish_quantity" => "id_quantity"]
        ], [
            "tb_dishes.id_dishes",
            "tb_dishes.dish_name",
            "tb_dishes.dish_img",
            "tb_dishes.featured_dish",
            "tb_dishes.dish_description",
            "tb_dishes.dish_price",
            "tb_category_dishes.category_name",
            "tb_category_dishes.category_description",
            "tb_quantity.people_quantity",
            "tb_quantity.quantity_description"
        ], [
            "id_dishes" => $_GET["id"]
        ]);
        $url_params = "id=" . $items[0]["id_dishes"] . "&lang=tr";
        $lang = "TR";
    }
}

if (isset($_SERVER["CONTENT_TYPE"])) {
    session_start();
    if (isset($_SESSION["isLoggedIn"])) {
        $contentType = $_SERVER["CONTENT_TYPE"];
        if ($contentType == "application/json") {
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);

            if (isset($_COOKIE["dishList"])) {
                $data = json_decode($_COOKIE['dishList'], true);
                $dish_list = $data;
            }

            $dish_details["id"] = $decoded["id_dish"];
            $dish_details["qty"] = $decoded["quantity_dishes"];
            $dish_details["price"] = $decoded["dish_price"];
            $dish_list[] = $dish_details;
            setcookie("dishList", json_encode($dish_list), time() + 72000);
        }
    } else {
        $isLogged = "no";
        echo json_encode($isLogged);
    }
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link rel="stylesheet" href="./css/main.css">
    <title>Description</title>
</head>

<body>
    <!-- header -->
    <header class="hero-container">
        <!-- Barra de navegacion -->
        <?php
        include "./parts/nav.php";
        ?>
        <!-- Barra de navegacion -->

        <!-- contenido del hero -->
        <?php
        echo "<div class='hero-main-description'>";
        echo "<section class='hero-text-container'>";
        echo "<h2 id='dishName' class='hero-title hero-title-hindu'>" . $items[0]["dish_name"] . "</h2>";
        echo "<p class='hero-text hero-text-hindu' id='dishDescription'>" . $items[0]["dish_description"] . "</p>";
        echo "<p class='hero-text hero-text-hindu'>$" . $items[0]["dish_price"] . "</p>";
        echo "<div class='description-btn-container'>";
        //echo "<form method='post' action='description.php'>";
        echo "<div class='quantity-container'>";
        echo "<input class='quantity-btn' id='decrease-btn' type='button' value='-'>";
        echo "<input class='quantity-input' type='number' id='input-quantity' name='quantity' value='1' min='1' max='50'>";
        echo "<input class='quantity-btn' id='increase-btn' type='button' value='+'>";
        echo "</div>";
        echo "<input class='btn-main' type='submit' value='Order Now' onClick='addToCart(" . $items[0]["id_dishes"] . ", " . $items[0]["dish_price"] . ")' >";
        //echo "<input type='hidden' value='".$items[0]["id_dishes"]."' name='id'>";
        //echo "</form>";
        echo "<div class='translate-container'>";
        echo "<span class='translate-btn' id='lang' onclick='getTranslate(" . $items[0]["id_dishes"] . ")'>Hindu</span>";
        echo "</div>";
        echo "</div>";
        echo "</section>";
        echo "<div class='hero-image-container'>";
        echo "<img class='hero-image' src='./imgs/" . $items[0]["dish_img"] . "' alt='hero-image'>";
        echo "</div>";
        echo "</div>";
        ?>


    </header>
    <!-- header -->

    <!-- main -->
    <main>
        <section class="related-products">
            <h2 class="section-title">Related Products</h2>
            <div class="underscore"></div>

            <!-- Cards -->
            <div class="related-products-container">
                <div class="related-img-container">
                    <img class="related-products-img" src="" alt="coca-cola">
                </div>
                <div class="related-content-container">
                    <div class="related-text-container">
                        <h3 class="related-text-title">malai-kofta</h3>
                        <p class="related-text">$99.99</p>
                    </div>
                    <div class="btn-container-related">
                        <a class="btn-main" href="#">See more</a>
                    </div>
                </div>
            </div>

            <div class="related-products-container">
                <div class="related-img-container">
                    <img class="related-products-img" src="" alt="coca-cola">
                </div>
                <div class="related-content-container">
                    <div class="related-text-container">
                        <h3 class="related-text-title">malai-kofta</h3>
                        <p class="related-text">$99.99</p>
                    </div>
                    <div class="btn-container-related">
                        <a class="btn-main" href="#">See more</a>
                    </div>
                </div>
            </div>

            <div class="related-products-container">
                <div class="related-img-container">
                    <img class="related-products-img" src="" alt="coca-cola">
                </div>
                <div class="related-content-container">
                    <div class="related-text-container">
                        <h3 class="related-text-title">malai-kofta</h3>
                        <p class="related-text">$99.99</p>
                    </div>
                    <div class="btn-container-related">
                        <a class="btn-main" href="#">See more</a>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!-- main -->

    <!-- footer -->
    <?php
    include "./parts/footer.php";
    ?>
    <script src="./js/main.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script>
        function showToastify(message) {
            Toastify({
                text: message,
                duration: 2000,
                newWindow: true,
                close: true,
                gravity: "top", // `top` or `bottom` 
                position: "center", // `left`, `center` or `right`
                stopOnFocus: true, // Prevents dismissing of toast on hover
                style: {
                    background: "linear-gradient(to right, #813022, #511E15)",
                },
            }).showToast();
        }


        let decreaseBtn = document.getElementById("decrease-btn");
        let increaseBtn = document.getElementById("increase-btn");
        let inputQuantity = document.getElementById("input-quantity");
        let quantityDish;
        decreaseBtn.addEventListener("click", function () {
            quantityDish = inputQuantity.value;
            if (quantityDish > 1) {
                quantityDish--;
                inputQuantity.value = quantityDish;
            }
        });

        increaseBtn.addEventListener("click", function () {
            quantityDish = inputQuantity.value;
            if (quantityDish < 20) {
                quantityDish++;
                inputQuantity.value = quantityDish;
            }
        });

        function addToCart(id, price) {
            let quantity = inputQuantity.value;
            console.log(id);
            if (quantity < 1) {
                inputQuantity.value = 1;
                showToastify("the value must be equal to or greater than 1");
                return;
            }
            let info = {
                id_dish: id,
                quantity_dishes: quantity,
                dish_price: price
            }

            console.log(price);

            fetch("http://localhost/Mahara-Palace-Backend/description.php", {
                method: "POST",
                mode: "same-origin",
                credentials: "same-origin",
                headers: {
                    'Accept': 'application/json, text/plain, */*',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(info)
            })
                .then(response => response.text())
                .then(data => {
                    let response = data;
                    if (response.length > 0) {
                        window.location.href = "login.php";
                    }
                    else {
                        showToastify("Added dish");
                    }
                })
                .catch(err => console.log("error: " + err));
        }

        let requestLang = "Hindu";

        function switchLang() {
            if (requestLang == "English") requestLang = "Hindu";
            else requestLang = "English";
            document.getElementById("lang").innerText = requestLang;
        }

        function getTranslate(id){

            let info = {
                id_dishes: id,
                language: requestLang
            };

            fetch("http://localhost/mahara-palace-backend/description-translate.php", {
                method: "POST",
                mode: "same-origin",
                credentials: "same-origin",
                headers: {
                    'Accept': 'application/json, text/plain, */*',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(info)
            })
                .then(response => response.json())
                .then(data => {
                    switchLang();
                    document.getElementById("dishName").innerText = data.name;
                    document.getElementById("dishDescription").innerText = data.description;
                })
                .catch(err => console.log("error: " + err));
        }

    </script>
    <!-- footer -->
</body>

</html>