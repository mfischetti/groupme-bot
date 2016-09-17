<?php
require './groupMeApi.php';

$groupMe = new groupMeApi();

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
            $groupMe->post('Hi ' . $usrName . '!',$BOT_ID);
            break;
    }
}
?>