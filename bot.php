<?php

// Get the message contents and decode the json
$postData = file_get_contents( "php://input" );

$p = json_decode($postData, true);

//values from groupme message
$msgid = $p['id'];
$msgText = strtolower($p['text']); 
$usrName = strtolower($p['name']);

echo 'Message id: ' . $msgid;
echo 'Message Text: ' . $msgText;
echo 'Message username : ' . $usrName;

?>