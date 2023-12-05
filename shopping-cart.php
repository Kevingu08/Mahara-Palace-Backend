<?php 
    require_once './database.php';
    $data;

    $response = [];
    $cart_list = [];
    $selected_dish = [];
    $items = [];
    $total = 0;
    session_start();
    // session_destroy();
   
    if(isset($_SESSION["isLoggedIn"])){
        if(isset($_COOKIE['dishList'])){
            $data = json_decode($_COOKIE['dishList'], true);
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
                $items[] = $selected_dish;
            }
        }
        
        if($_POST) {
            $data = json_decode($_POST["data"], true);
            var_dump($data);
        }
    }   

    if(isset($_SERVER["CONTENT_TYPE"])){
        if(isset($_SESSION["isLoggedIn"])){
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);
            // $response;

            //actualizar qty en el cart y obtener el precio
            if(isset($decoded["qty"])){
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
                $response["index"] = $decoded["index"];
                $response["total_price"] = $totalPrice["price"];
            }
            elseif(isset($decoded["request"])){
                $response["items"] = $items;
                $qtyList = [];
                foreach($cart_list as $item){
                    $qtyList[] = intval($item["qty"]);
                }
                $response["qty_dishes"] = $qtyList;
            }
            else{
                //eliminar item del cart
                foreach($cart_list as $index => $item){
                    if($item["id"] == $decoded["id_dish"]){
                        array_splice($cart_list, $index, 1);
                    }
                }
                $data = $cart_list;
            }
            
            //actualizar precio total
            $total = 0;
            foreach($data as $item){
                $total += ($item["qty"] * $item["price"]);
            }
            $response["total"] = $total;
            
            //actualizar la cookie con el cambio de cantidad
            setcookie('dishList', json_encode($data), time()+72000);

            //enviar el precio total para actualizarlo en la vista
            echo json_encode($response);
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
    <main class="main-cart">
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
                    echo "<tbody class='shopping-tbody'>";
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
                                echo "<td class='shopping-td'><button class='delete-btn-shopping' onClick='deleteItem(this, ".$dish["id_dishes"].")' >Delete</button></td>";
                                echo "<td class='shopping-td' id='total-price-".$iterator."'>$".($dish["dish_price"]*$cart_list[$iterator]["qty"])."</td>";
                            echo "</tr>";
                            $total += ($dish["dish_price"]*$cart_list[$iterator]["qty"]);
                        }
                    }
                    echo "</tbody>";
                    echo "<tfoot>";
                        echo "<tr>";
                            echo "<td class='shopping-td td-text-total' colspan='5'>Total</td>";
                            echo "<td class='shopping-td td-total' id='total-td'>$".$total."</td>";
                        echo "</tr>";
                    echo "</tfoot>";
                    echo "</table>";

                    echo "<button id='btn-modal' class='btn-main'>confirm</button>";
                    echo "<dialog class='modal-cart' id='modal'>";
                        echo "<h2>Confirm your purchase</h2>";

                        echo "<form method='post' action='save-purchase.php' class='modal-form' id='modal-form'>";

                            echo "<div id='card-modal-container' class='card-modal-container'>";
                                // se llena con JS
                            echo "</div>";

                            echo "<div class='ordering-type-container'>";
                            echo "<h3>Ordering methods</h3>";
                                echo "<div class='form-item-cart'>";
                                    echo "<input type='radio' id='express-item' value='1' name='ordering_type' data-id-order='1'  checked>";
                                    echo "<label for='express-item'>Express</label>";
                                echo "</div>";
                                echo "<div class='form-item-cart'>";
                                    echo "<input type='radio' id='salon-item' value='2' name='ordering_type' data-id-order='2' >";
                                    echo "<label for='salon-item'>Salon</label>";
                                echo "</div>";
                                echo "<div class='form-item-cart'>";
                                    echo "<input type='radio' id='go-to-carry-item' value='3' name='ordering_type' data-id-order='3'>";
                                    echo "<label for='go-to-carry-item'>Go to carry</label>";
                                echo "</div>";
                            echo "</div>";

                            echo "<div class='cta-modal'>";
                                echo "<button type='button' id='btn-close-modal' class='btn-main btn-close-modal'>close</button>";
                                echo "<input id='btn-send-modal' type='submit' class='btn-submit-modal btn-main' oncLick='closeModal()'>";
                            echo "</div>";
                        echo "</form>";
                    echo "</dialog>";
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
    <script src="https://cdn.jsdelivr.net/npm/luxon@3.4.3/build/global/luxon.min.js"></script>
    <script>
        let DateTime = luxon.DateTime;
        const now = DateTime.now()

        // console.log(now.year+"/"+now.month+"/"+now.day);
        // console.log(now.hour +":"+now.minute+":"+now.second);

        let inputQty;
        let quantity;
        let idDish;
        let cartDishList;
        
        let inputOrder = document.getElementById("input-order");
        let totalTd = document.getElementById("total-td");
        let modal = document.getElementById("modal");
        let btnModal = document.getElementById("btn-modal");
        let btnCloseModal = document.getElementById("btn-close-modal");
        let cardModalContainer = document.getElementById("card-modal-container");

        
        btnModal.addEventListener("click", function(){
            let info = {
                request: "cartItems"
            }
            sendDataByAjax(info);
            modal.showModal();
            modal.style.display = "grid";
            
        });

        btnCloseModal.addEventListener("click", function(){
            modal.close();
            modal.style.display = "none";
        });

        function closeModal(){
            modal.close();
        }

        function deleteItem(obj, id){
            let parentBtn = obj.parentNode;
            let trTable = parentBtn.parentNode;
            if(trTable != null){
                trTable.remove();
                let info = {
                    id_dish: id
                }
                sendDataByAjax(info);
            }
        }

        function increaseQuantity(index, id){
            inputQty = document.getElementById("input-qty-"+index);
            quantity = inputQty.value;
            if(quantity < 20){
                quantity++;
                inputQty.value = quantity;
                let info = {
                    id_dish: id,
                    qty: quantity,
                    index: index
                }
                sendDataByAjax(info);
            }
        }

        function decreaseQuantity(index, id){
            inputQty = document.getElementById("input-qty-"+index);
            quantity = inputQty.value;
            if(quantity > 1){
                quantity--;
                inputQty.value = quantity;
                let info = {
                    id_dish: id,
                    qty: quantity,
                    index: index
                }
                sendDataByAjax(info);
            }
        }

        function sendDataByAjax(info){
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
                let totalPrice = 0;
                if(data["total_price"] != null){
                    //actualiza el precio del platillo modificado
                    document.getElementById("total-price-"+data["index"]).innerHTML = "$"+data["total_price"].toFixed(1);
                }
                //actualiza el precio total
                totalTd.innerHTML = "$"+data["total"].toFixed(1);

                if(typeof data["items"] !== 'undefined'){
                    
                    let modalForm = document.getElementById("modal-form");

                    if(document.getElementById("card-modal-container") !== null) document.getElementById("card-modal-container").remove();

                    let newModalContainer = document.createElement("div");
                    newModalContainer.classList.add("card-modal-container");
                    newModalContainer.setAttribute("id", "card-modal-container");
                    modalForm.appendChild(newModalContainer);

                    let currentDate = now.year+"-"+now.month+"-"+now.day;
                    let currentTime = now.hour +":"+now.minute+":"+now.second;
                    let totalPriceModal = 0;
                    
                    let cartDishList = [];
                    let currentDish;
                    if(data["items"].length > 0){
                        
                        let dishList = data["items"];
                        let qtyList = data["qty_dishes"];
                        
                        dishList.forEach(function(item, index){

                            let modalCard = document.createElement("div");
                            modalCard.classList.add("card-modal");
                            newModalContainer.appendChild(modalCard);

                            let imageContainer = document.createElement("div")
                            imageContainer.classList.add("modal-image");
                            modalCard.appendChild(imageContainer);

                            let image = document.createElement("img");
                            image.classList.add("element-image");
                            image.setAttribute("src", './imgs/'+item[0]["dish_img"]);
                            image.setAttribute("alt", item[0]["dish_name"]);
                            imageContainer.appendChild(image);

                            let cardContent = document.createElement("div")
                            cardContent.classList.add("modal-content");
                            modalCard.appendChild(cardContent);

                            let dishName = document.createElement("p")
                            dishName.innerText = item[0]["dish_name"];
                            cardContent.appendChild(dishName);

                            let divPrices = document.createElement("div");
                            divPrices.classList.add("prices");
                            cardContent.appendChild(divPrices);

                            let priceTxt = document.createElement("p")
                            priceTxt.innerText = "price: $" + item[0]["dish_price"];
                            divPrices.appendChild(priceTxt);

                            let qtyTxt = document.createElement("p")
                            qtyTxt.innerText = "Quantity: " + qtyList[index];
                            divPrices.appendChild(qtyTxt);

                            let totalPrice = document.createElement("p")
                            totalPrice.innerText = "Total price: $" + (qtyList[index] * item[0]["dish_price"]).toFixed(1);
                            divPrices.appendChild(totalPrice);

                            let inputTotalDish = document.createElement("input");
                            inputTotalDish.type = "hidden";
                            inputTotalDish.name = "total_price";
                            inputTotalDish.value = (qtyList[index] * item[0]["dish_price"]);
                            inputTotalDish.setAttribute("id", "input-total-dish-"+index);
                            cardContent.appendChild(inputTotalDish);

                            totalPriceModal += (qtyList[index] * item[0]["dish_price"]);

                            let currentDish = {
                                id: item[0]["id_dishes"],
                                name: item[0]["dish_name"],
                                price: item[0]["dish_price"],
                                qty: qtyList[index],
                                total_price: (qtyList[index] * item[0]["dish_price"]).toFixed(1)
                            }

                            cartDishList.push(currentDish);
                        });
                    }
                    

                    let totalTxt = document.createElement("h3")
                    totalTxt.innerText = "Total price: $" + totalPriceModal;
                    newModalContainer.appendChild(totalTxt);

                    let inputTotal = document.createElement("input");
                    inputTotal.type = "hidden";
                    inputTotal.name = "total";
                    inputTotal.value = totalPriceModal;
                    newModalContainer.appendChild(inputTotal);

                    let inputDate = document.createElement("input");
                    inputDate.type = "hidden";
                    inputDate.name = "date";
                    inputDate.value = currentDate;
                    inputDate.setAttribute("id", "input-date");
                    newModalContainer.appendChild(inputDate);

                    let inputTime = document.createElement("input");
                    inputTime.type = "hidden";
                    inputTime.name = "time";
                    inputTime.value = currentTime;
                    inputTime.setAttribute("id", "input-time");
                    newModalContainer.appendChild(inputTime);

                    console.log("Test: " + JSON.stringify(cartDishList));

                    let inputData = document.createElement("input");
                    inputData.type = "hidden";
                    inputData.name = "data";
                    inputData.value = JSON.stringify(cartDishList);
                    inputData.setAttribute("id", "input-data");
                    newModalContainer.appendChild(inputData);
                }
            })
            .catch(err => console.log("error: " + err));
        }
        
    </script>
</body>
</html>