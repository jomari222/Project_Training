<?php

/**
 * Created by PhpStorm.
 * User: Jomari Garcia
 * Date: 12/16/2019
 * Time: 10:34 AM
 */
class db_connection
{
    public $id;
    public function __construct()
    {
        $server = "localhost";
        $username = "root";
        $password = "";
        $db_name = "login_db";

        $this->con = mysqli_connect($server, $username, $password, $db_name)
        or die("Failed To Connect".$this->con->connect_error);

        echo '<br>Connection Successful';
    }

    /*public function db_insert($insert_data)
    {
        $sqlInsert = "INSERT INTO";
        $this->insert_data = $sqlInsert.' '.$insert_data;
        mysqli_query($this->con, $this->insert_data) or die('Query error'.$this->con->error);
    }*/

    public function db_insert_tbluser($employee_id, $username, $password)
    {
        $sql_Insert = $this->con->prepare('INSERT INTO tbluser (fEmployeeID, fUsername, fPassword)VALUES(?,?,?)');
        $sql_Insert->bind_param('sss', $employee_id, $username, $password);
        $sql_Insert->execute() or die('Query error'.$this->con->error);

        $sql_Insert->close();
    }
    public function db_select_tbluser($username, $password)
    {
        $sql_Select = $this->con->prepare('SELECT * FROM tbluser WHERE BINARY fUsername = ?');
        $sql_Select->bind_param('s', $username);
        $sql_Select->execute() or die('Query error'.$this->con->error);

        $result = $sql_Select->get_result();
        $row = $result->fetch_assoc();

        if($row['fUsername'] == $username && password_verify($password,$row['fPassword']))
        {
            Message('Welcome '.$username);
            echo '<br><br>HELLO '.$username.'<br>';
        }
        else
        {
            MessageBack("Your Username or Password is invalid");
        }
        //echo '<br>'.$employee_id.'<br>';
        //echo $password.'<br>';

        //echo '<input type="text" value="'.$password.'" style="width: 32%" disabled/>';

        $sql_Select->close();
    }
    public function db_update_tbluser($username, $password)
    {
        $password = password_hash($password, PASSWORD_BCRYPT);
        $sql_Update = $this->con->prepare('UPDATE tbluser SET fPassword = ? WHERE fUsername = ?');
        $sql_Update->bind_param('ss', $password, $username);
        $sql_Update->execute() or die('Query error'.$this->con->error);

        $sql_Update->close();
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

        $this->employee_id = '<br>'.$row['fEmployeeID'];
        $this->first_name = '<br>'.$row['fFirstname'];
        $this->last_name = '<br>'.$row['fLastname'];
        if($row['fGender'])
        {
            $this->gender = '<br>Male';
        }
        else
        {
            $this->gender = '<br>Female';
        }
        //$this->gender = '<br>'.$row['fGender'];
        $this->id = '<br>'.$row['fPosition'];
        if($row['fStatus'])
        {
            $this->status = '<br>Active';
        }
        else
        {
            $this->status = '<br>Inactive';
        }
        //$this->status = '<br>'.$row['fStatus'];

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

        $this->position = '<br>'.$row['fPosition'];

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

    public function __destruct()
    {
        $this->con->close();
        echo '<br>Connection Close';
    }
}

function Message($msg)
{
    echo '<script type="text/javascript">alert("'.$msg.'")</script>';
}
function MessageBack($msg)
{
    echo '<script type="text/javascript">alert("'.$msg.'"); location.pathname = "Act%208%20(Review)/index.php"; setTimeout(window.location.pathname, 0);</script>';
}
?>