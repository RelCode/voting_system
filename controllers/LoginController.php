<?php
require_once('./library/Controller.php');
class LoginController extends Library\Controller {
    public function __construct(){
        $this->loginModel = $this->model('login');
    }

    public function index(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $this->userLogin($_POST);
        }
        return $this->view('login');
    }

    public function userLogin($post){
        if(!$this->validEmail($post['email'])){
            return;
        }
        //get user data
        $admin = $this->loginModel->getAdmin($post['email']);
        //check if user with this email address is registered
        if(empty($admin)){
            $_SESSION['validation']['email'] = 'email not registered';
            $_SESSION['old']['email'] = $post['email'];
            return;
        }
        //compare passwords to attemp login
        if(!password_verify($post['pword'],$admin['password'])){
            $_SESSION['error']['login'] = 'invalid login details';
            return;
        }
        //check if email address is verified
        if($admin['email_verified'] == 'N'){
            $_SESSION['validation']['email'] = 'account not verified. Check your email';
            return;
        }
        $_SESSION['admin']['id'] = $admin['id'];
        $_SESSION['admin']['name'] = $admin['name'];
        $_SESSION['admin']['email'] = $admin['email'];
        $_SESSION['admin']['level'] = $admin['level'];
        $_SESSION['loggedIn'] = true;
        header('location:?page=home');
        // var_dump($admin);
    }

    public function validEmail($email){
        if(filter_var($email,FILTER_VALIDATE_EMAIL)){
            return true;
        }
        $_SESSION['validation']['email'] = 'Invalid Email Address';
        $_SESSION['old']['email'] = $email;
        return false;
    }
}