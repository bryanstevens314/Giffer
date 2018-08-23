<?php

class ORDER
{
    private $conn;

    public function __construct()
    {
        $database = new OrderTable();
        $db = $database->dbConnection();
        $this->conn = $db;
    }

    public function neworder($ID, $uproduct, $uquantity, $uretouch, $ualum, $uinstructions)
    {
        try {
            $stmt = $this->conn->prepare('INSERT INTO order_Details(customer_ID, product, product_quantity, retouching, aluminum_Options, instructions) 
		                                  VALUES(:ID, :uproduct, :uquantity, :uretouch, :ualum, :uinstructions)');

            $stmt->bindparam(':ID', $ID);
            $stmt->bindparam(':uproduct', $uproduct);
            $stmt->bindparam(':uquantity', $uquantity);
            $stmt->bindparam(':uretouch', $uretouch);
            $stmt->bindparam(':ualum', $ualum);
            $stmt->bindparam(':uinstructions', $uinstructions);

            $stmt->execute();

            $id = $this->conn->lastInsertId();

            return $id;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function orderShipped($shipped_ID)
    {
        try {
            $stmt = $this->conn->prepare(
                "UPDATE customers
    									  SET shipped = '$shipped_ID',
    									  WHERE ID = '$shipped_ID'"
                                          );

            $stmt->execute();

            return $stmt;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getOrderID($query)
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

    public function dataview($query)
    {
        $stmt = $this->conn->prepare($query);
        $stmt->execute(); ?>
					  <tr>
    
    <th data-th="Name"><span>Name</span></th>
    <th>Shipping Address</th>
    <th>Email</th>
    <th>Order</th>
    <th>Shipped</th>
  </tr>
  <?php
        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>

                <tr>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['shipping']; ?></td>
                <td><?php echo $row['email']; ?></td>
                
                <td><label> <a href="view-Order.php">View Order</a></label></td>
                <td align="center">
                <a href="edit-data.php?edit_id=<?php echo $row['id']; ?>"><i class="glyphicon glyphicon-edit"></i></a>
                </td>
                <td align="center">
                <a href="delete.php?delete_id=<?php echo $row['id']; ?>"><i class="glyphicon glyphicon-remove-circle"></i></a>
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

    public function base64_to_jpeg($base64_string, $output_file)
    {
        $ifp = fopen($output_file, 'wb');
        fwrite($ifp, base64_decode($base64_string));
        fclose($ifp);

        return  $output_file;
    }

    public function ViewOrderItems($query)
    {
        $stmt = $this->conn->prepare($query);
        $stmt->execute(); ?>
					  <tr>
    <th></th>
    <th>Product</th>
    <th>Images</th>
    <th>Quantity</th>
    <th></th>
    <!--<th>Image</th>-->
  </tr>
  <?php
        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>

                <tr>
				<td width="31%"></td>
                <td width="13%"><?php echo $row['product']; ?></td>
                <td width="13%"><label> <a href="view-Images.php?order_ID=<?php echo $row['ID']; ?>" style="color:#2b6ca3;">View Image</a></label></td>
                <td width="13%"><?php echo $row['product_quantity']; ?></td>
                <td width="31%"></td>
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

    public function ViewImages($query)
    {
        $stmt = $this->conn->prepare($query);
        $stmt->execute(); ?>
					  <tr>
    
    <th></th>

  </tr>
  <?php
        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>

                <tr>
                <td><?php echo $row['product']; ?></td>
                <td><?php echo $row['product_quantity']; ?></td>
                <td><label> <a href="view-Order.php?order_ID=<?php echo $row['ID']; ?>">View Image</a></label></td>
                <td><?php echo $row['retouching']; ?></td>
                <td><?php echo $row['aluminum_Options']; ?></td>
                <td><?php echo $row['instructions']; ?></td>
                <!--<td align="center">-->
                <!--<a href="delete.php?delete_id=<?php echo $row['id']; ?>"><i class="glyphicon glyphicon-remove-circle"></i></a>-->
                <!--</td>-->
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

    public function paging($query, $records_per_page)
    {
        $starting_position = 0;
        if (isset($_GET['page_no'])) {
            $starting_position = ($_GET['page_no'] - 1) * $records_per_page;
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