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
                <table class="shopping-tb" id="shopping-tb">
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
                        <tr>
                            <td class="shopping-td"><img class="element-image" src="./imgs/chai-tea-latte.jpg" alt=""></td>
                            <td class="shopping-td">Tea</td>
                            <td class="shopping-td">$19</td>
                            <td class="shopping-td">
                                <input type="text" class="input-shopping-quantity">
                                <div>
                                    <button class="quantity-btn-shopping" >-</button>
                                    <button class="quantity-btn-shopping" >+</button>
                                </div>
                            </td>
                            <td class="shopping-td"><button>Delete</button></td>
                            <td class="shopping-td">$19</td>
                        </tr>
                        <tr>
                            <td class="shopping-td"><img class="element-image" src="./imgs/chai-tea-latte.jpg" alt=""></td>
                            <td class="shopping-td">Tea</td>
                            <td class="shopping-td">$19</td>
                            <td class="shopping-td">
                                <input type="text" class="input-shopping-quantity">
                                <div>
                                    <button class="quantity-btn-shopping" >-</button>
                                    <button class="quantity-btn-shopping" >+</button>
                                </div>
                            </td>
                            <td class="shopping-td"><button>Delete</button></td>
                            <td class="shopping-td">$19</td>
                        </tr>
                        <tr>
                            <td class="shopping-td"><img class="element-image" src="./imgs/chai-tea-latte.jpg" alt=""></td>
                            <td class="shopping-td">Tea</td>
                            <td class="shopping-td">$19</td>
                            <td class="shopping-td">
                                <input type="text" class="input-shopping-quantity">
                                <div>
                                    <button class="quantity-btn-shopping" >-</button>
                                    <button class="quantity-btn-shopping" >+</button>
                                </div>
                            </td>
                            <td class="shopping-td"><button>Delete</button></td>
                            <td class="shopping-td">$19</td>
                        </tr>
                        <tr>
                            <td class="shopping-td"><img class="element-image" src="./imgs/chai-tea-latte.jpg" alt=""></td>
                            <td class="shopping-td">Tea</td>
                            <td class="shopping-td">$19</td>
                            <td class="shopping-td">
                                <input type="text" class="input-shopping-quantity">
                                <div>
                                    <button class="quantity-btn-shopping" >-</button>
                                    <button class="quantity-btn-shopping" >+</button>
                                </div>
                            </td>
                            <td class="shopping-td"><button>Delete</button></td>
                            <td class="shopping-td">$19</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </main>
    <?php 
        include "./parts/footer.php";
    ?>
    <script src="./js/main.js"></script>
</body>
</html>