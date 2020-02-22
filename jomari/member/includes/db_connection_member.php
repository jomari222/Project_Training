<?php

/**
 * Created by PhpStorm.
 * User: Jomari Garcia
 * Date: 12/16/2019
 * Time: 10:34 AM
 */
class db_connection_member
{
    public $member_id;
    public $phone_number;
    public $code_activation_id;
    public $member_id_register;
    public $regCode;
    public $provCode;
    public $citymunCode;

    public function __construct()
    {
        $server = "localhost";
        $username = "root";
        $password = "";
        $db_name = "jomari";

        $this->con = mysqli_connect($server, $username, $password, $db_name)
        or die("Failed To Connect".$this->con->connect_error);
    }

    public function db_select_member_mainpage($phone_number)
    {
        $sql_Select = $this->con->prepare('SELECT * FROM member WHERE phone_number = ?');
        $sql_Select->bind_param('s',$phone_number);
        $sql_Select->execute() or die('Query error'.$this->con->error);

        $result = $sql_Select->get_result();
        $row = $result->fetch_assoc();

        $this->member_id = $row['member_id'];
        $this->first_name = $row['first_name'];
        $this->last_name = $row['last_name'];

        $sql_Select->close();
    }

    public function db_select_member_login_phone_number($phone_number)
    {
        $sql_Select = $this->con->prepare('SELECT * FROM member WHERE BINARY phone_number = ?');
        $sql_Select->bind_param('s',$phone_number);
        $sql_Select->execute() or die('Query error'.$this->con->error);

        $result = $sql_Select->get_result();
        $row = $result->fetch_assoc();

        if($row['phone_number'] == $phone_number)
        {
            $this->member_id = $row['member_id'];
            $this->phone_number = $row['phone_number'];
        }
        elseif($row['phone_number'] != $phone_number)
        {
            $this->db_select_member_login_username($phone_number);
        }
        else
        {
            include_once('message.php');
            MessageBackLogin("Your Phone number/Username or Password is invalid");
        }

        $sql_Select->close();
    }

    public function db_select_member_login_username($username)
    {
        $sql_Select = $this->con->prepare('SELECT * FROM account WHERE BINARY username = ?');
        $sql_Select->bind_param('s',$username);
        $sql_Select->execute() or die('Query error'.$this->con->error);

        $result = $sql_Select->get_result();
        $row = $result->fetch_assoc();

        if($row['username'] == $username)
        {
            $sql_Select2 = $this->con->prepare('SELECT * FROM member WHERE BINARY member_id = ?');
            $sql_Select2->bind_param('s',$row['member_id']);
            $sql_Select2->execute() or die('Query error'.$this->con->error);

            $result2 = $sql_Select2->get_result();
            $row2 = $result2->fetch_assoc();

            if($row2['member_id'] == $row['member_id'])
            {
                $sql_Select3 = $this->con->prepare('SELECT * FROM account WHERE member_id = ? ORDER BY registration_date LIMIT 1');
                $sql_Select3->bind_param('s',$row2['member_id']);
                $sql_Select3->execute() or die('Query error'.$this->con->error);

                $result3 = $sql_Select3->get_result();
                $row3 = $result3->fetch_assoc();

                if($username == $row3['username'])
                {
                    $this->member_id = $row2['member_id'];
                    $this->phone_number = $row2['phone_number'];
                }
                else
                {
                    include_once('message.php');
                    MessageBackLogin("Your Phone number/Username or Password is invalid");
                }
            }

            $sql_Select2->close();
        }
        else
        {
            include_once('message.php');
            MessageBackLogin("Your Phone number/Username or Password is invalid");
        }

        $sql_Select->close();
    }

    public function db_select_account_login($password)
    {
        $sql_Select = $this->con->prepare('SELECT * FROM account WHERE member_id = ? ORDER BY registration_date LIMIT 1');
        $sql_Select->bind_param('s', $this->member_id);
        $sql_Select->execute() or die('Query error'.$this->con->error);

        $result = $sql_Select->get_result();
        $row = $result->fetch_assoc();

        if($row['member_id'] == $this->member_id && password_verify($password,$row['password']))
        {
            $_SESSION['Phone_number'] = $this->phone_number;
            header('Location: ../mainpage_member.php');
        }
        else
        {
            include_once('message.php');
            MessageBackLogin("Your Phone number/Username or Password is invalid");
        }

        $sql_Select->close();
    }

    public function db_select_member_member_id()
    {
        $sql_Select = $this->con->prepare('SELECT member_id FROM member ORDER BY member_id DESC LIMIT 1');
        $sql_Select->execute() or die('Query error'.$this->con->error);

        $result = $sql_Select->get_result();
        $row = $result->fetch_assoc();

        $this->member_id_register = $row['member_id'] + 1;

        $sql_Select->close();
    }

    public function db_insert_member($member_id,$phone_number,$first_name,$last_name,$position_id,$blocked)
    {
        $sql_Insert = $this->con->prepare('INSERT INTO member (member_id, phone_number, first_name, last_name, position_id, blocked)VALUES(?,?,?,?,?,?)');
        $sql_Insert->bind_param('ssssss', $member_id, $phone_number, $first_name, $last_name, $position_id, $blocked);
        $sql_Insert->execute() or die('Query error'.$this->con->error);

        $sql_Insert->close();
    }

    public function db_insert_account($code_activation_id,$username,$password,$activation_code,$user_sponsor,$member_id)
    {
        $sql_Insert = $this->con->prepare('INSERT INTO account (code_activation_id, username, password, activation_code, user_sponsor, member_id)VALUES(?,?,?,?,?,?)');
        $sql_Insert->bind_param('ssssss', $code_activation_id, $username, $password, $activation_code, $user_sponsor, $member_id);
        $sql_Insert->execute() or die('Query error'.$this->con->error);

        $sql_Insert->close();
    }

    public function db_insert_fund($member_id,$peso_wallet,$voucher_points)
    {
        $sql_Insert = $this->con->prepare('INSERT INTO fund (member_id, peso_wallet, voucher_points)VALUES(?,?,?)');
        $sql_Insert->bind_param('sss', $member_id, $peso_wallet, $voucher_points);
        $sql_Insert->execute() or die('Query error'.$this->con->error);

        $sql_Insert->close();
    }

    public function db_select_fund()
    {
        $sql_Select = $this->con->prepare('SELECT * FROM fund WHERE BINARY member_id = ?');
        $sql_Select->bind_param('s', $this->member_id);
        $sql_Select->execute() or die('Query error'.$this->con->error);

        $result = $sql_Select->get_result();
        $row = $result->fetch_assoc();

        $this->peso_wallet = number_format($row['peso_wallet'],2);
        $this->voucher_points = number_format($row['voucher_points'],0);

        $sql_Select->close();
    }

    public function db_update_code_activation($activation_code)
    {
        $sql_Update = $this->con->prepare('UPDATE code_activation SET used = 1 WHERE activation_code = ?');
        $sql_Update->bind_param('s', $activation_code);
        $sql_Update->execute() or die('Query error'.$this->con->error);

        include_once('message.php');
        MessageBackAddAccount('Registration Complete');

        $sql_Update->close();
    }

    public function db_select_account_insert_all_info($code_activation_id,$username,$password,$activation_code,$user_sponsor,$member_id,$phone_number,$first_name,$last_name,$position_id,$blocked,$peso_wallet,$voucher_points)
    {
        $sql_Select = $this->con->prepare('SELECT * FROM code_activation WHERE BINARY activation_code = ?');
        $sql_Select->bind_param('s', $activation_code);
        $sql_Select->execute() or die('Query error'.$this->con->error);

        $result = $sql_Select->get_result();
        $row = $result->fetch_assoc();
        //////////////////////
        $sql_Select_account_sponsor = $this->con->prepare('SELECT * FROM account WHERE username = ?');
        $sql_Select_account_sponsor->bind_param('s', $user_sponsor);
        $sql_Select_account_sponsor->execute() or die('Query error'.$this->con->error);

        $result_account_sponsor = $sql_Select_account_sponsor->get_result();
        $row_account_sponsor = $result_account_sponsor->fetch_assoc();
        //////////////////////
        $sql_Select_account = $this->con->prepare('SELECT * FROM account WHERE username = ?');
        $sql_Select_account->bind_param('s', $username);
        $sql_Select_account->execute() or die('Query error'.$this->con->error);

        $result_account = $sql_Select_account->get_result();
        $row_account = $result_account->fetch_assoc();
        //////////////////////
        $sql_Select_member = $this->con->prepare('SELECT * FROM member WHERE phone_number = ?');
        $sql_Select_member->bind_param('s', $phone_number);
        $sql_Select_member->execute() or die('Query error'.$this->con->error);

        $result_member = $sql_Select_member->get_result();
        $row_member = $result_member->fetch_assoc();

        if($row['activation_code'] == $activation_code && $row['used'] == 0 && $row_account_sponsor['username'] == $user_sponsor && $row_member['phone_number'] != $phone_number && $row_account['username'] != $username)
        {
            $this->code_activation_id = $row['code_activation_id'];
            $this->db_insert_member($member_id,$phone_number,$first_name,$last_name,$position_id,$blocked);
            $this->db_insert_account($code_activation_id,$username,$password,$activation_code,$user_sponsor,$member_id);
            $this->db_insert_fund($member_id,$peso_wallet,$voucher_points);
            $this->db_update_code_activation($activation_code);
        }
        elseif($row['activation_code'] == $activation_code && $row['used'] == 1)
        {
            include_once('message.php');
            MessageBackRegistration("Activation code already used.");
        }
        elseif($row_account_sponsor['username'] != $user_sponsor)
        {
            include_once('message.php');
            MessageBackRegistration("Sponsor username invalid.");
        }
        elseif($row_member['phone_number'] == $phone_number)
        {
            include_once('message.php');
            MessageBackRegistration("Phone number is already registered.");
        }
        elseif($row_account['username'] == $username)
        {
            include_once('message.php');
            MessageBackRegistration("Username is already taken.");
        }
        else
        {
            include_once('message.php');
            MessageBackRegistration("Invalid activation code.");
        }

        $sql_Select->close();
    }

    public function db_select_member_account_add($activation_code,$username,$password,$sponsor)
    {
        $sql_Select = $this->con->prepare('SELECT * FROM account WHERE username = ?');
        $sql_Select->bind_param('s', $username);
        $sql_Select->execute() or die('Query error'.$this->con->error);

        $result = $sql_Select->get_result();
        $row = $result->fetch_assoc();

        if($row['username'] != $username)
        {
            $sql_Select_code_activation = $this->con->prepare('SELECT * FROM code_activation WHERE activation_code = ?');
            $sql_Select_code_activation ->bind_param('s', $activation_code);
            $sql_Select_code_activation ->execute() or die('Query error'.$this->con->error);

            $result_code_activation  = $sql_Select_code_activation ->get_result();
            $row_code_activation  = $result_code_activation ->fetch_assoc();

            if($row_code_activation['activation_code'] == $activation_code && $row_code_activation['used'] == 0)
            {
                $sql_Insert = $this->con->prepare('INSERT INTO account (code_activation_id, activation_code, username, password, user_sponsor, member_id)VALUES(?,?,?,?,?,?)');
                $sql_Insert->bind_param('ssssss',$row['code_activation_id'],$activation_code,$username,$password,$sponsor,$this->member_id);
                $sql_Insert->execute() or die('Query error'.$this->con->error);

                $sql_Insert->close();

                $this->db_update_code_activation($activation_code);
            }
            elseif($row_code_activation['activation_code'] == $activation_code && $row_code_activation['used'] != 0)
            {
                include_once('message.php');
                MessageBackAddAccount("Activation code already used.");
            }
            else
            {
                include_once('message.php');
                MessageBackAddAccount("Invalid activation code.");
            }
            $sql_Select_code_activation->close();
        }
        else
        {
            include_once('message.php');
            MessageBackAddAccount('Username already taken.');
        }
        $sql_Select->close();
    }

    public function db_select_account_table()
    {
        $sql_Select = $this->con->prepare('SELECT * FROM account WHERE member_id = ?');
        $sql_Select->bind_param('s', $this->member_id);
        $sql_Select->execute() or die('Query error'.$this->con->error);

        $result = $sql_Select->get_result();
        while($row = $result->fetch_assoc())
        {
            echo '<tr>
                    <td class="linement">'.$row['username'].'</td>
                    <td class="linement">'.$row['activation_code'].'</td>
                    <td class="linement">'.$row['user_sponsor'].'</td>
                </tr>';
        }
        $sql_Select->close();
    }

    public function db_select_home_location_table()
    {
        $sql_Select = $this->con->prepare('SELECT * FROM address WHERE member_id = ?');
        $sql_Select->bind_param('s', $this->member_id);
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
                    <td class="linement">'.$row_region['regDesc'].'</td>
                    <td class="linement">'.$row_province['provDesc'].'</td>
                    <td class="linement">'.$row_city_mun['citymunDesc'].'</td>
                    <td class="linement">'.$row_barangay['brgyDesc'].'</td>
                    <td class="linement">'.$row['unit'].'</td>
                </tr>';
        }
        $sql_Select->close();
    }

    public function  db_select_table_region()
    {

    }

    public function  db_select_table_province()
    {

    }

    public function  db_select_table_city()
    {

    }

    public function  db_select_table_barangay()
    {

    }

    public function db_insert_home_address_register($region,$province,$city,$brgy,$address,$id)
    {
        $sql_Insert = $this->con->prepare('INSERT INTO address (region, province, city, barangay, unit, member_id)VALUES(?,?,?,?,?,?)');
        $sql_Insert->bind_param('ssssss',$region,$province,$city,$brgy,$address,$id);
        $sql_Insert->execute() or die('Query error'.$this->con->error);

        $sql_Insert->close();
    }

    public function db_insert_home_address($region,$province,$city,$brgy,$address)
    {
        $sql_Select_check = $this->con->prepare('SELECT * FROM address WHERE member_id = ?');
        $sql_Select_check->bind_param('s', $this->member_id);
        $sql_Select_check->execute() or die('Query error'.$this->con->error);

        $result_check = $sql_Select_check->get_result();
        while($row_check = $result_check->fetch_assoc())
        {
            if($region == $row_check['region'] && $province == $row_check['province'] && $city == $row_check['city'] && $brgy == $row_check['barangay'] && $address == $row_check['unit'])
            {
                include_once('message.php');
                MessageBackAddAccount('Address is already registered to your account.');
            }
            else
            {
                $sql_Insert = $this->con->prepare('INSERT INTO address (region, province, city, barangay, unit, member_id)VALUES(?,?,?,?,?,?)');
                $sql_Insert->bind_param('ssssss',$region,$province,$city,$brgy,$address,$this->member_id);
                $sql_Insert->execute() or die('Query error'.$this->con->error);

                include_once('message.php');
                MessageBackAddAccount('Address has been added');

                $sql_Insert->close();
            }
        }
        $sql_Select_check->close();
    }

    function get_first_name()
    {
        echo $this->first_name ."";
    }
    function get_last_name()
    {
        echo $this->last_name ."";
    }
    function get_peso_wallet()
    {
        echo $this->peso_wallet ."";
    }
    function get_voucher_points()
    {
        echo $this->voucher_points ."";
    }

    public function __destruct()
    {
        $this->con->close();
    }
}
?>