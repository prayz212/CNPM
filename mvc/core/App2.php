<?php
class App2{
    function __construct(){
        require_once "./mvc/controllers/Account.php";
        $controller = new Account();
        call_user_func_array([$controller, "Login"], [] );
    }
}
?>