<?php
require_once('./config/database.php');
class Candidates extends Database {
    public function fetchCandidates($no, $filter){
        $data = [];
        $per_page = 5;
        $from = ($per_page * $no) - $per_page;
        if($filter == 'all'){
            $query = 'SELECT * FROM candidates WHERE soft_delete = "N" ORDER BY names ASC LIMIT ' . $from . ', ' . $per_page . '';
        }else{
            $filter = '%'.$filter.'%';
            $query = 'SELECT * FROM candidates WHERE soft_delete = "N" AND candidate_for LIKE '.$filter.' ORDER BY names ASC LIMIT ' . $from . ', ' . $per_page . '';
        }
        $stmt = $this->db->query($query);
        if($stmt->rowCount() > 0){
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                array_push($data,$row);
            }
        }
        return $data;
    }

    public function storeCandidate($post){
        $query = 'INSERT INTO candidates (names, political_group) VALUES (:names, :group)';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':names',$post['names']);
        $stmt->bindParam(':group',$post['political_group']);
        if($stmt->execute()){
            $id = $this->db->lastInsertId();
            $for = explode('%20',$post['running_for']);
            $in = explode('%20',$post['running_in']);
            for ($i=0; $i < count($for); $i++) { 
                $query = 'INSERT INTO candidacy (candidate, running_for, running_in) VALUES (:id,:for,:in)';
                $stmt = $this->db->prepare($query);
                $stmt->bindParam(':id',$id);
                $stmt->bindParam(':for',$for[$i]);
                $stmt->bindParam(':in',$in[$i]);
                if(!$stmt->execute()){
                    return false;
                }
            }
            return true;
        }
        return false;
    }
}