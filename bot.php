<?php

// Get the message contents and decode the json
$postData = file_get_contents( "php://input" );

$p = json_decode($postData, true);


?>