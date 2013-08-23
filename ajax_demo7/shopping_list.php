<?php

header("Content-type: application/json");

$items = array(
    "Produce" => array(
        array("name" => "Broccoli", "price" => 4),
        array("name" => "Carrots", "price" => 5)
    ),
    "Seafood" => array(
        array("name" => "Salmon", "price" => 6),
        array("name" => "Scallops", "price" => 7)
    ),
    "Pasta" => array(
        array("name" => "Linguine", "price" => 8)
    ),
    "Misc" => array(
        array("name" => "Paper Towels", "price" => 9),
        array("name" => "Forks", "price" => 10),
        array("name" => "Light Bulbs", "price" => 11)
    )
);

if (isset($_REQUEST['action'])) {
    switch($_REQUEST['action']) {
        case 'get_categories':
        $categories = array();
        foreach($items as $key => $value) {
            $categories[] = $key;
        }
        
        echo json_encode($categories);
        break;
        
        case 'get_all':
        echo json_encode($items);
        break;
        
        case 'get_by_category':
        $category = array($_GET['category']);
        
        $items = array_intersect_key($items, array_flip($category));
        
        echo json_encode($items);
        break;
        
        case 'add_item':
        $items[$_POST['category']][] = array('name' => $_POST['item'], 'price' => $_POST['price']);
        
        print_r($items);
        break;
    }
}

?>