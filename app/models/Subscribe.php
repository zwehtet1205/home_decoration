<?php 
class Subscribe {

    private $db;

    public function __construct()
    {
        $this->db = new SystemDatabase;
    }

    public function allsubscribes()
    {
        $this->db->dbquery("SELECT * FROM subscribes");
        return $this->db->getmultidataobj();

        
    }

    // create subscribe 
    public function createsubscribe($data){
        $this->db->dbquery("INSERT INTO subscribes (name, email, status_id) VALUES (:name, :email, :status_id)");
        $this->db->bind('name', $data['name']);
        $this->db->bind('email', $data['email']);
        $this->db->bind('status_id', $data['status_id']);

        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }
}

?>
<!-- CREATE TABLE IF NOT EXISTS subscribes (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50),
    email VARCHAR(100),
    status_id INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT now()
);

DESC subscribes; -->