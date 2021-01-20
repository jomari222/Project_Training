<?php

/**
 * Created by PhpStorm.
 * User: Jomari Garcia
 * Date: 2/25/2020
 * Time: 2:01 PM
 */
class db_connection_member
{
    public $product_id;
    public $date_min;
    public $date_max;
    public $order_id_delivery_date;
    public $order_id_payment_date;
    public $paid_amount;
    public $total_amount_to_be_paid;
    public $price_bought;
    public $payment_received;
    public $product_stock_order;
    public $total_payment_of_order;
    public $total_sales_modified;
    public $total_orders_modified;
    public $cancelled;
    public $position_id;
    public $account_id;
    public $customer_id;
    //Product
    public $Mangosteen_Purple_Corn;
    public $Malunggay_and_Banaba;
    //Sale each product
    public $Mangosteen_Purple_Corn_Sale;
    public $Malunggay_and_Banaba_Sale;
    //Product Price
    public $Mangosteen_Purple_Corn_Price;
    public $Malunggay_and_Banaba_Price;
    //Dates
    public $date_ordered;
    public $date_delivered;

    public function __construct()
    {
        $server = "localhost";
        $username = "root";
        $password = "";
        $db_name = "inventory_project";

        $this->con = mysqli_connect($server, $username, $password, $db_name)
        or die("Failed To Connect".$this->con->connect_error);
    }

    //LOGIN USERNAME AND PASSWORD
    public function db_select_member_login($username,$password)
    {
        $sql_Select = $this->con->prepare('SELECT * FROM account WHERE BINARY username = ?');
        $sql_Select->bind_param('s',$username);
        $sql_Select->execute() or die('Query error'.$this->con->error);

        $result = $sql_Select->get_result();
        $row = $result->fetch_assoc();

        if($row['username'] == $username && password_verify($password,$row['password']) && $row['position_id'] == 1)
        {
            $_SESSION['username'] = $username;
            header('Location: ../dashboard.php');
        }
        else if($row['username'] == $username && password_verify($password,$row['password']) && $row['position_id'] == 2)
        {
            $_SESSION['username'] = $username;
            header('Location: ../dashboard.php');
        }
        else if($row['username'] == $username && password_verify($password,$row['password']) && $row['position_id'] == 3)
        {
            $_SESSION['username'] = $username;
            header('Location: ../account_customer.php');
        }
        else
        {
            include_once('message.php');
            MessageBackLogin("Username or Password is invalid");
        }
    }
    //INSERT TO ACCOUNT FOR NEW USER
    public  function db_insert_account($firstname,$lastname,$contact_number,$username,$password,$position_id)
    {
        $sql_Insert = $this->con->prepare('INSERT INTO account (firstname,lastname,contact_number,username,password,position_id)VALUES(?,?,?,?,?,?)');
        $sql_Insert->bind_param('ssssss',$firstname,$lastname,$contact_number,$username,$password,$position_id);
        $sql_Insert->execute() or die('Query error'.$this->con->error);

        $sql_Insert->close();
    }
    //Check Order ID
    public function db_select_order_id($order_id,$ID)
    {
        $sql_Select = $this->con->prepare('SELECT * FROM table_order WHERE BINARY order_id = ?');
        $sql_Select->bind_param('s',$order_id);
        $sql_Select->execute() or die('Query error'.$this->con->error);

        $result = $sql_Select->get_result();
        $row = $result->fetch_assoc();

        if(!$row['order_id'] == $order_id)
        {
            header('Location:customer.php?ID='.$ID.'');
            die();
        }
    }
    //Check ID
    public function db_select_id($customer_id)
    {
        $sql_Select = $this->con->prepare('SELECT * FROM customer WHERE customer_id = ?');
        $sql_Select->bind_param('s',$customer_id);
        $sql_Select->execute() or die('Query error'.$this->con->error);

        $result = $sql_Select->get_result();
        $row = $result->fetch_assoc();

        if(!$row['customer_id'] == $customer_id)
        {
            header('Location:customer.php');
            die();
        }
    }
    //Check Product ID
    public function db_select_product_id($product_id)
    {
        $sql_Select = $this->con->prepare('SELECT * FROM product WHERE product_id = ?');
        $sql_Select->bind_param('s',$product_id);
        $sql_Select->execute() or die('Query error'.$this->con->error);

        $result = $sql_Select->get_result();
        $row = $result->fetch_assoc();

        if(!$row['product_id'] == $product_id)
        {
            header('Location:inventory.php');
            die();
        }
    }
    //SELECT USERNAME TO GET DATA
    public function db_select_member($username)
    {
        $sql_Select = $this->con->prepare('SELECT * FROM account WHERE username = ?');
        $sql_Select->bind_param('s',$username);
        $sql_Select->execute() or die('Query error'.$this->con->error);

        $result = $sql_Select->get_result();
        $row = $result->fetch_assoc();

        $this->account_id = $row['account_id'];
        $this->first_name_login = $row['firstname'];
        $this->last_name_login = $row['lastname'];
        $this->position_id = $row['position_id'];

        $sql_Select->close();
    }
    public function db_select_customer_id()
    {
        $sql_Select = $this->con->prepare('SELECT * FROM customer WHERE account_id = ?');
        $sql_Select->bind_param('s',$this->account_id);
        $sql_Select->execute() or die('Query error'.$this->con->error);

        $result = $sql_Select->get_result();
        $row = $result->fetch_assoc();

        $this->customer_id = $row['customer_id'];
        $sql_Select->close();
    }
    //INSERT TO CUSTOMER FOR NEW CUSTOMER
    public function db_insert_customer($firstname,$lastname,$store_name,$contact_number,$region,$province,$city,$brgy,$unit,$account_id)
    {
        $sql_Insert = $this->con->prepare('INSERT INTO customer (firstname,lastname,store_name,contact_number,region,province,city,barangay,unit,account_id)VALUES(?,?,?,?,?,?,?,?,?,?)');
        $sql_Insert->bind_param('ssssssssss',$firstname,$lastname,$store_name,$contact_number,$region,$province,$city,$brgy,$unit,$account_id);
        $sql_Insert->execute() or die('Query error'.$this->con->error);

        $sql_Insert->close();
    }
    //INSERT INTO EXPENSE
    public function db_insert_expense($amount,$remarks,$date_expense)
    {
        $sql_Insert = $this->con->prepare('INSERT INTO expense (account_id,amount, remarks, date_expense)VALUES(?,?,?,?)');
        $sql_Insert->bind_param('ssss',$this->account_id,$amount,$remarks,$date_expense);
        $sql_Insert->execute() or die('Query error'.$this->con->error);

        $sql_Insert->close();
    }
    //SELECT EXPENSE FOR TABLE
    public function db_select_expense_table()
    {
        $sql_Select = $this->con->prepare('SELECT * FROM expense');
        $sql_Select->execute() or die('Query error'.$this->con->error);

        $result = $sql_Select->get_result();
        while($row = $result->fetch_assoc())
        {
            $sql_Select_account = $this->con->prepare('SELECT * FROM account WHERE account_id = ?');
            $sql_Select_account->bind_param('s', $row['account_id']);
            $sql_Select_account->execute() or die('Query error'.$this->con->error);

            $result_account = $sql_Select_account->get_result();
            $row_account = $result_account->fetch_assoc();

            $amount = number_format($row['amount'], 2, '.', ',');

            echo '<tr>
                    <td class="linement">'.$row_account['firstname'].' '.$row_account['lastname'].'</td>
                    <td class="linement">'."₱".$amount.'</td>
                    <td class="linement">'.$row['remarks'].'</td>
                    <td class="linement">'.$row['date_expense'].'</td>
                </tr>';
        }
        $sql_Select->close();
    }
    //INSERT TO PRODUCT FOR NEW PRODUCT
    public function db_insert_product($product_name,$price,$stock)
    {
        $sql_Insert = $this->con->prepare('INSERT INTO product (product_name,price,stock)VALUES(?,?,?)');
        $sql_Insert->bind_param('sss',$product_name,$price,$stock);
        $sql_Insert->execute() or die('Query error'.$this->con->error);

        $sql_Insert->close();
    }
    //SELECT CUSTOMER FOR TABLE
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

            $customer_id_id = $this->base64_url_encode($row['customer_id']);

            echo '<tr>
                    <td class="linement">'.$row['customer_id'].'</td>
                    <td class="linement">'.$row['firstname']." ".$row['lastname'].'</td>
                    <td class="linement">'.$row['store_name'].'</td>
                    <td class="linement">'.$row['unit']." ".$row_barangay['brgyDesc'].", ".$row_city_mun['citymunDesc']." ".$row_province['provDesc'].'</td>
                    <td class="linement">'.$row['contact_number'].'</td>
                    <td class="linement"><a class="btn btn-success btn-sm" href="account.php?ID='.$customer_id_id.'">Order</a></td>
                    <td class="linement"><a class="btn btn-success" role="button" style="width:auto;" style="color: white" href="modify_customer.php?ID='.$customer_id_id.'">Modify</a></td>
                </tr>';
        }
        $sql_Select->close();
    }
    //SELECT CUSTOMER FOR THE NAME
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
    //SELECT CUSTOMER FOR TABLE
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

                $price = number_format($row_product['price'], 2, '.', ',');
                $total_amount = number_format($row['total_amount'], 2, '.', ',');
                $discount = number_format($row['discount'], 2,'.',',');

                $customer_id_id = $this->base64_url_encode($row['customer_id']);
                $order_id_id = $this->base64_url_encode($row['order_id']);

                if($row['delivered_status'] == "0")
                {
                    if($row['cancelled'] == 0)
                    {
                        $delivered_status = "Not yet delivered";
                        $delivery_date = '<td style="background-color: darkgray; color: white" class="linement">'.$delivered_status.'</td>';

                        $payment_status = "Unpaid";
                        $payment_date = '<td style="background-color: darkgray; color: white" class="linement">'.$payment_status.'</td>';

                        $order_status = '<td class="linement"><a class="btn btn-success" role="button" style="width:auto;" style="color: white" href="modify_order.php?ID='.$customer_id_id.'&order_id='.$order_id_id.'">Modify</a></td>';
                    }
                    else
                    {
                        $cancelled_status = "CANCELLED";
                        $delivery_date = '<td style="background-color: darkgray; color: white" class="linement">'.$cancelled_status.'</td>';

                        $payment_status = "CANCELLED";
                        $payment_date = '<td style="background-color: darkgray; color: white" class="linement">'.$payment_status.'</td>';

                        $order_status = '<td class="linement"><a class="btn btn-success disabled" role="button" style="width:auto;" style="color: white" href="modify_order.php?ID='.$customer_id_id.'&order_id='.$order_id_id.'">Modify</a></td>';
                    }
                }
                else
                {
                    $delivery_date = '<td class="linement">'.$row['date_received'].'</td>';

                    if($row['payment_status'] == "0" && $row['payment_received'] != $row['total_amount'])
                    {
                        $payment_status = "Unpaid";
                        $payment_date = '<td style="background-color: darkgray; color: white" class="linement">'.$payment_status.'</td>';

                        $order_status = '<td class="linement"><a class="btn btn-success" role="button" style="width:auto;" style="color: white" href="modify_order.php?ID='.$customer_id_id.'&order_id='.$order_id_id.'">Modify</a></td>';
                    }
                    else if($row['payment_status'] == "1" && $row['payment_received'] != $row['total_amount'])
                    {
                        $payment_status = "With balance";
                        $payment_date = '<td style="background-color: darkgray; color: white" class="linement">'.$payment_status.'</td>';

                        $order_status = '<td class="linement"><a class="btn btn-success" role="button" style="width:auto;" style="color: white" href="modify_order.php?ID='.$customer_id_id.'&order_id='.$order_id_id.'">Modify</a></td>';
                    }
                    else
                    {
                        $payment_date = '<td class="linement">'.$row['payment_date'].'</td>';

                        $order_status = '<td class="linement"><a class="btn btn-success" role="button" style="width:auto;" style="color: white" href="modify_order.php?ID='.$customer_id_id.'&order_id='.$order_id_id.'">Modify</a></td>';
                    }
                }

                echo '<tr>
                    <td class="linement">'.$row_product['product_name'].'</td>
                    <td class="linement">'.$row['quantity'].'</td>
                    <td class="linement">'."₱".$price.'</td>
                    <td class="linement">'."₱".$discount.'</td>
                    <td class="linement">'."₱".$total_amount.'</td>
                    <td class="linement">'.$row['date_ordered'].'</td>
                    '.$delivery_date.'
                    '.$payment_date.'
                    '.$order_status.'
                </tr>';
            }
        }
    }
    //SELECT CUSTOMER FOR TABLE (Customer)
    public function db_select_table_order_customer_customer_id($customer_id)
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

                $price = number_format($row_product['price'], 2, '.', ',');
                $total_amount = number_format($row['total_amount'], 2, '.', ',');
                $discount = number_format($row['discount'], 2,'.',',');

                if($row['delivered_status'] == "0")
                {
                    if($row['cancelled'] == 0)
                    {
                        $delivered_status = "Not yet delivered";
                        $delivery_date = '<td style="background-color: darkgray; color: white" class="linement">'.$delivered_status.'</td>';

                        $payment_status = "Unpaid";
                        $payment_date = '<td style="background-color: darkgray; color: white" class="linement">'.$payment_status.'</td>';

                        $order_status = '<td class="linement"><a class="btn btn-success" role="button" style="width:auto;" style="color: white" href="">Cancel Order</a></td>';
                    }
                    else
                    {
                        $cancelled_status = "CANCELLED";
                        $delivery_date = '<td style="background-color: darkgray; color: white" class="linement">'.$cancelled_status.'</td>';

                        $payment_status = "CANCELLED";
                        $payment_date = '<td style="background-color: darkgray; color: white" class="linement">'.$payment_status.'</td>';

                        $order_status = '<td class="linement"><a class="btn btn-success disabled" role="button" style="width:auto;" style="color: white" href="">Cancel Order</a></td>';
                    }
                }
                else
                {
                    $delivery_date = '<td class="linement">'.$row['date_received'].'</td>';

                    if($row['payment_status'] == "0" && $row['payment_received'] != $row['total_amount'])
                    {
                        $payment_status = "Unpaid";
                        $payment_date = '<td style="background-color: darkgray; color: white" class="linement">'.$payment_status.'</td>';

                        $order_status = '<td class="linement"><a class="btn btn-success" role="button" style="width:auto;" style="color: white" href="">Cancel Order</a></td>';
                    }
                    else if($row['payment_status'] == "1" && $row['payment_received'] != $row['total_amount'])
                    {
                        $payment_status = "With balance";
                        $payment_date = '<td style="background-color: darkgray; color: white" class="linement">'.$payment_status.'</td>';

                        $order_status = '<td class="linement"><a class="btn btn-success disabled" role="button" style="width:auto;" style="color: white" href="">Cancel Order</a></td>';
                    }
                    else
                    {
                        $payment_date = '<td class="linement">'.$row['payment_date'].'</td>';

                        $order_status = '<td class="linement"><a class="btn btn-success disabled" role="button" style="width:auto;" style="color: white" href="">Cancel Order</a></td>';
                    }
                }

                echo '<tr>
                    <td class="linement">'.$row_product['product_name'].'</td>
                    <td class="linement">'.$row['quantity'].'</td>
                    <td class="linement">'."₱".$price.'</td>
                    <td class="linement">'."₱".$discount.'</td>
                    <td class="linement">'."₱".$total_amount.'</td>
                    <td class="linement">'.$row['date_ordered'].'</td>
                    '.$delivery_date.'
                    '.$payment_date.'
                    '.$order_status.'
                </tr>';
            }
        }
    }
    //SELECT PRODUCT FOR SELECT
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
    //SELECT TABLE_ORDER FOR TABLE
    public function db_select_order_table()
    {
        if($this->date_min == '' && $this->date_max == '')
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

                $total_amount = number_format($row_order['total_amount'], 2, '.', ',');

                echo '<tr>
                    <td class="linement">'.$row_customer['firstname']." ".$row_customer['lastname'].'</td>
                    <td class="linement">'.$row_customer['store_name'].'</td>
                    <td class="linement">'.$row_product['product_name'].'</td>
                    <td class="linement">'.$row_order['quantity'].'</td>
                    <td class="linement">'."₱".$total_amount.'</td>
                    <td class="linement">'.$row_order['date_ordered'].'</td>
                </tr>';
            }
            $sql_Select_order ->close();
        }
        else
        {
            $sql_Select = $this->con->prepare('SELECT * FROM table_order WHERE date_ordered BETWEEN ? AND ?');
            $sql_Select->bind_param('ss', $this->date_min, $this->date_max);
            $sql_Select->execute() or die('Query error' . $this->con->error);

            $result = $sql_Select->get_result();
            while ($row = $result->fetch_assoc()) {
                $sql_Select_product = $this->con->prepare('SELECT * FROM product WHERE product_id = ?');
                $sql_Select_product->bind_param('s', $row['product_id']);
                $sql_Select_product->execute() or die('Query error' . $this->con->error);

                $result_product = $sql_Select_product->get_result();
                $row_product = $result_product->fetch_assoc();

                $sql_Select_customer = $this->con->prepare('SELECT * FROM customer WHERE customer_id = ?');
                $sql_Select_customer->bind_param('s', $row['customer_id']);
                $sql_Select_customer->execute() or die('Query error' . $this->con->error);

                $result_customer = $sql_Select_customer->get_result();
                $row_customer = $result_customer->fetch_assoc();

                $total_amount = number_format($row['total_amount'], 2, '.', ',');

                echo '<tr>
                    <td class="linement">' . $row_customer['firstname'] . " " . $row_customer['lastname'] . '</td>
                    <td class="linement">' . $row_customer['store_name'] . '</td>
                    <td class="linement">' . $row_product['product_name'] . '</td>
                    <td class="linement">' . $row['quantity'] . '</td>
                    <td class="linement">' ."₱".$total_amount . '</td>
                    <td class="linement">' . $row['date_ordered'] . '</td>
                </tr>';
            }
            $sql_Select->close();
        }
    }
    //SELECT TABLE_ORDER FOR TABLE CREDIT
    public function db_select_order_table_Credit()
    {
        if($this->date_min == '' && $this->date_max== '')
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

                $total_amount = number_format($row_order['total_amount'], 2, '.', ',');
                $paid_payment = number_format($row_order['payment_received'], 2, '.', ',');
                $credit = number_format($row_order['credit'], 2, '.', ',');

                if($row_order['payment_received'] != $row_order['total_amount'] && $row_order['cancelled'] == 0)
                {
                    echo '<tr>
                            <td class="linement">'.$row_customer['firstname']." ".$row_customer['lastname'].'</td>
                            <td class="linement">'.$row_product['product_name'].'</td>
                            <td class="linement">'.$row_order['quantity'].'</td>
                            <td class="linement">'."₱".$total_amount.'</td>
                            <td class="linement">'.$row_order['date_ordered'].'</td>
                            <td class="linement">'.$row_order['date_received'].'</td>
                            <td class="linement">'."₱".$paid_payment.'</td>
                            <td class="linement">'."₱".$credit.'</td>
                            <td class="linement">'.$row_order['payment_date'].'</td>
                        </tr>';
                }
            }
            $sql_Select_order ->close();
        }
        else
        {
            $sql_Select = $this->con->prepare('SELECT * FROM table_order WHERE payment_date BETWEEN ? AND ?');
            $sql_Select->bind_param('ss', $this->date_min,$this->date_max);
            $sql_Select ->execute() or die('Query error'.$this->con->error);

            $result = $sql_Select ->get_result();
            while($row = $result->fetch_assoc())
            {
                $sql_Select_product = $this->con->prepare('SELECT * FROM product WHERE product_id = ?');
                $sql_Select_product->bind_param('s', $row['product_id']);
                $sql_Select_product->execute() or die('Query error'.$this->con->error);

                $result_product = $sql_Select_product->get_result();
                $row_product = $result_product->fetch_assoc();

                $sql_Select_customer = $this->con->prepare('SELECT * FROM customer WHERE customer_id = ?');
                $sql_Select_customer->bind_param('s', $row['customer_id']);
                $sql_Select_customer->execute() or die('Query error'.$this->con->error);

                $result_customer = $sql_Select_customer->get_result();
                $row_customer = $result_customer->fetch_assoc();

                $total_amount = number_format($row['total_amount'], 2, '.', ',');
                $paid_payment = number_format($row['credit'], 2, '.', ',');
                $credit = number_format($row['credit'], 2, '.', ',');

                if($row['payment_received'] != $row['total_amount'] && $row['cancelled'] == 0)
                {
                    echo '<tr>
                            <td class="linement">'.$row_customer['firstname']." ".$row_customer['lastname'].'</td>
                            <td class="linement">'.$row_product['product_name'].'</td>
                            <td class="linement">'.$row['quantity'].'</td>
                            <td class="linement">'."₱".$total_amount.'</td>
                            <td class="linement">'.$row['date_ordered'].'</td>
                            <td class="linement">'.$row['date_received'].'</td>
                            <td class="linement">'."₱".$paid_payment.'</td>
                            <td class="linement">'."₱".$credit.'</td>
                            <td class="linement">'.$row['payment_date'].'</td>
                        </tr>';
                }
            }
            $sql_Select->close();
        }
    }
    //SELECT TABLE_ORDER FOR TABLE PAID
    public function db_select_order_table_Paid()
    {
        if($this->date_min == '' && $this->date_max== '')
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

                $total_amount = number_format($row_order['total_amount'], 2, '.', ',');

                if($row_order['payment_received'] == $row_order['total_amount'])
                {
                    echo '<tr>
                            <td class="linement">'.$row_customer['firstname']." ".$row_customer['lastname'].'</td>
                            <td class="linement">'.$row_customer['store_name'].'</td>
                            <td class="linement">'.$row_product['product_name'].'</td>
                            <td class="linement">'.$row_order['quantity'].'</td>
                            <td class="linement">'."₱".$total_amount.'</td>
                            <td class="linement">'.$row_order['payment_date'].'</td>
                        </tr>';

                    $this->total_sales_modified += $row_order['total_amount'];
                    $this->total_orders_modified += $row_order['quantity'];

                    if($row_order['product_id'] == 1)
                    {
                        $this->Mangosteen_Purple_Corn += $row_order['quantity'];
                        $this->Mangosteen_Purple_Corn_Sale += $row_order['total_amount'];
                    }
                    if($row_order['product_id'] == 2)
                    {
                        $this->Malunggay_and_Banaba += $row_order['quantity'];
                        $this->Malunggay_and_Banaba_Sale += $row_order['total_amount'];
                    }
                }
            }
            $sql_Select_order ->close();
        }
        else
        {
            $sql_Select = $this->con->prepare('SELECT * FROM table_order WHERE payment_date BETWEEN ? AND ?');
            $sql_Select->bind_param('ss', $this->date_min,$this->date_max);
            $sql_Select ->execute() or die('Query error'.$this->con->error);

            $result = $sql_Select ->get_result();
            while($row = $result->fetch_assoc())
            {
                $sql_Select_product = $this->con->prepare('SELECT * FROM product WHERE product_id = ?');
                $sql_Select_product->bind_param('s', $row['product_id']);
                $sql_Select_product->execute() or die('Query error'.$this->con->error);

                $result_product = $sql_Select_product->get_result();
                $row_product = $result_product->fetch_assoc();

                $sql_Select_customer = $this->con->prepare('SELECT * FROM customer WHERE customer_id = ?');
                $sql_Select_customer->bind_param('s', $row['customer_id']);
                $sql_Select_customer->execute() or die('Query error'.$this->con->error);

                $result_customer = $sql_Select_customer->get_result();
                $row_customer = $result_customer->fetch_assoc();

                $total_amount = number_format($row['total_amount'], 2, '.', ',');

                if($row['payment_received'] == $row['total_amount'])
                {
                    echo '<tr>
                            <td class="linement">'.$row_customer['firstname']." ".$row_customer['lastname'].'</td>
                            <td class="linement">'.$row_customer['store_name'].'</td>
                            <td class="linement">'.$row_product['product_name'].'</td>
                            <td class="linement">'.$row['quantity'].'</td>
                            <td class="linement">'."₱".$total_amount.'</td>
                            <td class="linement">'.$row['payment_date'].'</td>
                        </tr>';

                    $this->total_sales_modified += $row['total_amount'];
                    $this->total_orders_modified += $row['quantity'];

                    if($row['product_id'] == 1)
                    {
                        $this->Mangosteen_Purple_Corn += $row['quantity'];
                        $this->Mangosteen_Purple_Corn_Sale += $row['total_amount'];
                    }
                    if($row['product_id'] == 2)
                    {
                        $this->Malunggay_and_Banaba += $row['quantity'];
                        $this->Malunggay_and_Banaba_Sale += $row['total_amount'];
                    }
                }
            }
            $sql_Select->close();
        }
    }
    //SELECT TABLE_ORDER FOR TABLE DELIVERED
    public function db_select_order_table_Delivered()
    {
        if($this->date_min == '' && $this->date_max == '')
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

                $total_amount = number_format($row_order['total_amount'], 2, '.', ',');

                if($row_order['delivered_status'] == 1)
                {
                    echo '<tr>
                            <td class="linement">'.$row_customer['firstname']." ".$row_customer['lastname'].'</td>
                            <td class="linement">'.$row_customer['store_name'].'</td>
                            <td class="linement">'.$row_product['product_name'].'</td>
                            <td class="linement">'.$row_order['quantity'].'</td>
                            <td class="linement">'."₱".$total_amount.'</td>
                            <td class="linement">'.$row_order['date_received'].'</td>
                        </tr>';
                }
            }
            $sql_Select_order ->close();
        }
        else
        {
            $sql_Select = $this->con->prepare('SELECT * FROM table_order WHERE date_received BETWEEN ? AND ?');
            $sql_Select->bind_param('ss', $this->date_min,$this->date_max);
            $sql_Select ->execute() or die('Query error'.$this->con->error);

            $result = $sql_Select ->get_result();
            while($row = $result->fetch_assoc())
            {
                $sql_Select_product = $this->con->prepare('SELECT * FROM product WHERE product_id = ?');
                $sql_Select_product->bind_param('s', $row['product_id']);
                $sql_Select_product->execute() or die('Query error'.$this->con->error);

                $result_product = $sql_Select_product->get_result();
                $row_product = $result_product->fetch_assoc();

                $sql_Select_customer = $this->con->prepare('SELECT * FROM customer WHERE customer_id = ?');
                $sql_Select_customer->bind_param('s', $row['customer_id']);
                $sql_Select_customer->execute() or die('Query error'.$this->con->error);

                $result_customer = $sql_Select_customer->get_result();
                $row_customer = $result_customer->fetch_assoc();

                $total_amount = number_format($row['total_amount'], 2, '.', ',');

                if($row['delivered_status'] == 1)
                {
                    echo '<tr>
                            <td class="linement">'.$row_customer['firstname']." ".$row_customer['lastname'].'</td>
                            <td class="linement">'.$row_customer['store_name'].'</td>
                            <td class="linement">'.$row_product['product_name'].'</td>
                            <td class="linement">'.$row['quantity'].'</td>
                            <td class="linement">'."₱".$total_amount.'</td>
                            <td class="linement">'.$row['date_received'].'</td>
                        </tr>';
                }
            }
            $sql_Select->close();
        }
    }
    //Checking product
    public function check_product($product_id)
    {
        $sql_Select = $this->con->prepare('SELECT * FROM product WHERE product_id = ?');
        $sql_Select->bind_param('s', $product_id);
        $sql_Select->execute() or die('Query error'.$this->con->error);

        $result = $sql_Select->get_result();
        $row = $result->fetch_assoc();

        $this->product_stock_order = $row['stock'];

        $sql_Select->close();
    }
    //INSERT INTO TABLE ORDER
    public function db_insert_order_customer_id($customer_id,$product_id,$quantity,$date_ordered,$date_received,$discount,$returns,$payment_date,$payment_received,$total_amount)
    {
        $sql_Insert = $this->con->prepare('INSERT INTO table_order (customer_id, product_id, quantity, date_ordered, date_received, discount, returns, payment_date, payment_received, total_amount)VALUES(?,?,?,?,?,?,?,?,?,?)');
        $sql_Insert->bind_param('ssssssssss',$customer_id,$product_id,$quantity,$date_ordered,$date_received,$discount,$returns,$payment_date,$payment_received,$total_amount);
        $sql_Insert->execute() or die('Query error'.$this->con->error);

        $sql_Insert->close();
    }
    //Buying of products
    public function db_update_produce_order_remove($product_id,$quantity)
    {
        $sql_Select = $this->con->prepare('SELECT * FROM product WHERE product_id = ?');
        $sql_Select->bind_param('s', $product_id);
        $sql_Select->execute() or die('Query error'.$this->con->error);

        $result = $sql_Select->get_result();
        $row = $result->fetch_assoc();

        $new_stock = $row['stock'] - $quantity;

        $sql_Update = $this->con->prepare('UPDATE product SET stock = ? WHERE product_id = ?');
        $sql_Update->bind_param('ss', $new_stock,$product_id);
        $sql_Update->execute() or die('Query error'.$this->con->error);

        $sql_Select->close();
        $sql_Update->close();
    }
    //SELECT PRODUCT FOR TABLE
    public function db_select_product_table()
    {
        $sql_Select = $this->con->prepare('SELECT * FROM product');
        $sql_Select->execute() or die('Query error'.$this->con->error);

        $result = $sql_Select->get_result();
        while($row = $result->fetch_assoc())
        {
            $price = number_format($row['price'], 2, '.', ',');

            echo '<tr>
                    <td class="linement">'.$row['product_name'].'</td>
                    <td class="linement">'."₱".$price.'</td>
                    <td class="linement">'.$row['stock'].'</td>
                    <td class="linement"><a class="btn btn-success btn-sm" href="modify_product.php?ID='.$row['product_id'].'">Edit</a></td>
                </tr>';
        }
        $sql_Select->close();
    }
    //SELECT PRODUCT FOR TABLE REPORT
    public function db_select_product_report_table()
    {
        $sql_Select = $this->con->prepare('SELECT * FROM product');
        $sql_Select->execute() or die('Query error'.$this->con->error);

        $result = $sql_Select->get_result();
        while($row = $result->fetch_assoc())
        {
            $TotalPrice = $row['price']* $row['stock'];

            $price = number_format($row['price'], 2, '.', ',');
            $TTotalPrice = number_format($TotalPrice, 2, '.', ',');

            echo '<tr>
                    <td class="linement">'.$row['product_name'].'</td>
                    <td class="linement">'.$row['stock'].'</td>
                    <td class="linement">'."₱".$price.'</td>
                    <td class="linement">'."₱".$TTotalPrice.'</td>
                </tr>';
        }
        $sql_Select->close();
    }
    //SELECT PRODUCT FOR THE AMOUNT
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
    //SELECT PRODUCT FOR PRICE
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
    //UPDATE PRODUCT PRICE
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
    //SELECT TO MODIFY IF
    public function db_select_table_order_for_checking($order_id)
    {
        $sql_Select = $this->con->prepare('SELECT * FROM table_order WHERE order_id = ?');
        $sql_Select->bind_param('s', $order_id);
        $sql_Select->execute() or die('Query error'.$this->con->error);

        $result = $sql_Select->get_result();
        $row = $result->fetch_assoc();

        $sql_Select_product = $this->con->prepare('SELECT * FROM product WHERE product_id = ?');
        $sql_Select_product->bind_param('s', $row['product_id']);
        $sql_Select_product->execute() or die('Query error'.$this->con->error);

        $result_product = $sql_Select_product->get_result();
        $row_product = $result_product->fetch_assoc();

        $price = number_format($row['total_amount'], 2, '.', ',');

        $this->order_id_delivery_date = $row['date_received'];
        $this->order_id_payment_date = $row['payment_date'];
        $this->paid_amount = "₱".$row['payment_received'];
        $this->total_amount_to_be_paid = "₱".$price;
        $this->order_id_product_name = $row_product['product_name'];
        $this->price_bought = $row['total_amount'];
        $this->payment_received = $row['payment_received'];
        $this->credit = $row['credit'];
        $this->date_paid = $row['payment_date'];
        $this->cancelled = $row['cancelled'];
    }
    //UPDATE ORDER DELIVERY
    public function db_update_order_delivery($order_id,$delivery_date)
    {
        $sql_Select = $this->con->prepare('SELECT * FROM table_order WHERE order_id = ?');
        $sql_Select->bind_param('s', $order_id);
        $sql_Select->execute() or die('Query error'.$this->con->error);

        $result = $sql_Select->get_result();
        $row = $result->fetch_assoc();

        $sql_Update = $this->con->prepare('UPDATE table_order SET date_received = ?,delivered_status = 1 WHERE order_id = ?');
        $sql_Update->bind_param('ss', $delivery_date,$order_id);
        $sql_Update->execute() or die('Query error'.$this->con->error);

        $sql_Select->close();
        $sql_Update->close();
    }
    //ORDER CANCELLED
    public function db_update_order_cancel($order_id)
    {
        $sql_Select = $this->con->prepare('SELECT * FROM table_order WHERE order_id = ?');
        $sql_Select->bind_param('s', $order_id);
        $sql_Select->execute() or die('Query error'.$this->con->error);

        $result = $sql_Select->get_result();
        $row = $result->fetch_assoc();

        $sql_Update = $this->con->prepare('UPDATE table_order SET cancelled = 1 WHERE order_id = ?');
        $sql_Update->bind_param('s', $order_id);
        $sql_Update->execute() or die('Query error'.$this->con->error);

        $sql_Select_Product = $this->con->prepare('SELECT * FROM product WHERE product_id = ?');
        $sql_Select_Product->bind_param('s', $row['product_id']);
        $sql_Select_Product->execute() or die('Query error'.$this->con->error);

        $result_Product = $sql_Select_Product->get_result();
        $row_Product = $result_Product->fetch_assoc();

        $newStock = $row_Product['stock'] + $row['quantity'];

        $sql_Update_Product = $this->con->prepare('UPDATE product SET stock = ? WHERE product_id = ?');
        $sql_Update_Product->bind_param('ss', $newStock,$row['product_id']);
        $sql_Update_Product->execute() or die('Query error'.$this->con->error);

        $sql_Update_Product->close();
        $sql_Select_Product->close();
        $sql_Update->close();
        $sql_Select->close();
    }
    //ORDER PAYMENT CHECKING
    public function db_order_payment_checking($order_id)
    {
        $sql_Select = $this->con->prepare('SELECT * FROM table_order WHERE order_id = ?');
        $sql_Select->bind_param('s', $order_id);
        $sql_Select->execute() or die('Query error'.$this->con->error);

        $result = $sql_Select->get_result();
        $row = $result->fetch_assoc();

        $dt_o = new DateTime($row['date_ordered']);
        $dt_d = new DateTime($row['date_received']);

        $this->total_payment_of_order = $row['total_amount'] - $row['payment_received'];
        $this->date_ordered = $dt_o->format('Y-m-d');
        $this->date_delivered = $dt_d->format('Y-m-d');
    }
    //UPDATE ORDER PAYMENT
    public function db_update_order_payment($order_id,$payment_date,$amount)
    {
        $sql_Select = $this->con->prepare('SELECT * FROM table_order WHERE order_id = ?');
        $sql_Select->bind_param('s', $order_id);
        $sql_Select->execute() or die('Query error'.$this->con->error);

        $result = $sql_Select->get_result();
        $row = $result->fetch_assoc();

        $amount_sum = $row['payment_received'] + $amount;

        if($row['credit'] == '0.00')
        {
            $credit = $row['total_amount'] - $amount;
        }
        else
        {
            $credit = $row['credit'] - $amount;
        }


        $sql_Update = $this->con->prepare('UPDATE table_order SET payment_date = ?,payment_received = ?,credit = ?,payment_status = 1 WHERE order_id = ?');
        $sql_Update->bind_param('ssss', $payment_date,$amount_sum,$credit,$order_id);
        $sql_Update->execute() or die('Query error'.$this->con->error);

        $sql_Select->close();
        $sql_Update->close();
    }
    //SELECT AND UPDATE STOCKS (ADD)
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
    //SELECT AND UPDATE STOCKS (MINUS)
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
    //SELECT PRODUCT FOR MODIFY
    public function db_select_product_product_id($product_id)
    {
        $sql_Select = $this->con->prepare('SELECT * FROM product WHERE product_id = ?');
        $sql_Select->bind_param('s', $product_id);
        $sql_Select->execute() or die('Query error'.$this->con->error);

        $result = $sql_Select->get_result();
        $row = $result->fetch_assoc();

        $this->product_name = $row['product_name'];
        $this->current_price = $row['price'];
        $this->current_stock = $row['stock'];
    }
    //UPDATE PHONE NUMBER
    public function db_update_customer_phone_number($customer_id,$phone_number)
    {
        $sql_Select = $this->con->prepare('SELECT * FROM customer WHERE customer_id = ?');
        $sql_Select->bind_param('s', $customer_id);
        $sql_Select->execute() or die('Query error'.$this->con->error);

        $result = $sql_Select->get_result();
        $row = $result->fetch_assoc();

        $sql_Update = $this->con->prepare('UPDATE customer SET contact_number = ? WHERE customer_id = ?');
        $sql_Update->bind_param('ss', $phone_number,$customer_id);
        $sql_Update->execute() or die('Query error'.$this->con->error);

        $sql_Select->close();
        $sql_Update->close();
    }
    //UPDATE ADDRESS
    public function db_update_customer_address($customer_id,$region,$province,$city,$barangay,$unit)
    {
        $sql_Select = $this->con->prepare('SELECT * FROM customer WHERE customer_id = ?');
        $sql_Select->bind_param('s', $customer_id);
        $sql_Select->execute() or die('Query error'.$this->con->error);

        $result = $sql_Select->get_result();
        $row = $result->fetch_assoc();

        $sql_Update = $this->con->prepare('UPDATE customer SET region = ?,province = ?,city = ?,barangay = ?,unit = ? WHERE customer_id = ?');
        $sql_Update->bind_param('ssssss', $region,$province,$city,$barangay,$unit,$customer_id);
        $sql_Update->execute() or die('Query error'.$this->con->error);

        $sql_Select->close();
        $sql_Update->close();
    }

    public function total_sales()
    {
        $total_sales = '';
        $sql_Select_order = $this->con->prepare('SELECT * FROM table_order');
        $sql_Select_order ->execute() or die('Query error'.$this->con->error);

        $result_order = $sql_Select_order ->get_result();
        while($row_order = $result_order->fetch_assoc())
        {
            if($row_order<0)
            {
                $total_sales = "0";
            }
            else if($row_order['payment_received'] != $row_order['total_amount'])
            {

            }
            else
            {
                $total_sales += $row_order['total_amount'];
            }
        }
        if($total_sales!=0)
        {

        }
        else
        {
            $total_sales = 0;
        }
        $TTotalSales = number_format($total_sales, 2, '.', ',');
        echo "₱".$TTotalSales;
    }

    public function total_expenses()
    {
        $total_expenses = '';
        $sql_Select = $this->con->prepare('SELECT * FROM expense');
        $sql_Select->execute() or die('Query error'.$this->con->error);

        $result = $sql_Select->get_result();
        while($row = $result->fetch_assoc())
        {
            if($row<0)
            {
                $total_expenses = "0";
            }
            else
            {
                $total_expenses += $row['amount'];
            }
        }
        if($total_expenses!=0)
        {

        }
        else
        {
            $total_expenses = 0;
        }
        $TTotalExpenses = number_format($total_expenses, 2, '.', ',');
        echo "₱".$TTotalExpenses;
    }

    public function total_ordered()
    {
        $total_order = '';
        $sql_Select = $this->con->prepare('SELECT * FROM table_order');
        $sql_Select->execute() or die('Query error'.$this->con->error);

        $result = $sql_Select->get_result();
        while($row = $result->fetch_array())
        {
            if($row<0)
            {
                $total_order = "0";
            }
            else
            {
                $total_order = mysqli_num_rows($result);
            }
        }
        if($total_order!=0)
        {

        }
        else
        {
            $total_order = 0;
        }
        echo $total_order;
    }

    public function Mangosteen_Price()
    {
        $sql_Select_Product_Mangosteen = $this->con->prepare('SELECT * FROM product WHERE product_id = 1');
        $sql_Select_Product_Mangosteen ->execute() or die('Query error'.$this->con->error);

        $result_product = $sql_Select_Product_Mangosteen ->get_result();
        while($row = $result_product->fetch_array())
        {
            $this->Mangosteen_Purple_Corn_Price = $row['price'];
        }
    }

    public function Malunggay_Price()
    {
        $sql_Select_Product_Malunggay = $this->con->prepare('SELECT * FROM product WHERE product_id = 2');
        $sql_Select_Product_Malunggay ->execute() or die('Query error'.$this->con->error);

        $result_product = $sql_Select_Product_Malunggay ->get_result();
        while($row = $result_product->fetch_array())
        {
            $this->Malunggay_and_Banaba_Price = $row['price'];
        }
    }

    //GET DATA
    function get_product_name()
    {
        echo $this->product_name."";
    }

    function get_product_price()
    {
        $price = number_format($this->current_price, 2, '.', ',');
        echo "Price: ₱".$price."";
    }

    function get_product_stock()
    {
        echo "Stock: ".$this->current_stock."";
    }

    function get_order_id_product_name()
    {
        echo $this->order_id_product_name."";
    }

    function price_bought()
    {
        $price = number_format($this->price_bought, 2, '.', ',');
        echo "₱".$price."";
    }

    function get_fullname()
    {
        echo $this->first_name." ".$this->last_name;
    }

    function get_credit()
    {
        $price = number_format($this->credit, 2, '.', ',');
        echo "₱".$price."";
    }

    function get_last_date()
    {
        echo $this->date_paid."";
    }

    function get_fullname_login()
    {
        echo $this->first_name_login." ".$this->last_name_login;
    }

    function base64_url_encode($input)
    {
        return strtr(base64_encode($input), '+/=', '-_,');
    }

    function base64_url_decode($input)
    {
        return base64_decode(strtr($input, '-_,', '+/='));
    }

    public function __destruct()
    {
        $this->con->close();
    }
}