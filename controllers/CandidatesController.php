<?php
require_once('./library/Controller.php');
class CandidatesController extends Library\Controller {
    public $subpage;
    public function __construct()
    {
        $this->subpage = isset($_GET['subpage']) ? $_GET['subpage'] : 'view';
        $this->candidatesModel = $this->model('candidates');
    }

    public function index(){
        $data = [];
        if($this->subpage == 'view'){
            $no = isset($_GET['no']) ? htmlentities($_GET['no'],ENT_QUOTES) : 1;
            $filter = isset($_GET['filter']) ? htmlentities($_GET['filter'],ENT_QUOTES) : 'all';
            $data = $this->candidatesModel->fetchCandidates($no,$filter);
        }elseif($this->subpage == 'create'){
            $data = $this->candidatesModel->fetchAreas();
        }
        return $this->view('candidates/'.$this->subpage,$data);
    }
}