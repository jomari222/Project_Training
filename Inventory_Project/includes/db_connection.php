<?php

/**
 * Created by PhpStorm.
 * User: Jomari Garcia
 * Date: 2/25/2020
 * Time: 2:01 PM
 */
class db_connection
{
    public $product_id;

    public function __construct()
    {
        $server = "localhost";
        $username = "root";
        $password = "";
        $db_name = "inventory_project";

        $this->con = mysqli_connect($server, $username, $password, $db_name)
        or die("Failed To Connect".$this->con->connect_error);
    }

    public function db_select_customer()
    {
        $sql_Select = $this->con->prepare('SELECT * FROM customer');
        $sql_Select->execute() or die('Query error'.$this->con->error);

        $result = $sql_Select->get_result();
        while($row = $result->fetch_assoc())
        {
            $sql_Select_region = $this->con->prepare('SELECT * FROM refregion WHERE regCode = ?');
            $sql_Select_region->bind_param('s', $row['region']);
            $sql_Select_region->execute() or die(''.$this->con->error);

            $result_region = $sql_Select_region->get_result();
            $row_region = $result_region->fetch_assoc();

            $sql_Select_province = $this->con->prepare('SELECT * FROM refprovince WHERE provCode = ?');
            $sql_Select_province->bind_param('s', $row['province']);
            $sql_Select_province->execute() or die(''.$this->con->error);

            $result_province = $sql_Select_province->get_result();
            $row_province = $result_province->fetch_assoc();

            $sql_Select_city_mun = $this->con->prepare('SELECT * FROM refcitymun WHERE citymunCode = ?');
            $sql_Select_city_mun->bind_param('s', $row['city']);
            $sql_Select_city_mun->execute() or die(''.$this->con->error);

            $result_city_mun = $sql_Select_city_mun->get_result();
            $row_city_mun = $result_city_mun->fetch_assoc();

            $sql_Select_barangay = $this->con->prepare('SELECT * FROM refbrgy WHERE brgyCode = ?');
            $sql_Select_barangay->bind_param('s', $row['barangay']);
            $sql_Select_barangay->execute() or die(''.$this->con->error);

            $result_barangay= $sql_Select_barangay->get_result();
            $row_barangay = $result_barangay->fetch_assoc();

            echo '<tr>
                    <td class="linement">'.$row['customer_id'].'</td>
                    <td class="linement">'.$row['firstname']." ".$row['lastname'].'</td>
                    <td class="linement">'.$row['store_name'].'</td>
                    <td class="linement">'.$row['unit']." ".$row_barangay['brgyDesc'].", ".$row_city_mun['citymunDesc']." ".$row_province['provDesc'].'</td>
                    <td class="linement">'.$row['contact_number'].'</td>
                    <td class="linement"><a href="account.php?ID='.$row['customer_id'].'">Order</a></td>
                </tr>';
        }
        $sql_Select->close();
    }

    public function db_select_customer_customer_id($customer_id)
    {
        $sql_Select = $this->con->prepare('SELECT * FROM customer WHERE customer_id = ?');
        $sql_Select->bind_param('s', $customer_id);
        $sql_Select->execute() or die('Query error'.$this->con->error);

        $result = $sql_Select->get_result();
        $row = $result->fetch_assoc();

        $this->first_name = $row['firstname'];
        $this->last_name = $row['lastname'];
    }

    public function db_select_table_order_customer_id($customer_id)
    {
        $sql_Select = $this->con->prepare('SELECT * FROM table_order WHERE customer_id = ?');
        $sql_Select->bind_param('s', $customer_id);
        $sql_Select->execute() or die('Query error'.$this->con->error);

        $result = $sql_Select->get_result();
        while($row = $result->fetch_assoc())
        {
            if($row < 0)
            {
                include_once('message.php');
                MessageBackMain('No records');
            }
            else
            {
                $sql_Select_product = $this->con->prepare('SELECT * FROM product WHERE product_id = ?');
                $sql_Select_product->bind_param('s', $row['product_id']);
                $sql_Select_product->execute() or die('Query error'.$this->con->error);

                $result_product = $sql_Select_product->get_result();
                $row_product = $result_product->fetch_assoc();

                echo '<tr>
                    <td rowspan="2" class="linement">'.$row_product['product_name'].'</td>
                    <td rowspan="2" class="linement">'.$row['quantity'].'</td>
                    <td rowspan="2" class="linement">'.$row_product['price'].'</td>
                    <td rowspan="2" class="linement">'.$row['discount'].'</td>
                    <td rowspan="2" class="linement">'.$row['total_amount'].'</td>
                    <td class="linement">'.$row['date_received'].'</td>
                    <td class="linement">'.$row['payment_received'].'</td>
                </tr>
                <tr>
                    <td class="linement"><a style="color: white" href="">Not yet delivered</a></td>
                    <td class="linement"><a style="color: white" href="">Not yet paid</a></td>
                </tr>';
            }
        }
    }

    public function db_select_product()
    {
        $sql_Select = $this->con->prepare('SELECT * FROM product');
        $sql_Select->execute() or die('Query error'.$this->con->error);

        $result = $sql_Select->get_result();
        echo '<option value="">Select Product</option>';
        while($row = $result->fetch_assoc())
        {
            echo '<option value="'.$row['product_id'].'">'.$row['product_name'].'</option>';
        }
        $sql_Select->close();
    }

    public function db_select_order_table()
    {
        $sql_Select_order = $this->con->prepare('SELECT * FROM table_order');
        $sql_Select_order ->execute() or die('Query error'.$this->con->error);

        $result_order = $sql_Select_order ->get_result();
        while($row_order = $result_order->fetch_assoc())
        {
            $sql_Select_product = $this->con->prepare('SELECT * FROM product WHERE product_id = ?');
            $sql_Select_product->bind_param('s', $row_order['product_id']);
            $sql_Select_product->execute() or die('Query error'.$this->con->error);

            $result_product = $sql_Select_product->get_result();
            $row_product = $result_product->fetch_assoc();

            $sql_Select_customer = $this->con->prepare('SELECT * FROM customer WHERE customer_id = ?');
            $sql_Select_customer->bind_param('s', $row_order['customer_id']);
            $sql_Select_customer->execute() or die('Query error'.$this->con->error);

            $result_customer = $sql_Select_customer->get_result();
            $row_customer = $result_customer->fetch_assoc();

            echo '<tr>
                    <td class="linement">'.$row_customer['firstname']." ".$row_customer['lastname'].'</td>
                    <td class="linement">'.$row_customer['store_name'].'</td>
                    <td class="linement">'.$row_product['product_name'].'</td>
                    <td class="linement">'.$row_order['quantity'].'</td>
                    <td class="linement">'.$row_order['total_amount'].'</td>
                    <td class="linement">'.$row_order['date_ordered'].'</td>
                </tr>';
        }
        $sql_Select_order ->close();
    }

    public function db_insert_order_customer_id($customer_id,$product_id,$quantity,$date_ordered,$date_received,$discount,$returns,$payment_date,$payment_received,$total_amount)
    {
        $sql_Insert = $this->con->prepare('INSERT INTO table_order (customer_id, product_id, quantity, date_ordered, date_received, discount, returns, payment_date, payment_received, total_amount)VALUES(?,?,?,?,?,?,?,?,?,?)');
        $sql_Insert->bind_param('ssssssssss',$customer_id,$product_id,$quantity,$date_ordered,$date_received,$discount,$returns,$payment_date,$payment_received,$total_amount);
        $sql_Insert->execute() or die('Query error'.$this->con->error);

        $sql_Insert->close();
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
                                            <input type="number" class="form-control" id="txtAmount" name="fAmount" placeholder="Amount" value="'.$row['price'].'" readonly required/>
                                        </label>';
        }
        $sql_Select->close();
    }

    public function db_select_product_price($product_id)
    {
        $sql_Select = $this->con->prepare('SELECT * FROM product WHERE product_id = ?');
        $sql_Select->bind_param('s', $product_id);
        $sql_Select->execute() or die('Query error'.$this->con->error);

        $result = $sql_Select->get_result();
        while($row = $result->fetch_assoc())
        {
            echo '<label id="lbl_Price">Price:
                                            <input type="number" class="form-control" id="txtPrice" name="fPrice" placeholder="Amount" value="'.$row['price'].'" required/>
                                        </label>';
        }
        $sql_Select->close();
    }

    public function db_update_product_price($product_id,$new_price)
    {
        $sql_Select = $this->con->prepare('SELECT * FROM product WHERE product_id = ?');
        $sql_Select->bind_param('s', $product_id);
        $sql_Select->execute() or die('Query error'.$this->con->error);

        $result = $sql_Select->get_result();
        $row = $result->fetch_assoc();

        $sql_Update = $this->con->prepare('UPDATE product SET price = ? WHERE product_id = ?');
        $sql_Update->bind_param('ss', $new_price,$product_id);
        $sql_Update->execute() or die('Query error'.$this->con->error);

        $sql_Select->close();
        $sql_Update->close();
    }

    public function db_select_Add_product_stock($product_id,$addStock)
    {
        $sql_Select = $this->con->prepare('SELECT * FROM product WHERE product_id = ?');
        $sql_Select->bind_param('s', $product_id);
        $sql_Select->execute() or die('Query error'.$this->con->error);

        $result = $sql_Select->get_result();
        $row = $result->fetch_assoc();

        $newStock = $row['stock'] + $addStock;

        $sql_Update = $this->con->prepare('UPDATE product SET stock = ? WHERE product_id = ?');
        $sql_Update->bind_param('ss', $newStock,$product_id);
        $sql_Update->execute() or die('Query error'.$this->con->error);

        $sql_Select->close();
        $sql_Update->close();
    }

    public function db_select_Minus_product_stock($product_id,$minusStock)
    {
        $sql_Select = $this->con->prepare('SELECT * FROM product WHERE product_id = ?');
        $sql_Select->bind_param('s', $product_id);
        $sql_Select->execute() or die('Query error'.$this->con->error);

        $result = $sql_Select->get_result();
        $row = $result->fetch_assoc();

        $newStock = $row['stock'] - $minusStock;

        $sql_Update = $this->con->prepare('UPDATE product SET stock = ? WHERE product_id = ?');
        $sql_Update->bind_param('ss', $newStock,$product_id);
        $sql_Update->execute() or die('Query error'.$this->con->error);

        $sql_Select->close();
        $sql_Update->close();
    }

    //GET DATA
    function get_fullname()
    {
        echo $this->first_name." ".$this->last_name;
    }

    public function __destruct()
    {
        $this->con->close();
    }
}