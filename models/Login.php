<?php
require_once('./config/database.php');
class Login extends Database {
    public function getAdmin($email){
        $admin = [];
        $query = 'SELECT * FROM admins WHERE email = :email LIMIT 1';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':email',$email);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            $admin = $stmt->fetch(PDO::FETCH_ASSOC);
        }
        return $admin;
    }
}