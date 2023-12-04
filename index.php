<?php 
    include_once './database.php';
    session_start();
    // session_destroy();
    // Reference: https://medoo.in/api/select
    $items = $database->select("tb_dishes","*"); 
   
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- Libary -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css">
    <!-- Libary -->
    <link
        href="https://fonts.googleapis.com/css2?family=Cabin:wght@400;500;600;700&family=Hind+Madurai:wght@700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="./css/main.css">
    <title>Maharaja Palace</title>
</head>

<body>
    <!-- header -->
    <header class="hero-container">
        <!-- Barra de navegacion -->
        <?php 
            include './parts/nav.php';
        ?>
        <!-- Barra de navegacion -->

        <!-- contenido del hero -->
        <div class="hero-main">
            <section class="hero-text-container">
                <h2 class="hero-title"><?php echo $items[3]["dish_name"] ?></h2>
                
                <p class="hero-text"><?php echo $items[3]["dish_description"]?></p>
                <div class="cta-container">
                    <a class="btn-main" href='./description.php?id=<?php echo $items[3]["id_dishes"]?>'>Order Now</a>
                </div>
            </section>
            <div class="hero-image-container">
                <img class="hero-image" src="./imgs/<?php echo $items[3]["dish_img"]?>" alt="hero-image">
            </div>
        </div>
        <!-- contenido del hero -->
    </header>
    <!-- header -->

    <!-- main -->
    <main>
        <!-- slider -->
        <section class="featured-dishes">
            <h2 class="section-title">Featured Dishes</h2>
            <div class="underscore"></div>
            <!-- Slider main container -->
            <div class="swiper">
                <div class="swiper-wrapper">
                    <!-- Slides -->
                    <?php 
                        foreach($items as $item){
                            if($item["featured_dish"] == 1){
                                echo "<div class='swiper-slide'>";
                                    echo "<div class='card-slider'>";
                                        echo "<img class='slider-img' src='./imgs/".$item["dish_img"]."' alt='aloo-gosht'>";
                                        echo "<div class='card-content card-content-slider main-bg'>";
                                            echo "<div class='slider-text'>";
                                                echo "<h3>".substr($item["dish_name"],0, 20)."...</h3>";
                                                echo "<p>".substr($item["dish_description"],0,50)."...</p>";
                                            echo "</div>";
                                            echo "<div class='btn-slider-container'>";
                                                echo "<a class='btn-secondary link-text' href='./description.php?id=".$item["id_dishes"]."'>See more</a>";
                                            echo "</div>";
                                        echo "</div>";
                                    echo "</div>";
                                echo "</div>";
                            }
                        }
                       
                    ?>
                     <!-- Slides -->
                </div>
                
                <!-- pagination -->
                <div class="swiper-pagination"></div>
    
                <!--  navigation buttons -->
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
            <!-- Slider main container -->
            
        </section>
        <!-- slider -->

        <!-- menu -->
        <section class="menu-container" >
            <h2 class="section-title">Categories</h2>
            <div class="underscore"></div>
    
            
            <div class="menu" id="categories-container">
                <a class="link-text" href="./menu.php?id=<?php echo 2?>">
                    <div class="card-menu">
                        <div class="card-image-container">
                            <img class="card-image-filter" src="./imgs/appetizers.svg" alt="Appetizers icon">
                        </div>
                        <div class="card-content">
                                <h4>Appetizers</h4>                        
                        </div>
                    </div>
                </a>
    
            <a class="link-text" href="./menu.php?id=<?php echo 1?>">
                <div class="card-menu">
                    <div class="card-image-container">
                        <img class="card-image-filter" src="./imgs/maindishes.svg" alt="Main courses icon">
                    </div>
                    <div class="card-content">
                            <h4 class="categories-text">Main courses</h4>
                    </div>
                </div>
            </a>
    
                <a class="link-text" href="./menu.php?id=<?php echo 4?>">
                    <div class="card-menu">
                        <div class="card-image-container">
                            <img class="card-image-filter" src="./imgs/desserts.svg" alt="dessert icon">
                        </div>
                        <div class="card-content">
                                <h4 class="categories-text">Desserts</h4>
                        </div>
                    </div>
                </a>
    
                <a class="link-text" href="./menu.php?id=<?php echo 3?>">
                    <div class="card-menu">
                        <div class="card-image-container">
                            <img class="card-image-filter" src="./imgs/beverages.svg" alt="beverage icon">
                        </div>
                        <div class="card-content">
                                <h4 class="categories-text">Drinks</h4>                        
                        </div>
                    </div>
                </a>
    
            </div>
    
        </section>
        <!-- menu -->
    </main>
        <!-- main -->

    <!-- footer -->
    <?php 
        include "./parts/footer.php";
    ?>
    <!-- footer -->
    <script src="./js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
</body>

</html>