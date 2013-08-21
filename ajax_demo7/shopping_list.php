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
    )
);

if (isset($_REQUEST['action'])) {
    switch($_REQUEST['action']) {
        case 'all':
        echo json_encode($items);
        break;
    
        case 'categories':
        $categories = array();
        foreach($items as $key => $value) {
            $categories[] = $key;
        }
        
        echo json_encode($categories);
        break;
    }
}

?>