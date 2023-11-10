<?php 
    require_once './database.php';

    if($_GET){
        
        $items = $database->select("tb_dishes",[
            "[>]tb_category_dishes"=>["id_dish_category" => "id_category"],
            "[>]tb_quantity"=>["id_dish_quantity" => "id_quantity"]
        ],[
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
        ],[
            "id_dishes"=>$_GET["id"]
        ]);
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                    echo "<h2 class='hero-title hero-title-hindu'>".$items[0]["dish_name"]."</h2>";
                    echo "<p class='hero-text hero-text-hindu'>".$items[0]["dish_description"]."</p>";
                    echo "<p class='hero-text hero-text-hindu'>$".$items[0]["dish_price"]."</p>";    
                    echo "<div class='description-btn-container'>";
                        echo "<div class='quantity-container'>";
                            echo "<button class='quantity-btn'>-</button>";
                            echo "<input class='quantity-input' type='text'>";
                            echo "<button class='quantity-btn'>+</button>";
                        echo "</div>";
                        echo "<a class='btn-main' href='#'>Order Now</a>";
                    echo "</div>";
                echo "</section>";
                echo "<div class='hero-image-container'>";
                    echo "<img class='hero-image' src='./imgs/".$items[0]["dish_img"]."' alt='hero-image'>";
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
                    <img class="related-products-img" src="./imgs/Shemins-Butter-Chicken-LR.jpg" alt="coca-cola">
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
                    <img class="related-products-img" src="./imgs/Shemins-Butter-Chicken-LR.jpg" alt="coca-cola">
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
                    <img class="related-products-img" src="./imgs/Shemins-Butter-Chicken-LR.jpg" alt="coca-cola">
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
    <!-- footer -->
</body>

</html>