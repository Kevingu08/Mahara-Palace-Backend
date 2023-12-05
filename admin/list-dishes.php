<?php
require_once '../database.php';

$dishes = $database->select("tb_dishes", "*");



session_start();

$user = $database->select("tb_users", "*", [
    "id_user" => $_SESSION['id']
]);

if (isset($_SESSION['isLoggedIn']) && ($user[0]['is_admin'] == 'y')) {

    if ($_POST && isset($_POST['dish_id'])) {

        $img_delete = $database->get("tb_dishes", ["id_dishes", "dish_img"], [
            "id_dishes" => $_POST["dish_id"]
        ]);

        $database->delete("tb_dishes", [
            "id_dishes" => $_POST["dish_id"]
        ]);


        $database->delete("tb_related_products", [
            "id_related_dishes" => $_POST["dish_id"]
        ]);

        if ($img_delete && isset($img_delete["dish_img"])) {
            $deleted_img = $img_delete["dish_img"];
            $img_path = "../imgs/" . $deleted_img;

            if (file_exists($img_path)) {
                unlink($img_path);
            }
        }


        header("location: list-dishes.php");
    }

} else {
    header("location: ../index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>list-dishes</title>
    <link rel="stylesheet" href="../css/main.css">
</head>

<body>
    <!-- header -->
    <header class="hero-container">
        <?php
        $path = "../login.php";
        $iconPath = "../imgs/add-user.svg";
        if ($_SESSION) {
            $iconPath = "../imgs/user-icon.svg";
            $path = "../user-profile.php";
        }
        ?>
        <!-- Barra de navegacion -->
        <nav class="top-nav" id="top-navigation">
            <a href="../index.php"><img class="logo-maharaja" src="../imgs/Maharaja-palace-logo.png"
                    alt="Maharaja palace logo"></a>

            <!-- mobile nav -->
            <input class="mobile-check" type="checkbox" id="mobile-check">
            <label class="mobile-btn">
                <span class="line-menu firts-line-menu"></span>
                <span class="line-menu second-line-menu"></span>
                <span class="line-menu third-line-menu"></span>
            </label>
            <!-- mobile nav -->

            <ul class="nav-list" id="navigation-list">
                <li><a class="nav-list-link" href="index.php">Home</a></li>
                <li><a class="nav-list-link" href="menu.php">Menu</a></li>
                <li><a class="nav-list-link" href="#footer">About Us</a></li>
                <li><a class="nav-list-link" href="#footer">Contact</a></li>
            </ul>
            <div class="icon-nav-container">
        <form method="get" action="results.php" class="search-container-form">
            <input id="search" class="search" type="text" name="keyword">
            <input type="submit" class="search-btn" value="">
        </form>
        <a href="<?php echo $path?>" class=""><img class="icon-nav" src="<?php echo $iconPath?>" alt=""></a>
        <a href="../shopping-cart.php"><img class="icon-nav" src="../imgs/shopping-cart-svgrepo-com.svg" alt="shopping cart"></a>
    </div>
        </nav>
        <!-- Barra de navegacion -->
    </header>
    <!-- header -->



    <!-- main -->
    <span class="overlay"></span>
    <main class="admin">
        <div class="main-container">
            <!--SideBar-->
            <?php
            include "../parts/sidebar.php";
            ?>
            <!--SideBar-->

            <div class="tabular-wrapper">
                <h3 class="admin-title">Dishes list</h3>
                <div class="underscore-admin"></div>
                <div class="table-container">
                    <table class="table">
                        <thead class="table-head">
                            <tr class>
                                <th class="table-th">Dish name</th>
                                <th class="table-th">Featured</th>
                                <th class="table-th">Category</th>
                                <th class="table-th">Price </th>
                                <th class="table-th">Quantity</th>
                                <th class="table-th">Actions</th>
                            </tr>
                        <tbody class="table-body">
                            <?php
                            foreach ($dishes as $dish) {
                                echo "<tr class='table-tr'>";
                                echo "<td class='table-td'>" . $dish["dish_name"] . "</td>";
                                echo "<td class='table-td'>" . $dish["featured_dish"] . "</td>";
                                echo "<td class='table-td'>" . $dish["id_dish_category"] . "</td>";
                                echo "<td class='table-td'>" . $dish["dish_price"] . "</td>";
                                echo "<td class='table-td'>" . $dish["id_dish_quantity"] . "</td>";
                                echo "<td><a href='edit-dishes.php?id_dishes=" . $dish["id_dishes"] . "'><img src='../imgs/edit.svg' alt='edit icon'></a> 
                                <button class='btn-delete' onclick='showPopUp(\"" . $dish["id_dishes"] . "\",\"" . $dish["dish_name"] . "\",\"" . $dish["dish_img"] . "\")'><img src='../imgs/delete-icon.svg' alt='delete icon'></button></td>";
                            }
                            ?>
                            </tr>
                        </tbody>
                        </thead>
                    </table>
                </div>

                <section class="pop-up">
                    <label for="file">
                        <img id="preview" class="upload-box-delete" src="" alt="preview">
                    </label>
                    <h2 class="admin-title">Are you sure you want to delete <span id="name_dish"> </span></h2>
                    <button id="delete" class="input-button">Delete</button>
                    <button id="cancel" class="input-button">Cancel</button>
                    <form id="deleteDish" method="post" action="list-dishes.php">
                        <input type="hidden" id="dish_id" name="dish_id" value="">
                    </form>
                </section>

            </div>
    </main>
    <script>

        let popUp = document.querySelector(".pop-up");
        let overlay = document.querySelector(".overlay");
        let btnCancel = document.getElementById("cancel");
        let btnDelete = document.getElementById("delete");

        function showPopUp(id_dishes, dish_name, dish_img) {
            let preview = document.getElementById('preview').setAttribute('src', '../imgs/' + dish_img);
            document.getElementById("dish_id").value = id_dishes;
            document.getElementById("name_dish").innerHTML = dish_name;
            popUp.classList.add("active");
            overlay.classList.add("active");

            btnCancel.addEventListener("click", () => {
                popUp.classList.remove("active");
                overlay.classList.remove("active");
            });

            btnDelete.addEventListener("click", () => {
                document.getElementById("deleteDish").submit();
            });
        }
    </script>
</body>

</html>