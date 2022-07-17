<?php
require_once('./config/database.php');
class Candidates extends Database {
    public function fetchCandidates($no, $filter){
        $data = [];
        $per_page = 5;
        $from = ($per_page * $no) - $per_page;
        if($filter == 'all'){
            $query = 'SELECT * FROM candidates ORDER BY names ASC LIMIT ' . $from . ', ' . $per_page . '';
        }else{
            $filter = '%'.$filter.'%';
            $query = 'SELECT * FROM candidates WHERE candidate_for LIKE '.$filter.' ORDER BY names ASC LIMIT ' . $from . ', ' . $per_page . '';
        }
        $stmt = $this->db->query($query);
        if($stmt->rowCount() > 0){
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                array_push($data,$row);
            }
        }
        return $data;
    }
}