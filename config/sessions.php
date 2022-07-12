<?php
    //unset session variables after they have been displayed on a page
    unset($_SESSION['validation']);
    unset($_SESSION['old']);
    unset($_SESSION['error']);
    unset($_SESSION['alert']);