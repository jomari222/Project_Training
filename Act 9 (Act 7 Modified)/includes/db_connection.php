<?php

/**
 * Created by PhpStorm.
 * User: Jomari Garcia
 * Date: 12/16/2019
 * Time: 10:34 AM
 */
class db_connection
{
    public $employee_id_add;
    public $position_id;

    public function __construct()
    {
        $server = "localhost";
        $username = "root";
        $password = "";
        $db_name = "login_db";

        $this->con = mysqli_connect($server, $username, $password, $db_name)
        or die("Failed To Connect".$this->con->connect_error);
    }

    public function db_insert_tbluser($employee_id, $username, $password)
    {
        $sql_Insert = $this->con->prepare('INSERT INTO tbluser (fEmployeeID, fUsername, fPassword)VALUES(?,?,?)');
        $sql_Insert->bind_param('sss', $employee_id, $username, $password);
        $sql_Insert->execute() or die('Query error'.$this->con->error);

        $sql_Insert->close();
    }
    public function db_select_tbluser_login($username, $password)
    {
        $sql_Select = $this->con->prepare('SELECT * FROM tbluser WHERE BINARY fUsername = ?');
        $sql_Select->bind_param('s', $username);
        $sql_Select->execute() or die('Query error'.$this->con->error);

        $result = $sql_Select->get_result();
        $row = $result->fetch_assoc();

        if($row['fUsername'] == $username && password_verify($password,$row['fPassword']))
        {
            $_SESSION['Username'] = $username;
            $_SESSION['createnewpassword'] = 0;
            header('Location: ../mainpage.php');
        }
        else
        {
            MessageBackIndex("Your Username or Password is invalid");
        }

        $sql_Select->close();
    }
    public function db_select_user_tbluser($username)
    {
        $sql_Select = $this->con->prepare('SELECT * FROM tbluser WHERE BINARY fUsername = ?');
        $sql_Select->bind_param('s', $username);
        $sql_Select->execute() or die('Query error'.$this->con->error);

        $result = $sql_Select->get_result();
        $row = $result->fetch_assoc();

        $this->employee_id = $row['fEmployeeID'];

        $this->db_select_tblemployee($row['fEmployeeID']);

        $sql_Select->close();
    }
    public function db_update_tbluser($username, $password, $current_password)
    {
        $sql_Select = $this->con->prepare('SELECT * FROM tbluser WHERE BINARY fUsername = ?');
        $sql_Select->bind_param('s', $username);
        $sql_Select->execute() or die('Query error'.$this->con->error);

        $result = $sql_Select->get_result();
        $row = $result->fetch_assoc();

        if($row['fUsername'] == $username && password_verify($current_password,$row['fPassword']))
        {
            $password = password_hash($password, PASSWORD_BCRYPT);
            $sql_Update = $this->con->prepare('UPDATE tbluser SET fPassword = ? WHERE fUsername = ?');
            $sql_Update->bind_param('ss', $password, $username);
            $sql_Update->execute() or die('Query error'.$this->con->error);

            $sql_Update->close();

            MessageBackMainpage('Password has been successfully change');
        }
        else
        {
            MessageBackMainpageChangePassword("Current password is incorrect");
        }
        $sql_Select->close();
    }

    public function db_insert_tblemployee($employee_id, $first_name, $last_name, $gender, $position, $status)
    {
        $sql_Insert = $this->con->prepare('INSERT INTO tblemployee (fEmployeeID ,fFirstname, fLastname, fGender, fPosition, fStatus)VALUES(?,?,?,?,?,?)');
        $sql_Insert->bind_param('ssssss', $employee_id, $first_name, $last_name, $gender, $position, $status);
        $sql_Insert->execute() or die('Query error'.$this->con->error);

        $sql_Insert->close();
    }
    public function db_select_tblemployee($employee_id)
    {
        $sql_Select = $this->con->prepare('SELECT fEmployeeID, fFirstname, fLastname, fGender, fPosition, fStatus, fStamp FROM tblemployee WHERE fEmployeeID = ?');
        $sql_Select->bind_param('s', $employee_id);
        $sql_Select->execute() or die('Query error'.$this->con->error);

        $result = $sql_Select->get_result();
        $row = $result->fetch_assoc();

        $this->first_name = $row['fFirstname'];
        $this->last_name = $row['fLastname'];
        if($row['fGender'])
        {
            $this->gender = 'Male';
        }
        else
        {
            $this->gender = 'Female';
        }

        if($row['fStatus'])
        {
            $this->status = 'Active';
        }
        else
        {
            $this->status = 'Inactive';
        }

        $this->position_id = $row['fPosition'];
        $this->db_select_tblempposition($row['fPosition']);

        $sql_Select->close();
    }
    public function db_select_all_tblemployee()
    {
        $sql_Select = $this->con->prepare('SELECT * FROM tblemployee');
        $sql_Select->execute() or die('Query error'.$this->con->error);

        $result = $sql_Select->get_result();
        while($row = $result->fetch_assoc())
        {
            if($row['fGender'])
            {
                $this->gender_table = 'Male';
            }
            else
            {
                $this->gender_table = 'Female';
            }

            $this->employee_id_table = $row['fEmployeeID'];
            $this->employee_id_add = $row['fEmployeeID'] + 1;
            $this->first_name_table = $row['fFirstname'];
            $this->last_name_table = $row['fLastname'];
            $this->db_select_all_tblempposition($row['fPosition']);
        }
        $sql_Select->close();
    }
    public function db_select_table_tblemployee()
    {
        $sql_Select = $this->con->prepare('SELECT * FROM tblemployee');
        $sql_Select->execute() or die('Query error'.$this->con->error);

        $result = $sql_Select->get_result();
        while($row = $result->fetch_assoc())
        {
            if($row['fGender'])
            {
                $this->gender_table = 'Male';
            }
            else
            {
                $this->gender_table = 'Female';
            }

            $this->db_select_all_tblempposition($row['fPosition']);

            echo '<tr>
                    <td class="linement">'.$row['fEmployeeID'].'</td>
                    <td class="linement">'.$row['fFirstname'].'</td>
                    <td class="linement">'.$row['fLastname'].'</td>
                    <td class="linement">'.$this->gender_table.'</td>
                    
                    <td class="linement">'.$this->position_table.'</td>
                </tr>';
        }
        $sql_Select->close();
    }
    public function db_update_tblemployee()
    {

    }

    public function db_select_tblempposition($id)
    {
        $sql_Select = $this->con->prepare('SELECT fPosition FROM tblempposition WHERE fID = ?');
        $sql_Select->bind_param('s', $id);
        $sql_Select->execute() or die('Query error'.$this->con->error);

        $result = $sql_Select->get_result();
        $row = $result->fetch_assoc();

        $this->position = $row['fPosition'];

        $sql_Select->close();
    }
    public function db_select_all_tblempposition($id)
    {
        $sql_Select = $this->con->prepare('SELECT fPosition FROM tblempposition WHERE fID = ?');
        $sql_Select->bind_param('s', $id);
        $sql_Select->execute() or die('Query error'.$this->con->error);

        $result = $sql_Select->get_result();
        $row = $result->fetch_assoc();

        $this->position_table = $row['fPosition'];

        $sql_Select->close();
    }

    function get_employee_id()
    {
        echo $this->employee_id ."";
    }
    function get_first_name()
    {
        echo $this->first_name ."";
    }
    function get_last_name()
    {
        echo $this->last_name ."";
    }
    function get_gender()
    {
        echo $this->gender ."";
    }
    function get_position()
    {
        echo $this->position ."";
    }
    function get_status()
    {
        echo $this->status ."";
    }
    function get_username()
    {
        echo $this->username ."";
    }
    function get_password()
    {
        echo $this->password ."";
    }

    function get_employee_id_table()
    {
        echo $this->employee_id_table ."";
    }
    function get_first_name_table()
    {
        echo $this->first_name_table ."";
    }
    function get_last_name_table()
    {
        echo $this->last_name_table ."";
    }
    function get_gender_table()
    {
        echo $this->gender_table ."";
    }
    function get_position_table()
    {
        echo $this->position_table ."";
    }

    public function __destruct()
    {
        $this->con->close();
    }
}

function Message($msg)
{
    echo '<script type="text/javascript">alert("'.$msg.'")</script>';
}
function MessageBackIndex($msg)
{
    echo '<script type="text/javascript">alert("'.$msg.'"); location.pathname = "Act%209%20(Act%207%20Modified)/index.php"; setTimeout(window.location.pathname, 0);</script>';
}
function MessageBackMainpage($msg)
{
    echo '<script type="text/javascript">alert("'.$msg.'"); location.pathname = "Act%209%20(Act%207%20Modified)/mainpage.php"; setTimeout(window.location.pathname, 0);</script>';
    session_start();
    $_SESSION['createnewpassword'] = 0;
}
function MessageBackMainpageChangePassword($msg)
{
    echo '<script type="text/javascript">alert("'.$msg.'"); location.pathname = "Act%209%20(Act%207%20Modified)/mainpage.php"; setTimeout(window.location.pathname, 0);</script>';
    session_start();
    $_SESSION['createnewpassword'] = 1;
}
?>