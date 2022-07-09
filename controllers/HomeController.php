<?php
require_once('./library/Controller.php');
class HomeController extends Library\Controller {
    public function __construct(){
        $this->homeModel = $this->model('home');
    }

    public function index(){
        // var_dump($this->homeModel);
        return $this->view('home');
    }
}