<?php
class Database{
    private $host = 'localhost';
    private $dbname = 'voting_system';
    private $user = 'root';
    private $password = '';
    public $db;

    public function __construct(){
        try {
            $this->db = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->dbname, $this->user, $this->password);

            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo 'ERROR: ' . $exception;
        }
    }
    public function countAll($table){//count all table entries
        $query = 'SELECT * FROM '.$table.'';
        $stmt = $this->db->query($query);
        return $stmt->rowCount();   
    }
    /*
    allWhereIdCount:: method that selects from a specified table to check if a value already exists
    */
    public function allWhereIdCount($table,$column,$id){
        $query = 'SELECT * FROM '.$table.' WHERE '.$column.' = :id';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id',$id);
        return $this->returnCountBool($stmt);
    }
    public function allWhereIdCompare($table,$column1,$value1,$column2,$value2,$compare = 'equal'){
        if($compare == 'equal'){//comparing values where surogate keys are equal to values provided
            $query = 'SELECT * FROM ' . $table . ' WHERE ' . $column1 . ' = :value1 AND ' . $column2 . ' = :value2';
        }else{//comparing columns where surrogate keys are not equal to value provided
            $query = 'SELECT * FROM ' . $table . ' WHERE ' . $column1 . ' != :value1 AND ' . $column2 . ' = :value2';
        }
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':value1',$value1);
        $stmt->bindParam(':value2',$value2);
        return $this->returnCountBool($stmt);
    }
    public function returnCountBool($stmt){
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return true;
        }
        return false;
    }
    /*
    allWhereIdRow:: method used to get row(s) where id = :id
    */
    public function allWhereIdRow($table,$column,$id){
        $data = [];
        $query = 'SELECT * FROM '.$table.' WHERE '.$column.' = :id';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id',$id);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                array_push($data,$row);
            }
        }
        return $data;
    }
}
date_default_timezone_set('Africa/Johannesburg');