<?php
// require_once '../libraries/SystemDatabase.php';

class User
{
    private $db;

    public function __construct()
    {
        // echo "I am Article Model";
        $this->db = new SystemDatabase();
    }

    public function register($data)
    {
        $this->db->dbquery("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");

        $this->db->dbbind(':name', $data['fullname']);
        $this->db->dbbind(':email', $data['email']);
        $this->db->dbbind(':password', $data['password']);

        if($this->db->dbexecute()) {
            return true;
        } else {
            return false;
        }        
    }

    public function login($email, $password)
    {
        $this->db->dbquery("SELECT * FROM users WHERE email = :email");
        $this->db->dbbind(':email', $email);

        $row = $this->db->getsingledataassoc();

        $hashedpassword = $row['password'];

        if(password_verify($password, $hashedpassword)) {
            return $row;
        } else {
            return false;
        }
    }

    public function checkuniqueemail($email){

        $this->db->dbquery("SELECT email FROM users WHERE email = :email");
        $this->db->dbbind(':email', $email);

        $row = $this->db->getsingledataassoc();

        if($this->db->dbrowcount() > 0) {
            return true;
        } else {
            return false;
        }
    }
}

// new Article();

// CREATE TABLE IF NOT EXISTS users(
//     id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
//     name VARCHAR(50),
//     email VARCHAR(50),
//     password VARCHAR(50),
//     created_at TIMESTAMP DEFAULT now(),
//     updated_at TIMESTAMP DEFAULT Now() ON UPDATE now()
// );   