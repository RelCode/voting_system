<?php
require_once('./../config/database.php');
$database = new Database();
$db = $database->db;

$action = isset($_POST['action']) ? $_POST['action'] : '';
if($action == 'deleteVoter'){
    $id = htmlentities($_POST['id'],ENT_QUOTES);
    $id_number = htmlentities($_POST['id_number'],ENT_QUOTES);
    if($database->allWhereIdCompare('voters','id',$id,'id_number',$id_number)){
        $query = 'UPDATE voters SET soft_delete = "Y" WHERE id = :id AND id_number = :id_number';
        $stmt = $db->prepare($query);
        $stmt->bindParam(':id',$id);
        $stmt->bindParam(':id_number',$id_number);
        if($stmt->execute()){
            echo '200';
        }else{
            echo '500';
        }
        exit();
    }
    echo '404';
    exit();
}