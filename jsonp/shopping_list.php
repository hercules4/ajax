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

if (isset($_GET['callback'])) {
    echo $_GET['callback'] . '(' . json_encode($items) . ');';
} else {
    echo json_encode($items);
}

?>