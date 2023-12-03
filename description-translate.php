<?php
require_once './database.php';

$dishes = [];

if (isset($_SERVER["CONTENT_TYPE"])) {
    $contentType = $_SERVER["CONTENT_TYPE"];


    if ($contentType == "application/json") {
        $content = trim(file_get_contents("php://input"));

        $decoded = json_decode($content, true);

        $response = "server response";
        //echo json_encode($decoded["language"]);

        if ($decoded["language"] == 'English') {
            $item = $database->select("tb_dishes", [
                "tb_dishes.dish_name",
                "tb_dishes.dish_description"
            ], [
                "id_dishes" => $decoded["id_dishes"]
            ]);

            $dishes["name"] = $item[0]["dish_name"];
            $dishes["description"] = $item[0]["dish_description"];

        } else {
            $item = $database->select("tb_dishes", [
                "tb_dishes.dish_name_trslt",
                "tb_dishes.dish_description_trslt"
            ], [
                "id_dishes" => $decoded["id_dishes"]
            ]);

            $dishes["name"] = $item[0]["dish_name_trslt"];
            $dishes["description"] = $item[0]["dish_description_trslt"];
        }
            echo json_encode($dishes);
    }
}
?>