<?php
/*************************************************************************************
* bot.php
* PHP file used for GroupMe callback
* 
*************************************************************************************/
require './groupMeApi.php';
require './dbupdate.php';

$groupMe = new groupMeApi();
$dbupdate = new dbupdate();

//grabs the groupme bot id from the envrionment variables
$BOT_ID = getenv('BOT_ID'); 

// Get the message contents and decode the json
$postData = file_get_contents( "php://input" );

$p = json_decode($postData, true);

//values from groupme message
$msgid = $p['id'];
$msgText = strtolower($p['text']); 
$usrName = strtolower($p['name']);

//adds the message to the db
$dbupdate->addMsg($msgid, $usrName, $msgText);

$cmd = explode (':',$msgText);

//responses to message commands
if($cmd[0] == 'test_bot' && $usrName != 'test_bot'){
    switch ( $cmd[1] ){
        case "hello": 
            $groupMe->post('Hi ' . $usrName . '!',$BOT_ID);
            break;
        case "fact":
            $f_contents = file("./responses/facts.txt");
            $line = $f_contents[array_rand($f_contents)];
            $groupMe->post($line,$BOT_ID);
            break;
        case (preg_match("/\bdate\b/i", $cmd[1]) ? true : false ): 
            $date = date('Y-m-d');
            $msgDate = 'The date is ' . $date;
            $groupMe->post($msgDate,$BOT_ID);
            break;
    }
}
?>