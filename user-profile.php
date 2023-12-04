<?php
include_once "./database.php";
session_start();
// session_destroy();

if (isset($_SESSION)) {
    if ($_SESSION["isLoggedIn"]) {
        $user = $database->select("tb_users", "*", [
            "id_user" => $_SESSION["id"]
        ]);

        if (count($user) > 0) {
            $orders = $database->select("tb_order", "*", [
                "id_user" => $user[0]["id_user"]
            ]);

            if (count($orders) > 0) {
                $items = $database->select("tb_order", [
                    "[>]tb_order_details" => ["id_order" => "id_order"],
                    "[>]tb_dishes" => ["tb_order_details.id_dish" => "id_dishes"],
                    "[>]tb_users" => ["id_user" => "id_user"]
                ], [
                    "tb_order.id_order",
                    // "tb_order.order_date",
                    "tb_order.id_order_type",
                    // "tb_order.total_price",
                    "tb_order.id_user",
                    "tb_order_details.qty",
                    "tb_order_details.price",
                    "tb_dishes.dish_name",
                    "tb_dishes.dish_img"
                ], [
                    "tb_order.id_user" => $user[0]["id_user"]
                ]);
            }

            var_dump($orders);
        }
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
    <main class="user-main">
        <div class="user-section">
            <div class="user-card">
                <div class="user-img-container">
                    <img class="user-img" src="./imgs/user-svgrepo-com.svg" alt="user icon">
                </div>
                <div class="user-content">
                    <p class="user-title">
                        <?php echo $user[0]["fullname"] ?>
                    </p>
                    <p>
                        <?php echo $user[0]["email"] ?>
                    </p>
                </div>
                <button>
                    <img src="./imgs/exit-svgrepo-com.svg" alt="exit">
                </button>
            </div>
        </div>
        <section class="user-history">
            <h2 class="section-title">User history</h2>
            <?php
            if (count($orders) > 0) {
                foreach ($orders as $order) {
                    echo "<div class='history-item'>";
                    echo "<div class='history-header'>";
                    echo "<p>Date: " . $order["order_date"] . "</p>";
                    echo "<p>Total price: $" . $order["total_price"] . "</p>";
                    echo "</div>";

                    foreach ($items as $item) {
                        if ($item["id_order"] == $order["id_order"]) {
                            echo "<div class='history-content'>";
                            echo "<div class='history-img-container'>";
                            echo "<img class='history-img' src='./imgs/" . $item["dish_img"] . "' alt=''>";
                            echo "</div>";
                            echo "<div class='history-text'>";
                            echo "<div class='histoy-text-container'>";
                            echo "<p class='title-history-text'>Dish name</p>";
                            echo "<p>" . $item["dish_name"] . "</p>";
                            echo "</div>";
                            echo "<div class='histoy-text-container'>";
                            echo "<p class='title-history-text'>Quantity</p>";
                            echo "<p>" . $item["qty"] . "</p>";
                            echo "</div>";
                            echo "<div class='histoy-text-container'>";
                            echo "<p class='title-history-text'>Price</p>";
                            echo "<p>$" . $item["price"] . "</p>";
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
                        }
                    }
                    echo "</div>";
                }
            } else {
                echo "<h3>empty history</h3>";
            }
            ?>

            <div class="history-item">
                <div class="history-header">
                    <p>Date: 00/00/00</p>
                    <p>total price: $300</p>
                </div>
                <div class="history-content">
                    <img class="history-img" src="./imgs/chai-tea-latte.jpg" alt="">
                    <div class="history-text">
                        <p>name</p>
                        <p>qty</p>
                        <p>price</p>
                    </div>
                </div>

                <div class="history-content">
                    <img class="history-img" src="./imgs/chai-tea-latte.jpg" alt="">
                    <div class="history-text">
                        <div>
                            <p>name</p>
                            <p>test</p>
                        </div>
                        <div>
                            <p>name</p>
                            <p>test</p>
                        </div>
                        <div>
                            <p>name</p>
                            <p>test</p>
                        </div>

                    </div>
                </div>
            </div>

        </section>
    </main>

    <?php
    include "./parts/footer.php";
    ?>
</body>

</html>