<?php

header("Content-type: application/json");

echo <<<EOL
    {
        "Produce": ["Broccoli", "Carrots", "Mushrooms"],
        "Seafood": ["Salmon", "Scallops"],
        "Pasta": ["Linguine"],
        "Misc": ["Paper Towels", "Forks", "Light Bulbs"]
    }
EOL;

// $items = array(
//     "Produce" => array("Broccoli", "Carrots", "Mushrooms"),
//     "Seafood" => array("Salmon", "Scallops"),
//     "Pasta" => array("Linguine"),
//     "Misc" => array("Paper Towels", "Forks", "Light Bulbs")
// );
// 
// echo json_encode($items);

?>