<?php
    include("services/UserService.php");

    class LoginController{
        public function index(){
            include("views/login/login.php");
        }

        public function showAllUser(){
            $userService = new UserService();
            $user = $userService-> getAllUser();
            
            include("views/user/user.php");
        }
    }
?>   