<?php
    include("services/UserService.php");

    class SignUpController{
        public function index(){
            include("views/login/signUp.php");
            
        }

        public function processSignUp(){
            $userService = new UserService();
            $processSignUpUser = $userService->signUpUser();

        }
      
    }
?>   