<?php 
    require_once './database.php';
    $id_category = "";
    $is_ajax_available;

    if($_GET){
        $id_category = $_GET["id"];
        //para el primer desplegue de las cards
        $is_ajax_available = false;
    }
    // Reference: https://medoo.in/api/select
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
            "tb_dishes.id_dish_category",
            "tb_dishes.id_dish_quantity",
            "tb_category_dishes.category_name",
            "tb_category_dishes.category_description",
            "tb_quantity.people_quantity",
            "tb_quantity.quantity_description"
    ],[
        "id_dish_category" => $id_category
    ]);


    $categories = ["individual", "couples", "family"];
    $selected_categories = [];
    
   
    if(isset($_SERVER["CONTENT_TYPE"])){
        $contentType = $_SERVER["CONTENT_TYPE"];
        if($contentType == "application/json"){
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);
            $selected_categories = $decoded["categories"];
            $id_category = $decoded["id_category"];

            if(count($selected_categories) > 0){
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
                        "tb_dishes.id_dish_category",
                        "tb_dishes.id_dish_quantity",
                        "tb_category_dishes.category_name",
                        "tb_category_dishes.category_description",
                        "tb_quantity.people_quantity",
                        "tb_quantity.quantity_description"
                ],[
                    "id_dish_category" => $id_category,
                    "people_quantity" => $selected_categories
                ]);
                $response = "if";
            }
            else{
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
                        "tb_dishes.id_dish_category",
                        "tb_dishes.id_dish_quantity",
                        "tb_category_dishes.category_name",
                        "tb_category_dishes.category_description",
                        "tb_quantity.people_quantity",
                        "tb_quantity.quantity_description"
                ],[
                    "id_dish_category" => $id_category
                ]);
                $response = "else";
            }
            $is_ajax_available = true;
            echo json_encode($items);
            exit;
        }
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
    <main id="menu-container" class="menu-container background-menu adaptative-menu-nav">
        <h2 class="section-title">Menu</h2>
        <div class="underscore"></div>

        <div class="options-container">
            <div class="tags-container" id="tags-container">
                <button class="category-tag" id="btn-individual" value="individual" onCLick="filter('individual')" data-active="0">individual</button>
                <button class="category-tag" id="btn-couples" value="couples" onCLick="filter('couples')" data-active="0">couples</button>
                <button class="category-tag" id="btn-familiar" value="familiar" onCLick="filter('familiar')" data-active="0">familiar</button>
               <input type="hidden" value='<?php echo $id_category ?>' id="input-category">
               
            </div>
        </div>

        <div class="autofill-menu" id="menu">
            <?php 
                //solo mostrar una ves las card mediante php
                if(!$is_ajax_available){
                    foreach($items as $item){
                        if($item["id_dish_category"] == $id_category){
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
    <script>
        let tagsContainer = document.getElementById("tags-container");
        let selectedCategories = [];

        function filter(value){
            let buttonClicked = document.getElementById("btn-"+value);
            let category = buttonClicked.getAttribute("value");
            let idCategory = document.getElementById("input-category").value;
            console.log("element: " + idCategory);

            if(buttonClicked.getAttribute("data-active") == 0){
                buttonClicked.setAttribute("data-active", 1);
                selectedCategories.push(category);
            }
            else{
                buttonClicked.setAttribute("data-active", 0);
                let position = selectedCategories.indexOf(category);
                selectedCategories.splice(position, 1);
            }
            // console.log(selectedCategories);
            buttonClicked.classList.toggle("active-category-tag");

            let info = {
                categories: selectedCategories,
                id_category: idCategory
            }

            fetch("http://localhost/Mahara-Palace-Backend/menu.php",{
                method: "POST",
                mode: "same-origin",
                credentials: "same-origin",
                headers:{
                    'Accept': 'application/json, text/plain, */*',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(info)
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);
                let menuContainer = document.getElementById("menu-container");

                if(document.getElementById("menu") !== null) document.getElementById("menu").remove();
                let menu = document.createElement("div");
                menu.classList.add("autofill-menu"); 
                menu.setAttribute("id", "menu");
                menuContainer.appendChild(menu);

                // let menu = document.getElementById("menu");
                if(data.length > 0){

                    data.forEach(function(item){
                        console.log(item);
                        //create link for Cards
                        let linkCard = document.createElement("a");
                        linkCard.classList.add("link-card-menu"); 
                        linkCard.setAttribute("href", "description.php?id="+item.id_dishes);

                        menu.appendChild(linkCard);

                        //create cardDishes
                        let cardDish = document.createElement("div");
                        cardDish.classList.add("card-menu");
                        linkCard.appendChild(cardDish);

                        //create image container
                        let cardImageContainer = document.createElement("div");
                        cardImageContainer.classList.add("card-image-container");
                        cardDish.appendChild(cardImageContainer);

                        //create image
                        let image = document.createElement("img");
                        image.classList.add("card-image");
                        image.setAttribute("src", './imgs/'+item.dish_img);
                        image.setAttribute("alt", item.dish_name);
                        cardImageContainer.appendChild(image);

                        //create card content
                        let cardContent = document.createElement("div")
                        cardContent.classList.add("card-content");
                        cardDish.appendChild(cardContent);

                        //create card text
                        let cardTitle = document.createElement("h4")
                        cardTitle.innerText = item.dish_name;
                        cardContent.appendChild(cardTitle);
                    });
                    
                }
            })
            .catch(err => console.log("error: " + err));

        }
    </script>
</body>

</html>