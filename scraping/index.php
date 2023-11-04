<?php
    require_once '../database.php';
    //https://simplehtmldom.sourceforge.io/docs/1.9/
    include 'simple_html_dom.php';
    /*
    INDIA
    https://www.allrecipes.com/recipes/17136/world-cuisine/asian/indian/main-dishes/
    https://www.allrecipes.com/recipes/15935/world-cuisine/asian/indian/drinks/

    GENERIC DRINKS 
    https://www.allrecipes.com/recipes/77/drinks/

    */

    $link_appetizers = "https://www.allrecipes.com/recipes/1874/world-cuisine/asian/indian/appetizers/";
    $link_dishes = "https://www.allrecipes.com/recipes/17136/world-cuisine/asian/indian/main-dishes/";
    $link_drinks = "https://www.allrecipes.com/recipes/15935/world-cuisine/asian/indian/drinks/";
    $link_desserts = "https://www.allrecipes.com/recipes/1879/world-cuisine/asian/indian/desserts/";


    $filenames = [];
    $menu_item_names = [];
    $menu_item_descriptions = [];
    $image_urls = [];
    $formatted_description;

    //crear una variable para determinar la cantidad de platillos o bebidas: iniciarla en 6 para platillos y luego en 2 para las bebidas
    $limit = 6;
    
    //crear una variable para el file_get_html y que reciba como parámetro el link al url que se va a hacer el scraping
    //$dishes = file_get_html($link_dishes);
    $drinks = file_get_html($link_drinks);
    //$appetizers = file_get_html($link_appetizers);
    //$desserts = file_get_html($link_desserts);

    foreach($drinks->find('.card--no-image') as $item){
       if($limit > 0){
        $title = $item->find('.card__title-text');
        $details = file_get_html($item->href);
        $description = $details->find('.article-subheading');
        $image = $details->find('.primary-image__image');
        if(count($image) > 0){
            $image_urls[] = $image[0]->src;
        }
        else{
            $replace_img = $item->find('.universal-image__image');
            if(count($replace_img) > 0){
                $image_urls[] = $replace_img[0]->{'data-src'};
            }
        }

        if(count($description) > 0){
            if($limit == 0) break;
        }
            $menu_item_names[] = trim($title[0]->plaintext);
            $formatted_description = $description[0]->plaintext;
            $formatted_description = str_replace("'", "", $formatted_description);
            $menu_item_descriptions[] = $formatted_description;
            
            $filename = strtolower(trim($title[0]->plaintext));
            $filename = str_replace(' ', '-', $filename);
            $filenames[] = $filename;

            $limit--;
       } 
       echo count($menu_item_names);
    }
    //descargar las imágenes desde el sitio y llevarlas a la carpeta images

    // foreach ($filenames as $index=>$image){
    //     file_put_contents("../imgs/".$image.".jpg", file_get_contents($image_urls[$index]));
    // }

    //para asignar precios aleatorios puede usar esto: rand (1*10, 70*10)/10;
    //insert info
    // Reference: https://medoo.in/api/insert

    for($index = 0; $index<6; $index++){
        $database->insert("tb_dishes",[
            "dish_name"=> $menu_item_names[$index],
            "dish_img"=> $filenames[$index].".jpg",
            "id_dish_category"=> 3,
            "featured_dish"=> 0,
            "dish_description"=> $menu_item_descriptions[$index],
            "dish_price"=> rand (1*10, 70*10)/10,
            "id_dish_quantity"=> 1
        ]);
    }
?>