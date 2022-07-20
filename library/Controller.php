<?php
namespace Library;
class Controller {
    public function model($model){
        require_once('./models/'.ucfirst($model).'.php');
        return new $model();
    }
    //currentValue will be used mostly when a view used to edit is selected
    public function view($view,$data = [],$currentValues= [],$count = 0){
        require_once('./views/'.$view.'.php');
    }
}