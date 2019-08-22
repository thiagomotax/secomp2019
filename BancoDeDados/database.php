<?php
class Database
{   
    // private $host = "143.208.8.46";
    // private $db_name = "emcomprp_secomp";
    // private $username = "emcomprp_root";
    // private $password = "84068905Titi";
    // public $conn;
    // private $host = "143.208.8.46";
    // private $db_name = "emcomprp_secomp";
    // private $username = "emcomprp_root";
    // private $password = "84068905Titi";
    // public $conn;
    
    private $host = "localhost";
    private $db_name = "emcomprp_secomp";
    private $username = "root";
    private $password = "";
    public $conn;
     
    public function dbConnection()
	{
     
	    $this->conn = null;    
        try
		{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password, 
              array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
              ));
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
		catch(PDOException $exception)
		{
            echo "Connection error: " . $exception->getMessage();
        }
         
        return $this->conn;
    }
}

?>