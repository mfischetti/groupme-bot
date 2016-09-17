<?php
/*************************************************************************************
* groupMeApi.php
* Contains GroupMe specific functions
* 
*************************************************************************************/
require './httpful.phar';

class groupMeApi{

    private $baseUrl = "https://api.groupme.com/v3/bots/post";
    
    public function post($msg,$bot_id){
        error_log($msg);
        $res = \Httpful\Request::post( $this->baseUrl )->sendsJson( )->body( '{"text":"'.  $msg .'","bot_id":"' . $bot_id . '"}' )->send( );
   
    }
}
?>