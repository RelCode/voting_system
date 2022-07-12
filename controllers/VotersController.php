<?php
require_once('./library/Controller.php');
class VotersController extends Library\Controller{
    public $count = 0;
    private $subpage;
    public function __construct() {
        $this->subpage = isset($_GET['subpage']) ? $_GET['subpage'] : 'view';
        $this->votersModel = $this->model('voters');
    }

    public function index(){
        // if($_SERVER['REQUEST_METHOD'] == 'POST'){
        //     if(isset($_POST['create'])){
        //         $this->createVoter($_POST);
        //     }elseif(isset($_POST['update'])){
        //         $this->updateVoter($_POST);
        //     }
        // }
        if($this->subpage == 'create'){
            if(isset($_POST['create'])){
                $this->createVoter($_POST);
            }
            $data = $this->votersModel->fetchAreas();
        }elseif($this->subpage == 'edit'){
            if (isset($_POST['update'])) {
                $this->updateVoter($_POST);
            }
            $id = isset($_GET['id']) ? htmlentities($_GET['id'],ENT_QUOTES) : '';
            $data = $this->votersModel->allWhereIdRow('voters','id',$id);
            $data[0]['areas'] = $this->votersModel->fetchAreas();
        }else{
            $no = isset($_GET['no']) ? htmlentities($_GET['no']) : 1;
            $data = $this->votersModel->fetchVoters($no);
            $this->count = $this->votersModel->countAll('voters');
        }
        return $this->view('voters/'.$this->subpage,$data,$this->count);
    }

    public function createVoter($post){
        if(!$this->validateInput($post)){
            $this->oldValues($post);
            return false;
        }
        if($this->votersModel->allWhereIdCount('voters','id_number',$post['id_number'])){
            $_SESSION['validation']['id_number'] = 'ID Number Already Registered';
            $this->oldValues($post);
            return false;
        }
        if(!$this->votersModel->storeVoterData($post)){
            $_SESSION['alert']['class'] = 'alert-danger';
            $_SESSION['alert']['message'] = 'Error Occured. Try Again';
            $this->oldValues($post);
            return false;
        }
        $_SESSION['alert']['class'] = 'alert-success';
        $_SESSION['alert']['message'] = 'voter successfully registered';
        return true;
    }

    public function updateVoter($post){
        if (!$this->validateInput($post)) {
            return false;
        }
        if ($this->votersModel->allWhereIdCompare('voters','id', $post['id'], 'id_number', $post['id_number'])) {
            $_SESSION['validation']['id_number'] = 'ID Number Already Registered';
            return false;
        }
        if (!$this->votersModel->updateVoterData($post)) {
            $_SESSION['alert']['class'] = 'alert-danger';
            $_SESSION['alert']['message'] = 'Error Occured. Try Again';
            return false;
        }
        $_SESSION['alert']['class'] = 'alert-success';
        $_SESSION['alert']['message'] = 'voter successfully updated';
        return true;
    }

    public function validateInput($post){
        $valid = true;
        //validate voter names
        if(!preg_match("/^[a-zA-Z-' ]*$/", $post['names'])){
            $_SESSION['validation']['names'] = 'Name Must Be Letters Only';
            $valid = false;
        }
        if(!preg_match('/^[0-9]*$/', $post['id_number']) || strlen($post['id_number']) != 13){
            $_SESSION['validation']['id_number'] = 'Invalid ID Number';
            $valid = false;
        }
        if(!preg_match('/^[0-9]*$/', $post['age'])){
            $_SESSION['validation']['age'] = 'Age Must Be Numbers Only';
            $valid = false;
        }
        $areaExists = $this->votersModel->allWhereIdCount('areas', 'id', $post['area']);//check if area selected is valid

        if(!preg_match('/^[0-9]*$/', $post['area']) || !$areaExists){
            $_SESSION['validation']['area'] = 'Invalid Area Selected';
            $valid = false;
        }
        if($post['gender'] != 'm' && $post['gender'] != 'f'){
            $_SESSION['validation']['gender'] = 'Invalid Gender Option Selected';
            $valid = false;
        }
        return $valid;
    }

    public function oldValues($post){
        $_SESSION['old']['names'] = $post['names'];
        $_SESSION['old']['id_number'] = $post['id_number'];
        $_SESSION['old']['age'] = $post['age'];
        return true;
    }
}