<?php
require_once('./config/database.php');
class Voters extends Database {
    public function fetchVoters($no){
        $data = [];
        $per_page = 5;
        $from = ($per_page * $no) - $per_page;
        $query = 'SELECT v.id, v.names, v.id_number, v.age, v.gender, v.created_at, a.area, a.district, a.code FROM voters as v INNER JOIN areas as a ON v.area = a.id WHERE v.soft_delete = "N" ORDER BY names ASC LIMIT '.$from.','.$per_page.'';
        $stmt = $this->db->query($query);
        if($stmt->rowCount() > 0){
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                array_push($data,$row);
            }
        }
        return $data;
    }
    public function fetchAreas(){
        $data = [];
        $query = 'SELECT * FROM areas ORDER BY area ASC';
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                array_push($data,$row);
            }
        }
        return $data;
    }

    public function storeVoterData($post){
        $pin = mt_rand(1000,9999);
        // $id_number = preg_replace(' ','',$post['id_number']);//this is done to remove any whitespaces
        $query = 'INSERT INTO voters (names, id_number, age, area, pin, gender) 
            VALUES (:names, :id_number, :age, :area, :pin, :gender)';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':names',$post['names']);
        $stmt->bindParam(':id_number',$post['id_number']);
        $stmt->bindParam(':age',$post['age']);
        $stmt->bindParam(':area',$post['area']);
        $stmt->bindParam(':pin',$pin);
        $stmt->bindParam(':gender',$post['gender']);
        if($stmt->execute()){
            return true;
        }
        return false;
    }

    public function updateVoterData($post){
        // $pin = mt_rand(1000,9999);
        // $id_number = preg_replace(' ','',$post['id_number']);//this is done to remove any whitespaces
        $query = 'UPDATE voters SET names = :names, id_number = :id_number, age = :age, area = :area, gender = :gender WHERE id = :id';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':names',$post['names']);
        $stmt->bindParam(':id_number',$post['id_number']);
        $stmt->bindParam(':age',$post['age']);
        $stmt->bindParam(':area',$post['area']);
        $stmt->bindParam(':gender',$post['gender']);
        $stmt->bindParam(':id',$post['id']);
        if($stmt->execute()){
            return true;
        }
        return false;
    }
}