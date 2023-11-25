<?php 
    require_once './database.php';
    $cart_list = [];
    session_start();
    // session_destroy();
    if(isset($_SESSION["isLoggedIn"])){
        $cart_list = $_SESSION["cartList"];
        $id_list = [];
        $quantity_list = [];

        if(count($cart_list)>0){
            foreach($cart_list as $key => $dish){
                $id_list[] = $dish["id"];
                $quantity_list[] = $dish["quantity"];
            }
    
            $items = $database->select("tb_dishes","*",[
                "id_dishes" => $id_list
            ]);
        }
    }   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/main.css">
    <title>Document</title>
</head>
<body>
    <?php 
        include "./parts/nav.php";
    ?>
    <main>
        <section class="shopping-cart">
            <h2 class="section-title">Your Cart</h2>
            <div class="shopping-container">
                <?php
                if(count($cart_list) >0){

                    echo "<table class='shopping-tb' id='shopping-tb'>";
                    echo "<thead>";
                    echo "<tr>";
                    echo "<th class='shopping-th th-image'>Image</th>";
                    echo "<th class='shopping-th'>Name</th>";
                    echo "<th class='shopping-th'>Price</th>";
                    echo "<th class='shopping-th'>Quantity</th>";
                    echo "<th class='shopping-th'>Action</th>";
                    echo "<th class='shopping-th'>Total Price</th>";
                    echo "</tr>";
                    echo "</thead>";
                    echo "<tbody>";
                    foreach($items as $index =>$item){
                        echo "<tr>";
                            echo "<td class='shopping-td'><img class='element-image' src='./imgs/".$item["dish_img"]."' alt=''></td>";
                            echo "<td class='shopping-td'>".$item["dish_name"]."</td>";
                            echo "<td class='shopping-td'>$".$item["dish_price"]."</td>";
                            echo "<td class='shopping-td'>";
                            echo "<input type='text' class='input-shopping-quantity' value='".$quantity_list[$index]."'>";
                            echo "<div>";
                                echo "<button class='quantity-btn-shopping' >-</button>";
                                echo "<button class='quantity-btn-shopping' >+</button>";
                            echo "</div>";
                            echo "</td>";
                            echo "<td class='shopping-td'><button>Delete</button></td>";
                            echo "<td class='shopping-td'>$19</td>";
                        echo "</tr>";
                    }
                    echo "</tbody>";
                    echo "<tfoot>";
                        echo "<tr>";
                            echo "<td class='shopping-td td-text-total' colspan='5'>Total</td>";
                            echo "<td class='shopping-td td-total'>$120</td>";
                        echo "</tr>";
                    echo "</tfoot>";
                    echo "</table>";
                }
                else{
                    echo "<h3>There are no elements</h3>";
                }
                ?>



                <!-- <table class="shopping-tb" id="shopping-tb">
                    <thead>
                        <tr>
                            <th class="shopping-th th-image">Image</th>
                            <th class="shopping-th">Name</th>
                            <th class="shopping-th">Price</th>
                            <th class="shopping-th">Quantity</th>
                            <th class="shopping-th">Action</th>
                            <th class="shopping-th">Total Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            if(count($cart_list) >0){
                                foreach($items as $index =>$item){
                                    echo "<tr>";
                                    echo "<td class='shopping-td'><img class='element-image' src='./imgs/".$item["dish_img"]."' alt=''></td>";
                                    echo "<td class='shopping-td'>".$item["dish_name"]."</td>";
                                    echo "<td class='shopping-td'>$".$item["dish_price"]."</td>";
                                    echo "<td class='shopping-td'>";
                                        echo "<input type='text' class='input-shopping-quantity' value='".$quantity_list[$index]."'>";
                                        echo "<div>";
                                            echo "<button class='quantity-btn-shopping' >-</button>";
                                            echo "<button class='quantity-btn-shopping' >+</button>";
                                        echo "</div>";
                                    echo "</td>";
                                    echo "<td class='shopping-td'><button>Delete</button></td>";
                                    echo "<td class='shopping-td'>$19</td>";
                                    echo "</tr>";
                                }
                            }
                        ?>
                    </tbody>
                </table> -->

            </div>
        </section>
    </main>
    <?php 
        include "./parts/footer.php";
    ?>
    <script src="./js/main.js"></script>
</body>
</html>