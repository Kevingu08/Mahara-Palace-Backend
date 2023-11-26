<?php 
    require_once './database.php';
    $data = json_decode($_COOKIE['dishList'], true);
    // var_dump($data);
    $cart_list = [];
    $selected_dish = [];
    $items = [];
    session_start();
    // session_destroy();

    if(isset($_SESSION["isLoggedIn"])){
        if(isset($_COOKIE['dishList'])){
            $cart_list = $data;
            // var_dump($cart_list);
        }
        if(count($cart_list) > 0){
            foreach($cart_list as $dish){
                $selected_dish = $database->select("tb_dishes",[
                    "tb_dishes.id_dishes",
                    "tb_dishes.dish_name",
                    "tb_dishes.dish_img",
                    "tb_dishes.dish_price",
                ],[
                    "id_dishes" => $dish["id"]
                ]);
                // $selected_dish["qty"] = $dish["qty"];
                $items[] = $selected_dish;
            }
        }
    }   

    if(isset($_SERVER["CONTENT_TYPE"])){
        if(isset($_SESSION["isLoggedIn"])){
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);
            //actualizar cantidad en el cart y obtener el precio
            foreach($data as $index => $item){
                if($item["id"] == $decoded["id_dish"]){
                    $data[$index]["qty"] = $decoded["qty"];

                    $dish_price = $database->select("tb_dishes",[
                        "tb_dishes.dish_price"
                    ],[
                        "id_dishes" => $decoded["id_dish"]
                    ]);

                    $totalPrice["price"] = ($dish_price[0]["dish_price"] * $decoded["qty"]);
                } 
            }
            //actualizar la cookie con el cambio de cantidad
            setcookie('dishList', json_encode($data), time()+72000);
            //enviar el precio total para actualizarlo en la vista
            echo json_encode($totalPrice);
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
                    foreach($items as $iterator =>$item){
                        foreach($item as $index => $dish){
                            echo "<tr>";
                                echo "<td class='shopping-td'><img class='element-image' src='./imgs/".$dish["dish_img"]."' alt=''></td>";
                                echo "<td class='shopping-td'>".$dish["dish_name"]."</td>";
                                echo "<td class='shopping-td'>$".$dish["dish_price"]."</td>";
                                echo "<td class='shopping-td'>";
                                echo "<input type='text' class='input-shopping-quantity' id='input-qty-".$iterator."' value='".$cart_list[$iterator]["qty"]."'>";
                                echo "<div>";
                                    echo "<button class='quantity-btn-shopping' onCLick='decreaseQuantity(".$iterator.", ".$dish["id_dishes"].")'>-</button>";
                                    echo "<button class='quantity-btn-shopping' onCLick='increaseQuantity(".$iterator.", ".$dish["id_dishes"].")'>+</button>";
                                echo "</div>";
                                echo "</td>";
                                echo "<td class='shopping-td'><button>Delete</button></td>";
                                echo "<td class='shopping-td' id='total-price-".$iterator."'>$".($dish["dish_price"]*$cart_list[$iterator]["qty"])."</td>";
                            echo "</tr>";
                        }
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

            </div>
        </section>
    </main>
    <?php 
        include "./parts/footer.php";
    ?>
    <script src="./js/main.js"></script>
    <script>
        let inputQty;
        let quantity;
        let idDish;
        let totalPrice;

        function increaseQuantity(index, id){
            inputQty = document.getElementById("input-qty-"+index);
            quantity = inputQty.value;
            console.log(id);
            if(quantity < 20){
                quantity++;
                inputQty.value = quantity;
                let info = {
                    id_dish: id,
                    qty: quantity
                }
                sendDataByAjax(info, index);
            }
        }

        function decreaseQuantity(index, id){
            inputQty = document.getElementById("input-qty-"+index);
            quantity = inputQty.value;
            console.log(id);
            if(quantity > 1){
                quantity--;
                inputQty.value = quantity;
                let info = {
                    id_dish: id,
                    qty: quantity
                }
                sendDataByAjax(info, index);
                
            }
        }

        function sendDataByAjax(info, index){
            fetch("http://localhost/Mahara-Palace-Backend/shopping-cart.php",{
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
                console.log(data["price"]);
                document.getElementById("total-price-"+index).innerHTML = "$"+data["price"].toFixed(1);
            })
            .catch(err => console.log("error: " + err));
        }
        
    </script>
</body>
</html>