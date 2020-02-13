<?php

/**
 * Created by PhpStorm.
 * User: Jomari Garcia
 * Date: 12/16/2019
 * Time: 10:34 AM
 */
class db_connection
{
    public $member_id;
    public $phone_number;
    public $activation_code_list;

    public function __construct()
    {
        $server = "localhost";
        $username = "root";
        $password = "";
        $db_name = "jomari";

        $this->con = mysqli_connect($server, $username, $password, $db_name)
        or die("Failed To Connect".$this->con->connect_error);
    }

    public function db_select_code_activation($activation_code,$used)
    {
        $sql_Select = $this->con->prepare('SELECT * FROM code_activation WHERE activation_code = ?');
        $sql_Select->bind_param('s',$activation_code);
        $sql_Select->execute() or die('Query error'.$this->con->error);

        $result = $sql_Select->get_result();
        $row = $result->fetch_assoc();

        if($activation_code == $row['activation_code'])
        {
            include_once('message.php');
            MessageBackCodeMaker('Activation code was already generated. Please generate again');
        }
        else
        {
            $this->db_insert_code_activation($activation_code,$used);
        }

        $sql_Select->close();
    }

    public function db_insert_code_activation($activation_code, $used)
    {
        $sql_Insert = $this->con->prepare('INSERT INTO code_activation (activation_code, used)VALUES(?,?)');
        $sql_Insert->bind_param('ss', $activation_code, $used);
        $sql_Insert->execute() or die('Query error'.$this->con->error);

        include_once('message.php');
        MessageBackCodeMaker('Activation code has been generated.');

        $sql_Insert->close();
    }

    public function db_select_member_mainpage($phone_number)
    {
        $sql_Select = $this->con->prepare('SELECT * FROM member WHERE phone_number = ?');
        $sql_Select->bind_param('s',$phone_number);
        $sql_Select->execute() or die('Query error'.$this->con->error);

        $result = $sql_Select->get_result();
        $row = $result->fetch_assoc();

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

        if($row['phone_number'] == $phone_number && $row['position_id'] == 1)
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

            if($row2['member_id'] == $row['member_id']  && $row2['position_id'] == 1)
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
        $sql_Select = $this->con->prepare('SELECT * FROM account WHERE BINARY member_id = ? ORDER BY registration_date LIMIT 1');
        $sql_Select->bind_param('s', $this->member_id);
        $sql_Select->execute() or die('Query error'.$this->con->error);

        $result = $sql_Select->get_result();
        $row = $result->fetch_assoc();

        if($row['member_id'] == $this->member_id && password_verify($password,$row['password']))
        {
            $_SESSION['Phone_number_admin'] = $this->phone_number;
            header('Location: ../code_activation_maker.php');
        }
        else
        {
            include_once('message.php');
            MessageBackLogin("Your Phone number/Username or Password is invalid");
        }

        $sql_Select->close();
    }

    public function generate_activation_code($qty)
    {
        for($i=1;$i<=$qty;$i++)
        {
            $this->activation_code_list = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"), 0, 20);

            echo $this->activation_code_list."\n";
        }
    }

    function download_send_headers($filename) {
        // disable caching
        $now = gmdate("D, d M Y H:i:s");
        header("Expires: Tue, 03 Jul 2030 06:00:00 GMT");
        header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
        header("Last-Modified: {$now} GMT");

        // force download
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header('Content-Type: text/x-csv');

        // disposition / encoding on response body
        header("Content-Disposition: attachment;filename={$filename}");
        header("Connection: close");
    }

    public function db_select_activation_code($qty)
    {

    }

    function get_first_name()
    {
        echo $this->first_name ."";
    }
    function get_last_name()
    {
        echo $this->last_name ."";
    }

    public function __destruct()
    {
        $this->con->close();
    }
}
?>