<?php

/**
 * Created by PhpStorm.
 * User: Jomari Garcia
 * Date: 2/25/2020
 * Time: 2:01 PM
 */
class db_connection
{
    public function __construct()
    {
        $server = "localhost";
        $username = "root";
        $password = "";
        $db_name = "inventory_project";

        $this->con = mysqli_connect($server, $username, $password, $db_name)
        or die("Failed To Connect".$this->con->connect_error);
    }

    public function db_select_product()
    {
        $sql_Select = $this->con->prepare('SELECT * FROM product');
        $sql_Select->bind_param('s', $this->member_id);
        $sql_Select->execute() or die('Query error'.$this->con->error);

        $result = $sql_Select->get_result();
        while($row = $result->fetch_assoc())
        {
            echo '<option value="'.$row['product_id'].'">'.$row['product_name'].'</option>';
        }
        $sql_Select->close();
    }

    public function db_select_product_table()
    {
        $sql_Select = $this->con->prepare('SELECT * FROM product');
        $sql_Select->execute() or die('Query error'.$this->con->error);

        $result = $sql_Select->get_result();
        while($row = $result->fetch_assoc())
        {
            echo '<tr>
                    <td class="linement">'.$row['product_name'].'</td>
                    <td class="linement">'.$row['price'].'</td>
                    <td class="linement">'.$row['stock'].'</td>
                </tr>';
        }
        $sql_Select->close();
    }

    public function db_select_product_amount($product_id)
    {
        $sql_Select = $this->con->prepare('SELECT * FROM product WHERE product_id = ?');
        $sql_Select->bind_param('s', $product_id);
        $sql_Select->execute() or die('Query error'.$this->con->error);

        $result = $sql_Select->get_result();
        while($row = $result->fetch_assoc())
        {
            echo '<label id="lbl_Amount">Amount:
                                            <input type="text" class="form-control" id="txtAmount" name="fAmount" placeholder="Amount" value="'.$row['amount'].'" readonly required/>
                                        </label>';
        }
        $sql_Select->close();
    }

    public function __destruct()
    {
        $this->con->close();
    }
}