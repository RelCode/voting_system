<?php
require_once('./library/Controller.php');
class CandidatesController extends Library\Controller {
    public $count = 0;
    public $subpage;
    public function __construct()
    {
        $this->subpage = isset($_GET['subpage']) ? $_GET['subpage'] : 'view';
        $this->candidatesModel = $this->model('candidates');
    }

    public function index(){
        $data = [];
        $currentValues = [];
        if($this->subpage == 'create'){
            if(isset($_POST['create'])){
                $this->createCandidate($_POST);
            }
            $data = $this->candidatesModel->fetchAreas();
        }elseif($this->subpage == 'edit'){
            // var_dump($_POST);
            $id = isset($_GET['id']) ? htmlentities($_GET['id'], ENT_QUOTES) : '';
            if(isset($_POST['update'])){
                $this->updateCandidate($_POST,$id);
            }
            $data = $this->candidatesModel->allWhereIdRow('candidates','id',$id);
            $data['areas'] = $this->candidatesModel->fetchAreas();
            $currentValues = $this->getCandidacy($id);
        }else{
            // ($this->subpage == 'view'){
            $no = isset($_GET['no']) ? htmlentities($_GET['no'],ENT_QUOTES) : 1;
            $filter = isset($_GET['filter']) ? htmlentities($_GET['filter'],ENT_QUOTES) : 'all';
            $data = $this->candidatesModel->fetchCandidates($no,$filter);
            $this->count = $this->candidatesModel->countAll('candidates');
        }
        return $this->view('candidates/'.$this->subpage,$data,$currentValues,$this->count);
    }

    public function getCandidacy($id){
        $candidacy = ['area','district','ward'];
        $candidateOptions = [];
        $cans = $this->candidatesModel->allWhereIdRow('candidacy', 'candidate', $id);
        for ($i=0; $i < count($candidacy); $i++) { 
            for ($j=0; $j < count($cans); $j++) { 
                if($candidacy[$i] == $cans[$j]['running_for']){
                    $candidateOptions[$candidacy[$i]] = $this->candidatesModel->allWhereIdRow('areas','id',$cans[$j]['running_in']);
                }
            }
        }
        return $candidateOptions;
    }

    public function updateCandidate($post,$id){
        if (empty($_POST['running_for']) || empty($_POST['running_in'])) {
            $this->candidacyError();
            $this->oldValues($post);
            return false;
        }
        if (!$this->validateName($post['names'])) {
            $this->oldValues($post);
            return false;
        }
        if (!$this->candidatesModel->updateCandidate($post,$id)) {
            $_SESSION['alert']['message'] = 'Operation Failed, Try Again';
            $_SESSION['alert']['class'] = 'alert-danger';
            $this->oldValues($post);
            return false;
        }
        $_SESSION['alert']['message'] = 'Candidate Successfully Updated';
        $_SESSION['alert']['class'] = 'alert-success';
        return true;
    }

    public function createCandidate($post){
        if(empty($_POST['running_for']) || empty($_POST['running_in'])){
            $this->candidacyError();
            $this->oldValues($post);
            return false;
        }
        if(!$this->validateName($post['names'])){
            $this->oldValues($post);
            return false;
        }
        $names = $post['names'];
        $group = $post['political_group'];
        if($this->candidatesModel->allWhereIdCompare('candidates','names',$names,'political_group',$group)){
            $_SESSION['alert']['message'] = 'Candidate With Name and Affiliation Already Exists';
            $_SESSION['alert']['class'] = 'alert-danger';
            $this->oldValues($post);
            return false;
        }
        if(!$this->candidatesModel->storeCandidate($post)){
            $_SESSION['alert']['message'] = 'Operation Failed, Try Again';
            $_SESSION['alert']['class'] = 'alert-danger';
            $this->oldValues($post);
            return false;
        }
        $_SESSION['alert']['message'] = 'Candidate Successfully Added';
        $_SESSION['alert']['class'] = 'alert-success';
        return true;
    }

    public function validateName($names){
        //validate voter names
        if (!preg_match("/^[a-zA-Z-' ]*$/", $names)) {
            $_SESSION['error']['names'] = 'Name Must Be Letters Only';
            return false;
        }
        return true;
    }

    public function candidacyError(){
        $_SESSION['alert']['message'] = 'Select At Least One Candidacy';
        $_SESSION['alert']['class'] = 'alert-danger';
        return true;
    }

    public function oldValues($post){
        $_SESSION['old']['names'] = $post['names'];
        $_SESSION['old']['political_group'] = $post['political_group'];
        return true;
    }
}