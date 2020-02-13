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

        if($row['activation_code'] == $activation_code && $row['used'] == 0)
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
        else
        {
            include_once('message.php');
            MessageBackRegistration("Invalid activation code.");
        }

        $sql_Select->close();
    }

    public function db_select_member_account_add($activation_code,$username,$password,$sponsor)
    {
        $sql_Select = $this->con->prepare('SELECT * FROM account');
        $sql_Select->execute() or die('Query error'.$this->con->error);

        $result = $sql_Select->get_result();
        $row = $result->fetch_assoc();

        if($username == $row['username'])
        {
            include_once('message.php');
            MessageBackAddAccount('Username already taken.');
        }
        elseif($activation_code == $row['activation_code'])
        {
            include_once('message.php');
            MessageBackAddAccount('Activation code already used.');
        }
        else
        {
            $sql_Select = $this->con->prepare('SELECT * FROM code_activation WHERE BINARY activation_code = ?');
            $sql_Select->bind_param('s', $activation_code);
            $sql_Select->execute() or die('Query error'.$this->con->error);

            $result = $sql_Select->get_result();
            $row = $result->fetch_assoc();

            if($row['activation_code'] == $activation_code && $row['used'] == 0)
            {
                $sql_Insert = $this->con->prepare('INSERT INTO account (code_activation_id, activation_code, username, password, user_sponsor, member_id)VALUES(?,?,?,?,?,?)');
                $sql_Insert->bind_param('ssssss',$row['code_activation_id'],$activation_code,$username,$password,$sponsor,$this->member_id);
                $sql_Insert->execute() or die('Query error'.$this->con->error);

                $sql_Insert->close();

                $this->db_update_code_activation($activation_code);
            }
            elseif($row['activation_code'] == $activation_code && $row['used'] == 1)
            {
                include_once('message.php');
                MessageBackAddAccount("Activation code already used.");
            }
            else
            {
                include_once('message.php');
                MessageBackAddAccount("Invalid activation code.");
            }
        }
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

    public function db_select_region()
    {
        $sql_Select = $this->con->prepare('SELECT * FROM refregion');
        $sql_Select->execute() or die('Query error'.$this->con->error);

        $result = $sql_Select->get_result();
        while($row = $result->fetch_assoc())
        {
            echo '<option value='.$row['regDesc'].'>'. $row['regDesc'] .'</option>';
            $this->regCode = $row['regCode'];
        }

        $sql_Select->close();
    }

    public function db_select_province($regDesc)
    {
        $sql_Select = $this->con->prepare('SELECT * FROM refregion WHERE regDesc = ?');
        $sql_Select->bind_param('s', $regDesc);
        $sql_Select->execute() or die('Query error'.$this->con->error);

        $result = $sql_Select->get_result();
        while($row = $result->fetch_assoc())
        {
            $sql_Select2 = $this->con->prepare('SELECT * FROM refprovince WHERE regCode = ?');
            $sql_Select2->bind_param('s', $row['regCode']);
            $sql_Select2->execute() or die('Query error'.$this->con->error);

            $result2 = $sql_Select2->get_result();
            while($row2 = $result2->fetch_assoc())
            {
                echo '<option value='.$row2['provDesc'].'>'. $row2['provDesc'] .'</option>';
                $this->provCode = $row2['provCode'];
            }

            $sql_Select2->close();
        }

        $sql_Select->close();
    }

    public function db_select_city_mun($provCode)
    {
        $sql_Select = $this->con->prepare('SELECT * FROM refcitymun WHERE provCode = ?');
        $sql_Select->bind_param('s', $provCode);
        $sql_Select->execute() or die('Query error'.$this->con->error);

        $result = $sql_Select->get_result();
        while($row = $result->fetch_assoc())
        {
            echo '<option value='.$row['citymunDesc'].'>'. $row['citymunDesc'] .'</option>';
            $this->citymunCode = $row['citymunCode'];
        }

        $sql_Select->close();
    }

    public function db_select_brgy($citymunCode)
    {
        $sql_Select = $this->con->prepare('SELECT * FROM refbrgy WHERE citymunCode = ?');
        $sql_Select->bind_param('s', $citymunCode);
        $sql_Select->execute() or die('Query error'.$this->con->error);

        $result = $sql_Select->get_result();
        while($row = $result->fetch_assoc())
        {
            echo '<option value='.$row['brgyDesc'].'>'. $row['brgyDesc'] .'</option>';
        }

        $sql_Select->close();
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