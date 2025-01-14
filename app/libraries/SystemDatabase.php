<?php

class SystemDatabase
{
    private $dbhost = DB_HOST;
    private $dbuser = DB_USER;
    private $dbname = DB_NAME;
    private $dbpass = DB_PASS;

    private $conn;
    private $error;
    private $stmt;
    private $dbconnected = false;

    public function __construct()
    {
        $options = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];

        try {
            // Create a new PDO instance
            $this->conn = new PDO("mysql:host={$this->dbhost};dbname={$this->dbname}", $this->dbuser, $this->dbpass, $options);
            $this->dbconnected = true;
        } catch (PDOException $e) {
            // Log the error and stop further execution
            $this->error = $e->getMessage();
            die("Database Connection Failed: " . $this->error);
        }
    }

    // Get PDO error
    public function geterror()
    {
        return $this->error;
    }

    // Check if the database is connected
    public function isconnected()
    {
        return $this->dbconnected;
    }

    // Prepare the query
    public function dbquery($query)
    {
        if ($this->conn) {
            $this->stmt = $this->conn->prepare($query);
        } else {
            die("Database connection is not established.");
        }
    }

    // Bind the query parameters
    public function dbbind($param, $value, $type = null)
    {
        if (is_null($type)) {
            switch (true) {
                case is_string($value):
                    $type = PDO::PARAM_STR;
                    break;
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
            }
        }

        $this->stmt->bindValue($param, $value, $type);
    }

    // Execute the prepared statement
    public function dbexecute()
    {
        return $this->stmt->execute();
    }

    // Fetch multiple results as an associative array
    public function getmultidataassoc()
    {
        $this->dbexecute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Fetch multiple results as an object
    public function getmultidataobj()
    {
        $this->dbexecute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Fetch a single result as an associative array
    public function getsingledataassoc()
    {
        $this->dbexecute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Fetch a single result as an object
    public function getsingledataobj()
    {
        $this->dbexecute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    // Get row count
    public function dbrowcount()
    {
        return $this->stmt->rowCount();
    }
}
