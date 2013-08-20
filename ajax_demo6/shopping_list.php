<?php

header("Content-type: application/json");

echo <<<EOL
    {
        "Produce": [
            {"name": "Broccoli", "price": 4},
            {"name": "Carrots", "price": 5},
            {"name": "Mushrooms", "price": 6}
        ],
        "Seafood": [
            {"name": "Salmon", "price": 7},
            {"name": "Scallops", "price": 8}
        ]
    }
EOL;

// $items = array(
//     "Produce" => array(
//         array("name" => "Broccoli", "price" => 4),
//         array("name" => "Carrots", "price" => 5)
//     "Seafood" => array(
//         array("name" => "Salmon", "price" => 6),
//         array("name" => "Scallops", "price" => 7)
//     )
// );
// 
// echo json_encode($items);

?>