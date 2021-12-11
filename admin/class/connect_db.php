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
            echo "'Connect failed !'";
        }
        if (!($res = mysqli_query($conn, $query))) {
            echo "Error : Failed when executed query !";
            return false;
        }
        mysqli_close($conn);
        return true;
    }

    public function multiExecute($query) {
        if (!$conn = mysqli_connect($this->host,$this->username,$this->password,$this->database)) {
            echo "Connect failed !";
        }
        if (!($res = mysqli_multi_query($conn, $query))) {
            echo "Error : Failed when executed query !";
            return false;
        }
        mysqli_close($conn);
        return true;
    }
}