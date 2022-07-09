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
}
date_default_timezone_set('Africa/Johannesburg');