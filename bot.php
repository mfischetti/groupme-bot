<?php

//grabs the groupme bot id from the envrionment variables
$BOT_ID = getenv('BOT_ID'); 

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

//bot repeats messages back to group
$baseUrl = "https://api.groupme.com/v3/bots/post";
$res = \Httpful\Request::post( $this->baseUrl )->sendsJson( )->body( '{"text":"'.  $msgText .'","bot_id":"' . $BOT_ID . '"}' )->send( );

?>