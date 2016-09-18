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
        
        //trim text so groupme succesfuly sends message
        $msgToSend = trim(preg_replace('/\s+/', ' ', $msg));
        $res = \Httpful\Request::post( $this->baseUrl )->sendsJson( )->body( '{"text":"'.  $msgToSend .'","bot_id":"' . $bot_id . '"}' )->send( );
   
    }
}
?>