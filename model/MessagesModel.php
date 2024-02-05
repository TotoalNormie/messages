<?php

class MessagesModel {
    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $database = 'messages';
    private $conn;

    public function __construct() {
        $connection = mysqli_connect($this->host, $this->username, $this->password, $this->database);
        if (!$connection) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $this->conn = $connection;
    }

    protected function getMessages($filters) {

        if(isset($filters['search']) && $filters['search'] != '') {
            $name = $filters['search'];
            $query = "SELECT * FROM messages WHERE name LIKE '%$serach%'";
        }
        if(isset($filters['orderBy']) && $filters['orderBy'] != '') {
            $orderBy = $filters['orderBy'];
            $query = "SELECT * FROM messages ORDER BY $orderBy";
        }
        $query = "SELECT * FROM messages";
        $result = mysqli_query($this->conn, $query);
        $messages = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $messages[] = $row;
        }
        return $messages;
    }

    protected function insertMessage($name, $email, $message) {
        $query = "INSERT INTO messages (name, email, message) VALUES ('$name', '$email', '$message')";
        mysqli_query($this->conn, $query);
    }

}

?>