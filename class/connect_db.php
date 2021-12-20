<?php
class connect_db
{
    protected $host;
    protected $password;
    protected $username;
    protected $database;
    public function __construct() {
        $this->database = 'localhost';
        $this->username = 'root';
        $this->password = '';
        $this->database = 'book_store_online';
    }

    public function select($query) {
        if (!$conn = mysqli_connect($this->host,$this->username,$this->password,$this->database)) {
            echo "Connect failed !";
        }
        if (!(mysqli_query($conn, "set names 'utf8'"))) {
            echo "Error : Failed to set names utf-8 !";
        }
        if (!($res = mysqli_query($conn, $query))) {
            echo "Error : Failed when executed query !";
        }
        mysqli_close($conn);
        return $res;
    }

    public function execute($query) {
        if (!$conn = mysqli_connect($this->host,$this->username,$this->password,$this->database)) {
            return false;
        }
        if (!($res = mysqli_query($conn, $query))) {
            return false;
        }
        mysqli_close($conn);
        return true;
    }
    public function executeTwoReferencTables($query1, $queries2, bool $autoCommit) {
        if (!$conn = mysqli_connect($this->host,$this->username,$this->password,$this->database)) {
            return false;
        }
        mysqli_autocommit($conn, $autoCommit);
        $result = mysqli_multi_query($conn, $query1.";".$queries2);
        echo $query1.";".$queries2;
        if(!$result)
        {
            return false;
        }
        mysqli_commit($conn);
        mysqli_close($conn);
        return true;
    }
    public function multiExecute($query) {
        if (!$conn = mysqli_connect($this->host,$this->username,$this->password,$this->database)) {
            echo "Connect failed !";
            return false;
        }
        if (!($res = mysqli_multi_query($conn, $query))) {
            echo "Error : Failed when executed query !";
            return false;
        }
        mysqli_close($conn);
        return true;
    }
    public function getConnection()
    {
        $connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);
        if($connection)
        {
            return $connection;
        }
        else {
            return null;
        }
    }
}