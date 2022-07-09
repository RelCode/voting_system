<?php
    session_start();
    $page = isset($_GET['page']) ? $_GET['page'] : 'home';//get current page, else set it to default::HOME
    $_SESSION['url']['page'] = $page;
    $subpage = isset($_GET['subpage']) ? $_GET['subpage'] : '';
    $no = isset($_GET['no']) ? $_GET['no'] : 1; //this number is used for pagination, when needed

    /*admin must be logged in to use the  application
    //if the admin is not logged in, we check if the current page is login.php, else redirect
    */
    if (!isset($_SESSION['loggedIn']) && $page != 'login') {
        header('location:?page=login');
    }

    //a list of navigatable pages in the application
    $navigatable = ['home','login'];