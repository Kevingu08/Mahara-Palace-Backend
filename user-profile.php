<?php 
    include_once "./database.php";
    session_start();
    // session_destroy();
    $isLoggedIn = false;

    if(isset($_SESSION)){
        if($_SESSION["isLoggedIn"]){
            $user = $database->select("tb_users","*",[
                "id_user" => $_SESSION["id"]
            ]);
            
            if(count($user) > 0){
                $orders = $database->select("tb_order","*",[
                    "id_user" => $user[0]["id_user"]
                ]);
                $isLoggedIn = true;
    
                if(count($orders) > 0){
                    $items = $database->select("tb_order",[
                        "[>]tb_order_details"=>["id_order" => "id_order"],
                        "[>]tb_dishes"=>["tb_order_details.id_dish" => "id_dishes"],
                        "[>]tb_users"=>["id_user" => "id_user"],
                        "[>]tb_quantity"=>["tb_dishes.id_dish_quantity" => "id_quantity"]
                    ],[
                        "tb_order.id_order",
                        "tb_order.id_order_type",
                        "tb_order.id_user",
                        "tb_order_details.qty",
                        "tb_order_details.price",
                        "tb_dishes.dish_name",
                        "tb_dishes.dish_img",
                        "tb_quantity.people_quantity"
                    ],[
                        "tb_order.id_user" => $user[0]["id_user"]
                    ]);
                }
            }
        }
        else{
            header("location: login.php");
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/main.css">
    <title>User Profile</title>
</head>

<body>
    <?php 
        include "./parts/nav.php";
    ?>
    <main class="user-main adaptative-menu-nav">
        <div class="user-section">
            <div class="user-card">
                <div class="user-img-container">
                    <img class="user-img" src="./imgs/user-svgrepo-com.svg" alt="user icon">
                </div>
                <div class="user-content">
                    <p class="user-title"><?php echo $user[0]["fullname"]?></p>
                    <p><?php echo $user[0]["email"]?></p>
                    <a id="btn-logout" class="btn-logout" href='./logout.php'>
                    logout
                </a>
                </div>
                
            </div>
        </div>
        <section class="user-history">
            <h2 class="section-title">History</h2>
            <?php 
                if(count($orders) > 0){
                    foreach($orders as $order){
                        echo "<div class='history-item'>";
                            echo "<div class='history-header'>";
                                echo "<p>Date: ".$order["order_date"]."</p>";
                                echo "<p>Total price: $".$order["total_price"]."</p>";
                            echo "</div>";

                            foreach($items as $item){
                                if($item["id_order"] == $order["id_order"]){
                                    echo "<div class='history-content'>";
                                        echo "<div class='history-img-container'>";
                                            echo "<img class='history-img' src='./imgs/".$item["dish_img"]."' alt=''>";
                                        echo "</div>";
                                        echo "<div class='history-text'>";
                                            echo "<div class='histoy-text-container'>";
                                                echo "<p class='title-history-text'>Dish name</p>";
                                                echo "<p>".$item["dish_name"]."</p>";
                                            echo "</div>";
                                            echo "<div class='histoy-text-container'>";
                                                echo "<p class='title-history-text'>Quantity</p>";
                                                echo "<p>".$item["qty"]."</p>";
                                            echo "</div>";
                                            echo "<div class='histoy-text-container'>";
                                                echo "<p class='title-history-text'>Price/und</p>";
                                                echo "<p>$".$item["price"]."</p>";
                                            echo "</div>";
                                            echo "<div class='histoy-text-container'>";
                                                echo "<p class='title-history-text'>People quantity</p>";
                                                echo "<p>".$item["people_quantity"]."</p>";
                                            echo "</div>";
                                        echo "</div>";
                                    echo "</div>";
                                }
                            }
                        echo "</div>";
                    }
                }
                else{
                    echo "<h3>empty history</h3>";
                }
            ?>
        </section>
    </main>

    <?php 
        include "./parts/footer.php";
    ?>
    <script src="./js/main.js"></script>
</body>

</html>