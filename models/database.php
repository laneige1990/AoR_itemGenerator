<?php

class Database{

    protected $connection_ = null;

    public $error = null;

    public $insert_id = null;

    public function __construct(){
        $conn = $this->databaseConnect();
        return $conn;
    }

    protected function databaseConnect(){
        // Create connection
        $this->connection_ = new mysqli(SERVER, USER, PASSWORD, DATABASE);
        // Check connection
        if ($this->connection_->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }

        return $this->connection_;
    }

    public function query($query)
    {
        $query = $this->connection_->query($query);
        $this->error = $this->connection_->error;
        $this->insert_id = $this->connection_->insert_id;
        return $query;
    }

    public function close()
    {
        return $this->connection_->close();
    }


}

?>