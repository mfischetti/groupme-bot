<?php
require './httpful.phar';

//grabs the groupme bot id from the envrionment variables
$BOT_ID = getenv('BOT_ID'); 

// Get the message contents and decode the json
$postData = file_get_contents( "php://input" );

$p = json_decode($postData, true);

//values from groupme message
$msgid = $p['id'];
$msgText = strtolower($p['text']); 
$usrName = strtolower($p['name']);

$cmd = explode (':',$msgText);

//responses to message commands
if($cmd[0] == 'test_bot'){
    switch ( $cmd[1] ){
       case "Hello": 
            $post('Hi ' . $usrName . '!');
            break;
        }
}

function post($msg){
    $baseUrl = "https://api.groupme.com/v3/bots/post";
    $res = \Httpful\Request::post( $this->baseUrl )->sendsJson( )->body( '{"text":"'.  $msg .'","bot_id":"' . $BOT_ID . '"}' )->send( );
}

?>