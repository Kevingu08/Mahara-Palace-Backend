<?php 
    require_once "./database.php";

    if(isset($_GET)){
        $items = $database->select("tb_dishes","*",[
            "dish_name[~]" => $_GET["keyword"]
        ]);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/main.css">
    <title>Results</title>
</head>
<body>
    <?php 
        include "./parts/nav.php";
    ?>

    <main class="menu-container adaptative-menu-nav">
            
        <section>
            <h2 class="section-title">Results</h2>
            <div class="underscore"></div>

            <?php 
                if(count($items) > 0){
                    echo "<p>We Found: ".count($items)." dish(es)</p>";
                }
                else{
                    echo "<p class='hero-text'>No dishes found</p>";
                }
            ?>

            <div class="autofill-menu" id="menu">
            <?php 
                //solo mostrar una ves las card mediante php
                    foreach($items as $item){
                            echo "<a id='link-card-menu' class='link-card-menu' href='description.php?id=".$item["id_dishes"]."'>";
                            echo "<div class='card-menu'>";
                                echo "<div class='card-image-container'>";
                                    echo "<img class='card-image' src='./imgs/".$item["dish_img"]."' alt='beverage image'>";
                                echo "</div>";
    
                                echo "<div class='card-content'>";
                                    echo "<h4>".$item["dish_name"]."</h4>";
                                echo "</div>";
                            echo "</div>";
                            echo "</a>";
                    }
            ?>
        </div>
        </section>

    </main>
    <?php 
        include "./parts/footer.php";
    ?>
    <script src="./js/main.js"></script>
</body>
</html>