<?php
/*************************************************************************************
* mysqlinit.php
* Run once to setup mysql table
* 
*************************************************************************************/

//cleardb url for heroku
$url = parse_url(getenv("CLEARDB_DATABASE_URL"));

$server = $url["host"];
$username = $url["user"];
$password = $url["pass"];
$db = ltrim($url["path"], '/');

$table = "messages";
try {
    $db = new PDO('mysql:host=' .$server. ';dbname=' .$db. ';charset=utf8mb4', $username, $password);
    error_log("db connect");
    $db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );//Error Handling
    $sql ="CREATE table $table(
     ID INT( 11 )  PRIMARY KEY,
     Name VARCHAR( 50 ) NOT NULL, 
     Msg VARCHAR( 250 ) NOT NULL);" ;
     $db->exec($sql);
     print("Created $table Table.\n");

} catch(PDOException $e) {
    echo $e->getMessage();
}
?>