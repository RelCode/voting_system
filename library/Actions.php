<?php
require_once('./../config/database.php');
$database = new Database();
$db = $database->db;

$action = isset($_POST['action']) ? $_POST['action'] : '';
if($action == 'deletevoter'){
    $id = htmlentities($_POST['id'],ENT_QUOTES);
    $identifier = htmlentities($_POST['identifier'],ENT_QUOTES);
    if($database->allWhereIdCompare('voters','id',$id,'id_number',$identifier)){
        $query = 'UPDATE voters SET soft_delete = "Y" WHERE id = :id AND id_number = :identifier';
        $stmt = $db->prepare($query);
        $stmt->bindParam(':id',$id);
        $stmt->bindParam(':identifier',$identifier);
        if($stmt->execute()){
            echo '200';
        }else{
            echo '500';
        }
        exit();
    }
    echo '404';
    exit();
}elseif($action == 'deletecandidate'){
    $id = htmlentities($_POST['id'],ENT_QUOTES);
    $identifier = htmlentities($_POST['identifier'],ENT_QUOTES);
    if($database->allWhereIdCompare('candidates','id',$id,'names',$identifier)){
        $timestamp = date('Y-m-d H:i:s');
        $query = 'UPDATE candidates SET soft_delete = "Y", deleted_at = :timestamp WHERE id = :id AND names = :identifier';
        $stmt = $db->prepare($query);
        $stmt->bindParam(':timestamp',$timestamp);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':identifier', $identifier);
        if ($stmt->execute()) {
            echo '200';
        } else {
            echo '500';
        }
        exit();
    }
    echo '404';
    exit();
}