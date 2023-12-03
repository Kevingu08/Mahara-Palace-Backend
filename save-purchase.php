<?php 
    require_once "./database.php";
    session_start();
    if($_POST){
        var_dump($_POST);
        $data = json_decode($_POST["data"], true);
        $order_type = intval($_POST["ordering_type"]);
        $total_price = intval($_POST["total"]);
        $date = $_POST["date"];
        $time = $_POST["time"];
        var_dump($data);
        if(isset($_SESSION)){
            $id_user = $_SESSION["id"];
        }

        $database->insert("tb_order",[
            "order_date"=>$date ." ". $time,
            "id_order_type"=>$order_type,
            "id_user"=>$id_user,
            "total_price"=>$total_price
        ]);

        $id_order = $database->id();

        for($index = 0; $index < count($data); $index++){
            $database->insert("tb_order_details",[
                "id_order"=>$id_order,
                "id_dish"=>$data[$index]["id"],
                "qty"=>$data[$index]["qty"],
                "price"=>$data[$index]["price"]
            ]);
        }

        header("location: shopping-cart.php");
        $dish_list = [];
        setcookie("dishList", json_encode($dish_list), time() + 72000);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>