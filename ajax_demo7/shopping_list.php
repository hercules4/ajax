<?php

session_start();

header("Content-type: application/json");

// only add the items to the session if the key doesn't exist
if (!isset($_SESSION['items'])) {
    $_SESSION['items'] = array(
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
}

if (isset($_REQUEST['action'])) {
    switch($_REQUEST['action']) {
        case 'get_categories':
        $categories = array();
        foreach($_SESSION['items'] as $key => $value) {
            $categories[] = $key;
        }
        
        echo json_encode($categories);
        break;
        
        case 'get_all':
        echo json_encode($_SESSION['items']);
        break;
        
        case 'get_by_category':
        $category = array($_GET['category']);
        
        // filter the array by category
        $items = array_intersect_key($_SESSION['items'], array_flip($category));
        
        echo json_encode($items);
        break;
        
        case 'add_item':
        $_SESSION['items'][$_POST['category']][] = array('name' => $_POST['item'], 'price' => intval($_POST['price']));
        
        // echo something so that the jQuery done() method is triggered
        echo 1;
        break;
        
        case 'clear_added_items':
        unset($_SESSION['items']);
        
        header('Location: index.html');
        break;
    }
}

?>