<?php

$response = <<<EOL

<h3>Form Response</h3>
<p>Name: {$_POST['name']}</p>
<p>Email: {$_POST['email']}</p>
<p>Comments: {$_POST['comments']}</p>

EOL;

echo $response;

?>