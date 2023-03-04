<?php
    include("services/UserService.php");

    class LogoutController{
        public function index(){
            $userService = new UserService();
            $userLogOut = $userService->userLogOut();
            include("views/login/login.php");
            
        }
      
      
    }
?>   