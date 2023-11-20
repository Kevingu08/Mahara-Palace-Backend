<?php 
    require_once './database.php';
    // Reference: https://medoo.in/api/select
    $items = $database->select("tb_dishes","*");
    if($_GET){
        $id_category = $_GET["id"];
    }
    if($_POST){
        $id_category = $_POST["id_category"];
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/main.css">
    <title>Menu</title>
</head>

<body>
    <!-- header -->
    <header class="hero-container">
        <!-- Barra de navegacion -->
        <?php 
            include "./parts/nav.php";
        ?>
        <!-- Barra de navegacion -->
    </header>
    <!-- header -->

    <!-- main -->
    <main class="menu-container background-menu adaptative-menu-nav">
        <h2 class="section-title">Menu</h2>
        <div class="underscore"></div>

        <div class="options-container">
            <div class="tags-container">
                <form method="post" action="menu.php">
                    <button type="submit" class="category-tag">individual</button>
                    <button class="category-tag">couples</button>
                    <button class="category-tag">familiar</button>
                    <input hidden="hidden" type="text" value="<?php echo $id_category?>" name="id_category">
                </form>
                
            </div>
        </div>

        <div class="menu">
            <?php 
                foreach($items as $item){
                    if($item["id_dish_category"] == $id_category){
                        echo "<a class='link-card-menu' href='description.php?id=".$item["id_dishes"]."'>";
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
                }
            ?>
        </div>
    </main>
    <!-- main -->

    <!-- footer -->
    <?php 
        include "./parts/footer.php";
    ?>
    <!-- footer -->
    <script src="./js/main.js"></script>
    <script>console.log("test")</script>
</body>

</html>