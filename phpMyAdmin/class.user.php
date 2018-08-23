<?php

class USER
{	

	private $conn;
	
	public function __construct()
	{
		$database = new Database();
		$db = $database->dbConnection();
		$this->conn = $db;
    }
	
	public function runQuery($sql)
	{
		$stmt = $this->conn->prepare($sql);
		return $stmt;
	}
	
	public function register($uname,$umail,$upass)
	{
		try
		{
			$new_password = password_hash($upass, PASSWORD_DEFAULT);
			
			$stmt = $this->conn->prepare("INSERT INTO users(user_name,user_email,user_pass) 
		                                               VALUES(:uname, :umail, :upass)");
												  
			$stmt->bindparam(":uname", $umail);
			$stmt->bindparam(":umail", $umail);
			$stmt->bindparam(":upass", $new_password);										  
				
			$stmt->execute();	
			
			return $stmt;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}				
	}
	
public function getUserID($query)
	{
	    	$stmt = $this->conn->prepare($query);
		    $stmt->execute();
		    $ID;
		    if($stmt->rowCount()>0)
		        {
			        while($row=$stmt->fetch(PDO::FETCH_ASSOC))
		    	        {
		    	            $ID = $row['user_id'];
		    	        }
                }
	        return $ID;
	}
	
public function addStripeInfo($customerID, $id,$secret,$publishable)
	{
		        try {
            $dbhost = 'localhost';
            $dbuser = 'stevens_apps';
            $db_name = 'crud';
            $dbpass = '';
            $conn1 = new PDO("mysql:host={$dbhost};dbname={$db_name}", $dbuser, $dbpass);
			$query1 = "UPDATE users
    				  SET stripe_ID = :id secret = :secret publishable = :publishable
    				  WHERE ID = $customerID";

        $stmt = $conn1->prepare($query1);

        $res = $stmt->execute([
          'id' => $id,
          'secret' => $secret,
          'publishable' => $publishable
        ]);
        return;

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
				
	}
	
public function getStripeID($query)
	{
	    	$stmt = $this->conn->prepare($query);
		    $stmt->execute();
		    $ID;
		    if($stmt->rowCount()>0)
		        {
			        while($row=$stmt->fetch(PDO::FETCH_ASSOC))
		    	        {
		    	            $ID = $row['stripe_ID'];
		    	        }
                }
	        return $ID;
	}
	
public function CreateStripeTable($user_ID, $stripeID, $key, $refresh_token,$access_token)
	{
		try
		{
			
			$stmt = $this->conn->prepare("INSERT INTO stripe(user_ID,stripe_ID,publishable,refresh_Token,access_Token) 
		                                               VALUES(:user_ID, :stripeID, :publishable, :refresh_token, :access_token)");
												  
			$stmt->bindparam(":user_ID", $user_ID);
			$stmt->bindparam(":stripeID", $stripeID);
			$stmt->bindparam(":publishable", $key);
			$stmt->bindparam(":refresh_token", $refresh_token);
			$stmt->bindparam(":access_token", $access_token);
				
			$stmt->execute();	
			
			return $stmt;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}

			// $dbhost = 'localhost';
   //         $dbuser = 'stevens_apps';
   //         $db_name = "crud";
   //         $dbpass = '';
   //          $conn1 = mysql_connect($dbhost, $dbuser, $dbpass);
             
			// $query1 = "UPDATE users
   // 				   SET access_Token = $access_token
   // 				   WHERE user_id = $user_ID";
   // 		// stripe_ID = $stripeID publishable = $key refresh_Token = $refresh_token  
   // 		mysql_select_db('crud');
    		
   // 		//$conn1->query($query1);
 		// 	 mysql_query($query1);	
			
			// return $retval;		
				
	}
	
	
	public function doLogin($uname,$umail,$upass)
	{
		try
		{
			$stmt = $this->conn->prepare("SELECT user_id, user_name, user_email, user_pass FROM users WHERE user_name=:uname OR user_email=:umail ");
			$stmt->execute(array(':uname'=>$uname, ':umail'=>$umail));
			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
			if($stmt->rowCount() == 1)
			{
				if(password_verify($upass, $userRow['user_pass']))
				{
					$_SESSION['user_session'] = $userRow['user_id'];
					return true;
				}
				else
				{
					return false;
				}
			}
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	
	public function is_loggedin()
	{
		if(isset($_SESSION['user_session']))
		{
			return true;
		}
	}
	
	public function redirect($url)
	{
		header("Location: $url");
	}
	
	public function doLogout()
	{
		session_start();
		session_destroy();
		unset($_SESSION['user_session']);
		return true;
	}
}
?>