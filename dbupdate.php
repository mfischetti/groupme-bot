<?php
/*************************************************************************************
* dbupdate.php
* Contains functions for interacting with the MySQL database
* 
*************************************************************************************/

class dbupdate{
    protected $url;
    protected $server;
    protected $username;
    protected $password;
    protected $db;
    
    public function __construct () {
        $this->url = parse_url(getenv("CLEARDB_DATABASE_URL"));
        $this->server = $this->url["host"];
        $this->username = $this->url["user"];
        $this->password = $this->url["pass"];
        $this->db = substr($this->url["path"], 1);
    }
    public function addMsg($msgid, $usrName,$msgText){
        $dbc = new PDO('mysql:host=' .$this->server. ';dbname=' .$this->db. ';charset=utf8mb4', $this->username, $this->password);

        try{
            $dbc->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );//Error Handling

            $stmt = $dbc->prepare("INSERT INTO messages(ID, Name, Msg)
                VALUES(:id, :name, :msg)");
            $stmt->execute(array(
                "id" => $msgid,
                "name" => $usrName,
                "msg" => $msgText
            ));
        }catch(PDOException $e) {
            echo $e->getMessage();
        }
    }
}
?>
