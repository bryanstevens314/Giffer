<?php
class OrderTable
{   
    private $host = "localhost";
    private $db_name = "orders";
    private $username = "stevens_apps";
    private $password = "";
    public $conn;
    
     
public function dbConnection()
	{
     
	    $this->conn = null;    
        try
		{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
        }
		catch(PDOException $exception)
		{
            echo "Connection error: " . $exception->getMessage();
        }
         
        return $this->conn;
    }
    public function dbConnection1()
	{
     
	    $connect = mysql_connect($host, $username, $password);
         
        return $connect;
    }
    

	
	
}
?>