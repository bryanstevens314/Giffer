

<?php
// require 'vendor/autoload.php';
class URL
{
    private $conn;

    public function __construct()
    {
        $database = new URLTable();
        $db = $database->dbConnection();
        $this->conn = $db;
    }

    public function crypto_rand_secure($min, $max)
    {
        $range = $max - $min;
        if ($range < 1) {
            return $min;
        } // not so random...
        $log = ceil(log($range, 2));
        $bytes = (int) ($log / 8) + 1; // length in bytes
    $bits = (int) $log + 1; // length in bits
    $filter = (int) (1 << $bits) - 1; // set all lower bits to 1
    do {
        $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
        $rnd = $rnd & $filter; // discard irrelevant bits
    } while ($rnd > $range);

        return $min + $rnd;
    }

    public function getToken($length)
    {
        $token = '';
        $codeAlphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $codeAlphabet .= 'abcdefghijklmnopqrstuvwxyz';
        $codeAlphabet .= '0123456789';
        $max = strlen($codeAlphabet); // edited

        for ($i = 0; $i < $length; ++$i) {
            $token .= $codeAlphabet[crypto_rand_secure(0, $max - 1)];
        }

        return $token;
    }

    public function updateCustomer($uname, $umail, $ushipping, $uchargeID, $udate, $ID)
    {
        try {
            $dbhost = 'localhost';
            $dbuser = 'stevens_apps';
            $db_name = 'main';
            $dbpass = '';
        $conn1 = new PDO("mysql:host={$dbhost};dbname={$db_name}", $dbuser, $dbpass);
        $sql1 = "UPDATE customers
                  SET name = :uname, email = :umail, shipping = :ushipping, shipped = 'NO', charge_ID = :ucharge_id, date = :udate
                  WHERE ID = :id";

        $stmt = $conn1->prepare($sql1);

        $res = $stmt->execute([
          'uname' => $uname,
          'umail' => $umail,
          'ushipping' => $ushipping,
          'ucharge_id' => $uchargeID,
          'udate' => $udate,
          'id' => $ID
        ]);
        return;

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function newURL($url)
    {
        try {
            $stmt = $this->conn->prepare('INSERT INTO main(url) 
		                                  VALUES(:url)');

            $stmt->bindparam(':url', $url);

            $stmt->execute();
            $id = $this->conn->lastInsertId();

            return $id;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function addFavorite($url,$uID){
                try {
            $stmt = $this->conn->prepare('INSERT INTO favorites(url, uID) 
		                                  VALUES(:url,:uID)');

            $stmt->bindparam(':url', $url);
            $stmt->bindparam(':uID', $uID);

            $stmt->execute();
            $id = $this->conn->lastInsertId();

            return $id;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function getUserID($query)
    {
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $ID;
        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $ID = $row['id'];
            }
        }

        return $ID;
    }
public function dataview($query,$pageNum,$id)
    {
        $stmt = $this->conn->prepare($query);
        $stmt->execute(); ?>
        <style>
            .frame{
                width:285px;
                padding-top:2px;
                margin-right:2px;
                padding-bottom:25px;
                border: 1px solid grey;
            }
            .heart{
                height:30;
                width:32px;
                float:right;
                padding-right:7px;
            }
            .gif{
                width:99%;
                display: block;
                margin-left:auto;
                margin-right: auto;
                margin-bottom:10px;
            }

            a.link{
                text-align:center;
                font-size: 20px;
                color: #a6a6a6;
                display:inline-block;
            }
            h2{
                font-size: 20px;
                color: #1a53ff;
                margin: auto;
                margin-left:10px;
                display:inline-block;
            }
        </style>
		<tr>
            <th></th>
        </tr>
  <?php
        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <tr class="row">
                    
                    <td class="frame">
                        <a class="navbar-brand" href=<?php echo $row['url']?> style="width:315px; height:80px;" target="_blank">
                            <img  class='gif' src=<?php echo $row['url']?>></img> 
                        </a>
                        <div>
                            <a href="addToFavorites.php?url=<?php echo $row['url']; ?>?pageNum=<?php echo $pageNum ?>?id=<?php echo $id ?>" class="heartContainer">
                                <img class='heart' src="heart.png"></img> 
                            </a>
                        </div>
                         <a class="navbar-brand" href="index.php" style="width:315px; height:80px;">
                            <h2>Posted by User101</h2>
                         </a>
                    </td>

                </tr>
                <?php
            }
        } else {
            ?>
            <tr>
            <td>Nothing here...</td>
            </tr>
            <?php
        }
    }

    public function getCustomerID($query)
    {
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $ID;
        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $ID = $row['ID'];
            }
        }

        return $ID;
    }

    public function getChargeID($query1)
    {
        $stmt = $this->conn->prepare($query1);
        $stmt->execute();
        $ID;
        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $ID = $row['charge_ID'];
            }
        }

        return $ID;
    }
    public function displayPayments($query)
    {
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $totalEarned;
        $totalOrders;
        $rows;
        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ++$rows;
                $fee = $row['fee'];
                $amout = $row['amount'];
                $total_recieved = $amout - $fee;
                $totalEarned = $totalEarned + $total_recieved;
                ++$totalOrders;
                if ($rows == $stmt->rowCount()) {
                    $totalEarned1 = number_format($totalEarned, 2); ?>
					<div class="rectangle" id="rectangle" style="height:200px; width: 100%; margin-top:120px; margin: 120px auto 0px auto; text-align:center; ">
						<div class="vertical" style="width: 1px; position:fixed; top: 180px; left: 50%;overflow: visible;">
							<div style="margin-left: -50px; width: 100px; height: 35px;">
        						<font size="2"style = "line-height: 35px;">TOTAL ORDERS</font>
        					</div>
        					<div style="margin-left: -50px; width: 100px; height: 35px;">
        						<font size="6"style = "line-height: 35px;"><?php echo $totalOrders; ?></font>
    						</div>
    					</div>
    					<div class="vertical" style="width: 1px; position:fixed; top: 180px; left: 50%;overflow: visible;">
    						<div style="margin-left: 150px; width: 100px; height: 35px;">
        						<font size="2"style = "line-height: 35px;">TOTAL EARNED</font>
        					</div>
        					<div style="margin-left: 150px; width: 100px; height: 35px;text-align:center;">
        						<font size="6"style = "line-height: 35px;"><?php echo '$'.$totalEarned1; ?></font>
   		 					</div>
    					</div>
    					
    						
    						

   		 			</div>
									




            <?php
                }
            }
        } else {
        }

        return;
    }

    public function orderShipped($id)
    {
        try {
            
            $dbhost = 'localhost';
            $dbuser = 'stevens_apps';
            $db_name = 'orders';
            $dbpass = '';
                    $conn1 = new PDO("mysql:host={$dbhost};dbname={$db_name}", $dbuser, $dbpass);
        $query1 = "UPDATE customers
    				  SET shipped = :id
    				  WHERE ID = :id";

        $stmt = $conn1->prepare($query1);

        $res = $stmt->execute([
          'id' => $id
        ]);
        return;

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function orderShippedUncheck($id)
    {
        try {
            $dbhost = 'localhost';
            $dbuser = 'stevens_apps';
            $db_name = 'orders';
            $dbpass = '';
            $conn1 = new PDO("mysql:host={$dbhost};dbname={$db_name}", $dbuser, $dbpass);
        $query1 = "UPDATE customers
    				  SET shipped = 'NULL'
    				  WHERE ID = :id";

        $stmt = $conn1->prepare($query1);

        $res = $stmt->execute([
          'id' => $id
        ]);
        return;

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function ViewOrderItems($query)
    {
        $stmt = $this->conn->prepare($query);
        $stmt->execute(); ?>
  <tr>
    
    <th>Images</th>
    <th>Quantity</th>
    <th>Product</th>
    <th>Aluminum Options</th>
  </tr>
  <?php
        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>

                <tr>
                	<td><label> <a href="view-Order.php">View Image</a></label></td>
                	<td><?php echo $row['product_quantity']; ?></td>
                	<td><?php echo $row['product']; ?></td>
                
                
                	<td><?php echo $row['aluminum_Options']; ?></td>

                </tr>
                <?php
            }
        } else {
            ?>
            <tr>
            <td>Nothing here...</td>
            </tr>
            <?php
        }

        return $data;
    }

    public function paging($query, $records_per_page)
    {
        $starting_position = 0;
        if (isset($_GET['page_no'])) {
            $starting_position = ($_GET['page_no'] - 1) * $records_per_page;
        }
        else{
            $starting_position = 0 * $records_per_page;
        }
        $query2 = $query." limit $starting_position,$records_per_page";

        return $query2;
    }

    public function jsonview($query)
    {
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $json = array();

        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $json[] = $row;
            }
        }

        return json_encode($json);
    }
}
?>

