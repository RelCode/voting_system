<?php
    //include core config file
    require_once('./config/core.php');

    //the scaffolding starts here:: inclusion of header & nav
    require_once('./views/layouts/header.php');
    //check if current page is navigatable, else display 404 page
    if(in_array($page,$navigatable)){
        $ctrl = ucfirst($page) . 'Controller'; //eg: HomeController with $page == 'Home'
        require_once('./controllers/'.$ctrl.'.php');
        $controller = new $ctrl();
        $controller->index();
    }else{
        require('./views/404.php');
    }
    require_once('./views/layouts/footer.php');
    //after a page load we add session handler to remove session values passed
    require('./config/sessions.php');