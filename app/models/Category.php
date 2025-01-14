<?php 
class Category {

    private $db;

    public function __construct()
    {
        $this->db = new SystemDatabase;
    }

    public function allcategories()
    {
        $this->db->dbquery("SELECT *,
                            statuses.id As statusid,
                            statuses.name As originalname,
                            statuses.created_at AS publicdate
                            FROM statuses INNER JOIN users 
                            ON statuses.user_id = users.id 
                            ORDER BY statuses.created_at DESC
                        ");
        return $this->db->getmultidataobj();


    }

    public function createcategory($data){
        $this->db->dbquery("INSERT INTO statuses(name,status_id,user_id) VALUE (:name,:status_id,:user_id)");
        
        $this->db->dbbind(":name",$data['name']);
        $this->db->dbbind(":status_id",$data["status_id"]);
        $this->db->dbbind(":user_id",$data["user_id"]);

        if($this->db->dbexecute()){
            return true;
        } 
        return false;
    }

    public function getcategorybyid($id){
        $this->db->dbquery("SELECT * FROM categories WHERE id=:id");
        
        $this->db->dbbind(":id",$id);

        $row = $this->db->getsingledataassoc();

        return $row;
    }

    public function updatecategory($data){
        $this->db->dbquery("UPDATE categories SET name=:name,status_id=:status_id WHERE id=:id");
        
        $this->db->dbbind(":id",$data["id"]);
        $this->db->dbbind(":name",$data['name']);
        $this->db->dbbind(":status_id",$data['status_id']);

        if($this->db->dbexecute()){
            return true;
        } 
        return false;
    }

    public function deletecategory($id){
        $this->db->dbquery("DELETE FROM statuses WHERE id = :id");
        
        $this->db->dbbind(":id",$id);

        if($this->db->dbexecute()){
            return true;
        } 
        return false;
    }
}


?>
<!-- CREATE TABLE IF NOT EXISTS categories (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50),
    status_id INT,
    user_id INT,
    created_at TIMESTAMP DEFAULT now(),
    updated_at TIMESTAMP DEFAULT Now() ON UPDATE now(),
    FOREIGN KEY (status_id) REFERENCES statuses(id) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON UPDATE CASCADE ON DELETE CASCADE
);

DESC categories; -->